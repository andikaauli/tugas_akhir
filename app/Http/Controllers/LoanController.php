<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Eksemplar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $loan = Loan::with(['eksemplar', 'member', 'eksemplar.biblio'])->get();
        if ($search) {
            $loan = Loan::where('member.name', 'LIKE', "%$search%")
                ->orWhere('member.nim', 'LIKE', "%$search%")->get();
        }
        return response()->json($loan, 200);
    }

    public function showData($id)
    {
        $loan = Loan::with(['eksemplar', 'eksemplar.bookstatus', 'member', 'eksemplar.biblio'])->findOrFail($id);
        return response()->json($loan, 200);
    }
    public function peminjaman(Request $request, $id)
    {
        //kasih kondisi klo kode eksemplar yg dicari barang hilang gagal
        //kasih update untuk ketika eksemplar tersedia berubah menjadi dipinjam
        $validator = Validator::make($request->all(), [
            'eksemplar_id' => ['required', 'exists:eksemplar,id'],
        ]);

        $member = Member::find($id);

        $bookstatus = Eksemplar::where('item_code', $request->item_code)->first('book_status_id');

        if ($bookstatus['book_status_id'] != '2') {
            return response()->json(['message' => 'Eksemplar tidak dapat Dipinjam!'], 422);
        }

        $eksemplar = Eksemplar::with(['bookstatus', 'biblio:id,title,author_id', 'biblio.author:id,title'])->where('item_code', $request->item_code)->first();
        $loan = Loan::create([
            "eksemplar_id" => $eksemplar->id,
            "member_id" => $member->id,
            "loan_date" => now(),
            "due_date" => now()->addDays(7),
            "loan_status" => 'Sedang dipinjam',
        ]);

        $eksemplar->update([
            'book_status_id' => 1
        ]);

        return response()
            ->json(['message' => 'Proses peminjaman berhasil ditambahkan!', 'data' => $loan, 'eksemplar' => $eksemplar, 'member' => $member]);
    }

    public function perpanjang(Request $request, $id)
    {
        $loan = Loan::find($id);
        $loan->update([
            'due_date' => Carbon::parse($loan->due_date)->addDays(7)
        ]);
        $loan->refresh();
        return response()
            ->json(['message' => 'Proses perpanjangan buku menjadi ' . ($loan->due_date), 'data' => $loan]);
    }
    public function destroyData(Request $request, $id)
    { //hard delete
        $loan = Loan::find($id);
        $eksemplar = Eksemplar::find($loan->eksemplar_id);
        $eksemplar->update([
            'book_status_id' => 2
        ]);
        $loan->forceDelete();
        return response()
            ->json(['message'=>'Peminjaman Eksemplar dibatalkan!', 'data'=>$loan]);

            //kalo hapus juga merubah status eksemplar
    }

    public function pengembalian(Request $request, $id)
    {
        $loan = Loan::find($id);
        $loan->update([
            'return_date' => now(),
        ]);
        $eksemplar = Eksemplar::find($loan->eksemplar_id);
        $eksemplar->update([
            'book_status_id' => 2
        ]);

        if (Carbon::now()->isAfter(Carbon::parse($loan->due_date))) {
            $loan->update([
                'loan_status' => 'Dikembalikan Terlambat'
            ]);
        } else {
            $loan->update([
                'loan_status' => 'Dikembalikan Tepat Waktu'
            ]);
        }

        $loan->refresh();
        return response()
            ->json(['message' => 'Eksemplar berhasil dikembalikan!', 'data' => $loan]);
    }


    // function peminjaman(Request $req)
    // {
    //     $loanDate = now(); // YYYY-MM-DD | 2023-10-06
    //     $dueDate = now()->addDays(7); // YYYY-MM-DD | 2023-10-13
    // }
    // function perpanjang($loanID)
    // {
    //     $loan = Loan::find($loanID);

    //     $loan->update([
    //         "due_date" => Carbon::parse($loan->due_date)->addDays(7),
    //     ]);
    // }
}

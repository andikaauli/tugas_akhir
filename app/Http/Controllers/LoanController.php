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
        $member = $request->member;
        $loan = Loan::with(['eksemplar', 'member', 'eksemplar.biblio', 'eksemplar.biblio.colltype']);
        // $loan = Loan::with(['member']);

        if ($member) {
            $loan = $loan->where('member_id', $member);
        }


        if ($search) {
            $loan = $loan
                ->whereHas("member", function ($b) use ($search) {
                    $b->where('name', 'LIKE', "%$search%")->orWhere('nim', 'LIKE', "%$search%");
                })

                ->orWhereHas("eksemplar", function ($b) use ($search) {
                    $b->where('item_code', 'LIKE', "%$search%");
                })

                ->orWhereHas("eksemplar.biblio", function ($b) use ($search) {
                    $b->where('title', 'LIKE', "%$search%");
                })

                ->orWhere('loan_status', 'LIKE', "%$search%");
        }

        $loan = $loan->get();
        return response()->json($loan, 200);
    }

    public function showData($id)
    {
        $loan = Loan::with(['eksemplar', 'eksemplar.bookstatus', 'member', 'eksemplar.biblio'])->findOrFail($id);
        return response()->json($loan, 200);
    }


    public function peminjaman(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'item_code' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $member = Member::find($id);

        $eksemplar = Eksemplar::with(['bookstatus', 'biblio', 'biblio.colltype'])->where('item_code', $request->item_code)->first();

        if ($eksemplar) {
            $bookstatus = Eksemplar::where('item_code', $request->item_code)->first('book_status_id');
            if ($bookstatus['book_status_id'] != '2') {

                return response()->json(['message' => 'Eksemplar tidak dapat Dipinjam!'], 422);
            } else {
                $loan = Loan::create([
                    "eksemplar_id" => $eksemplar->id,
                    "member_id" => $member->id,
                    "loan_date" => now(),
                    "due_date" => now()->addDays(7),
                    "loan_status" => null,
                    'return_status' => '0',
                ]);

                $eksemplar->update([
                    'book_status_id' => 1
                ]);

                return response()->json(['message' => 'Proses peminjaman berhasil ditambahkan!', 'data' => $loan, 'eksemplar' => $eksemplar, 'member' => $member]);
            }
        }
        return response()->json(['message' => 'Eksemplar dengan kode ' . ($request->item_code) . ' tidak tersedia'], 404);
    }

    public function selesai_transaksi($member)
    {
        $loan = Loan::where('member_id', $member)->whereNull('loan_status')->get();

        foreach ($loan as $item) {
            $item->loan_status = "Sedang Dipinjam";
            $item->save();
        }

        return response()->json($loan, 200);
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
                'loan_status' => 'Terlambat Kembali',
                'return_status' => '2'
            ]);
        } else {
            $loan->update([
                'loan_status' => 'Telah Kembali',
                'return_status' => '1'
            ]);
        }

        $loan->refresh();
        return response()
            ->json(['message' => 'Eksemplar berhasil dikembalikan!', 'data' => $loan, 'eksemplar' => $eksemplar]);
    }

    public function pengembalianButton(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_code' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors(), 'message' => 'Masukkan Kode Eksemplar Yang Akan Dikembalikan'], 422);
            // return response()->json(['message' => 'Eksemplar dengan kode ' . ($request->item_code) . ' tidak tersedia'], 404);

        }

        $eksemplar = Eksemplar::get()->where('item_code', $request->item_code)->first();

        if ($eksemplar) {
            $loan = Loan::whereHas('eksemplar', function ($query) use ($request) {
                return $query->where('item_code', $request->item_code);
            })->where('return_date', null);
            $loanData = $loan->first();
            $countData = $loan->count();
            if ($countData == 1) {
                $loanData->update([
                    'return_date' => now(),
                ]);
                $eksemplar->update([
                    'book_status_id' => 2
                ]);
                if (Carbon::now()->isAfter(Carbon::parse($loanData->due_date))) {
                    $loanData->update([
                        'loan_status' => 'Terlambat Kembali',
                        'return_status' => '2'

                    ]);
                } else {
                    $loanData->update([
                        'loan_status' => 'Telah Kembali',
                        'return_status' => '1'

                    ]);
                }
                $loanData->refresh();
                return response()->json(['message' => 'Eksemplar berjudul '.($eksemplar->biblio->title).' dengan kode ' . ($request->item_code) . ' berhasil dikembalikan!', 'data' => $loanData, 'eksemplar' => $eksemplar]);
            } else {
                return response()->json(['message' => 'Eksemplar dengan kode ' . ($request->item_code) . ' tidak ada di peminjaman!']);
            }
        }
        return response()->json(['message' => 'Eksemplar dengan kode ' . ($request->item_code) . ' tidak tersedia'], 404);
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
            ->json(['message' => 'Peminjaman Eksemplar dibatalkan!', 'data' => $loan]);
    }
}

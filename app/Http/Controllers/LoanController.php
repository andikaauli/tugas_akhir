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
        $loan = Loan::with(['eksemplar','member','eksemplar.biblio'])->get();
        if ($search) {
            $loan = Loan::where('member.name', 'LIKE', "%$search%")
            ->orWhere('member.nim', 'LIKE', "%$search%")->get();
        }
        return response()->json($loan, 200);
    }

    public function showData($id)
    {
        $loan = Loan::with(['eksemplar','eksemplar.bookstatus','member','eksemplar.biblio'])->findOrFail($id);
        return response()->json($loan, 200);
    }
    public function peminjaman(Request $request, $id)
    {
        //kasih kondisi klo kode eksemplar yg dicari barang hilang gagal
        //kasih update untuk ketika eksemplar tersedia berubah menjadi dipinjam

        // $validator = Validator::make($request->all(), [
        //     'eksemplar_id' => ['required', 'exists:eksemplar,id'],
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $validator = Validator::make($request->all(), [
            'eksemplar_id' => ['required', 'exists:eksemplar,id'],
        ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        $bookstatus = Eksemplar::findOrFail($request->eksemplar_id)->only('book_status_id');

        if($bookstatus['book_status_id'] != '2'){
            return response()->json(['message'=>'Eksemplar tidak dapat Dipinjam!'], 422);
         }

        $member = Member::findOrFail($id);
        $eksemplar = Eksemplar::with(['bookstatus','biblio:id,title,author_id','biblio.author:id,title'])->findOrFail($request->eksemplar_id)->only('item_code','book_status_id','bookstatus','biblio');

        $loan = Loan::create([
            "eksemplar_id" => $request->eksemplar_id,
            "member_id" => $member->id,
            "loan_date" => now(),
            "due_date" => now()->addDays(7),
        ]);

        return response()
            ->json(['message'=>'Proses peminjaman berhasil ditambahkan!', 'data'=>$loan, 'eksemplar'=>$eksemplar, 'member'=>$member]);
    }

    public function perpanjang(Request $request, $id)
    {
        $loan = Loan::find($id);
        $loan->update([
            'due_date'=> Carbon::parse($loan->due_date)->addDays(7),
        ]);
        $loan->refresh();
        return response()
            ->json(['message'=>'Proses perpanjangan buku menjadi '.($loan->due_date), 'data'=>$loan]);
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Eksemplar;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $loan = Loan::with(['eksemplar','member'])->get();
        if ($search) {
            $loan = Loan::where('member.name', 'LIKE', "%$search%")
            ->orWhere('member.nim', 'LIKE', "%$search%")->get();
        }
        return response()->json($loan, 200);
    }

    public function showData($id)
    {
        $loan = Loan::with(['eksemplar','member'])->findOrFail($id);
        return response()->json($loan, 200);
    }
    public function peminjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eksemplar_id' => ['required', 'exists:eksemplar,id'], //bentukan kalo ada foreign
        ]);
        $loanDate = now();
        $dueDate = now()->addDays(7);
        return response()
            ->json(['message'=>'Biblio baru berhasil ditambahkan!', 'data'=>$biblio]);
    }

    public function perpanjang(Request $request, $id)
    {
        $loan = Loan::find($id);
        $loan->update([
            'due_date'=> Carbon::parse($loan->due_date)->addDays(7),
        ]);
    }




}

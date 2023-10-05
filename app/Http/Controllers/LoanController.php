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
    public function getData()
    {
        $loan = Loan::with(['eksemplar','member'])->get();
        return response()->json($loan, 200);
    }

    public function showData($id)
    {
        $loan = Loan::with(['eksemplar','member'])->get();
        return response()->json($loan, 200);
    }


}

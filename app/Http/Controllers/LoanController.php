<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Eksemplar;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
	public function getData()
	{
		$loan = Loan::with(['eksemplar', 'member'])->get();
		return response()->json($loan, 200);
	}

	public function showData($id)
	{
		$loan = Loan::with(['eksemplar', 'member'])->get();
		return response()->json($loan, 200);
	}

	function peminjaman(Request $req)
	{
		$loanDate = now(); // YYYY-MM-DD | 2023-10-06
		$dueDate = now()->addDays(7); // YYYY-MM-DD | 2023-10-13
	}
	function perpanjang($loanID)
	{
		$loan = Loan::find($loanID);

		$loan->update([
			"due_date" => Carbon::parse($loan->due_date)->addDays(7),
		]);
	}
}

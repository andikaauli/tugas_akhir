<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Biblio;
use App\Models\Member;
use App\Models\Visitor;
use App\Models\Eksemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
	public function getData()
	{
		return view('petugas.beranda.beranda');
	}
	public function index(Request $request)
	{
		$search = $request->search;
		$http = new Request();
		$http = $http->create(url('api') . '/visitor', 'GET', ['search' => $search]);

		$visitors = Visitor::whereHas("type", function ($b) use ($search) {
			$b->where('name', 'LIKE', "%$search%");
		})->orWhere('name', 'LIKE', "%$search%")->orWhere('institution', 'LIKE', "%$search%")->orWhere('created_at', 'LIKE', "%$search%")->paginate(10);


		$memberReq = new Request();
		$memberReq = $memberReq->create(url('api') . '/member/');
		$member = Member::get();

		$biblioReq = new Request();
		$biblioReq = $biblioReq->create(url('api') . '/biblio/');
		$bibilio = Biblio::get();

		$eksemplarReq = new Request();
		$eksemplarReq = $eksemplarReq->create(url('api') . '/eksemplar/');
		$eksemplar = Eksemplar::get();

		$loanReq = new Request();
		$loanReq = $loanReq->create(url('api') . '/loan/');

		$loans = Loan::get();
		// dd($loans);
		$fillterloan = $loans->filter(function ($loan) {
			return $loan->return_status == '0';
		});

		return view('petugas/beranda/beranda', ['visitors' => $visitors, 'members' => $member, 'biblios' => $bibilio, 'eksemplars' => $eksemplar, 'loans' => $fillterloan]);
	}

	// public function edit(Request $request)
	// {
	//     $http = new Request();
	//     $http = $http->create(url('api') . '/user/' . '9a77f60f-0538-466e-9382-73eb8bf92dd4');
	//     $response = app()->handle($http);
	//     $response = $response->getContent();

	//     $profil = json_decode($response);

	//     dd($profil);

	// return view('petugas/beranda/edit-profil', ['profils' => $profil]);
	// }

	public function update(Request $request, $id)
	{
		$http = new Request();
		$http = $http->create(url('api') . '/user/edit/' . '9a77f60f-0538-466e-9382-73eb8bf92dd4', 'POST', $request->except('_method'));
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.edit-profil');
	}
}

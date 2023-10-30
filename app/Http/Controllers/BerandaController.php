<?php

namespace App\Http\Controllers;

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
        $http = $http->create(config('app.api_url') . '/visitor', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $profilReq = new Request();
        $profilReq = $profilReq->create(config('app.api_url') . '/user/', 'GET' );
        $profilRes = app()->handle($profilReq);
        $profilRes = $profilRes->getContent();

        $memberReq = new Request();
        $memberReq = $memberReq->create(config('app.api_url') . '/member/', 'GET' );
        $memberRes = app()->handle($memberReq);
        $memberRes = $memberRes->getContent();

        $biblioReq = new Request();
        $biblioReq = $biblioReq->create(config('app.api_url') . '/biblio/', 'GET' );
        $biblioRes = app()->handle($biblioReq);
        $biblioRes = $biblioRes->getContent();

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(config('app.api_url') . '/eksemplar/', 'GET' );
        $eksemplarRes = app()->handle($eksemplarReq);
        $eksemplarRes = $eksemplarRes->getContent();

        $loanReq = new Request();
        $loanReq = $loanReq->create(config('app.api_url') . '/loan/', 'GET' );
        $loanRes = app()->handle($loanReq);
        $loanRes = $loanRes->getContent();

        $biblio = json_decode($biblioRes);
        $eksemplar = json_decode($eksemplarRes);
        $member = json_decode($memberRes);
        $profil = json_decode($profilRes);
        $visitors = json_decode($response);
        $loans = json_decode($loanRes);
        $loans = array_filter($loans, function ($loan) {
            return $loan->return_status == '0';
        });

        // dd($loans);

        return view('petugas/beranda/beranda', ['visitors' => $visitors, 'profils' => $profil, 'members' => $member, 'eksemplars' => $eksemplar, 'loans' => $loans, 'biblios' => $biblio]);
    }

    public function edit($id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/user/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $profil = json_decode($response);

    return view('petugas/beranda/edit-profil', ['profils' => $profil]);
    }

    public function update(Request $request, $id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/user/edit/' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.visitors-history');
    }

}

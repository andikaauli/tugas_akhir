<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoansController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $loans = json_decode($response);
        // dd($loans);

        return view('petugas/sirkulasi/sejarah-peminjaman', ['loans' => $loans]);
    }

    public function overdue(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $loans = json_decode($response);
        $loans = array_filter($loans, function ($loan) {
            return $loan->return_status == '2';
        });
        // dd($loans);

        return view('petugas/sirkulasi/daftar-keterlambatan', ['loans' => $loans]);
    }
    public function copyout(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $loans = json_decode($response);
        $loans = array_filter($loans, function ($loan) {
            return $loan->return_status == '0';
        });
        // dd($loans);

        return view('petugas/bibliografi/eksemplar-keluar', ['loans' => $loans]);
    }

    public function fastreturn(Request $request, $id)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/loan/pengembaliankilat' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.authors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

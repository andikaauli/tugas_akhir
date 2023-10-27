<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockOpnamesController extends Controller
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
        $http = $http->create(config('app.api_url') . '/stockopname', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $stockopname = json_decode($response);

        // dd($stockopname);
        return view('petugas/inventarisasi/rekaman-inventarisasi', ['stockopnames' => $stockopname]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas/inventarisasi/inisialisasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/stockopname/add', 'POST', $request->all());
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }

        // return redirect()->route('client.authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/stockopname/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $stockopname = json_decode($response);

        // dd($stockopname);
        return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
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

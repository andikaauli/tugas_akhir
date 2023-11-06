<?php

namespace App\Http\Controllers\Client;

use App\Models\CollType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollTypesController extends Controller
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
        $http = $http->create(config('app.api_url') . '/colltype', 'GET', ['search' => $search]);
        $colltypes = CollType::where('title', 'LIKE', "%$search%")->paginate(10);

        return view('petugas/daftar-terkendali/daftar-tipe-koleksi', ['colltypes' => $colltypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas/daftar-terkendali/create-tipe-koleksi');
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
        $http = $http->create(config('app.api_url') . '/colltype/add', 'POST', $request->all());
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.colltypes');
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
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/colltype/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $colltypes = json_decode($response);


        return view('petugas/daftar-terkendali/edit-tipe-koleksi', ['colltypes' => $colltypes]);
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
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/colltype/edit/' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.colltypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deletedColltypesIdList = $request->deletedColltypes;

        if (!$deletedColltypesIdList) {
            return redirect()->back();
        }

        foreach ($deletedColltypesIdList as $colltypesId) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/colltype/destroy/' . $colltypesId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.colltypes');
    }
}

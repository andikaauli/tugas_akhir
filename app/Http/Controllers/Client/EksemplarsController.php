<?php

namespace App\Http\Controllers\Client;

use App\Models\Eksemplar;
use App\Models\BookStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EksemplarsController extends Controller
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
        $http = $http->create(url('api') . '/eksemplar', 'GET', ['search' => $search]);
        $eksemplar = Eksemplar::whereHas("biblio", function ($b) use ($search) {
            $b->where('title', 'LIKE', "%$search%");
        })->orwhereHas("bookstatus", function ($b) use ($search) {
            $b->where('name', 'LIKE', "%$search%");
        })->orWhere('item_code', 'LIKE', "%$search%")->paginate(10);

        $bs = new Request();
        $bs = $bs->create(url('api') . '/bookstatus', 'GET');
        $bookstatus = BookStatus::get();


        return view('petugas/bibliografi/eksemplar', ['eksemplar' => $eksemplar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bs = new Request();
        $bs = $bs->create(url('api') . '/bookstatus/');
        $bsres = app()->handle($bs);
        $bsres = $bsres->getContent();

        $bsApi = json_decode($bsres);

        return view('petugas/bibliografi/create-eksemplar', ['statuses' =>  $bsApi]);
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
        $http = $http->create(url('api') . '/eksemplar/add', 'POST', $request->all());
        $response = app()->handle($http);


        if ($response->isClientError()) {
            return redirect($request->fullUrl())->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.edit-bibliografi', ['id' => $request->biblio_id]);
        // return redirect()->route('client.bibliografi');
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
        $http = $http->create(url('api') . '/eksemplar/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        // dd($response);

        // ! Dari API
        $bs = new Request();
        $bs = $bs->create(url('api') . '/bookstatus/');
        $bsres = app()->handle($bs);
        $bsres = $bsres->getContent();
        $bsApi = json_decode($bsres);

        $eksemplar = json_decode($response);

        // dd($eksemplar);

        return view('petugas/bibliografi/edit-eksemplar', ['eksemplar' => $eksemplar], ['status' =>  $bsApi]);
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
        $http = $http->create(url('api') . '/eksemplar/edit/' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        // dd($response);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.eksemplar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deletedEksemplarIdList = $request->deletedEksemplar;

        if (!$deletedEksemplarIdList) {
            return redirect()->back();
        }

        foreach ($deletedEksemplarIdList as $eksemplarId) {
            $http = new Request();
            $http = $http->create(url('api') . '/eksemplar/destroy/' . $eksemplarId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.eksemplar');
    }
}

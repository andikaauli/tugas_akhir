<?php

namespace App\Http\Controllers\Client;

use App\Models\Biblio;
use App\Models\Eksemplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BiblioController extends Controller
{
    function getBiblio(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio', 'GET', ['search' => $search]);
        $bibliografi = Biblio::where('title', 'LIKE', "%$search%")->orWhere('title', 'LIKE', "%$search%")->paginate(5);

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(config('app.api_url') . '/eksemplar/');
        $eksemplar = Eksemplar::get();

        return view('petugas/bibliografi/bibliografi', ['bibliografi' => $bibliografi, 'eksemplars' => $eksemplar]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio', 'GET', ['search' => $search]);
        $bibliografi = Biblio::where('title', 'LIKE', "%$search%")->paginate(5);

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(config('app.api_url') . '/eksemplar/');
        $eksemplarRes = app()->handle($eksemplarReq);
        $eksemplarRes = $eksemplarRes->getContent();

        $eksemplar = json_decode($eksemplarReq);

        // dd($bibliografi);

        return view('dashboard/cari-koleksi', ['bibliografi' => $bibliografi, 'eksemplars' => $eksemplar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $pengarangReq = new Request();
        $pengarangReq = $pengarangReq->create(config('app.api_url') . '/author/');
        $pengarangRes = app()->handle($pengarangReq);
        $pengarangRes = $pengarangRes->getContent();

        $publisherReq = new Request();
        $publisherReq = $publisherReq->create(config('app.api_url') . '/publisher/');
        $publisherRes = app()->handle($publisherReq);
        $publisherRes = $publisherRes->getContent();

        $collTypeReq = new Request();
        $collTypeReq = $collTypeReq->create(config('app.api_url') . '/colltype/');
        $collTypeRes = app()->handle($collTypeReq);
        $collTypeRes = $collTypeRes->getContent();

        $pengarang = json_decode($pengarangRes);
        $publisher = json_decode($publisherRes);
        $collType = json_decode($collTypeRes);


        return view('petugas/bibliografi/create-bibliografi', ["pengarang" => $pengarang, "publishers" => $publisher, "colltypes"=> $collType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio/add', 'POST', $request->all(), files: $request->allFiles());
        $response = app()->handle($http);

        // dd($response);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.bibliografi');
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
        $http = $http->create(config('app.api_url') . '/biblio/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        // dd($response);

        $pengarangReq = new Request();
        $pengarangReq = $pengarangReq->create(config('app.api_url') . '/author/');
        $pengarangRes = app()->handle($pengarangReq);
        $pengarangRes = $pengarangRes->getContent();

        $publisherReq = new Request();
        $publisherReq = $publisherReq->create(config('app.api_url') . '/publisher/');
        $publisherRes = app()->handle($publisherReq);
        $publisherRes = $publisherRes->getContent();

        $collTypeReq = new Request();
        $collTypeReq = $collTypeReq->create(config('app.api_url') . '/colltype/');
        $collTypeRes = app()->handle($collTypeReq);
        $collTypeRes = $collTypeRes->getContent();

        $bibliografi = json_decode($response);
        $pengarang = json_decode($pengarangRes);
        $publisher = json_decode($publisherRes);
        $collType = json_decode($collTypeRes);

        // dd($bibliografi);

        return view('petugas/bibliografi/edit-bibliografi', ['bibliografi' => $bibliografi, "pengarang" => $pengarang, "publishers" => $publisher, 'colltypes'=> $collType]);
    }

    public function detail($id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        // dd($response);

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(config('app.api_url') . '/eksemplar/');
        $eksemplarRes = app()->handle($eksemplarReq);
        $eksemplarRes = $eksemplarRes->getContent();

        $bibliografi = json_decode($response);
        $eksemplar = json_decode($eksemplarRes);

        // dd($bibliografi);
        // dd($bibliografi);

        return view('dashboard/detail', ['bibliografi' => $bibliografi, "eksemplar" => $eksemplar]);
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
        $http = $http->create(config('app.api_url') . '/biblio/edit/' . $id, 'POST', $request->except('_method'), files: $request->allFiles());


        // ? 2 Cara filter request
        // ? EXCEPT from Request
        // $request->except('_method')

        // ? Array Filter
        // array_filter($request->all(), function ($key) {
        //     return $key != '_method';
        // }, ARRAY_FILTER_USE_KEY);

        $response = app()->handle($http);

        dd($response);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }


        return redirect()->route('client.bibliografi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);
        $deletedBiblioIdList = $request->deletedBiblio;
        // dd($deletedBiblioIdList);
        if (!$deletedBiblioIdList) {
            return redirect()->back();
        }

        foreach ($deletedBiblioIdList as $biblioId) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/biblio/destroy/' . $biblioId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.bibliografi');
    }
}

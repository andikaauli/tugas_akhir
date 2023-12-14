<?php

namespace App\Http\Controllers\Client;

use App\Models\Biblio;
use App\Models\Eksemplar;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use App\Http\Controllers\Controller;

class BiblioController extends Controller
{
    function getBiblio(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(url('api') . '/biblio', 'GET', ['search' => $search]);
        $bibliografi = Biblio::whereHas("author", function ($b) use ($search) {
            $b->where('title', 'LIKE', "%$search%");
        })->orWhere('title', 'LIKE', "%$search%")->orWhere('isbnissn', 'LIKE', "%$search%")->paginate(10);

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(url('api') . '/eksemplar/');
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
        $http = $http->create(url('api') . '/biblio', 'GET', ['search' => $search]);
        $bibliografi = Biblio::whereHas("author", function ($b) use ($search) {
            $b->where('title', 'LIKE', "%$search%");
        })->orWhere('title', 'LIKE', "%$search%")->orWhere('isbnissn', 'LIKE', "%$search%")->paginate(10);
        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(url('api') . '/eksemplar/');
        $eksemplar = Eksemplar::get();

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
        $errors = session('errors') ?? new ViewErrorBag();

        $pengarangReq = new Request();
        $pengarangReq = $pengarangReq->create(url('api') . '/author/');
        $pengarangRes = app()->handle($pengarangReq);
        $pengarangRes = $pengarangRes->getContent();

        $publisherReq = new Request();
        $publisherReq = $publisherReq->create(url('api') . '/publisher/');
        $publisherRes = app()->handle($publisherReq);
        $publisherRes = $publisherRes->getContent();

        $collTypeReq = new Request();
        $collTypeReq = $collTypeReq->create(url('api') . '/colltype/');
        $collTypeRes = app()->handle($collTypeReq);
        $collTypeRes = $collTypeRes->getContent();

        $pengarang = json_decode($pengarangRes);
        $publisher = json_decode($publisherRes);
        $collType = json_decode($collTypeRes);


        return view('petugas/bibliografi/create-bibliografi', ["pengarang" => $pengarang, "publishers" => $publisher, "colltypes" => $collType, "errors" => $errors]);
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
        $http = $http->create(url('api') . '/biblio/add', 'POST', $request->all(), files: $request->allFiles());
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.bibliografi')->with('success', 'Bibliografi berhasil ditambahkan!');
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
    public function edit(Request $request, $id)
    {
        $errors = session('errors') ?? new ViewErrorBag();
        $page = $request->page;
        $showModal = $request->has('showModal') || session()->has('showModal');
        try {
            $id = decrypt($id);
        } catch (\Throwable $th) {
            abort(404, 'Not Found');
        }
        $http = new Request();
        $http = $http->create(url('api') . '/biblio/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $pengarangReq = new Request();
        $pengarangReq = $pengarangReq->create(url('api') . '/author/');
        $pengarangRes = app()->handle($pengarangReq);
        $pengarangRes = $pengarangRes->getContent();


        $publisherReq = new Request();
        $publisherReq = $publisherReq->create(url('api') . '/publisher/');
        $publisherRes = app()->handle($publisherReq);
        $publisherRes = $publisherRes->getContent();


        $collTypeReq = new Request();
        $collTypeReq = $collTypeReq->create(url('api') . '/colltype/');
        $collTypeRes = app()->handle($collTypeReq);
        $collTypeRes = $collTypeRes->getContent();

        $bibliografi = json_decode($response);

        // if($bibliografi == null){
        //     abort(404, 'Not Found');
        // }

        $pengarang = json_decode($pengarangRes);
        $publisher = json_decode($publisherRes);
        $collType = json_decode($collTypeRes);

        $bs = new Request();
        $bs = $bs->create(url('api') . '/bookstatus/');
        $bsres = app()->handle($bs);
        $bsres = $bsres->getContent();

        $bsApi = json_decode($bsres);

        // dd($bibliografi);

        return view('petugas/bibliografi/edit-bibliografi', [
            'bibliografi' => $bibliografi, "pengarang" => $pengarang, "publishers" => $publisher,
            'colltypes' => $collType, 'statuses' => $bsApi, 'showModal' => $showModal, 'page' => $page, 'errors' => $errors
        ]);
    }

    public function detail($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Throwable $th) {
            abort(404, 'Not Found');
        }
        $http = new Request();
        $http = $http->create(url('api') . '/biblio/' .$id);
        $response = app()->handle($http);
        $response = $response->getContent();

        // dd($response);

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(url('api') . '/eksemplar/');
        $eksemplarRes = app()->handle($eksemplarReq);
        $eksemplarRes = $eksemplarRes->getContent();

        $bibliografi = json_decode($response);

        if($bibliografi == null){
            abort(404, 'Not Found');
        }

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
        // dd($request->all());
        $http = $http->create(url('api') . '/biblio/edit/' . decrypt($id), 'POST', $request->except('_method'), files: $request->allFiles());


        // ? 2 Cara filter request
        // ? EXCEPT from Request
        // $request->except('_method')

        // ? Array Filter
        // array_filter($request->all(), function ($key) {
        //     return $key != '_method';
        // }, ARRAY_FILTER_USE_KEY);

        $response = app()->handle($http);

        // dd($response);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
            // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }


        return redirect()->route('client.bibliografi', ['page' => $request->page])->with('success', 'Bibliografi berhasil diperbaharui!');
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
            $http = $http->create(url('api') . '/biblio/destroy/' . $biblioId, 'DELETE');
            $response = app()->handle($http);
        }

        // return redirect()->route('client.bibliografi')->with('destroy', 'Bibliografi berhasil dihapus!');
        $eksemplar = Eksemplar::where('biblio_id', $biblioId)->exists();
        if(!$eksemplar){
            return redirect()->route('client.bibliografi')->with('destroy', 'Bibliografi berhasil dihapus!');

        }
        return redirect()->route('client.bibliografi')->with('destroy', 'Biblio tidak dapat dihapus karena masih memiliki eksemplar');

    }
}

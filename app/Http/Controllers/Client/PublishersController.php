<?php

namespace App\Http\Controllers\client;

use App\Models\Publisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublishersController extends Controller
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
        $http = $http->create(config('app.api_url') . '/publisher', 'GET', ['search' => $search]);
        $publishers = Publisher::where('title', 'LIKE', "%$search%")->paginate(10);

        return view('petugas/daftar-terkendali/daftar-penerbit', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas/daftar-terkendali/create-penerbit');
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
        $http = $http->create(config('app.api_url') . '/publisher/add', 'POST', $request->all());
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

    return redirect()->route('client.publishers');
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
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/publisher/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $publisher = json_decode($response);

        return view('petugas/daftar-terkendali/edit-penerbit', ['publisher' => $publisher]);
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
        $http = $http->create(config('app.api_url') . '/publisher/edit/' . $id, 'POST', $request->except('_method'));
        $response = app()->handle($http);

        // dd($response->getContent)();

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.publishers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deletedPublishersIdList = $request->deletedPublishers;

        if (!$deletedPublishersIdList) {
            return redirect()->back();
        }

        foreach ($deletedPublishersIdList as $publishersId) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/publisher/destroy/' . $publishersId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.publishers');
    }
}

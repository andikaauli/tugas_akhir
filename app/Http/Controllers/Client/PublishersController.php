<?php

namespace App\Http\Controllers\Client;

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
		$http = $http->create(url('api') . '/publisher', 'GET', ['search' => $search]);
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
		$http = $http->create(url('api') . '/publisher/add', 'POST', $request->all());
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.publishers')->with('success', 'Penerbit berhasil ditambahkan!');
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
        try {
            $id = decrypt($id);
        } catch (\Throwable $th) {
            abort(404, 'Not Found');
        }
		$http = new Request();
		$http = $http->create(url('api') . '/publisher/' . $id);
		$response = app()->handle($http);
		$response = $response->getContent();

		$publisher = json_decode($response);
        if($publisher == null){
            abort(404, 'Not Found');
        }

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
		$http = $http->create(url('api') . '/publisher/edit/' . decrypt($id), 'POST', $request->except('_method'));
		$response = app()->handle($http);

		// dd($response);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.publishers')->with('success', 'Penerbit berhasil diperbaharui!');
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
			$http = $http->create(url('api') . '/publisher/destroy/' . $publishersId, 'DELETE');
			$response = app()->handle($http);
		}

		return redirect()->route('client.publishers')->with('destroy', 'Penerbit berhasil dihapus!');
	}
}

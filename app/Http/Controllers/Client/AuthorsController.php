<?php

namespace App\Http\Controllers\Client;

use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorsController extends Controller
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
		$http = $http->create(url('api') . '/author', 'GET', ['search' => $search]);
		// $response = app()->handle($http);
		// $response = $response->getContent();
		// $authors = json_decode($response);
		$authors = Author::where('title', 'LIKE', "%$search%")->paginate(5);
		// dd($authors);


		return view('petugas/daftar-terkendali/daftar-pengarang', ['authors' => $authors]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('petugas/daftar-terkendali/create-pengarang');
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
		$http = $http->create(url('api') . '/author/add', 'POST', $request->all());
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}


		return redirect()->route('client.authors');
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
		$http = $http->create(url('api') . '/author/' . $id);
		$response = app()->handle($http);
		$response = $response->getContent();

		$authors = json_decode($response);

		return view('petugas/daftar-terkendali/edit-pengarang', ['author' => $authors]);
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
		$http = $http->create(url('api') . '/author/edit/' . $id, 'POST', $request->except('_method'));
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		// dd($response);

		return redirect()->route('client.authors');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$deletedAuthorsIdList = $request->deletedAuthors;

		if (!$deletedAuthorsIdList) {
			return redirect()->back();
		}

		foreach ($deletedAuthorsIdList as $authorsId) {
			$http = new Request();
			$http = $http->create(url('api') . '/author/destroy/' . $authorsId, 'DELETE');
			$response = app()->handle($http);
		}

		return redirect()->route('client.authors');
	}
}

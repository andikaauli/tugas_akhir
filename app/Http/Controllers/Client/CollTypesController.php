<?php

namespace App\Http\Controllers\Client;

use App\Models\Biblio;
use App\Models\CollType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
		$http = $http->create(url('api') . '/colltype', 'GET', ['search' => $search]);
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
		$http = $http->create(url('api') . '/colltype/add', 'POST', $request->all());
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.colltypes')->with('success', 'Tipe Koleksi berhasil ditambahkan!');
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
        try {
            $id = decrypt($id);
        } catch (\Throwable $th) {
            abort(404, 'Not Found');
        }
		$http = new Request();
		$http = $http->create(url('api') . '/colltype/' . $id);
		$response = app()->handle($http);
		$response = $response->getContent();

		$colltypes = json_decode($response);
        // if($colltypes == null){
        //     abort(404, 'Not Found');
        // }

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
		$http = $http->create(url('api') . '/colltype/edit/' . decrypt($id), 'POST', $request->except('_method'));
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}

		return redirect()->route('client.colltypes')->with('success', 'Tipe Koleksi berhasil diperbaharui!');
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
			$http = $http->create(url('api') . '/colltype/destroy/' . $colltypesId, 'DELETE');
			$response = app()->handle($http);
		}

        $colltype = CollType::find($colltypesId);
        $biblio = Biblio::where('coll_type_id', $colltypesId)->first();

        if($biblio && $biblio->coll_type_id == $colltype->id){
            return redirect()->route('client.colltypes')->with('destroy', 'Tipe Koleksi tidak dapat dihapus');
        }

		return redirect()->route('client.colltypes')->with('destroy', 'Tipe Koleksi berhasil dihapus!');
	}
}

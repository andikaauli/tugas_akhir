<?php

namespace App\Http\Controllers\Client;

use App\Models\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$search = $request->search;
		$http = new Request();
		$http = $http->create(url('api') . '/visitor', 'GET', ['search' => $search]);
		$visitors = Visitor::where('name', 'LIKE', "%$search%")->paginate(10);

		// dd($visitors);

		return view('petugas/beranda/beranda', ['visitors' => $visitors]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function create()
	{
		$typeReq = new Request();
		$typeReq = $typeReq->create(url('api') . '/type/');
		$typeRes = app()->handle($typeReq);
		$typeRes = $typeRes->getContent();

		$type = json_decode($typeRes);
		// dd($type);

		return view('dashboard/absen', ["type" => $type]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// dd($request->all());
		$http = new Request();
		$http = $http->create(url('api') . '/visitor/add', 'POST', $request->all());
		$response = app()->handle($http);
		// dd($response);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
			// throw ValidationException::withMessages((array) json_decode($response->getContent()));
		}
		// dd($request->all());


		return redirect()->route('client.visitors');
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

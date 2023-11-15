<?php

namespace App\Http\Controllers\Client;

use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\StockTakeItem;
use PDF;

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
		$http = $http->create(url('api') . '/stockopname', 'GET', ['search' => $search]);
		$stockopname = StockOpname::where('name', 'LIKE', "%$search%")->paginate(10);

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
		$http = $http->create(url('api') . '/stockopname/add', 'POST', $request->all());
		$response = app()->handle($http);

		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
		}

		$response = json_decode($response->getContent());

		session(["active_inventarisasi" => $response->id]);

		return redirect()->route('client.stockOpnameRecord');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id, Request $request)
	{
		$search = $request->search;

		$http = new Request();
		$http = $http->create(url('api') . '/stockopname/' . $id, 'GET', ['search' => $search]);
		// if ($search) {
		//     $stockopname = $stockopname->whereHas('stocktakeitem', function ($q) use ($search) {
		//         $q->whereHas('eksemplar', function ($q) use ($search) {
		//             $q->whereHas('biblio', function ($q) use ($search) {
		//                 $q->where('title', 'like', '%' . $search . '%');
		//             })->orWhere('item_code', 'like', '%' . $search . '%');
		//         });
		//     });
		// }
		$response = app()->handle($http);
		$response = $response->getContent();

		$stockopname = json_decode($response);

		// dd($stockopname);
		return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
	}

    public function downloadPDF($id, Request $request)
	{
		$http = new Request();
		$http = $http->create(url('api') . '/stockopname/' . $id, 'GET');
		$response = app()->handle($http);
		$response = $response->getContent();
		$stockopname = json_decode($response);

        $pdf = PDF::loadView('petugas/inventarisasi/download-pdf', ['stockopnames' => $stockopname]);
        return $pdf->download($stockopname->name . '.pdf');

		return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
	}

	// public function gone(Request $request)
	// {
	//     $active_inventarisasi = Session::get('active_inventarisasi');

	//     $search = $request->search;
	//     $http = new Request();
	//     $http = $http->create(url('api') . '/stockopname/' . $active_inventarisasi, 'GET', parameters:[
	//         "hilang" => true,
	//         'search' => $search
	//     ]);
	//     $response = app()->handle($http);
	//     $response = $response->getContent();
	//     $stockopname = json_decode($response);

	//     // dd($stockopname);
	//     return view('petugas/inventarisasi/eksemplar-hilang', ['stockopnames' => $stockopname]);
	// }
	public function gone(Request $request)
	{
		$active_inventarisasi = Session::get('active_inventarisasi');

		$search = $request->search;
		$http = new Request();
		$http = $http->create(url('api') . '/stockopname/' . $active_inventarisasi, 'GET', parameters: [
			"hilang" => true,
			// 'search' => $search
		]);

		$stockopname = StockTakeItem::with(['eksemplar', 'eksemplar.biblio']);

		$stockopname = $stockopname->whereHas('stockopname', function ($query) {
			$query->whereNull('end_date');
		});

		$stockopname = $stockopname
			->whereHas("eksemplar.biblio", function ($b) use ($search) {
				$b->where('item_code', 'LIKE', "%$search%")->orWhere('title', 'LIKE', "%$search%");
			});

		$stockopnames = $stockopname->get();
		$stockopnames = $stockopnames->filter(function ($stockopname) {
			return $stockopname->book_status_id == '3';
		})->paginate(10);

		// dd($stockopnames);
		return view('petugas/inventarisasi/eksemplar-hilang', ['stockopnames' => $stockopnames]);
	}

	public function laporan(Request $request)
	{
		$active_inventarisasi = Session::get('active_inventarisasi');

		$http = new Request();
		$http = $http->create(url('api') . '/stockopname/' . $active_inventarisasi, 'GET');
		$response = app()->handle($http);
		$response = $response->getContent();

		$stockopname = json_decode($response);
		// dd($stockopname);

		return view('petugas/inventarisasi/laporan-inventarisasi', ['stockopnames' => $stockopname]);
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

	function end()
	{
		$active_inventarisasi = Session::get('active_inventarisasi');

		$http = new Request();
		$http = $http->create(url('api') . '/stockopname/finish/' . $active_inventarisasi, 'POST');
		$response = app()->handle($http);



		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
		}

		Session::forget('active_inventarisasi');

		return redirect()->route('client.stockOpnameRecord');
	}
}

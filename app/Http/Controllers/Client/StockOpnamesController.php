<?php

namespace App\Http\Controllers\Client;

use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Models\StockTakeItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
		$stockopname = StockOpname::where('stockopname_name', 'LIKE', "%$search%")->paginate(10);

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
        try {
            $id = decrypt($id);
        } catch (\Throwable $th) {
            abort(404, 'Not Found');
        }

		// $http = new Request();
		// $http = $http->create(url('api') . '/stockopname/' . $id, 'GET', ['search' => $search]);
        $stockopname = StockOpname::where('id', $id)->get();
        $stockopname['total_tersedia'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 2)->count();
        $stockopname['total_hilang'] =  $stockopname[0]->stocktakeitem()->where('book_status_id', 3)->count();
        $stockopname['total_dipinjam'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 1)->count();
        $stockopname['total_eksemplar'] = $stockopname[0]->stocktakeitem()->count();
        $stockopname['total_diperiksa'] = $stockopname[0]->stocktakeitem()->whereIn('book_status_id', [2, 3])->count();
        $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;


        // $stockopname['total_tersedia'] = $stocktakeitem->where('book_status_id', 2)->count();

        // $stocktakeitem = StockTakeItem::where('stock_opname_id', $id)->get();
        // dd($stockopname);
		// $response = app()->handle($http);
		// $response = $response->getContent();

		// $stockopname = json_decode($response);
        // dd($stockopname);
		return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
	}

    public function downloadPDF($id, Request $request)
	{
		// $http = new Request();
		// $http = $http->create(url('api') . '/stockopname/' . $id, 'GET');
		// $response = app()->handle($http);
		// $response = $response->getContent();
		// $stockopname = json_decode($response);
        // dd($stockopname);
        // $pdf = PDF::loadView('petugas/inventarisasi/download-pdf', ['stockopnames' => $stockopname]);
        // return $pdf->download('Laporan Hasil StockOpname '. $stockopname->name . '.pdf');

		// return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
         // Fetch stockopname data directly from the controller

        $stockopname = StockOpname::where('id', $id)->get();
        $stockopname['total_tersedia'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 2)->count();
        $stockopname['total_hilang'] =  $stockopname[0]->stocktakeitem()->where('book_status_id', 3)->count();
        $stockopname['total_dipinjam'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 1)->count();
        $stockopname['total_eksemplar'] = $stockopname[0]->stocktakeitem()->count();
        $stockopname['total_diperiksa'] = $stockopname[0]->stocktakeitem()->whereIn('book_status_id', [2, 3])->count();
        $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;

         $pdf = PDF::loadView('petugas/inventarisasi/download-pdf', ['stockopnames' => $stockopname]);
         $pdf->setOptions(['isHtml5ParserEnabled' => true]);

         return $pdf->download('Laporan Hasil StockOpname ' . $stockopname[0]->stockopname_name . '.pdf');
	}

    public function preview()
    {
        return view('petugas/inventarisasi/chart');
    }
    // public function download()
    // {
    //     $render = view('petugas/inventarisasi/chart')->render();

    //     $pdf = new Pdf;
    //     $pdf->addPage($render);
    //     $pdf->setOptions(['javascript-delay' => 5000]);
    //     $pdf->saveAs(public_path('report.pdf'));

    //     return response()->download(public_path('report.pdf'));
    // }
    public function download()
    {
        $pdf = PDF::loadView('petugas/inventarisasi/chart');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 1000);
        $pdf->setOption('no-stop-slow-scripts', true);
        $pdf->setOption('enable-smart-shrinking', true);
        return $pdf->stream();
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

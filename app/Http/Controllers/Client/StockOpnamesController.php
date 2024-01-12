<?php

namespace App\Http\Controllers\Client;

use App\Models\Eksemplar;
use App\Models\StockOpname;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StockTakeItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
        // dd($response->id);
        $eksemplars = Eksemplar::all();

        $data = [];
        foreach ($eksemplars as $eksemplar) {
            $data[] = [
                'id'=> Str::uuid()->toString(),
                'stock_opname_id' => $response->id,
                'eksemplar_id' => $eksemplar->id,
                'book_status_id' => $eksemplar->book_status_id === 1 ? 1 : 3,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Create data lebih cepat 7.87s
        DB::table('stock_take_item')->insert($data);

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

        // //lebih lama dan queries banyak
        $stockopname = StockOpname::where('id', $id)->get();
        $stockopname['total_tersedia'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 2)->count();
        $stockopname['total_hilang'] =  $stockopname[0]->stocktakeitem()->where('book_status_id', 3)->count();
        $stockopname['total_terpinjam'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 1)->count();
        $stockopname['total_eksemplar'] = $stockopname[0]->stocktakeitem()->count();
        $stockopname['total_diperiksa'] = $stockopname[0]->stocktakeitem()->whereIn('book_status_id', [2, 3])->count();
        $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;

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
        //  return $pdf->stream();
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
        $http = $http->create(url('api') . '/stockopname/' . $active_inventarisasi, 'GET', [
            "hilang" => true,
            // 'search' => $search
        ]);

        $stockopnames = StockTakeItem::with(['eksemplar', 'eksemplar.biblio'])
            ->whereHas('stockopname', function ($query) {
                $query->whereNull('end_date');
            })
            ->whereHas("eksemplar.biblio", function ($b) use ($search) {
                $b->where('item_code', 'LIKE', "%$search%")
                ->orWhere('title', 'LIKE', "%$search%");
            })
            ->where('book_status_id', '3') // Filter for book_status_id = 3 within the query
            ->paginate(10);

        return view('petugas/inventarisasi/eksemplar-hilang', ['stockopnames' => $stockopnames]);
	}

	public function laporan(Request $request)
	{
		$active_inventarisasi = Session::get('active_inventarisasi');
		// $http = new Request();
		// $http = $http->create(url('api') . '/stockopname/' . $active_inventarisasi, 'GET');
		// $response = app()->handle($http);
		// $response = $response->getContent();

		// $stockopname = json_decode($response);

        $stockopname = StockOpname::where('id', $active_inventarisasi)->get();
        $stockopname['total_tersedia'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 2)->count();
        $stockopname['total_hilang'] =  $stockopname[0]->stocktakeitem()->where('book_status_id', 3)->count();
        $stockopname['total_dipinjam'] = $stockopname[0]->stocktakeitem()->where('book_status_id', 1)->count();
        $stockopname['total_eksemplar'] = $stockopname[0]->stocktakeitem()->count();
        $stockopname['total_diperiksa'] = $stockopname[0]->stocktakeitem()->whereIn('book_status_id', [2, 3])->count();
        $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;
        $stockopname['stockopname_name'] = $stockopname[0]->stockopname_name;
        $stockopname['name_user'] = $stockopname[0]->name_user;
        $stockopname['start_date'] = $stockopname[0]->start_date;

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
        // dd($response);


		if ($response->isClientError()) {
			return redirect()->back()->withErrors((array) json_decode($response->getContent()));
		}

		Session::forget('active_inventarisasi');

		return redirect()->route('client.stockOpnameRecord');
	}
}

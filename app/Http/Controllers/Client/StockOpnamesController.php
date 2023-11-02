<?php

namespace App\Http\Controllers\client;

use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\StockTakeItem;

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
        $http = $http->create(config('app.api_url') . '/stockopname', 'GET', ['search' => $search]);
        $stockopname = StockOpname::where('name', 'LIKE', "%$search%")->paginate(1);

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
        $http = $http->create(config('app.api_url') . '/stockopname/add', 'POST', $request->all());
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
    public function show($id)
    {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/stockopname/' . $id);
        $response = app()->handle($http);
        $response = $response->getContent();

        $stockopname = json_decode($response);

        // dd($stockopname);
        return view('petugas/inventarisasi/hasil-inventarisasi', ['stockopnames' => $stockopname]);
    }

    // public function gone(Request $request)
    // {
    //     $active_inventarisasi = Session::get('active_inventarisasi');

    //     $search = $request->search;
    //     $http = new Request();
    //     $http = $http->create(config('app.api_url') . '/stockopname/' . $active_inventarisasi, 'GET', parameters:[
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
        $http = $http->create(config('app.api_url') . '/stockopname/' . $active_inventarisasi, 'GET', parameters:[
            "hilang" => true,
            // 'search' => $search
        ]);

        $stockopname = StockTakeItem::with(['eksemplar', 'eksemplar.biblio']);

        $stockopname = $stockopname->whereHas('stockopname', function ($query) {
                $query->whereNull('end_date');
            });

        $stockopname = $stockopname
            ->whereHas("eksemplar", function ($b) use ($search) {
            $b->where('item_code', 'LIKE', "%$search%");
            });

        $stockopnames = $stockopname->get();
        $stockopnames = $stockopnames->filter( function($stockopname) {
            return $stockopname->book_status_id == '3';
        })->paginate(50);

        // dd($stockopnames);
        return view('petugas/inventarisasi/eksemplar-hilang', ['stockopnames' => $stockopnames]);
    }

    public function laporan(Request $request)
    {
        $active_inventarisasi = Session::get('active_inventarisasi');

        $http = new Request();
        $http = $http->create(config('app.api_url') . '/stockopname/' . $active_inventarisasi, 'GET');
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
        $http = $http->create(config('app.api_url') . '/stockopname/finish/' . $active_inventarisasi, 'POST');
        $response = app()->handle($http);



        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }

        Session::forget('active_inventarisasi');

        return redirect()->route('client.stockOpnameRecord');
    }
}

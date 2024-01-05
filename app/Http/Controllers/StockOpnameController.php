<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Models\StockTakeItem;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class StockOpnameController extends Controller
{
    // SATART INVEN addData bagian awal pas start sekalian nambahin stocktakeitem berdasarkan keseluruhan eksemplar (untuk eksemplar terpinjam bookstatus stocktakeitem tetap terpinjam sisanya menjadi hilang)
    // INVENTARISASI getdata daftar list stockopname nama dan tanggal bagian rekaman
    // bagian INVENTARIASAI AKTIF list buku ambil dari showdata+ controller editData dari stocktakeitem
    // PROSES INVENTARIS ini isinya dari stocktakeitem jadi gausa isi (editData)
    // LAPORAN INVENTARISASI showData dengan mengambil status buku dari stocktakeitem yg baru discan agar terbaru

    public function getData(Request $request)
    {
        $search = $request->search;
        $stockopname = StockOpname::all();
        if ($search) {
            $stockopname = StockOpname::where('stockopname_name', 'LIKE', "%$search%")->get();
        }
        return response()->json($stockopname, 200);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "stockopname_name" => 'required|max:255',
            "name_user" => 'required|max:255|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (StockOpname::whereNull('end_date')->count() > 0) {
            return response()->json(['message' => 'Inventarisasi sedang berlangsung'], 422);
        }

        $stockopname = StockOpname::create([
            "stockopname_name" => $request->stockopname_name,
            "name_user" => $request->name_user,
            "status_stockopname" => 'berlangsung',
            "start_date" => now()
        ]);

        // $eksemplars = Eksemplar::all();

        // foreach ($eksemplars as $eksemplar) {
        //     StockTakeItem::create([
        //         "stock_opname_id" => $stockopname->id,
        //         "eksemplar_id" => $eksemplar->id,
        //         "book_status_id" => $eksemplar->book_status_id === 1 ? 1 : 3
        //     ]);
        // }

        return response()->json($stockopname, 200);
    }
    public function showData($id, Request $request) //buat FE = diambil saat inven aktif, harus difetch berulang2 utk yg terbaru
    {
        // $cacheKey = 'stock_opname_data_' . $id;
        // $cacheDuration = 60; // Cache for 60 minutes
        // $stockopname = Cache::remember($cacheKey, $cacheDuration, function () use ($id, $request) {
        $stockopname = DB::table('stock_opname')
            ->select('stockopname_name', 'name_user', 'start_date')
            ->where('end_date', null) //indexing
            ->get();

        $stocktakeitem = DB::table('stock_take_item')
            ->select('stock_take_item.*','book_statuses.name', 'eksemplar.item_code', 'eksemplar.rfid_code', 'biblio.id AS biblio_id', 'biblio.title', 'biblio.classification')
            ->join('eksemplar', 'eksemplar.id', '=', 'stock_take_item.eksemplar_id')
            ->join('biblio', 'biblio.id', '=', 'eksemplar.biblio_id')
            ->join('book_statuses', 'book_statuses.id', '=', 'stock_take_item.book_status_id')  // Join with book_statuses using stock_take_item.book_status_id
            ->where('stock_take_item.stock_opname_id', $id)
            ->when($request->has('dipinjam'), function ($query) use ($request) {
                $query->whereIn('stock_take_item.book_status_id', [1]);
            })
            ->when($request->has('tersedia'), function ($query) use ($request) {
                $query->whereIn('stock_take_item.book_status_id', [2]);
            })
            ->when($request->has('hilang'), function ($query) use ($request) {
                $query->whereIn('stock_take_item.book_status_id', [3]);
            })
            ->when($request->has('searchStock'), function ($query) use ($request) {
                $query->where('eksemplar.item_code', 'LIKE', "%{$request->searchStock}%");
            })
            ->orderBy('stock_take_item.updated_at', 'desc')
            ->get();

            $stockopname['stockopname_name'] = $stockopname[0]->stockopname_name;
            $stockopname['name_user'] = $stockopname[0]->name_user;
            $stockopname['start_date'] = $stockopname[0]->start_date;
            $stockopname['stocktakeitem'] = $stocktakeitem;
            $stockopname['total_tersedia'] = $stocktakeitem->where('book_status_id', 2)->count();
            $stockopname['total_hilang'] = $stocktakeitem->where('book_status_id', 3)->count();
            $stockopname['total_terpinjam'] = $stocktakeitem->where('book_status_id', 1)->count();
            $stockopname['total_eksemplar'] = $stocktakeitem->count();
            $stockopname['total_diperiksa'] = $stocktakeitem->whereIn('book_status_id', [2, 3])->count(); //Query builder dapat menggunakan indeks untuk mempercepat pencarian data dalam kondisi ini.
            $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;
            // return $stockopname;
            // });
        return response()->json($stockopname);

        // $stockopname = StockOpname::with(['stocktakeitem:id,stock_opname_id,eksemplar_id,book_status_id', 'stocktakeitem' => function ($stocktakeitem) use ($request) {
        //     $stocktakeitem->with([ "eksemplar" => function ($eksemplar) use ($request) {
        //         return $eksemplar->with(['biblio:id,title,classification']);
        //     }])->get();

        //     // $stockopname = StockOpname::with(['stocktakeitem' => function ($stocktakeitem) use ($request) {
        //     //     $stocktakeitem->with(["bookstatus", 'eksemplar' => function ($eksemplar) use ($request) {
        //     //         return $eksemplar->with(['biblio']);
        //     //     }]);

        //     $filterstatus = [];
        //     if ($request->has('dipinjam')) {
        //         $filterstatus[] = 1;
        //     }
        //     if ($request->has('tersedia')) {
        //         $filterstatus[] = 2;
        //     }
        //     if ($request->has('hilang')) {
        //         $filterstatus[] = 3;
        //     }

        //     if (count($filterstatus)) {
        //         $stocktakeitem->whereIn('book_status_id', $filterstatus);
        //     }

        //     $stocktakeitem->whereHas('eksemplar', function ($q) use ($request) {
        //         $q->where('item_code', "LIKE", "%$request->searchStock%");
        //     })->orderBy('updated_at', 'desc');

        // }])->findOrFail($id);


        // //dibawah ini untuk list data laporan hitungan totaal eksemplar
        // $stocktakeitem = $stockopname->stocktakeitem;
        // $stockopname['total_tersedia'] = $stocktakeitem->filter(function ($s) {
        //     return $s->bookstatus->id == 2;
        // })->count();

        // $stockopname['total_hilang'] = $stocktakeitem->filter(function ($s) {
        //     return $s->bookstatus->id == 3;
        // })->count();

        // $stockopname['total_terpinjam'] = $stocktakeitem->filter(function ($s) {
        //     return $s->bookstatus->id == 1;
        // })->count();

        // $stockopname['total_eksemplar'] = $stocktakeitem->count();

        // $stockopname['total_diperiksa'] = $stocktakeitem->filter(function ($s) {
        //     return $s->bookstatus->id == 2 || $s->bookstatus->id == 3;
        // })->count(); //misal ingin hitungan 2 id
        // $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;

        // return response()->json($stockopname, 200);
        //bikin filter yg diambil 2 dan 3 utk bagian laporan
        //list data yg ditampilkan pada inven aktif ambil dari sini, dengan status 2 dan 3 dgn contoh url http://localhost:8000/api/stockopname/9a4689fe-6119-47f6-a6fc-94f64d56f6b7?tersedia=&hilang=
        //ketika bagian laporan ambil showdata tanpa parameter dgn contoh url http://localhost:8000/api/stockopname/9a4689fe-6119-47f6-a6fc-94f64d56f6b7
    }

    public function finishStockOpname($id)
    {
        $stockopname = StockOpname::with('stocktakeitem.eksemplar')->find($id);
        $stockopname->update([
            "end_date" => now(),
            "status_stockopname" => 'selesai'
        ]);

        $stocktakeitem = $stockopname->stocktakeitem;

        foreach ($stocktakeitem as $item) {
            $item->eksemplar->update([
                'book_status_id' => $item->book_status_id
            ]);
        }

        $stockopname->refresh();
        return response()
            ->json(['message' => 'Proses Inventarisasi ' . ($stockopname->name) . ' sudah selesai!', 'data' => $stockopname]);
    }
}

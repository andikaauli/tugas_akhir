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
        // $stocktakeitems['stocktakeitem'] = StockTakeItem::with([
        //     'eksemplar:id,item_code,rfid_code,biblio_id',
        //     'eksemplar.biblio:id,title',
        //     'bookstatus:id,name',
        // ])
        //     ->where('stock_opname_id', $id)
        //     ->when($request->has('searchStock'), function ($query) use ($request) {
        //         $query->whereHas('eksemplar', function ($q) use ($request) {
        //             $q->where('item_code', 'LIKE', "%{$request->searchStock}%");
        //         });
        //     })
        //     // ->when(function ($query) use ($request) {
        //     //     $query->when($request->has('dipinjam'), function ($q) {
        //     //         $q->where('book_status_id', 1);
        //     //     });
        //     //     $query->when($request->has('tersedia'), function ($q) {
        //     //         $q->where('book_status_id', 2);
        //     //     });
        //     //     $query->when($request->has('hilang'), function ($q) {
        //     //         $q->where('book_status_id', 3);
        //     //     });
        //     // })
        //     ->orderBy('updated_at', 'desc')
        //     ->get();

        // return response()->json($stocktakeitems, 200);

///////////////////////////////////////////////////////////////////////////////////////////////////////

        // //eloquent lebih ringan
        // $stockopname = StockOpname::with([
        //     'stocktakeitem:id,stock_opname_id,eksemplar_id,book_status_id',
        //     'stocktakeitem.eksemplar:id,item_code,rfid_code',
        //     'stocktakeitem.eksemplar.biblio:id,title',
        //     'stocktakeitem.bookstatus:id,name',
        // ])->where('id', $id)
        //   ->when($request->has('searchStock'), function ($query) use ($request) {
        //       $query->whereHas('stocktakeitem.eksemplar', function ($q) use ($request) {
        //           $q->where('item_code', 'LIKE', "%{$request->searchStock}%");
        //       });
        //   })
        //   ->where(function ($query) use ($request) {
        //       $query->when($request->has('dipinjam'), function ($q) {
        //           $q->where('book_status_id', 1);
        //       });
        //       $query->when($request->has('tersedia'), function ($q) {
        //           $q->where('book_status_id', 2);
        //       });
        //       $query->when($request->has('hilang'), function ($q) {
        //           $q->where('book_status_id', 3);
        //       });
        //   })
        //   ->orderBy('updated_at', 'desc')
        //   ->firstOrFail();

        // return response()->json($stockopname, 200);

////////////////////////////////////////////////////////////////////////////////////////////////////

        //query builder baru fix
        $stockopname['stocktakeitem'] = DB::table('stock_opname')
            ->select('item_code', 'rfid_code', 'title', 'classification', 'name', 'stock_take_item.book_status_id')
            ->where('end_date', null) //indexing
            ->join('stock_take_item', 'stock_take_item.stock_opname_id', '=', 'stock_opname.id')
            ->join('eksemplar', 'eksemplar.id', '=', 'stock_take_item.eksemplar_id')
            ->join('biblio', 'biblio.id', '=', 'eksemplar.biblio_id')
            ->join('book_statuses', 'book_statuses.id', '=', 'stock_take_item.book_status_id')
            ->where('stock_take_item.stock_opname_id', $id)
            ->when($request->has('searchStock'), function ($query) use ($request) {
                $query->where('eksemplar.item_code', 'LIKE', "%{$request->searchStock}%");
            })
            ->orderBy('stock_take_item.updated_at', 'desc')
            ->get(); // Kode ini menggunakan query chain untuk menggabungkan beberapa metode Query Builder secara berurutan. Kode ini mirip dengan kode asli, tetapi metode count() dipindahkan ke dalam query chain.

            // $stockopname['stockopname_name'] = $stockopname['stocktakeitem'][0]->stockopname_name;
            // $stockopname['name_user'] = $stockopname['stocktakeitem'][0]->name_user;
            // $stockopname['start_date'] = $stockopname['stocktakeitem'][0]->start_date;
            // $stockopname['total_tersedia'] = $stockopname['stocktakeitem']->where('book_status_id', 2)->count();
            // $stockopname['total_hilang'] = $stockopname['stocktakeitem']->where('book_status_id', 3)->count();
            // $stockopname['total_terpinjam'] = $stockopname['stocktakeitem']->where('book_status_id', 1)->count();
            // $stockopname['total_eksemplar'] = $stockopname['stocktakeitem']->count();
            // $stockopname['total_diperiksa'] = $stockopname['stocktakeitem']->whereIn('book_status_id', [2, 3])->count(); //count() termasuk query skalar utk hitung jmlh data
            // $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;
        return response()->json($stockopname);

/////////////////////////////////////////////////////////////////////////////

        // //query builder optimal
        // $stockopname = DB::table('stock_opname')
        //     ->select('stockopname_name', 'name_user', 'start_date')
        //     ->where('end_date', null) //indexing
        //     ->get();

        // $stocktakeitem = DB::table('stock_take_item')
        //     ->select('stock_take_item.*','book_statuses.name', 'eksemplar.item_code', 'eksemplar.rfid_code', 'biblio.id AS biblio_id', 'biblio.title', 'biblio.classification')
        //     ->join('eksemplar', 'eksemplar.id', '=', 'stock_take_item.eksemplar_id')
        //     ->join('biblio', 'biblio.id', '=', 'eksemplar.biblio_id')
        //     ->join('book_statuses', 'book_statuses.id', '=', 'stock_take_item.book_status_id') //ini indexing  // Join with book_statuses using stock_take_item.book_status_id
        //     ->where('stock_take_item.stock_opname_id', $id)
        //     ->when($request->has('dipinjam'), function ($query) use ($request) {
        //         $query->whereIn('stock_take_item.book_status_id', [1]); //indexing
        //     })
        //     ->when($request->has('tersedia'), function ($query) use ($request) {
        //         $query->whereIn('stock_take_item.book_status_id', [2]); //indexing
        //     })
        //     ->when($request->has('hilang'), function ($query) use ($request) {
        //         $query->whereIn('stock_take_item.book_status_id', [3]); //indexing
        //     })
        //     ->when($request->has('searchStock'), function ($query) use ($request) {
        //         $query->where('eksemplar.item_code', 'LIKE', "%{$request->searchStock}%");
        //     })
        //     ->orderBy('stock_take_item.updated_at', 'desc')
        //     ->get();

        //     $stockopname['stockopname_name'] = $stockopname[0]->stockopname_name;
        //     $stockopname['name_user'] = $stockopname[0]->name_user;
        //     $stockopname['start_date'] = $stockopname[0]->start_date;
        //     $stockopname['stocktakeitem'] = $stocktakeitem;
        //     $stockopname['total_tersedia'] = $stocktakeitem->where('book_status_id', 2)->count();
        //     $stockopname['total_hilang'] = $stocktakeitem->where('book_status_id', 3)->count();
        //     $stockopname['total_terpinjam'] = $stocktakeitem->where('book_status_id', 1)->count();
        //     $stockopname['total_eksemplar'] = $stocktakeitem->count();
        //     $stockopname['total_diperiksa'] = $stocktakeitem->whereIn('book_status_id', [2, 3])->count(); //Query builder dapat menggunakan indeks untuk mempercepat pencarian data dalam kondisi ini.
        //     $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;
        // return response()->json($stockopname);

///////////////////////////////////////////////////////////////////////////////////////////

        // //eloquent optimal
        // $stockopname = StockOpname::with([
        //     'stocktakeitem' => function ($query) use ($request) {
        //         $query->select('id', 'stock_opname_id', 'eksemplar_id', 'book_status_id')
        //               ->with([
        //                   'eksemplar:id,item_code,rfid_code,biblio_id',
        //                   'eksemplar.biblio:id,title,classification',
        //                   'bookstatus:id,name',
        //               ]);

        //         $filterstatus = [];
        //         if ($request->has('dipinjam')) {
        //             $filterstatus[] = 1;
        //         }
        //         if ($request->has('tersedia')) {
        //             $filterstatus[] = 2;
        //         }
        //         if ($request->has('hilang')) {
        //             $filterstatus[] = 3;
        //         }

        //         if (count($filterstatus)) {
        //             $query->whereIn('book_status_id', $filterstatus);
        //         }

        //         if ($request->has('searchStock')) {
        //             $query->whereHas('eksemplar', function ($q) use ($request) {
        //                 $q->where('item_code', 'LIKE', "%{$request->searchStock}%");
        //             });
        //         }

        //         $query->orderBy('updated_at', 'desc');
        //     }
        // ])->findOrFail($id);

        // $stockopname['total_tersedia'] = $stockopname->stocktakeitem->where('book_status_id', 2)->count();
        // $stockopname['total_hilang'] = $stockopname->stocktakeitem->where('book_status_id', 3)->count();
        // $stockopname['total_terpinjam'] = $stockopname->stocktakeitem->where('book_status_id', 1)->count();
        // $stockopname['total_eksemplar'] = $stockopname->stocktakeitem->count();
        // $stockopname['total_diperiksa'] = $stockopname->stocktakeitem->whereIn('book_status_id', [2, 3])->count();
        // $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;

        // return response()->json($stockopname, 200);

////////////////////////////////////////////////////////////////////////////

        // //eloquent awal
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
    }

    public function finishStockOpname($id)
    {
        $stockopname = StockOpname::with('stocktakeitem.eksemplar')->find($id);
        $stockopname->update([
            "end_date" => now(),
            "status_stockopname" => 'selesai'
        ]);

        $stocktakeitem = $stockopname->stocktakeitem()->get();

        foreach ($stocktakeitem as $item) {
            $item->eksemplar->update([
                'book_status_id' => $item->book_status_id
            ]);
        }
        // foreach ($stocktakeitem as $item) {
        //     DB::table('eksemplar')->where('id', $item->eksemplar_id)->update(['book_status_id' => $item->book_status_id]);
        //  }

        $stockopname->refresh();
        return response()
            ->json(['message' => 'Proses Inventarisasi ' . ($stockopname->name) . ' sudah selesai!', 'data' => $stockopname]);
    }
}

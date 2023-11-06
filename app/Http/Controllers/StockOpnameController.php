<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use App\Models\StockOpname;
use App\Models\StockTakeItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
            $stockopname = StockOpname::where('name', 'LIKE', "%$search%")->get();
        }
        return response()->json($stockopname, 200);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => 'required|max:255',
            "name_user" => 'required|max:255|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (StockOpname::whereNull('end_date')->count() > 0) {
            return response()->json(['message' => 'Inventarisasi sedang berlangsung'], 422);
        }

        $stockopname = StockOpname::create([
            "name" => $request->name,
            "name_user" => $request->name_user,
            "status_stockopname" => 'berlangsung',
            "start_date" => now()
        ]);

        $eksemplars = Eksemplar::all();

        foreach ($eksemplars as $eksemplar) {
            if ($eksemplar->book_status_id == 1) {
                $book_status_id = 1;
            } else {
                $book_status_id = 3;
            }

            StockTakeItem::create([
                "stock_opname_id" => $stockopname->id,
                "eksemplar_id" => $eksemplar->id,
                "book_status_id" => $book_status_id
            ]);
        }

        return response()->json($stockopname, 200);
    }
    public function showData($id, Request $request) //buat FE = diambil saat inven aktif, harus difetch berulang2 utk yg terbaru
    {
        // $search = $request->searchStock;
        // $stockopname = Stockopname::with(['stocktakeitem' => function ($stocktakeitem) use ($request) {
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

        //     // .biblio.author', 'eksemplar.biblio.colltype', 'eksemplar.biblio.publisher'
        //     $search = $request->searchEksemplar;
        //     return $stocktakeitem->with(['bookstatus', 'eksemplar' => function ($eksemplar) use ($request) {
        //         return $eksemplar->with(['biblio.author', 'biblio.colltype', 'biblio.publisher']);
        //     }])->whereHas('eksemplar', function ($q) use ($search) {
        //         $q->where('item_code', "LIKE", "%$search%");
        //     })->orderBy('updated_at', 'desc');
        // }]);

        // // PENCARIAN
        // if ($search) {
        //     $stockopname = $stockopname->whereHas('stocktakeitem', function ($q) use ($search) {
        //         $q->whereHas('eksemplar', function ($q) use ($search) {
        //             $q->whereHas('biblio', function ($q) use ($search) {
        //                 $q->where('title', 'like', '%' . $search . '%');
        //             })->orWhere('item_code', 'like', '%' . $search . '%');
        //         });
        //     });
        // }

        // $stockopname = $stockopname->findOrFail($id);

        $stockopname = StockOpname::with(['stocktakeitem' => function ($stocktakeitem) use ($request) {
            $stocktakeitem->with(["bookstatus", 'eksemplar' => function ($eksemplar) use ($request) {
                return $eksemplar->with(['biblio.author', 'biblio.colltype', 'biblio.publisher']);
            }]);

            $filterstatus = [];
            if ($request->has('dipinjam')) {
                $filterstatus[] = 1;
            }
            if ($request->has('tersedia')) {
                $filterstatus[] = 2;
            }
            if ($request->has('hilang')) {
                $filterstatus[] = 3;
            }

            if (count($filterstatus)) {
                $stocktakeitem->whereIn('book_status_id', $filterstatus);
            }

            $stocktakeitem->whereHas('eksemplar', function ($q) use ($request) {
                $q->where('item_code', "LIKE", "%$request->searchStock%");
            })->orderBy('updated_at', 'desc');
        }])->findOrFail($id);


        //dibawah ini untuk list data laporan hitungan totaal eksemplar
        $stocktakeitem = $stockopname->stocktakeitem;
        $stockopname['total_tersedia'] = $stocktakeitem->filter(function ($s) {
            return $s->bookstatus->id == 2;
        })->count();

        $stockopname['total_hilang'] = $stocktakeitem->filter(function ($s) {
            return $s->bookstatus->id == 3;
        })->count();

        $stockopname['total_terpinjam'] = $stocktakeitem->filter(function ($s) {
            return $s->bookstatus->id == 1;
        })->count();

        $stockopname['total_eksemplar'] = $stocktakeitem->count();

        $stockopname['total_diperiksa'] = $stocktakeitem->filter(function ($s) {
            return $s->bookstatus->id == 2 || $s->bookstatus->id == 3;
        })->count(); //misal ingin hitungan 2 id
        $stockopname['total_persen'] = ($stockopname['total_tersedia'] / $stockopname['total_diperiksa']) * 100;

        return response()->json($stockopname, 200);
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

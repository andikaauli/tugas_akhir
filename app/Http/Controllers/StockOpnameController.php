<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use App\Models\StockOpname;
use App\Models\StockTakeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockOpnameController extends Controller
{
    // SATART INVEN addData bagian awal pas start sekalian nambahin stocktakeitem berdasarkan keseluruhan eksemplar (untuk eksemplar terpinjam bookstatus stocktakeitem tetap terpinjam sisanya menjadi hilang)
    // INVENTARISASI getdata daftar list stockopname nama dan tanggal bagian rekaman
    // PROSES INVENTARIS ini isinya dari stocktakeitem jadi gausa isi (editData)
    // LAPORAN INVENTARISASI showData dengan mengambil status buku dari stocktakeitem yg baru discan agar terbaru

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" =>'required|max:255',
            "name_user" => 'required|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $stockopname = StockOpname::create([
            "name" => $request->name,
            "name_user" => $request->name_user,
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

    public function getData()
    {
        $stockopname = StockOpname::all();
        return response()->json($stockopname);


    }
}

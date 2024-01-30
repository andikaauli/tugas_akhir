<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use Illuminate\Http\Request;
use App\Models\StockTakeItem;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class StockTakeItemController extends Controller
{
    //contoh untuk proses stock opname
    public function editData(Request $request)
    {
        $stocktakeitem = StockTakeItem::whereHas('eksemplar', function ($query) use ($request) {
            return $query->where('rfid_code', $request->rfid_code);
        })->whereHas('stockopname', function ($query) {
            $query->whereNull('end_date');
        })->where("book_status_id", 3)->first();
        if (!$stocktakeitem) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->rfid_code . ' tidak tersedia'], 404);
        }

        if ($stocktakeitem->book_status_id === 1) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->rfid_code . ' sedang Dipinjam!'], 422);
        }

        if ($stocktakeitem->book_status_id === 2) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->rfid_code . ' sudah Tersedia!'], 422);
        }

        $stocktakeitem->update([
            'book_status_id' => 2
        ]);

        $stocktakeitem->refresh();

        return response()->json([
            'message' => 'Eksemplar dengan kode ' . $request->item_code . ' berhasil diubah ke Tersedia',
            'data' => $stocktakeitem,
            'eksemplar' => $stocktakeitem->eksemplar
        ]);
    }
    public function editDataButton(Request $request)
    {

        $stocktakeitem = StockTakeItem::with('eksemplar')
        ->whereHas('eksemplar', function ($query) use ($request) {
            $query->where('item_code', $request->item_code);
        })
        ->where('stock_opname_id', $request->stock_opname_id)
        ->first();

        if (!$stocktakeitem) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->item_code . ' tidak tersedia'], 404);
        }

        if ($stocktakeitem->book_status_id === 1) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->item_code . ' sedang Dipinjam!'], 422);
        }

        if ($stocktakeitem->book_status_id === 2) {
            return response()->json(['message' => 'Eksemplar dengan kode ' . $request->item_code . ' sudah Tersedia!'], 422);
        }

        $stocktakeitem->update(['book_status_id' => 2]);
        return response()->json([
            'message' => 'Eksemplar dengan kode ' . $request->item_code . ' berhasil diubah ke Tersedia',
            'data' => $stocktakeitem,
            'eksemplar' => $stocktakeitem->eksemplar
        ]);
    }


    public function getData(Request $request)
    {
        $search = $request->search;
        $stocktakeitem = StockTakeItem::with(['eksemplar.bookstatus'])->get();
        if ($search) {
            $stocktakeitem = StockTakeItem::where('title', 'LIKE', "%$search%")
                ->orWhere('isbnissn', 'LIKE', "%$search%")->get();
        }
        return response()->json($stocktakeitem, 200);
    }
}

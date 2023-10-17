<?php

namespace App\Http\Controllers;

use App\Models\StockTakeItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StockTakeItemController extends Controller
{
    //contoh untuk proses stock opname
    public function editData(Request $request, $rfid_code)
    {
        $stocktakeitem = StockTakeItem::with(['eksemplar' => function ($query) use ($rfid_code) {
            return $query->where('rfid_code', $rfid_code);
        }])->whereHas('stockopname', function ($query) {
            $query->whereNull('end_date');
        })->where("book_status_id", 3)->first();

        $stocktakeitem->update([
            'book_status_id' => 2
        ]);

        $stocktakeitem->refresh();

        return response()->json($stocktakeitem, 200);
    }
    public function editDataButton(Request $request, $item_code)
    {
        return $request->all();
        $stocktakeitem = StockTakeItem::whereHas('eksemplar', function ($query) use ($request) {
            return $query->where('item_code', $request->item_code);
        })->where('stock_opname_id', $request->stock_opname_id)->where("book_status_id", 3)->first();

        $stocktakeitem->update([
            'book_status_id' => 2
        ]);

        return response()->json($stocktakeitem, 200);
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

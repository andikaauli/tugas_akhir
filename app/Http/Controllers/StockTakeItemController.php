<?php

namespace App\Http\Controllers;

use App\Models\StockTakeItem;
use Illuminate\Http\Request;

class StockTakeItemController extends Controller
{
    //contoh untuk proses stock opname
    public function editData(Request $request, $rfid_code){

        $stocktakeitem = StockTakeItem::with(['eksemplar' => function ($query) use ($rfid_code){
            return $query->where('rfid_code', $rfid_code);
        }])->first();

        $stocktakeitem->update([
            'book_status_id' => 2
        ]);

        return response()->json($stocktakeitem, 200);
    }
}

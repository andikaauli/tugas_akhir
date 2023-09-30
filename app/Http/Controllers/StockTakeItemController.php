<?php

namespace App\Http\Controllers;

use App\Models\StockTakeItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StockTakeItemController extends Controller
{
    //contoh untuk proses stock opname
    public function editData(Request $request, $rfid_code){

        $stocktakeitem = StockTakeItem::with(['eksemplar' => function ($query) use ($rfid_code){
            return $query->where('rfid_code', $rfid_code);
        }])->where("book_status_id",3)->first();

        $stocktakeitem->update([
            'book_status_id' => 2
        ]);

        return response()->json($stocktakeitem, 200);

        // [
        //     "name" => $request->name,
        //     "name_user" => $request->name_user,
        //     "start_date" => now()
        // ] isi addData stockopname
    }
}

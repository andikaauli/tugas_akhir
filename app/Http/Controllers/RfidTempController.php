<?php

namespace App\Http\Controllers;

use App\Models\RfidTemp;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RfidTempController extends Controller
{
    public function getData(Request $request)
    {

        $rfidtemp = Rfidtemp::first();
        if ($rfidtemp){
            $rfidtemp->forceDelete();
        }

        return response()->json($rfidtemp, 200);
    }

    public function addData(Request $request) //abil make api ini
    {
        // $rfidtemp = Rfidtemp::create($request->all());
        // return response()->json($rfidtemp, 200);
        $rfidtemp = $request->input('rfid_code');
        $rfidtemps = Rfidtemp::first();
        if ($rfidtemps){
            Rfidtemp::truncate();
        }
        Rfidtemp::create(['rfid_code' => $rfidtemp]);
        return response()->json(Rfidtemp::first(), 200);
    }
}

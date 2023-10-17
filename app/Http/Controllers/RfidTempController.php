<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $rfidtemp = Rfidtemp::create($request->all());
        return response()->json($rfidtemp, 200);
    }
}

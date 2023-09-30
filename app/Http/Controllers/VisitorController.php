<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class VisitorController extends Controller
{
    // public function getData()
    // {
    //     $visitor = Visitor::all();
    //     return response()->json($visitor, 200);
    // }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'instituion' => 'required|max:255',
            'jenis_id' => ['required', 'exists:types,id'], //bentukan kalo ada foreign

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $visitor = Visitor::create($request->all());
        return response()
        ->json(['message'=>'Pengunjung baru berhasil ditambahkan!', 'data'=>$visitor]);
    }
}

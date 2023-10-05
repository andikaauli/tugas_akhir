<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class VisitorController extends Controller
{
    public function getData()
    {
        // $visitor = Visitor::all();
        $visitor = Visitor::with(['type:id,name'])->get(); //nampilin semua kolom nanti FE yg atur, . berarti masuk ke dan , berarti dan

        return response()->json($visitor, 200);
    }

    public function showData($id)
    {
        $visitor = Visitor::with(['type:id,name'])->findOrFail($id); //with(['type:id,name']) utk menampilkan data tertentu
        return response()->json($visitor, 200);

    }

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

        // $request->jenis_id = types()->id;
        $visitor = Visitor::create($request->all());
        // $visitor = visitor::create($request->toArray());
        // $visitor->type()->sync([]);
        return response()
        ->json(['message'=>'Pengunjung baru berhasil ditambahkan!', 'data'=>$visitor]);
    }
}

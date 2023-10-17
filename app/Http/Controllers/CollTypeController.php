<?php

namespace App\Http\Controllers;

use App\Models\CollType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CollTypeController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $colltype = CollType::all();
        if ($search) {
            $colltype = CollType::where('title', 'LIKE', "%$search%")->get();
        }
        return response()->json($colltype, 200);
    }

    public function showData($id)
    {
        $colltype = CollType::findOrFail($id);
        return response()->json($colltype, 200);
    }

    // public function showData($id)
    // {
    //     $colltype = Colltype::all()->find($id);
    //     if(is_null($colltype)){
    //         return abort(422);
    //     }
    //     return response()->json($colltype, 200);
    // }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $colltype = CollType::create($request->all());
        return response()
            ->json(['message'=>'Tipe Koleksi baru berhasil ditambahkan!', 'data'=>$colltype]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $colltype = CollType::find($id);
        $colltype->update($request->all());
        return response()
            ->json(['message'=>'Data Tipe Koleksi berhasil diubah!', 'data'=>$colltype]);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $colltype = CollType::find($id);
        $colltype->forceDelete();
        return response()
            ->json(['message'=>'Data Tipe Koleksi '.($request->title).' berhasil dihapus!', 'data'=>$colltype]);

    }
}

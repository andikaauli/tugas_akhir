<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PublisherController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $publisher = Publisher::all();
        if ($search) {
            $publisher = Publisher::where('title', 'LIKE', "%$search%")->get();
        }
        return response()->json($publisher, 200);
    }

    public function showData($id)
    {
        $publisher = Publisher::findOrFail($id);
        return response()->json($publisher, 200);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => "required|max:255|string|unique:publisher,title",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $publisher = Publisher::create($request->all());
        return response()
            ->json(['message'=>'Penerbit baru berhasil ditambahkan!', 'data'=>$publisher]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => "required|max:255|string|unique:publisher,title",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $publisher = Publisher::find($id);
        $publisher = Publisher::where('title',$id)->first();
        $publisher->update($request->all());
        return response()
        ->json(['message'=>'Data Penerbit berhasil diubah!', 'data'=>$publisher]);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $publisher = Publisher::find($id);
        if(is_null($publisher)){
            return abort(422);
        }
        $publisher->forceDelete();
        return response()
            ->json(['message'=>'Data Penerbit '.($request->title).' berhasil dihapus!', 'data'=>$publisher]);
    }
}

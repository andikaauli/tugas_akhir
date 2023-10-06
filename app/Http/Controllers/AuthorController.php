<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $author = Author::all();
        if ($search) {
            $author = Author::where('title', 'LIKE', "%$search%")->get();
        }
        return response()->json($author, 200);
    }

    public function showData($id)
    {
        $author = author::all()->findOrFail($id);
        return response()->json($author, 200);
    }

    // public function showData($id)
    // {
    //     $author = Author::all()->find($id);
    //     if(is_null($author)){
    //         return abort(422);
    //     }
    //     return response()->json($author, 200);
    // }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $author = Author::create($request->all());
        return response()
            ->json(['message'=>'Pengarang baru berhasil ditambahkan!', 'data'=>$author]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $author = Author::find($id);
        $author->update($request->all());
        return response()
            ->json(['message'=>'Data Pengarang berhasil diubah!', 'data'=>$author]);

    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $author = Author::find($id);

        // if ($author) {
        //     $author->forceDelete();
        //     return response()->json(['message'=>'Data Pengarang '.($request->title).'berhasil dihapus!', 'data'=>$author], 200);
        // } else {
        //     return response()->json(['message'=>'Data Pengarang '.($request->title).'tidak ditemukan!'], 404);
        // }
        $author->forceDelete();
        return response()
            ->json(['message'=>'Data Pengarang'.($request->title).' berhasil dihapus!', 'data'=>$author]);
    }

    //soft delete
    // public function destroyData(Request $request, $id)
    // {
    //     $author = Author::find($id);
    //     $author->delete();
    //     return response()
    //         ->json(['message'=>'Data Pengarang '.($request->title).' berhasil dihapus!', 'data'=>$author]);
    // }



}

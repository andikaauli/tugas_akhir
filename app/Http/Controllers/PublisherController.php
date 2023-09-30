<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PublisherController extends Controller
{
    public function getData()
    {
        $publisher = Publisher::all();
        return response()->json($publisher);
    }

    // public function showData($id)
    // {
    //     $publisher = Publisher::all()->findOrFail($id);
    //     return response()->json($publisher);
    // }

    public function showData($id)
    {
        $publisher = Publisher::all()->find($id);
        if(is_null($publisher)){
            return abort(422);
        }
        return response()->json($publisher);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $publisher = Publisher::create($request->all());
        return response()->json($publisher, 200);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $publisher = Publisher::find($id);
        $publisher->update($request->all());
        return response()->json($publisher, 200);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $publisher = Publisher::find($id);
        if(is_null($publisher)){
            return abort(422);
        }
        $publisher->forceDelete();
        return response()->json($publisher, 200);
    }
}

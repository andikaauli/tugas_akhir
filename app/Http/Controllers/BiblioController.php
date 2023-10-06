<?php

namespace App\Http\Controllers;

use App\Models\Biblio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BiblioController extends Controller
{
    public function getData()
    {
        $biblio = Biblio::with(['eksemplar.bookstatus','author','colltype','publisher'])->get(); //nampilin semua kolom nanti FE yg atur, . berarti masuk ke dan , berarti dan
        // $biblio = Biblio::with(['eksemplar' => function ($query) {  // ini adalah cara ke2
        //     return $query->with(['bookstatus'])->where("name", "Hilang");// bentuk klo nampilih bookstatus yg hilang
        // }])->get();
        return response()->json($biblio, 200);

        //bisa ditambahin pesan 200 dan 422
    }


    public function showData($id)
    {
        $biblio = Biblio::with(['eksemplar.bookstatus','author','colltype','publisher'])->findOrFail($id);
        return response()->json($biblio, 200);
    }

    // public function showData($id)
    // {
    //     $biblio = Biblio::with(['eksemplar.bookstatus'])->find($id);
    //     if(is_null($biblio)){
    //         return abort(422);
    //     }
    //     return response()->json($biblio, 200);
    // }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'responsibility' => 'required',
            'edition' => 'required',
            'spec_detail' => 'required',
            'coll_type_id' => ['required', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'gmd' => 'required',
            'content_type' => 'nullable',
            'carrier_type' => 'nullable',
            'date' => 'nullable',
            'isbnissn' => ['required', 'unique:biblio', 'numeric'],
            'publisher_id' => ['required', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration
            'place' => 'required',
            'description' => 'required',
            'title_series' => 'required',
            'classification' => 'required',
            'call_number' => ['required', 'unique:biblio', 'numeric'],
            'language' => 'required',
            'abstract' => 'nullable',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $biblio = Biblio::create($request->all());
        return response()
            ->json(['message'=>'Biblio baru berhasil ditambahkan!', 'data'=>$biblio]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'responsibility' => 'nullable',
            'edition' => 'required',
            'spec_detail' => 'required',
            'gmd' => 'required',
            'content_type' => 'nullable',
            'carrier_type' => 'nullable',
            'date' => 'nullable',
            'isbnissn' => ['required', 'unique:biblio', 'numeric'],
            'place' => 'required',
            'description' => 'required',
            'title_series' => 'required',
            'classification' => 'required',
            'call_number' => ['required', 'unique:biblio', 'numeric'],
            'language' => 'required',
            'image' => 'nullable|image|max:10240|mimes:jpeg,png,jpg',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'coll_type_id' => ['required', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'publisher_id' => ['required', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // if ($image = $request->file('image')) {
        //     $destinationPath = public_path('images/');
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }

        $biblio = Biblio::find($id);
        $biblio->update($request->all());
        return response()
        ->json(['message'=>'Data Biblio berhasil diubah!', 'data'=>$biblio]);

    }

    // public function hapusData(Request $request, $id)
    // { //soft delete
    //     $biblio = Biblio::find($id);
    //     $biblio->delete();
    // }

    // public function destroyData(Request $request, $id)
    // { //hard delete
    //     $biblio = Biblio::onlyTrashed()->find($id);
    //     $biblio->forceDelete();
    // }

    public function destroyData(Request $request, $id)
    { //hard delete
        $biblio = Biblio::find($id);
        $biblio->forceDelete();
        return response()
            ->json(['message'=>'Data Buku berhasil dihapus!', 'data'=>$biblio]);
    }
}

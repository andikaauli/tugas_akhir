<?php

namespace App\Http\Controllers;

use App\Models\Biblio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiblioController extends Controller
{
    public function getData()
    {
        $biblio = Biblio::with(['eksemplar.bookstatus'])->get(); //nampilin semua kolom nanti FE yg atur, . berarti masuk ke dan , berarti dan
        // $biblio = Biblio::with(['eksemplar' => function ($query) {  // ini adalah cara ke2
        //     return $query->with(['bookstatus'])->where("name", "Hilang");// bentuk klo nampilih bookstatus yg hilang
        // }])->get();
        return response()->json($biblio);

        //bisa ditambahin pesan 200 dan 422
    }

    public function showData($id)
    {
        $biblio = Biblio::with(['eksemplar.bookstatus'])->findOrFail($id);
        return response()->json($biblio);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'responsibility' => 'required',
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
            'subject' => 'required',
            'language' => 'required',
            'image' => 'required|image|max:1024',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'coll_type_id' => ['required', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'publisher_id' => ['required', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $biblio = Biblio::create($request->all());
        return response()->json($biblio, 200);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'responsibility' => 'required',
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
            'subject' => 'required',
            'language' => 'required',
            'image' => 'required|image|max:1024',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'coll_type_id' => ['required', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'publisher_id' => ['required', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $biblio = Biblio::find($id);
        $biblio->update($request->all());
        return response()->json($biblio, 200);
    }

    public function hapusData(Request $request, $id)
    { //soft delete
        $biblio = Biblio::find($id);
        $biblio->delete();
    }

    public function destroyData(Request $request, $id)
    { //hard delete
        $biblio = Biblio::onlyTrashed()->find($id);
        $biblio->forceDelete();
    }
}

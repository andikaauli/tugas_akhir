<?php

namespace App\Http\Controllers;

use App\Models\Biblio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiblioController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $biblio = Biblio::with(['eksemplar.bookstatus', 'author', 'colltype', 'publisher'])->get();
        if ($search) {
            $biblio = Biblio::where('title', 'LIKE', "%$search%")
                ->orWhere('isbnissn', 'LIKE', "%$search%")->get();
        }
        return response()->json($biblio, 200);
    }


    public function showData($id)
    {
        $biblio = Biblio::with(['eksemplar.bookstatus', 'author', 'colltype', 'publisher'])->findOrFail($id);
        return response()->json($biblio, 200);
    }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'responsibility' => 'nullable',
            'edition' => 'required',
            'spec_detail' => 'nullable',
            'coll_type_id' => ['required', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'gmd' => 'nullable',
            'content_type' => 'nullable',
            'carrier_type' => 'nullable',
            'date' => 'nullable',
            'isbnissn' => ['required', 'unique:biblio', 'numeric'],
            'publisher_id' => ['required', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration
            'place' => 'nullable',
            'description' => 'nullable',
            'title_series' => 'nullable',
            'classification' => 'required',
            'call_number' => ['required', 'unique:biblio', 'numeric'],
            'language' => 'required',
            'abstract' => 'nullable',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $fileName);
            $biblio->image = $fileName;
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $biblio = Biblio::create($request->all());
        return response()
            ->json(['message' => 'Biblio baru berhasil ditambahkan!', 'data' => $biblio]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|max:255',
            'responsibility' => 'nullable',
            'edition' => 'nullable',
            'spec_detail' => 'nullable',
            'gmd' => 'nullable',
            'content_type' => 'nullable',
            'carrier_type' => 'nullable',
            'date' => 'nullable',
            'isbnissn' => ['nullable', 'unique:biblio', 'numeric'],
            'place' => 'nullable',
            'description' => 'nullable',
            'title_series' => 'nullable',
            'classification' => 'nullable',
            'call_number' => ['nullable', 'unique:biblio', 'numeric'],
            'language' => 'nullable',
            'image' => 'nullable|image|max:10240|mimes:jpeg,png,jpg',
            'author_id' => ['nullable', 'exists:author,id'], //bentukan kalo ada foreign
            'coll_type_id' => ['nullable', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'publisher_id' => ['nullable', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $fileName);
            $biblio->image = $fileName;

            if ($biblio->image && Storage::exists('public/images/' . $biblio->image)) {
                Storage::delete('public/images/' . $biblio->image);
            }
        }

        $biblio = Biblio::find($id);
        $biblio->update($request->all());
        return response()
            ->json(['message' => 'Data Biblio berhasil diubah!', 'data' => $biblio]);
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
            ->json(['message' => 'Data Buku berhasil dihapus!', 'data' => $biblio]);
    }
}

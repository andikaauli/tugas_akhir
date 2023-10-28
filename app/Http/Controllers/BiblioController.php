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
        $biblio = Biblio::with(['eksemplar.bookstatus', 'author', 'colltype', 'publisher']);

        if ($search) {
            $biblio = $biblio->whereHas("eksemplar", function ($b) use ($search) {
                // $b->where('title', 'LIKE', "%$search%");
            })->where('title', 'LIKE', "%$search%")->orWhere('title', 'LIKE', "%$search%");
        }

        $biblio = $biblio->get();


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
            'responsibility' => 'nullable|max:255',
            'edition' => 'nullable|max:255',
            'spec_detail' => 'nullable|max:255',
            'coll_type_id' => ['nullable', 'max:255', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'gmd' => 'nullable|max:255',
            'content_type' => 'nullable|max:255',
            'media_type' => 'nullable|max:255',
            'carrier_type' => 'nullable|max:255',
            'date' => 'nullable|date',
            'isbnissn' => ['nullable', 'unique:biblio', 'numeric'],
            'publisher_id' => ['nullable', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration
            'place' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'title_series' => 'nullable|max:255',
            'classification' => 'nullable|max:255',
            'call_number' => ['nullable', 'unique:biblio', 'numeric'],
            'language' => 'nullable',
            'abstract' => 'nullable|max:255',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $storeImage = $image->storeAs('public/images', $fileName);
            $imagePath = asset(str_replace("public", "storage", $storeImage));
            $data['image'] = $imagePath;
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $biblio = Biblio::create($data);
        return response()
            ->json(['message' => 'Biblio baru berhasil ditambahkan!', 'data' => $biblio]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'author_id' => ['required', 'exists:author,id'], //bentukan kalo ada foreign
            'responsibility' => 'nullable|max:255',
            'edition' => 'nullable|max:255',
            'spec_detail' => 'nullable|max:255',
            'coll_type_id' => ['nullable', 'max:255', 'exists:coll_type,id'], //bentukan kalo ada foreign
            'gmd' => 'nullable|max:255',
            'content_type' => 'nullable|max:255',
            'carrier_type' => 'nullable|max:255',
            'date' => 'nullable|date',
            'isbnissn' => ['nullable', 'unique:biblio,id', 'numeric'],
            'publisher_id' => ['nullable', 'exists:publisher,id'], //bentukan kalo ada foreign //bikin ini tidak liat model tapi liat dari migration
            'place' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'title_series' => 'nullable|max:255',
            'classification' => 'nullable|max:255',
            'call_number' => ['nullable', 'unique:biblio,id', 'numeric'],
            'language' => 'nullable',
            'abstract' => 'nullable|max:255',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        $data = $request->all();
        $imagePath = null;
        $biblio = biblio::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $storeImage = $image->storeAs('public/images', $fileName);
            $imagePath = asset(str_replace("public", "storage", $storeImage));
            $data['image'] = $imagePath;

            // http://127.0.0.1:8000/storage/images/1618531176_1618531176_eksemplar.jpg
            // public/images/1618531176_1618531176_eksemplar.jpg

            if ($biblio->image && Storage::exists(str_replace(asset('storage'), 'public', $biblio->image))) {
                Storage::delete(str_replace(asset('storage'), 'public', $biblio->image));
            }
        }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $biblio->update($data);

        return response()
            ->json(['message' => 'Data Biblio berhasil diubah!', 'data' => $biblio]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $fileName = time() . '_' . $image->getClientOriginalName();
        //     $storeImage = $image->storeAs('public/images', $fileName);
        //     $imagePath = asset(str_replace("public", "storage", $storeImage));
        //     $data['image'] = $imagePath;
        // }
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        // $biblio = Biblio::create($id);
        // $biblio->update($request->all());
        // return response()
        //     ->json(['message' => 'Data Biblio berhasil diubah!', 'data' => $biblio]);
    }

    public function destroyData(Request $request, $id)
    { //hard delete
        $biblio = Biblio::find($id);
        $biblio->forceDelete();
        return response()
            ->json(['message' => 'Data Buku berhasil dihapus!', 'data' => $biblio]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Eksemplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EksemplarController extends Controller
{
    //getData list semua data
    //showData detail 1 data
    //addData tambah data
    //editData edit data
    //hapusData hapus data

    public function getData(Request $request)
    {
        $search = $request->search;
        $eksemplar = Eksemplar::with(['bookstatus', 'loan', 'stocktakeitem', 'biblio.author', 'biblio.colltype', 'biblio.publisher'])->get();
        if ($search) {
            $eksemplar = Eksemplar::whereHas("biblio", function ($b) use ($search) {
                $b->where('title', 'LIKE', "%$search%");
            })->orWhere('item_code', 'LIKE', "%$search%")->get();
        }

        return response()->json($eksemplar, 200);
    }

    public function showData($id)
    {
        $eksemplar = Eksemplar::with(['bookstatus', 'loan'])->findOrFail($id);
        return response()->json($eksemplar, 200);
    }

    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_code' => 'required|max:255|numeric',
            'rfid_code' => 'required',
            'order_number' => 'nullable|numeric',
            'order_date' => 'required',
            'receipt_date' => 'required',
            'agent' => 'nullable',
            'source' => 'required',
            'invoice' => 'nullable',
            'price' => ['required', 'numeric'],
            'book_status_id' => ['required', 'exists:book_status,id'], //bentukan kalo ada foreign
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $eksemplar = Eksemplar::create($request->all());
        return response()
            ->json(['message' => 'Eksemplar baru berhasil ditambahkan!', 'data' => $eksemplar]);
    }

    public function editData(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'item_code' => 'required|max:255',
            'rfid_code' => 'required',
            'order_number' => 'nullable',
            'order_date' => 'required',
            'receipt_date' => 'required',
            'agent' => 'nullable',
            'source' => 'required',
            'invoice' => 'nullable',
            'price' => ['required', 'numeric'],
            'book_status_id' => ['required', 'exists:bookstatus,id'], //bentukan kalo ada foreign
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $eksemplar = Eksemplar::find($id);
        $eksemplar->update($request->all());
        return response()
            ->json(['message' => 'Data Eksemplar berhasil diubah!', 'data' => $eksemplar]);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $eksemplar = Eksemplar::find($id);
        $eksemplar->forceDelete();
        return response()
            ->json(['message' => 'Data Eksemplar ' . ($request->item_code) . ' berhasil dihapus!', 'data' => $eksemplar]);
    }
}

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
        $eksemplar = Eksemplar::with(['bookstatus', 'loan', 'stocktakeitem', 'biblio.author', 'biblio.colltype', 'biblio.publisher']);

        if ($search) {
            $eksemplar = $eksemplar->whereHas("biblio", function ($b) use ($search) {
                $b->where('title', 'LIKE', "%$search%");
            })->orWhere('item_code', 'LIKE', "%$search%");
        }

        $eksemplar = $eksemplar->get();

        return response()->json($eksemplar, 200);
    }

    public function showData($id)
    {
        $eksemplar = Eksemplar::with(['bookstatus', 'loan', 'biblio'])->findOrFail($id);
        return response()->json($eksemplar, 200);
    }

    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'biblio_id' => 'required|exists:biblio,id',
            'item_code' => 'required|numeric|unique:eksemplar,item_code',
            'rfid_code' => 'nullable|unique:eksemplar,rfid_code',
            'order_number' => 'nullable|numeric',
            'order_date' => 'nullable|date',
            'receipt_date' => 'nullable|date',
            'agent' => 'nullable|max:255|string',
            'source' => 'required',
            'invoice' => 'nullable',
            'price' => ['nullable', 'numeric'],
            'book_status_id' => ['nullable', 'exists:book_statuses,id'], //bentukan kalo ada foreign
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
            'item_code' => "required|numeric|unique:eksemplar,item_code,$id",
            'rfid_code' => "nullable|unique:eksemplar,rfid_code,$id",
            'order_number' => 'nullable|numeric',
            'order_date' => 'nullable|date',
            'receipt_date' => 'nullable|date',
            'agent' => 'nullable|max:255|string',
            'source' => 'nullable',
            'invoice' => 'nullable',
            'price' => ['nullable', 'numeric'],
            'book_status_id' => ['nullable', 'exists:book_statuses,id'], //bentukan kalo ada foreign
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
        //if eksemplar masih ada di loan dan status Sedang Dipinjam jgn diteruskan di delete
        // $loan = Loan::where('eksemplar_id', $id)->first();
        // if ($loan->loan_status == 'Sedang Dipinjam') {
        //     return response()->json(['message' => 'Eksemplar Sedang dipinjam!'], 422);
        // }
        if($eksemplar->book_status_id == 1){
            return response()->json(['message' => 'Eksemplar Sedang dipinjam!'], 422);
        } else {
            $eksemplar->forceDelete();
            return response()
                ->json(['message' => 'Data Eksemplar ' . ($request->item_code) . ' berhasil dihapus!', 'data' => $eksemplar]);
        }



    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class VisitorController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $visitor = Visitor::with(['type']);

        if ($search) {
            $visitor = $visitor->whereHas("type", function ($b) use ($search) {
                $b->where('name', 'LIKE', "%$search%");
            })->orWhere('name', 'LIKE', "%$search%")->orWhere('institution', 'LIKE', "%$search%")->orWhere('updated_at', 'LIKE', "%$search%");
        }
        $visitor = $visitor->get();

        return response()->json($visitor, 200);
    }

    public function showData($id)
    {
        $visitor = Visitor::with(['type'])->findOrFail($id); //with(['type:id,name']) utk menampilkan data tertentu
        return response()->json($visitor, 200);

    }

    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'institution' => 'required|max:255|string',
            'jenis_id' => ['required', 'exists:types,id'], //bentukan kalo ada foreign

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $visitor = Visitor::create($request->all());
        return response()
        ->json(['message'=>'Pengunjung baru berhasil ditambahkan!', 'data'=>$visitor]);
    }
}

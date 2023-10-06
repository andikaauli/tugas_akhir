<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function getData()
    {
        $member = Member::all();
        return response()->json($member, 200);

    }

    public function showData($id)
    {
        $member = Member::all()->findOrFail($id);
        return response()->json($member, 200);
    }

    // public function showData($id)
    // {
    //     $member = Member::all()->find($id);
    //     if(is_null($member)){
    //         return abort(422);
    //     }
    //     return response()->json($member, 200);
    // }

    public function addData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'nim' => 'required|max:255|numeric','unique:member',
            'gender' => 'required|max:255',
            'birth_date' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|max:255|email','unique:member',
            'instituion' => 'required|max:255',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'required|max:255|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $member = Member::create($request->all());
        return response()
            ->json(['message'=>'Anggota baru berhasil ditambahkan!', 'data'=>$member]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'nim' => 'required|max:255|numeric','unique:member',
            'gender' => 'required|max:255',
            'birth_date' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|max:255|email','unique:member',
            'instituion' => 'required|max:255',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'required|max:255|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $member = Member::find($id);
        $member->update($request->all());
        return response()
            ->json(['message'=>'Data Anggota berhasil diubah!', 'data'=>$member]);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $member = Member::find($id);
        $member->forceDelete();
        return response()
            ->json(['message'=>'Data Anggota'.($request->name).' berhasil dihapus!', 'data'=>$member]);
    }
}

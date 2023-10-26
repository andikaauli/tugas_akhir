<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function getData(Request $request)
    {
        $search = $request->search;
        $member = Member::with(['loan'])->get();
        // $member = Member::all();
        if ($search) {
            $member = Member::where('name', 'LIKE', "%$search%")
                ->orWhere('nim', 'LIKE', "%$search%")->get();
        }
        return response()->json($member, 200);
    }

    public function showData($id)
    {
        // $member = Member::all()->findOrFail($id);
        $member = Member::with(['loan'])->findOrFail($id);
        return response()->json($member, 200);
    }

    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'nim' => 'required|min:14|numeric', 'unique:member',
            'gender' => 'nullable',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|max:255',
            'email' => 'nullable|max:255|email', 'unique:member',
            'institution' => 'nullable|max:255|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'nullable|min:11|numeric', 'unique:member',
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
        $member = Member::create($data);
        return response()
            ->json(['message' => 'Anggota baru berhasil ditambahkan!', 'data' => $member]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255|string',
            'nim' => 'nullable|min:14|numeric', 'unique:member,id',
            'gender' => 'nullable',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|max:255',
            'email' => 'nullable|max:255|email', 'unique:member,id',
            'institution' => 'nullable|max:255|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'nullable|min:11|numeric', 'unique:member,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $fileName);
            $memberImage = $fileName;

            if ($memberImage && Storage::exists('public/images/' . $memberImage)) {
                Storage::delete('public/images/' . $memberImage);
            }
        }

        $member = Member::find($id);
        $member->update($request->all());
        return response()
            ->json(['message' => 'Data Anggota berhasil diubah!', 'data' => $member]);
    }


    public function destroyData(Request $request, $id)
    { //hard delete
        $member = Member::find($id);
        $member->forceDelete();
        return response()
            ->json(['message' => 'Data Anggota' . ($request->name) . ' berhasil dihapus!', 'data' => $member]);
    }
}

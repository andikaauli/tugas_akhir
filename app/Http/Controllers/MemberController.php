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
            'phone' => 'nullable|min:11|numeric|regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:member',
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
            'name' => 'required|max:255|string',
            'nim' => 'required|min:14|numeric', 'unique:member,id',
            'gender' => 'nullable',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|max:255',
            'email' => 'nullable|max:255|email', 'unique:member,id',
            'institution' => 'nullable|max:255|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'nullable|min:11|numeric|regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:member,id',
        ]);

        $data = $request->all();
        $imagePath = null;
        $member = Member::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $storeImage = $image->storeAs('public/images', $fileName);
            $imagePath = asset(str_replace("public", "storage", $storeImage));
            $data['image'] = $imagePath;

            // http://127.0.0.1:8000/storage/images/1618531176_1618531176_eksemplar.jpg
            // public/images/1618531176_1618531176_eksemplar.jpg

            if ($biblio->image && Storage::exists(str_replace(asset('storage'), 'public', $member->image))) {
                Storage::delete(str_replace(asset('storage'), 'public', $member->image));
            }
        }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $member->update($data);

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

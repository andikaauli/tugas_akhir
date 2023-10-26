<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BibliooController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'nim' => 'required|min:14|numeric', 'unique:member',
            'gender' => 'required',
            'birthdate' => 'required|date',
            'address' => 'required|max:255',
            'email' => 'required|max:255|email', 'unique:member',
            'institution' => 'required|max:255|string',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
            'phone' => 'required|min:11|numeric', 'unique:member',
        ]);

        $data = $request->all();
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '' . $image->getClientOriginalName();
            $storeImage = $image->storeAs('public/images', $fileName);
            $imagePath = asset(str_replace("public", "storage", $storeImage));
            $data['image'] = $imagePath;
            // $member->image = $fileName;
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $member = Member::create($data);
        return response()
            ->json(['message' => 'Anggota baru berhasil ditambahkan!', 'data' => $member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

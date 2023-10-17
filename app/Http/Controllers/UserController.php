<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function getData()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function showData()
    {
        //info admin siapa yg login
        $user = auth()->user();
        // $user = User::all()->findOrFail($id);
        return response()->json($user, 200);
    }

    public function addData(Request $request)
    {//jika dibutuhkan tambah data

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255','unique:user',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'required|max:255|email','unique:user',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($request->all());
        return response()
            ->json(['message'=>'Admin baru berhasil ditambahkan!', 'data'=>$user]);
    }

    public function editData(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255','unique:user',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'required|max:255|email','unique:user',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::find($id);
        $user->update($request->all());
        return response()
            ->json(['message'=>'Data Admin berhasil diubah!', 'data'=>$user]);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(!auth()->attempt(['username' => $request->username, 'password' => $request->password]))
        {
            return response()->json(['message' =>'Username atau password Anda salah!'], 404);
        }

        $user = User::findOrFail(auth()->user()->id);

        return response()
            ->json(['message'=>($user->name).' berhasil Login!', 'data'=>$user]);
    }

    public function logout()
    {
        auth()->user();
        return response()->json(['message'=>'Anda berhasil Logout!']);
    }

}

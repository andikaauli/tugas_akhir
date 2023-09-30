<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function getData()
    {
        $user = User::all();
        return response()->json($user);
    }

    // public function addData(Request $request)
    // {//jika dibutuhkan tambah data

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:255|string',
    //         'username' => 'required|max:255','unique:user',
    //         'password' => 'required|min:8',
    //         'email' => 'required|max:255|email','unique:user',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $user = User::create($request->all());

    //     // $user = User::create([
    //     //     'name'=>$request['name'],
    //     //     'username'=>$request['username'],
    //     //     'email' => $request['email'],
    //     //     'password' =>bcrypt($request['password'])
    //     // ]);  //jika ingin hash password saat tambah akun
    //     ////lebih singkat atur di model


    //     return response()
    //         ->json($user, 200)
    //         ->with('success', 'User created successfully.');
    // }

}

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

    public function addData(Request $request)
    {//jika dibutuhkan tambah data

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255|string',
            'username' => 'nullable|max:255','unique:user',
            'password' => 'nullable|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'nullable|max:255|email','unique:user',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($request->all());

        // $user = User::create([
        //     'name'=>$request['name'],
        //     'username'=>$request['username'],
        //     'email' => $request['email'],
        //     'password' =>bcrypt($request['password'])
        // ]);  //jika ingin hash password saat tambah akun
        ////lebih singkat atur di model


        return response()
            ->json(['message'=>'Admin baru berhasil ditambahkan!', 'data'=>$user]);
    }

    public function editData(Request $request, $id)
    {//jika dibutuhkan tambah data

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:255|string',
            'username' => 'nullable|max:255','unique:user',
            'password' => 'nullable|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'nullable|max:255|email','unique:user',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::find($id);
        $user->update($request->all());
        return response()
            ->json(['message'=>'Data Admin berhasil diubah!', 'data'=>$user]);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required',
    //     ]);
    //     if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/');
    //     }

    //     return back()->withErrors([
    //         'password' => 'Wrong username or password',
    //     ]);
    // }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        // if($validator->fails())
        // {
        //     return response()->json($validator->errors(), 422);
        // }

        // if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //     $user = $request->user();
        //     // $request->session()->regenerate();
        //     // return redirect()->intended('/');
        // }

        if(!auth()->attempt(['username' => $request->username, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return response()->json(['message' =>'Username atau password Anda salah!'], 404);
        }

        $user = User::findOrFail(auth()->user()->id);

        return response()
            ->json(['message'=>($user->name).' berhasil Login!', 'data'=>$user]);

    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message'=>'Anda berhasil Logout!']);
    }

}

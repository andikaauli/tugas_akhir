<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



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
    { //jika dibutuhkan tambah data

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255', 'unique:user',
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
            'email' => 'required|max:255|email', 'unique:user',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create(['name' => $request->name, 'username' => $request->username, 'password' => Hash::make($request->password), 'email' => $request->email, 'image' => $request->image]);
        return response()
            ->json(['message' => 'Admin baru berhasil ditambahkan!', 'data' => $user]);
    }

    public function editData(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'username' => 'required|max:255', 'unique:user.id',
            'new_password' => 'nullable|min:8',
            'password_confirm' => 'nullable|same:new_password',
            'email' => 'nullable|max:255|email', 'unique:user.id',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->new_password),
            'email' => $request->email,
            'image' => $request->image,
        ]);
        return response()
            ->json(['message' => 'Data Admin berhasil diubah!', 'data' => $user]);
    }

    public function login(Request $request)
    {
        return view('dashboard.login');
    }
    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('beranda');
            // return redirect()->intended('beranda');
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Nama Pengguna atau Kata Sandi Salah. AKSES DITOLAK');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return response()->json(['message'=>'Anda berhasil Logout!']);
        return redirect('login');
    }
}

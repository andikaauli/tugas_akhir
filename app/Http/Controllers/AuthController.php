<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

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
            return redirect('bibliografi');
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Nama Pengguna atau Kata Sandi Salah. AKSES DITOLAK');
        return redirect('login');
    }
}

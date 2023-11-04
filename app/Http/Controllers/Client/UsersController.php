<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('petugas/beranda/edit-profil');
    }
    public function update(Request $request)
    {
        return view('petugas/beranda/edit-profil');
    }
}

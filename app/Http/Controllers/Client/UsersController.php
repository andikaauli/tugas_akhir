<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('petugas/beranda/edit-profil', $data);
    }
    public function update(Request $request)
    {
        $http = new Request();
        $http = $http->create(url('api') . '/user/edit/', 'POST', $request->except('_method'), files: $request->allFiles());
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }



        return redirect()->route('client.edit-profil')->with('success', 'Profile berhasil diperbaharui!');
    }
}

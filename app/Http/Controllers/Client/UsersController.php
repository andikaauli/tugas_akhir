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
        $user=auth()->user();
        $data['user'] = $user;
        return view('petugas/beranda/edit-profil', $data);
    }
    public function update(Request $request)
    {
        // $user=auth()->user();
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:255|string',
        //     'username' => 'required|max:255','unique:user.id',
        //     // 'password' => 'nullable|min:8',
        //     // 'password_confirm' => 'nullable|same:password',
        //     'email' => 'nullable|max:255|email','unique:user.id',
        //     'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        // // $user->auth()->user();
        // $user->update($request->all());
        // return redirect()->route('client.edit-profil')->with('success', 'Profile berhasil diperbaharui!');

        $http = new Request();
        $http = $http->create(config('app.api_url') . '/user/edit/', 'POST', $request->except('_method'));
        $response = app()->handle($http);

        if ($response->isClientError()) {
            return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        }

        return redirect()->route('client.edit-profil')->with('success', 'Profile berhasil diperbaharui!');
    }
}

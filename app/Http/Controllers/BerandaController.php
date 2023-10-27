<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function getData()
    {
        return view('petugas.beranda.beranda');
    }
    public function index(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/visitor', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();
        $visitors = json_decode($response);
        return view('petugas/beranda/beranda', ['visitors' => $visitors]);
    }
}

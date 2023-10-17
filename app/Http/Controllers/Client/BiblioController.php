<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiblioController extends Controller
{
    function getBiblio(Request $request)
    {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $eksemplarReq = new Request();
        $eksemplarReq = $eksemplarReq->create(config('app.api_url') . '/eksemplar/');
        $eksemplarRes = app()->handle($eksemplarReq);
        $eksemplarRes = $eksemplarRes->getContent();

        $bibliografi = json_decode($response);
        $eksemplar = json_decode($eksemplarReq);



        return view('petugas/bibliografi/bibliografi', ['bibliografi' => $bibliografi, 'eksemplars' => $eksemplar]);
    }
}

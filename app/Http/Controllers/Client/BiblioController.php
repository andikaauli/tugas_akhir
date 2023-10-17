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

        $bibliografi = json_decode($response);



        return view('petugas/bibliografi/bibliografi', ['bibliografi' => $bibliografi]);
    }
}

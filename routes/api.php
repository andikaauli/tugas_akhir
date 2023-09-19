<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiblioController;
use App\Http\Controllers\EksemplarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::get('/biblio', [BiblioController::class, "getData"]);
Route::get('/biblio/{id}', [BiblioController::class, "showData"]);
Route::post('/biblio', [BiblioController::class, "addData"]);
Route::get('/biblio/edit/{id}', [BiblioController::class, "editData"]);

Route::get('/eksemplar', [EksemplarController::class, "getData"]);
Route::get('/eksemplar/{id}', [EksemplarController::class, "showData"]);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BiblioController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CollTypeController;
use App\Http\Controllers\EksemplarController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookStatusController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\StockTakeItemController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::get('/author', [AuthorController::class, "getData"]);
Route::get('/author/{id}', [AuthorController::class, "showData"]);
Route::post('/author/add', [AuthorController::class, "addData"]);
Route::post('/author/edit/{id}', [AuthorController::class, "editData"]);
Route::delete('/author/destroy/{id}', [AuthorController::class, "destroyData"]);

Route::get('/biblio', [BiblioController::class, "getData"]);
Route::get('/biblio/{id}', [BiblioController::class, "showData"]);
Route::post('/biblio/add', [BiblioController::class, "addData"]);
Route::post('/biblio/edit/{id}', [BiblioController::class, "editData"]);
Route::delete('/biblio/destroy/{id}', [BiblioController::class, "destroyData"]);

Route::get('/bookstatus', [BookStatusController::class, "getData"]);

Route::get('/colltype', [CollTypeController::class, "getData"]);
Route::get('/colltype/{id}', [CollTypeController::class, "showData"]);
Route::post('/colltype/add', [CollTypeController::class, "addData"]);
Route::post('/colltype/edit/{id}', [CollTypeController::class, "editData"]);
Route::delete('/colltype/destroy/{id}', [CollTypeController::class, "destroyData"]);

Route::get('/eksemplar', [EksemplarController::class, "getData"]);
Route::get('/eksemplar/{id}', [EksemplarController::class, "showData"]);
Route::post('/eksemplar/add', [EksemplarController::class, "addData"]);
Route::post('/eksemplar/edit/{id}', [EksemplarController::class, "editData"]);

Route::get('/loan', [LoanController::class, "getData"]);
Route::get('/loan/{id}', [LoanController::class, "showData"]);
Route::post('/loan/add/{id}', [LoanController::class, "peminjaman"]);
Route::post('/loan/perpanjang/{id}', [LoanController::class, "perpanjang"]);
Route::post('/loan/pengembalian/{id}', [LoanController::class, "pengembalian"]);
Route::delete('/loan/destroy/{id}', [LoanController::class, "destroyData"]);


Route::get('/member', [MemberController::class, "getData"]);
Route::get('/member/{id}', [MemberController::class, "showData"]);
Route::post('/member/add', [MemberController::class, "addData"]);
Route::post('/member/edit/{id}', [MemberController::class, "editData"]);
Route::delete('/member/destroy/{id}', [MemberController::class, "destroyData"]);

Route::get('/publisher', [PublisherController::class, "getData"]);
Route::get('/publisher/{id}', [PublisherController::class, "showData"]);
Route::post('/publisher/add', [PublisherController::class, "addData"]);
Route::post('/publisher/edit/{id}', [PublisherController::class, "editData"]);
Route::delete('/publisher/destroy/{id}', [PublisherController::class, "destroyData"]);

Route::get('/stockopname', [StockOpnameController::class, "getData"]);
Route::get('/stockopname/{id}', [StockOpnameController::class, "showData"]);
Route::post('/stockopname/finish/{id}', [StockOpnameController::class, "finishStockOpname"]);
Route::post('/stockopname/add', [StockOpnameController::class, "addData"]);

Route::post('/stocktakeitem', [StockTakeItemController::class, "editData"]);
Route::get('/stocktakeitem', [StockTakeItemController::class, "getData"]);
Route::post('/stocktakeitem/button', [StockTakeItemController::class, "editDataButton"]);

Route::get('/type', [TypeController::class, "getData"]);

Route::get('/user', [UserController::class, "getData"]);
Route::get('/userlogin', [UserController::class, "showData"]);
Route::post('/user/add', [UserController::class, "addData"]);
Route::post('/user/login', [UserController::class, "login"]);
Route::post('/user/logout', [UserController::class, "logout"]);
Route::post('/user/edit/{id}', [UserController::class, "editData"]);

Route::get('/visitor', [VisitorController::class, "getData"]);
Route::get('/visitor/{id}', [VisitorController::class, "showData"]);
Route::post('/visitor/add', [VisitorController::class, "addData"]);




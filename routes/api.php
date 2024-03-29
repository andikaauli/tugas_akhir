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
use App\Http\Controllers\RfidTempController;
use App\Http\Controllers\EksemplarController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookStatusController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\StockTakeItemController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix("author")->group(function () {
Route::group(['prefix' => 'author', 'middleware' => ['auth']], function () {
    Route::get('', [AuthorController::class, "getData"]);
    Route::get('/{id}', [AuthorController::class, "showData"]);
    Route::post('/add', [AuthorController::class, "addData"]);
    Route::post('/edit/{id}', [AuthorController::class, "editData"]);
    Route::delete('/destroy/{id}', [AuthorController::class, "destroyData"]);
});

Route::prefix("biblio")->group(function () {
    Route::get('', [BiblioController::class, "getData"]);
    Route::get('/{id}', [BiblioController::class, "showData"]);
    Route::post('/add', [BiblioController::class, "addData"])->middleware('auth');
    Route::post('/edit/{id}', [BiblioController::class, "editData"])->middleware('auth');
    Route::delete('/destroy/{id}', [BiblioController::class, "destroyData"])->middleware('auth');
});

Route::prefix("bookstatus")->group(function () {
    Route::get('', [BookStatusController::class, "getData"]);
});

Route::prefix("colltype")->group(function () {
    Route::get('', [CollTypeController::class, "getData"]);
    Route::get('/{id}', [CollTypeController::class, "showData"]);
    Route::post('/add', [CollTypeController::class, "addData"]);
    Route::post('/edit/{id}', [CollTypeController::class, "editData"]);
    Route::delete('/destroy/{id}', [CollTypeController::class, "destroyData"]);
});

// Route::prefix("eksemplar")->group(function () {
Route::group(['prefix' => 'eksemplar', 'middleware' => ['auth']], function () {
    Route::get('', [EksemplarController::class, "getData"]);
    Route::get('/{id}', [EksemplarController::class, "showData"]);
    Route::post('/add', [EksemplarController::class, "addData"]);
    Route::post('/edit/{id}', [EksemplarController::class, "editData"]);
    Route::post('/addRFID/{rfid_code}', [EksemplarController::class, "addRFID"]);
    Route::delete('/destroy/{id}', [EksemplarController::class, "destroyData"]);

});

// Route::prefix("loan")->group(function () {
Route::group(['prefix' => 'loan', 'middleware' => ['auth']], function () {
    Route::get('', [LoanController::class, "getData"]);
    Route::get('/{id}', [LoanController::class, "showData"]);
    Route::post('/add/{id}', [LoanController::class, "peminjaman"]);
    Route::post('/transaksi/{member}', [LoanController::class, "selesai_transaksi"]);
    Route::post('/pengembalian/{id}', [LoanController::class, "pengembalian"]);
    Route::post('/pengembaliankilat', [LoanController::class, "pengembalianButton"])->name('button.fastreturn');
    Route::post('/perpanjang/{id}', [LoanController::class, "perpanjang"]);
    Route::delete('/destroy/{id}', [LoanController::class, "destroyData"]);
});

// Route::prefix("member")->group(function () {
Route::group(['prefix' => 'member', 'middleware' => ['auth']], function () {
    Route::get('', [MemberController::class, "getData"]);
    Route::get('/{id}', [MemberController::class, "showData"]);
    Route::post('/add', [MemberController::class, "addData"]);
    Route::post('/edit/{id}', [MemberController::class, "editData"]);
    Route::delete('/destroy/{id}', [MemberController::class, "destroyData"]);
});

// Route::prefix("publisher")->group(function () {
Route::group(['prefix' => 'publisher', 'middleware' => ['auth']], function () {
    Route::get('', [PublisherController::class, "getData"]);
    Route::get('/{id}', [PublisherController::class, "showData"]);
    Route::post('/add', [PublisherController::class, "addData"]);
    Route::post('/edit/{id}', [PublisherController::class, "editData"]);
    Route::delete('/destroy/{id}', [PublisherController::class, "destroyData"]);
});


Route::prefix("rfidtemp")->group(function () {
// Route::group(['prefix' => 'rfidtemp', 'middleware' => ['auth']], function () {
    Route::get('', [RfidTempController::class, "getData"])->name('get.rfidtemp');
    Route::post('/add', [RfidTempController::class, "addData"]);
});

// Route::prefix("stockopname")->group(function () {
Route::group(['prefix' => 'stockopname', 'middleware' => ['auth']], function () {
    Route::get('', [StockOpnameController::class, "getData"]);
    Route::get('/{id}', [StockOpnameController::class, "showData"])->name('show.stockopname');
    Route::post('/finish/{id}', [StockOpnameController::class, "finishStockOpname"]);
    Route::post('/add', [StockOpnameController::class, "addData"]);
});

// Route::prefix("stocktakeitem")->group(function () {
Route::group(['prefix' => 'stocktakeitem'], function () {
    Route::get('', [StockTakeItemController::class, "getData"]);
    Route::post('/edit', [StockTakeItemController::class, "editData"]);
    Route::post('/button', [StockTakeItemController::class, "editDataButton"])->name('button.stocktakeitem')->middleware('auth');
});

Route::prefix("type")->group(function () {
    Route::get('', [TypeController::class, "getData"]);
});

Route::prefix("user")->group(function () {
// Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('', [UserController::class, "getData"])->middleware('auth');
    Route::get('/userlogin', [UserController::class, "showData"])->middleware('auth');
    Route::post('/add', [UserController::class, "addData"])->middleware('auth');
    Route::get('/login', [UserController::class, "login"]);
    Route::post('/login', [UserController::class, "authenticating"]);
    Route::post('/logout', [UserController::class, "logout"])->middleware('auth');
    Route::post('/edit', [UserController::class, "editData"])->middleware('auth');
    Route::get('/forgot-password', [UserController::class, "showForgotPasswordForm"]);
    Route::post('/forgot-password', [UserController::class, 'sendResetLinkEmail']);
    Route::post('/password/email', [UserController::class, 'sendResetLinkEmail']);
});

Route::prefix("visitor")->group(function () {
    Route::get('', [VisitorController::class, "getData"])->middleware('auth');
    Route::get('/{id}', [VisitorController::class, "showData"])->middleware('auth');
    Route::post('/add', [VisitorController::class, "addData"]);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookStatusController;
use App\Http\Controllers\Client\BiblioController;
use App\Http\Controllers\Client\EksemplarsController;
use App\Http\Controllers\Client\MembersController;
use App\Http\Controllers\Client\AuthorsController;
use App\Http\Controllers\Client\ColltypesController;
use App\Http\Controllers\Client\PublishersController;
use App\Http\Controllers\Client\LoansController;
use App\Http\Controllers\EksemplarController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StockTakeItemController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
use App\Models\BookStatus;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("/bibliografi")->group(function () {
    Route::get('/', [BiblioController::class, 'getBiblio'])->name('client.bibliografi');
    Route::delete('/delete', [BiblioController::class, 'destroy'])->name('client.delete-bibliografi');
    Route::get('/create', [BiblioController::class, 'create']);
    Route::post('/create', [BiblioController::class, 'store'])->name('client.create-bibliografi');
    Route::get('/edit/{id}', [BiblioController::class, 'edit'])->name('client.edit-bibliografi');
    Route::put('/edit/{id}', [BiblioController::class, 'update']);
});



Route::prefix("/eksemplar")->group(function () {
    Route::get('/', [EksemplarsController::class, 'index'])->name('client.eksemplar');
    Route::delete('/delete', [EksemplarsController::class, 'destroy'])->name('client.delete-eksemplar');
    Route::get('/create', [EksemplarsController::class, 'create']);
    Route::post('/create', [EksemplarsController::class, 'store'])->name('client.create-eksemplar');
    Route::get('/edit/{id}', [EksemplarsController::class, 'edit'])->name('client.edit-eksemplar');
    Route::put('/edit/{id}', [EksemplarsController::class, 'update']);
});

Route::get('/eksemplar-keluar', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $loan = json_decode($response);

    return view('petugas/bibliografi/eksemplar-keluar', ['loan' => $loan]);
})->name('client.loan');

Route::get('/edit-eksemplar', function () {
    return view('petugas/bibliografi/edit-eksemplar');
});

Route::get('/mulai-transaksi', function () {
    return view('petugas/sirkulasi/mulai-transaksi');
});

Route::get('/pengembalian-kilat', function () {
    return view('petugas/sirkulasi/pengembalian-kilat');
});

Route::get('/sejarah-peminjaman', function () {
    return view('petugas/sirkulasi/sejarah-peminjaman');
});

Route::get('/daftar-keterlambatan', function () {
    return view('petugas/sirkulasi/daftar-keterlambatan');
});

Route::prefix("/anggota")->group(function () {
    Route::get('/', [MembersController::class, 'index'])->name('client.member');
    Route::delete('/delete', [MembersController::class, 'destroy'])->name('client.delete-member');
    Route::get('/create', [MembersController::class, 'create']);
    Route::post('/create', [MembersController::class, 'store'])->name('client.create-member');
    Route::get('/edit/{id}', [MembersController::class, 'edit'])->name('client.edit-member');
    Route::put('/edit/{id}', [MembersController::class, 'update']);
});

Route::prefix("/author")->group(function () {
    Route::get('/', [AuthorsController::class, 'index'])->name('client.authors');
    Route::delete('/delete', [AuthorsController::class, 'destroy'])->name('client.delete-authors');
    Route::get('/create', [AuthorsController::class, 'create']);
    Route::post('/create', [AuthorsController::class, 'store'])->name('client.create-authors');
    Route::get('/edit/{id}', [AuthorsController::class, 'edit'])->name('client.edit-authors');
    Route::put('/edit/{id}', [AuthorsController::class, 'update']);
});

// Route::get('/daftar-pengarang', function (Request $request) {

// })->name('client.authors');


// Route::delete('/daftar-pengarang/delete', function (Request $request) {

// })->name('client.delete-authors');

// Route::get('/create-pengarang', function () {

// });

// Route::post('/create-pengarang', function (Request $request) {

// })->name('client.create-authors');

// Route::get('/edit-pengarang/{id}', function ($id) {

// })->name('client.edit-authors');

// Route::put('/edit-pengarang/{id}', function (Request $request, $id) {

// });

Route::prefix("/publisher")->group(function () {
    Route::get('/', [PublishersController::class, 'index'])->name('client.publishers');
    Route::delete('/delete', [PublishersController::class, 'destroy'])->name('client.delete-publishers');
    Route::get('/create', [PublishersController::class, 'create']);
    Route::post('/create', [PublishersController::class, 'store'])->name('client.create-publishers');
    Route::get('/edit/{id}', [PublishersController::class, 'edit'])->name('client.edit-publishers');
    Route::put('/edit/{id}', [PublishersController::class, 'update']);
});

Route::prefix("/colltype")->group(function () {
    Route::get('/', [CollTypesController::class, 'index'])->name('client.colltypes');
    Route::delete('/delete', [CollTypesController::class, 'destroy'])->name('client.delete-colltypes');
    Route::get('/create', [CollTypesController::class, 'create']);
    Route::post('/create', [CollTypesController::class, 'store'])->name('client.create-colltypes');
    Route::get('/edit/{id}', [CollTypesController::class, 'edit'])->name('client.edit-colltypes');
    Route::put('/edit/{id}', [CollTypesController::class, 'update']);
});

Route::prefix("loan")->group(function () {
    Route::get('/history', [LoansController::class. 'index'])->name('client.loan-history');
});

// Route::get('/daftar-tipe-koleksi', function (Request $request) {

// })->name('client.colltypes');

// Route::delete('/daftar-tipe-koleksi/delete', function () {

// })->name('client.delete-colltypes');

// Route::get('/create-tipe-koleksi', function () {

// });

// Route::post('/create-tipe-koleksi', function (Request $request) {

// })->name('client.create-colltypes');

// Route::get('/edit-tipe-koleksi/{id}', function ($id) {

// })->name('client.edit-colltypes');

// Route::put('/edit-tipe-koleksi/{id}', function (Request $request, $id) {

// });

Route::get('/inisialisasi', function () {
    return view('petugas/inventarisasi/inisialisasi');
});

Route::get('/rekaman-inventarisasi', function () {
    return view('petugas/inventarisasi/rekaman-inventarisasi');
});

Route::get('/inventarisasi-aktif', function () {
    return view('petugas/inventarisasi/inventarisasi-aktif');
});

Route::get('/eksemplar-hilang', function () {
    return view('petugas/inventarisasi/eksemplar-hilang');
});

Route::get('/end-inventarisasi', function () {
    return view('petugas/inventarisasi/end-inventarisasi');
});

Route::get('/hasil-inventarisasi', function () {
    return view('petugas/inventarisasi/hasil-inventarisasi');
});

Route::get('/laporan-inventarisasi', function () {
    return view('petugas/inventarisasi/laporan-inventarisasi');
});

Route::get('/profil', function () {
    return view('dashboard/profil');
});

Route::get('/layanan', function () {
    return view('dashboard/layanan');
});

Route::get('/keanggotaan', function () {
    return view('dashboard/keanggotaan');
});

Route::get('/detail', function () {
    return view('dashboard/detail');
});

// Route::resource("zzz", VisitorController::class);

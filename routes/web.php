<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\BiblioController;
use App\Http\Controllers\EksemplarController;
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

Route::get('/bibliografi', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/biblio', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $bibliografi = json_decode($response);


    return view('petugas/bibliografi/bibliografi', ['bibliografi' => $bibliografi]);
})->name('client.bibliografi');

Route::delete('/bibliografi/delete', function (Request $request) {
    $deletedBiblioIdList = $request->deletedBiblio;

    if (!$deletedBiblioIdList) {
        return redirect()->back();
    }

    foreach ($deletedBiblioIdList as $biblioId) {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/biblio/destroy/' . $biblioId, 'DELETE');
        $response = app()->handle($http);
    }

    return redirect()->route('client.bibliografi');
})->name('client.delete-bibliografi');

Route::get('/create-bibliografi', function () {
    return view('petugas/bibliografi/create-bibliografi');
});

Route::post('/create-bibliografi', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/biblio/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.bibliografi');
})->name('client.create-bibliografi');

Route::get('/eksemplar', function () {
    return view('petugas/bibliografi/eksemplar');
});

Route::get('/eksemplar-keluar', function () {
    return view('petugas/bibliografi/eksemplar-keluar');
});

Route::get('/edit-eksemplar', function () {
    return view('petugas/bibliografi/edit-eksemplar');
});

Route::get('/edit-bibliografi/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/biblio/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();

    $bibliografi = json_decode($response);


    return view('petugas/bibliografi/edit-bibliografi', ['bibliografi' => $bibliografi]);
})->name('client.edit-bibliografi');

Route::put('/edit-bibliografi/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/biblio/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.bibliografi');
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

Route::get('/daftar-anggota', function () {
    return view('petugas/keanggotaan/daftar-anggota');
});

Route::get('/create-anggota', function () {
    return view('petugas/keanggotaan/create-anggota');
});

Route::get('/edit-anggota', function () {
    return view('petugas/keanggotaan/edit-anggota');
});

Route::get('/daftar-pengarang', function () {
    return view('petugas/daftar-terkendali/daftar-pengarang');
});

Route::get('/create-pengarang', function () {
    return view('petugas/daftar-terkendali/create-pengarang');
});

Route::get('/edit-pengarang', function () {
    return view('petugas/daftar-terkendali/edit-pengarang');
});

Route::get('/daftar-penerbit', function () {
    return view('petugas/daftar-terkendali/daftar-penerbit');
});

Route::get('/create-penerbit', function () {
    return view('petugas/daftar-terkendali/create-penerbit');
});

Route::get('/edit-penerbit', function () {
    return view('petugas/daftar-terkendali/edit-penerbit');
});

Route::get('/daftar-status', function () {
    return view('petugas/daftar-terkendali/daftar-status');
});

Route::get('/create-status', function () {
    return view('petugas/daftar-terkendali/create-status');
});

Route::get('/edit-status', function () {
    return view('petugas/daftar-terkendali/edit-status');
});

Route::get('/daftar-tipe-koleksi', function () {
    return view('petugas/daftar-terkendali/daftar-tipe-koleksi');
});

Route::get('/create-tipe-koleksi', function () {
    return view('petugas/daftar-terkendali/create-tipe-koleksi');
});

Route::get('/edit-tipe-koleksi', function () {
    return view('petugas/daftar-terkendali/edit-tipe-koleksi');
});

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


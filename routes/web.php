<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/bibliografi', function () {
    return view('petugas/bibliografi/bibliografi');
});

Route::get('/create-bibliografi', function () {
    return view('petugas/bibliografi/create-bibliografi');
});

Route::get('/eksemplar', function () {
    return view('petugas/bibliografi/eksemplar');
});

Route::get('/eksemplar-keluar', function () {
    return view('petugas/bibliografi/eksemplar-keluar');
});

Route::get('/edit-eksemplar', function () {
    return view('petugas/bibliografi/edit-eksemplar');
});

Route::get('/edit-bibliografi', function () {
    return view('petugas/bibliografi/edit-bibliografi');
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




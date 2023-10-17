<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookStatusController;
use App\Http\Controllers\Client\BiblioController;
use App\Http\Controllers\EksemplarController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StockTakeItemController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;
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

Route::get('/bibliografi', [BiblioController::class, 'getBiblio'])->name('client.bibliografi');

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

Route::get('/edit-bibliografi/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/biblio/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();

    $pengarangReq = new Request();
    $pengarangReq = $pengarangReq->create(config('app.api_url') . '/author/');
    $pengarangRes = app()->handle($pengarangReq);
    $pengarangRes = $pengarangRes->getContent();

    $publisherReq = new Request();
    $publisherReq = $publisherReq->create(config('app.api_url') . '/publisher/');
    $publisherRes = app()->handle($publisherReq);
    $publisherRes = $publisherRes->getContent();

    $bibliografi = json_decode($response);
    $pengarang = json_decode($pengarangRes);
    $publisher = json_decode($publisherRes);


    return view('petugas/bibliografi/edit-bibliografi', ['bibliografi' => $bibliografi, "pengarang" => $pengarang, "publishers" => $publisher]);
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

Route::prefix("/eksemplar")->group(function () {
    Route::get('/', function (Request $request) {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/eksemplar', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();


        $eksemplar = json_decode($response);


        return view('petugas/bibliografi/eksemplar', ['eksemplar' => $eksemplar]);
    })->name('client.eksemplar');

    Route::delete('/delete', function (Request $request) {
        $deletedEksemplarIdList = $request->deletedEksemplar;

        if (!$deletedEksemplarIdList) {
            return redirect()->back();
        }

        foreach ($deletedEksemplarIdList as $eksemplarId) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/eksemplar/destroy/' . $eksemplarId, 'DELETE');
            $response = app()->handle($http);
        }

        return redirect()->route('client.eksemplar');
    })->name('client.delete-eksemplar');
});



Route::get('/create-eksemplar', function () {
    return view('petugas/bibliografi/create-eksemplar');
});

Route::post('/create-eksemplar', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/eksemplar/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.eksemplar');
})->name('client.create-eksemplar');

Route::get('/edit-eksemplar/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/eksemplar/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();

    $eksemplar = json_decode($response);


    return view('petugas/bibliografi/edit-eksemplar', ['eksemplar' => $eksemplar]);
})->name('client.edit-eksemplar');

Route::put('/edit-eksemplar/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/eksemplar/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.eksemplar');
});

Route::get('/eksemplar-keluar', function () {
    return view('petugas/bibliografi/eksemplar-keluar');
});

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

Route::get('/daftar-anggota', function () {
    return view('petugas/keanggotaan/daftar-anggota');
});

Route::get('/create-anggota', function () {
    return view('petugas/keanggotaan/create-anggota');
});

Route::get('/edit-anggota', function () {
    return view('petugas/keanggotaan/edit-anggota');
});

Route::get('/daftar-pengarang', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/author', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $authors = json_decode($response);

    return view('petugas/daftar-terkendali/daftar-pengarang', ['authors' => $authors]);
})->name('client.authors');

Route::delete('/daftar-pengarang/delete', function (Request $request) {
    $deletedAuthorsIdList = $request->deletedAuthors;

    dd($deletedAuthorsIdList);

    if (!$deletedAuthorsIdList) {
        return redirect()->back();
    }

    foreach ($deletedAuthorsIdList as $authorsId) {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/author/destroy/' . $authorsId, 'DELETE');
        $response = app()->handle($http);
    }

    return redirect()->route('client.authors');
})->name('client.delete-authors');

Route::get('/create-pengarang', function () {
    return view('petugas/daftar-terkendali/create-pengarang');
});

Route::post('/create-pengarang', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/author/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.authors');
})->name('client.create-authors');

Route::get('/edit-pengarang/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/author/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();


    $authors = json_decode($response);

    return view('petugas/daftar-terkendali/edit-pengarang', ['author' => $authors]);
})->name('client.edit-authors');

Route::put('/edit-pengarang/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/author/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }


    return redirect()->route('client.authors');
});

Route::get('/daftar-penerbit', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/publisher', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $publishers = json_decode($response);


    return view('petugas/daftar-terkendali/daftar-penerbit', ['publishers' => $publishers]);
})->name('client.publishers');

Route::delete('/daftar-penerbit/delete', function (Request $request) {
    $deletedPublishersIdList = $request->deletedPublishers;

    if (!$deletedPublishersIdList) {
        return redirect()->back();
    }

    foreach ($deletedPublishersIdList as $publishersId) {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/publisher/destroy/' . $publishersId, 'DELETE');
        $response = app()->handle($http);
    }

    return redirect()->route('client.publishers');
})->name('client.delete-publishers');

Route::get('/create-penerbit', function () {
    return view('petugas/daftar-terkendali/create-penerbit');
});

Route::post('/create-penerbit', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/publisher/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.publishers');
})->name('client.create-publishers');

Route::get('/edit-penerbit/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/publisher/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();

    $publisher = json_decode($response);


    return view('petugas/daftar-terkendali/edit-penerbit', ['publisher' => $publisher]);
})->name('client.edit-publishers');

Route::put('/edit-penerbit/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/publisher/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }


    return redirect()->route('client.publishers');
});

Route::get('/daftar-tipe-koleksi', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/colltype', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $colltypes = json_decode($response);


    return view('petugas/daftar-terkendali/daftar-tipe-koleksi', ['colltypes' => $colltypes]);
})->name('client.colltypes');

Route::delete('/daftar-tipe-koleksi/delete', function (Request $request) {
    $deletedColltypesIdList = $request->deletedColltypes;

    if (!$deletedColltypesIdList) {
        return redirect()->back();
    }

    foreach ($deletedColltypesIdList as $colltypesId) {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/colltype/destroy/' . $colltypesId, 'DELETE');
        $response = app()->handle($http);
    }

    return redirect()->route('client.colltypes');
})->name('client.delete-colltypes');

Route::get('/create-tipe-koleksi', function () {
    return view('petugas/daftar-terkendali/create-tipe-koleksi');
});

Route::post('/create-tipe-koleksi', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/colltype/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.colltypes');
})->name('client.create-colltypes');

Route::get('/edit-tipe-koleksi/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/colltype/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();

    $colltypes = json_decode($response);


    return view('petugas/daftar-terkendali/edit-tipe-koleksi', ['colltypes' => $colltypes]);
})->name('client.edit-colltypes');

Route::put('/edit-tipe-koleksi/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/colltype/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }


    return redirect()->route('client.colltypes');
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

// Route::resource("zzz", VisitorController::class);

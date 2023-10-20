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
    Route::get('/', function (Request $request) {
        $search = $request->search;
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/eksemplar', 'GET', ['search' => $search]);
        $response = app()->handle($http);
        $response = $response->getContent();

        $eksemplar = json_decode($response);

        dd(collect($eksemplar)->paginate(5));

        // ! Nyoba BookStatus
        // ! Dari API
        $bs = new Request();
        $bs = $bs->create(config('app.api_url') . '/bookstatus', 'GET');
        $bsres = app()->handle($bs);
        $bsres = $bsres->getContent();
        $bsApi = json_decode($bsres);

        // ! Dari Model Langsung
        $bookstatus = BookStatus::all();

        // dd($bsApi, $bookstatus->toArray());
        // // ! Nyoba BookStatus

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

    // ! Dari API
    $bs = new Request();
    $bs = $bs->create(config('app.api_url') . '/bookstatus', 'GET');
    $bsres = app()->handle($bs);
    $bsres = $bsres->getContent();
    $bsApi = json_decode($bsres);


    $eksemplar = json_decode($response);


    return view('petugas/bibliografi/edit-eksemplar', ['eksemplar' => $eksemplar], ['status' =>  $bsApi]);
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

Route::get('/eksemplar-keluar', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $loan = json_decode($response);
    dd($loan);

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

Route::get('/daftar-anggota', function (Request $request) {
    $search = $request->search;
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/member', 'GET', ['search' => $search]);
    $response = app()->handle($http);
    $response = $response->getContent();

    $member = json_decode($response);
    dd($member);
    return view('petugas/keanggotaan/daftar-anggota', ['members' => $member]);
})->name('client.member');

Route::delete('/daftar-anggota/delete', function (Request $request) {
    $deletedMemberIdList = $request->deletedMember;

    if (!$deletedMemberIdList) {
        return redirect()->back();
    }

    foreach ($deletedMemberIdList as $memberId) {
        $http = new Request();
        $http = $http->create(config('app.api_url') . '/member/destroy/' . $memberId, 'DELETE');
        $response = app()->handle($http);
    }

    return redirect()->route('client.member');
})->name('client.delete-member');

Route::get('/create-anggota', function () {
    return view('petugas/keanggotaan/create-anggota');
});

Route::post('/create-anggota', function (Request $request) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/member/add', 'POST', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }

    return redirect()->route('client.member');
})->name('client.create-member');

Route::get('/edit-anggota', function () {
    return view('petugas/keanggotaan/edit-anggota');
});

Route::get('/edit-anggota/{id}', function ($id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/member/' . $id);
    $response = app()->handle($http);
    $response = $response->getContent();


    $member = json_decode($response);

    return view('petugas/daftar-terkendali/edit-pengarang', ['members' => $member]);
})->name('client.edit-member');

Route::put('/edit-anggota/{id}', function (Request $request, $id) {
    $http = new Request();
    $http = $http->create(config('app.api_url') . '/member/edit/' . $id, 'GET', $request->all());
    $response = app()->handle($http);

    if ($response->isClientError()) {
        return redirect()->back()->withErrors((array) json_decode($response->getContent()));
        // throw ValidationException::withMessages((array) json_decode($response->getContent()));
    }


    return redirect()->route('client.member');
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

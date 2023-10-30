<?php

use App\Models\BookStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\EksemplarController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookStatusController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\Client\LoansController;
use App\Http\Controllers\Client\BiblioController;
use App\Http\Controllers\StockTakeItemController;
use App\Http\Controllers\Client\AuthorsController;
use App\Http\Controllers\Client\MembersController;
use App\Http\Controllers\client\VisitorsController;
use App\Http\Controllers\Client\ColltypesController;
use App\Http\Controllers\Client\EksemplarsController;
use App\Http\Controllers\Client\PublishersController;
use App\Http\Controllers\Client\StockOpnamesController;
use App\Http\Controllers\Client\StockTakeItemsController;

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

Route::group(['prefix' => '/bibliografi', 'middleware' => ['auth']], function () {
    Route::get('/', [BiblioController::class, 'getBiblio'])->name('client.bibliografi');
    Route::delete('/delete', [BiblioController::class, 'destroy'])->name('client.delete-bibliografi');
    Route::get('/create', [BiblioController::class, 'create']);
    Route::post('/create', [BiblioController::class, 'store'])->name('client.create-bibliografi');
    Route::get('/edit/{id}', [BiblioController::class, 'edit'])->name('client.edit-bibliografi');
    Route::put('/edit/{id}', [BiblioController::class, 'update']);
});

//cadangan untuk eksemplar
// Route::prefix("/eksemplar")->group(function () {
//     Route::get('/', [EksemplarsController::class, 'index'])->name('client.eksemplar')->middleware('auth');
//     Route::delete('/delete', [EksemplarsController::class, 'destroy'])->name('client.delete-eksemplar')->middleware('auth');
//     Route::get('/create', [EksemplarsController::class, 'create'])->middleware('auth');
//     Route::post('/create', [EksemplarsController::class, 'store'])->name('client.create-eksemplar')->middleware('auth');
//     Route::get('/edit/{id}', [EksemplarsController::class, 'edit'])->name('client.edit-eksemplar')->middleware('auth');
//     Route::put('/edit/{id}', [EksemplarsController::class, 'update'])->middleware('auth');
// });
Route::group(['prefix' => '/eksemplar', 'middleware' => ['auth']], function () {
    Route::get('/', [EksemplarsController::class, 'index'])->name('client.eksemplar');
    Route::delete('/delete', [EksemplarsController::class, 'destroy'])->name('client.delete-eksemplar');
    Route::get('/create', [EksemplarsController::class, 'create'])->middleware('auth');
    Route::post('/create', [EksemplarsController::class, 'store'])->name('client.create-eksemplar');
    Route::get('/edit/{id}', [EksemplarsController::class, 'edit'])->name('client.edit-eksemplar');
    Route::put('/edit/{id}', [EksemplarsController::class, 'update']);

});
Route::get('/eksemplar-keluar', [LoansController::class, 'copyout'])->name('client.loan-copyout')->middleware('auth');

// Route::get('/eksemplar-keluar', function (Request $request) {
//     // $search = $request->search;
//     // $http = new Request();
//     // $http = $http->create(config('app.api_url') . '/loan', 'GET', ['search' => $search]);
//     // $response = app()->handle($http);
//     // $response = $response->getContent();

//     // $loan = json_decode($response);

//     // return view('petugas/bibliografi/eksemplar-keluar', ['loan' => $loan]);
// })->name('client.loan')->middleware('auth');

Route::get('/edit-eksemplar', function () {
    return view('petugas/bibliografi/edit-eksemplar');
})->middleware('auth');

Route::get('/mulai-transaksi', function () {
    return view('petugas/sirkulasi/mulai-transaksi');
})->middleware('auth');

Route::get('/pengembalian-kilat', function () {
    return view('petugas/sirkulasi/pengembalian-kilat');
})->middleware('auth');

Route::get('/sejarah-peminjaman', function () {
    return view('petugas/sirkulasi/sejarah-peminjaman');
})->middleware('auth');

Route::get('/daftar-keterlambatan', function () {
    return view('petugas/sirkulasi/daftar-keterlambatan');
})->middleware('auth');

Route::group(['prefix' => '/anggota', 'middleware' => ['auth']], function () {
    Route::get('/', [MembersController::class, 'index'])->name('client.member');
    Route::delete('/delete', [MembersController::class, 'destroy'])->name('client.delete-member');
    Route::get('/create', [MembersController::class, 'create']);
    Route::post('/create', [MembersController::class, 'store'])->name('client.create-member');
    Route::get('/edit/{id}', [MembersController::class, 'edit'])->name('client.edit-member');
    Route::put('/edit/{id}', [MembersController::class, 'update']);
});

Route::group(['prefix' => '/author', 'middleware' => ['auth']], function () {
    Route::get('/', [AuthorsController::class, 'index'])->name('client.authors');
    Route::delete('/delete', [AuthorsController::class, 'destroy'])->name('client.delete-authors');
    Route::get('/create', [AuthorsController::class, 'create']);
    Route::post('/create', [AuthorsController::class, 'store'])->name('client.create-authors');
    Route::get('/edit/{id}', [AuthorsController::class, 'edit'])->name('client.edit-authors');
    Route::put('/edit/{id}', [AuthorsController::class, 'update']);
});


Route::group(['prefix' => '/publisher', 'middleware' => ['auth']], function () {
    Route::get('/', [PublishersController::class, 'index'])->name('client.publishers');
    Route::delete('/delete', [PublishersController::class, 'destroy'])->name('client.delete-publishers');
    Route::get('/create', [PublishersController::class, 'create']);
    Route::post('/create', [PublishersController::class, 'store'])->name('client.create-publishers');
    Route::get('/edit/{id}', [PublishersController::class, 'edit'])->name('client.edit-publishers');
    Route::put('/edit/{id}', [PublishersController::class, 'update']);
});

Route::group(['prefix' => '/colltype', 'middleware' => ['auth']], function () {
    Route::get('/', [CollTypesController::class, 'index'])->name('client.colltypes');
    Route::delete('/delete', [CollTypesController::class, 'destroy'])->name('client.delete-colltypes');
    Route::get('/create', [CollTypesController::class, 'create']);
    Route::post('/create', [CollTypesController::class, 'store'])->name('client.create-colltypes');
    Route::get('/edit/{id}', [CollTypesController::class, 'edit'])->name('client.edit-colltypes');
    Route::put('/edit/{id}', [CollTypesController::class, 'update']);
});
Route::group(['prefix' => '/loan', 'middleware' => ['auth']], function () {
    Route::get('/history', [LoansController::class, 'index'])->name('client.loan-history');
    Route::get('/overdue', [LoansController::class, 'overdue'])->name('client.loan-overdue');
    Route::put('/pengembalian-kilat', [LoansController::class, 'overdue'])->name('client.loan-fastreturn');
});

Route::group(['prefix' => '/inventarisasi', 'middleware' => ['activate_inven']], function () {
    Route::get('/', function () {
        if (session('active_inventarisasi')) {
            return redirect(route('client.active-inventarisasi'));
        } else {
            return redirect(route('client.stockOpnameRecord'));
        }
    });
    Route::middleware('inven_is_active:false')->group(function () {
        Route::get('/inisialisasi', [StockOpnamesController::class, 'create']);
        Route::post('/inisialisasi', [StockOpnamesController::class, 'store'])->name('client.create-stockopname');
        Route::get('/rekaman', [StockOpnamesController::class, 'index'])->name('client.stockOpnameRecord');
        Route::get('/hasil/{id}', [StockOpnamesController::class, 'show'])->name('client.stockopname');

    });

    Route::middleware('inven_is_active:true')->group(function () {
        Route::get('/laporan', function () {
            return view('petugas/inventarisasi/laporan-inventarisasi');
        });
        Route::get('/end', function () {
            return view('petugas/inventarisasi/end-inventarisasi');
        });
        Route::post('/end', [StockOpnamesController::class, 'end'])->name('client.end-stockopname');

        Route::get('/aktif', function () {
            $inventarisasiId = session()->get('active_inventarisasi');

            return view('petugas/inventarisasi/inventarisasi-aktif', ['inventarisasiId' => $inventarisasiId]);
        })->name('client.active-inventarisasi');

        Route::get('/eksemplar-hilang', function () {
            return view('petugas/inventarisasi/eksemplar-hilang');
        });
    });
});

Route::middleware(['only_guest'])->group(function () {
    Route::get('/profil', function () {
        return view('dashboard/profil');
    });

    Route::get('/layanan', function () {
        return view('dashboard/layanan');
    });

    Route::get('/keanggotaan', function () {
        return view('dashboard/keanggotaan');
    });

    Route::get('/detail/{id}', [BiblioController::class, 'detail'])->name('client.detail');

    Route::get('/koleksi', [BiblioController::class, 'index'])->name('client.koleksi');
});

Route::group(['prefix' => '/absen', 'middleware' => ['only_guest']], function () {
    Route::get('/', [VisitorsController::class, 'create'])->name('client.visitors');
    Route::post('/create', [VisitorsController::class, 'store'])->name('client.create-visitors');
});
Route::group(['prefix' => '/type', 'middleware' => ['auth']], function () {
    Route::get('/', [TypeController::class, 'index'])->name('client.types');
});

//COBA LOGIN

Route::middleware(['only_guest'])->group(function () {
    Route::get('/login', [UserController::class, "login"])->name('login');
    Route::post('/sesi/login', [UserController::class, "authenticating"]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, "logout"]);
    Route::get('/beranda', [BerandaController::class, "index", "getData"])->name('client.visitors-history');
    Route::get('/edit/profil/{id}', [BerandaController::class, "edit"])->name('client.edit-profil');
    Route::put('/edit/profil/{id}', [BerandaController::class, "update"]);
});

Route::get('/test', function () {
    return view('test');
});

// Route::resource("zzz", VisitorController::class);

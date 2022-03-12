<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\BarangController;
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
    return view('back.login');
});

Route::get('/cv-afis', function () {
    return view('back.cvku');
});
Route::get('/barang-tamu', [TamuController::class, 'index'])->name('index');
Route::post('/barang-tamu/datatable', [TamuController::class, 'datatable'])->name('datatable');

Route::get('/sign-out', [LoginController::class, 'logout'])->name('keluar');
Route::post('/login-user', [LoginController::class, 'login'])->name('masuk');

Route::group(['middleware' => 'user'], function () {
    Route::get('/dashboard', function () {
        return view('back.welcome.welcome');
    });
    
    Route::group([
        'prefix' => 'master',
        'as' => 'master.',
    ], function () {

        Route::group([
            'prefix' => 'hak-akses',
            'as' => 'hak-akses.',
        ], function () {
            Route::group([
                'prefix' => 'user',
                'as' => 'user.',
            ], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/menu-user/{id}', [UserController::class, 'menu_user'])->name('menuUser');
                Route::post('/simpan', [UserController::class, 'store'])->name('store');
                Route::post('/edit', [UserController::class, 'edit'])->name('edit');
                Route::post('/ubah', [UserController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [UserController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::group([
                'prefix' => 'role-user',
                'as' => 'role-user.',
            ], function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::post('/simpan', [RoleController::class, 'store'])->name('store');
                Route::post('/edit', [RoleController::class, 'edit'])->name('edit');
                Route::post('/ubah', [RoleController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [RoleController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [RoleController::class, 'destroy'])->name('destroy');
            });

            Route::group([
                'prefix' => 'menu',
                'as' => 'menu.',
            ], function () {
                Route::get('/', [MenuController::class, 'index'])->name('index');
                Route::post('/simpan', [MenuController::class, 'store'])->name('store');
                Route::post('/edit', [MenuController::class, 'edit'])->name('edit');
                Route::post('/ubah', [MenuController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [MenuController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [MenuController::class, 'destroy'])->name('destroy');
            });
        });

        Route::group([
            'prefix' => 'barang',
            'as' => 'barang.',
        ], function () {
            Route::get('/', [BarangController::class, 'index'])->name('index');
            Route::post('/simpan', [BarangController::class, 'store'])->name('store');
            Route::post('/edit', [BarangController::class, 'edit'])->name('edit');
            Route::post('/ubah', [BarangController::class, 'ubah'])->name('ubah');
            Route::post('/datatable', [BarangController::class, 'datatable'])->name('datatable');
            Route::post('/destroy', [BarangController::class, 'destroy'])->name('destroy');
        });

    });

    Route::group([
        'prefix' => 'transaksi',
        'as' => 'transaksi.',
    ], function () {
        
        Route::get('/log-barang', [BarangController::class, 'logbarang'])->name('logbarang');
        Route::post('/log-barang/data', [BarangController::class, 'logdata'])->name('logdata');

        Route::group([
            'prefix' => 'stok-barang',
            'as' => 'stok-barang.',
        ], function () {
            Route::get('/', [BarangController::class, 'stokbarang'])->name('stokbarang');
            Route::post('/datatable', [BarangController::class, 'datatablestok'])->name('datatablestok');
        });
        
        Route::group([
            'prefix' => 'barang-masuk',
            'as' => 'barang-masuk.',
        ], function () {
            Route::get('/', [BarangController::class, 'masuk'])->name('masuk');
            Route::post('/simpan', [BarangController::class, 'storemasuk'])->name('storemasuk');
            Route::post('/edit', [BarangController::class, 'editmasuk'])->name('editmasuk');
            Route::post('/ubah', [BarangController::class, 'ubahmasuk'])->name('ubahmasuk');
            Route::post('/datatable', [BarangController::class, 'datatablemasuk'])->name('datatablemasuk');
            Route::post('/destroy', [BarangController::class, 'destroymasuk'])->name('destroymasuk');
        });

        Route::group([
            'prefix' => 'barang-keluar',
            'as' => 'barang-keluar.',
        ], function () {
            Route::get('/', [BarangController::class, 'keluar'])->name('keluar');
            Route::post('/simpan', [BarangController::class, 'storekeluar'])->name('storekeluar');
            Route::post('/edit', [BarangController::class, 'editkeluar'])->name('editkeluar');
            Route::post('/ubah', [BarangController::class, 'ubahkeluar'])->name('ubahkeluar');
            Route::post('/datatable', [BarangController::class, 'datatablekeluar'])->name('datatablekeluar');
            Route::post('/destroy', [BarangController::class, 'destroykeluar'])->name('destroykeluar');
        });

    });
});

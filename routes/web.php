<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\App;

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
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {
    //menu user
    Route::resource('user', UserController::class);

    //menu barang
    Route::resource('barang', BarangController::class);

    //menu transaksi
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/detail_transaksi/{id}/edit', [TransaksiController::class, 'editDetailTransaksi']);
    Route::put('/detail_transaksi/{id}/update', [TransaksiController::class, 'updateDetailTransaksi']);
    Route::delete('/detail_transaksi/{id}', [TransaksiController::class, 'destroyRincian']);
    Route::get('/cart/hapus/{id}', [TransaksiController::class, 'hapus_cart']);
    Route::get('/cart/simpan', [TransaksiController::class, 'simpan']);
    Route::get('/cetak/pdf/{id}', [TransaksiController::class, 'cetakTransaksi'])->name('cetak.pdf');
    Route::get('/cetak/print-thermal/{id}', [TransaksiController::class, 'printThermal'])->name('cetak.print-thermal');

    //menu pencarian transaksi
    Route::get('/transaksi-cari/tanggal', [TransaksiController::class, 'cariTgl']);
    Route::get('/transaksi-cari/totalharga', [TransaksiController::class, 'cariTotal']);
    Route::get('/transaksi-cari/kombinasi', [TransaksiController::class, 'cariKombinasi']);
});



        
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

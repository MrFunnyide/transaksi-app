<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\transactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [salesController::class, 'allTransaction'])->name('dashboard');
Route::get('add-transaksi', [salesController::class, 'index'])->name('page-add-transaksi');
Route::post('tambah-keranjang', [salesController::class, 'addCart'])->name('add-to-cart');
Route::post('hapus-item-keranjang', [salesController::class, 'removeItemCart'])->name('remove-cart-item');
Route::post('edit-item-keranjang', [salesController::class, 'updateItemCart'])->name('update-item-cart');

Route::get('get-name-price', [salesController::class, 'getNameAndPrice'])->name('get-name-price');
Route::get('get-name-telp', [customerController::class, 'getNameAndTelp'])->name('get-name-telp');

Route::post('store-transaksi', [transactionController::class, 'store'])->name('transaction');

// route customer
Route::group(['prefix' => 'customer'], function () {
    Route::get('', [customerController::class, 'index'])->name('page-customer');
    Route::post('add-customer', [customerController::class, 'store'])->name('store-customer');
    Route::put('edit-customer/{customer}', [customerController::class, 'update'])->name('update-customer');
    Route::delete('hapus-customer/{customer}', [customerController::class, 'destroy'])->name('delete-customer');
});

// route barang
Route::group(['prefix' => 'barang'], function () {
    Route::get('', [BarangController::class, 'index'])->name('page-barang');
    Route::post('add-barang', [BarangController::class, 'store'])->name('store-barang');
    Route::put('edit-barang/{barang}', [BarangController::class, 'update'])->name('update-barang');
    Route::delete('hapus-barang/{barang}', [BarangController::class, 'destroy'])->name('delete-barang');
});

<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route kategori
Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('kategori/{param}', [KategoriController::class, 'detail'])->name('kategori.detail');
Route::put('kategori/{param}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::delete('kategori/{param}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// route produk
Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('produk/{param}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::put('produk/{param}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::delete('produk/{param}', [ProdukController::class, 'destroy'])->name('produk.destroy');



Route::view('tampilan', 'template.app');

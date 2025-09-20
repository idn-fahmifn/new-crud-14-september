<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('kategori/{param}', [KategoriController::class, 'detail'])->name('kategori.detail');
Route::put('kategori/{param}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::delete('kategori/{param}', [KategoriController::class, 'edit'])->name('kategori.edit');


Route::view('tampilan', 'template.app');

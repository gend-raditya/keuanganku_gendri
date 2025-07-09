<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DompetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;


// Auth routes
Auth::routes();

// Redirect root ke /transaksi
Route::get('/', function () {
    return view('welcome-public'); // Nama file Blade-nya nanti kita buat
});


// Grup route untuk user yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Semua user bisa lihat transaksi & kategori
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
});

// Hanya admin yang bisa create/edit/delete kategori
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('dompet', \App\Http\Controllers\DompetController::class);
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//tambah dompet
Route::get('/dompet/create', [DompetController::class, 'create'])->name('dompet.create');
Route::post('/dompet', [DompetController::class, 'store'])->name('dompet.store');


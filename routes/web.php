<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardSiswaController;


Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

// Routes untuk proses simpan buku (POST)
Route::post('/bukus', [BukuController::class, 'store'])->name('bukus.store');

// Routes yang membutuhkan auth & verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard dan tampilan terkait buku, anggota, dsb.
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Route untuk dashboard siswa
    Route::get('/dashboard/siswa', [DashboardSiswaController::class, 'index'])->name('dashboard.siswa')->middleware('role:siswa');

    // Route untuk buku, anggota, peminjaman, dsb.
    Route::view('/buku', 'pages.buku')->name('buku.index');
    Route::view('/anggota', 'pages.anggota')->name('anggota.index');
    Route::view('/peminjaman', 'pages.peminjaman')->name('peminjaman.index');
    Route::view('/terlambat', 'pages.terlambat')->name('terlambat.index');
    Route::view('/broadcast', 'pages.broadcast')->name('broadcast.index');
});

// Route profile hanya membutuhkan auth, tidak perlu verified
Route::view('/profile', 'pages.profile')
    ->middleware('auth')
    ->name('profile');

// Route auth bawaan Laravel (login, register, dll)
require __DIR__.'/auth.php';

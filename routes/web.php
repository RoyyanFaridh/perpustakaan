<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('buku', 'pages.buku')
    ->middleware(['auth', 'verified'])
    ->name('buku.index');

Route::view('anggota', 'pages.anggota')
    ->middleware(['auth', 'verified'])
    ->name('anggota.index');

Route::view('peminjaman', 'pages.peminjaman')
    ->middleware(['auth', 'verified'])
    ->name('peminjaman.index');

Route::view('terlambat', 'pages.terlambat')
    ->middleware(['auth', 'verified'])
    ->name('terlambat.index');

Route::view('broadcast', 'pages.broadcast')
    ->middleware(['auth', 'verified'])
    ->name('broadcast.index');

Route::view('profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('buku', 'buku')
    ->middleware(['auth', 'verified'])
    ->name('buku.index');

Route::view('anggota', 'anggota')
    ->middleware(['auth', 'verified'])
    ->name('anggota.index');

Route::view('peminjaman', 'peminjaman')
    ->middleware(['auth', 'verified'])
    ->name('peminjaman.index');

Route::view('terlambat', 'terlambat')
    ->middleware(['auth', 'verified'])
    ->name('terlambat.index');

Route::view('broadcast', 'broadcast')
    ->middleware(['auth', 'verified'])
    ->name('broadcast.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\AnggotaComponent;
use App\Livewire\AnggotaCreate;
use App\Livewire\AnggotaEdit;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('/buku', 'pages.buku')
    ->middleware(['auth', 'verified'])
    ->name('buku.index');

Route::get('/anggota', AnggotaComponent::class)
    ->middleware(['auth', 'verified'])
    ->name('anggota.index');

Route::get('/anggota/create', AnggotaCreate::class)
    ->middleware(['auth', 'verified'])
    ->name('anggota.create');
    

Route::view('/peminjaman', 'pages.peminjaman')
    ->middleware(['auth', 'verified'])
    ->name('peminjaman.index');

Route::view('/terlambat', 'pages.terlambat')
    ->middleware(['auth', 'verified'])
    ->name('terlambat.index');

Route::view('/broadcast', 'pages.broadcast')
    ->middleware(['auth', 'verified'])
    ->name('broadcast.index');

Route::view('/profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

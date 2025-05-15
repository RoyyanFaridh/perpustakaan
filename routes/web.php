<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Livewire\Pages\Auth\Register;

 
Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/register', Register::class)->name('register');

Route::post('/anggotas', [AnggotaController::class, 'store'])->name('anggotas.store');
Route::post('/bukus', [BukuController::class, 'store'])->name('bukus.store');


// Routes yang membutuhkan auth & verified
// Untuk admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'AdminDashboard'])->name('dashboard');
    Route::view('/buku', 'pages.admin.buku')->name('buku.index');
    Route::view('/anggota', 'pages.admin.anggota')->name('anggota.index');
    Route::view('/peminjaman', 'pages.admin.peminjaman')->name('peminjaman.index');
    Route::view('/terlambat', 'pages.admin.terlambat')->name('terlambat.index');
    Route::view('/broadcast', 'pages.admin.broadcast')->name('broadcast.index');
});

// Untuk guru dan siswa
Route::middleware(['auth', 'verified', 'role:siswa,guru'])->group(function () {
    Route::get('/dashboard-user', [UserController::class, 'UserDashboard'])->name('user.dashboard');
});

// Route profile hanya membutuhkan auth, tidak perlu verified
Route::view('/profile', 'pages.profile')
    ->middleware('auth')
    ->name('profile');

// Route auth bawaan Laravel (login, register, dll)
require __DIR__.'/auth.php';

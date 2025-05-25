<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\User\BukuComponent;

 
Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/register', Register::class)->name('register');

Route::post('/anggotas', [AnggotaController::class, 'store'])->name('anggotas.store');
Route::post('/bukus', [BukuController::class, 'store'])->name('bukus.store');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::view('/buku', 'pages.admin.buku')->name('admin.buku.index');
    Route::view('/anggota', 'pages.admin.anggota')->name('admin.anggota.index');
    Route::view('/peminjaman', 'pages.admin.peminjaman')->name('admin.peminjaman.index');
    Route::view('/terlambat', 'pages.admin.terlambat')->name('admin.terlambat.index');
    Route::view('/broadcast', 'pages.admin.broadcast')->name('admin.broadcast.index');
});

// Untuk guru dan siswa
Route::middleware(['auth', 'verified', 'role:siswa,guru'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/buku', BukuComponent::class)->name('user.buku.index');
    Route::view('/peminjaman', 'pages.user.peminjaman')->name('user.peminjaman.index');
});

// Route profile hanya membutuhkan auth, tidak perlu verified
Route::view('/profile', 'pages.profile')
    ->middleware('auth')
    ->name('profile');

// Route auth bawaan Laravel (login, register, dll)
require __DIR__.'/auth.php';

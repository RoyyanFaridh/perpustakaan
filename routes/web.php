<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Auth\Register;
use App\Http\Controllers\BroadcastController;

//Admin
use App\Http\Controllers\Admin\AdminController;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Buku\Index as BukuIndex;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;

//User
use App\Http\Controllers\User\UserController;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;


 
Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/register', Register::class)->name('register');

Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
Route::get('/broadcast/create', [BroadcastController::class, 'create'])->name('broadcast.create');
Route::post('/broadcast', [BroadcastController::class, 'store'])->name('broadcast.store');
Route::get('/broadcast/{id}', [BroadcastController::class, 'show']);

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/anggota', AnggotaIndex::class)->name('admin.anggota.index');
    Route::get('/buku', BukuIndex::class)->name('admin.buku.index');
    Route::get('/peminjaman', PeminjamanIndex::class)->name('admin.peminjaman.index');
    Route::view('/broadcast', 'livewire.admin.broadcast')->name('admin.broadcast.index');
});

// Untuk guru dan siswa
Route::middleware(['auth', 'verified', 'role:siswa,guru'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
    Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
});

// Route profile hanya membutuhkan auth, tidak perlu verified
Route::view('/profile', 'pages.profile')
    ->middleware('auth')
    ->name('profile');

// Route auth bawaan Laravel (login, register, dll)
require __DIR__.'/auth.php';

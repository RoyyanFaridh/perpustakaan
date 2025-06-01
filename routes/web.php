<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\WelcomeController;

// Admin
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Anggota\Siswa;
use App\Livewire\Admin\Anggota\Guru;
use App\Livewire\Admin\Buku\Index as BukuIndexAdmin;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;
use App\Livewire\Admin\Anggota\Export;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Admin\Broadcast\Index as BroadcastIndex;
use App\Http\Controllers\PeminjamanController;
use App\Livewire\Admin\Peminjaman\Index;

// User
use App\Livewire\User\Dashboard\Index as DashboardIndexUser;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;
use \App\Livewire\User\Profile as ProfileIndexUser;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/peminjaman', Index::class)->name('admin.peminjaman');
});


Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

// Public routes
Route::get('/', fn() => view('pages.welcome'))->name('welcome');


// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', DashboardIndex::class)->name('admin.dashboard');
    Route::get('/anggota', AnggotaIndex::class)->name('admin.anggota.index');
    Route::get('/anggota/export/siswa', fn() => Excel::download(new Export('siswa'), 'daftar_siswa.xlsx'))->name('export.siswa');
    Route::get('/anggota/export/guru', fn() => Excel::download(new Export('guru'), 'daftar_guru.xlsx'))->name('export.guru');
    Route::get('/anggota/siswa', Siswa::class)->name('anggota.siswa');
    Route::get('/anggota/guru', Guru::class)->name('anggota.guru');
    Route::get('/buku', BukuIndexAdmin::class)->name('admin.buku.index');
    Route::get('/peminjaman', PeminjamanIndex::class)->name('admin.peminjaman.index');
    Route::get('/broadcast', BroadcastIndex::class)->name('admin.broadcast.index');
    Route::view('/profile', 'livewire.admin.profile')->name('admin.profile');
});

// Siswa & Guru routes
Route::middleware(['auth', 'verified', 'role:siswa,guru', 'check.default.password', 'check.anggota.email'])->group(function () {
    Route::get('/dashboard', DashboardIndexUser::class)->name('user.dashboard');
    Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
    Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
});

Route::middleware(['auth', 'verified', 'role:siswa,guru'])->get('/profile', ProfileIndexUser::class)->name('user.profile');

Route::get('/test-email', function () {
    Mail::raw('Tes kirim email Laravel menggunakan Gmail SMTP.', function ($message) {
        $message->to('roynashruddin18@gmail.com')
                ->subject('Test Email');
    });

    return 'Email terkirim (jika tidak error).';
});

// Auth routes (login, register, etc)
require __DIR__.'/auth.php';


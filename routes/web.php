<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Livewire\Volt\Volt;
use App\Http\Controllers\WelcomeController;
use App\Livewire\Pages\Auth\VerifyEmail;
use App\Livewire\Pages\Auth\SetupAccount;

// Admin
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Anggota\Siswa;
use App\Livewire\Admin\Anggota\Guru;
use App\Livewire\Admin\Buku\Index as BukuIndexAdmin;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;
use App\Livewire\Admin\Anggota\Export;
use App\Livewire\Admin\Broadcast\Index as BroadcastIndex;
use Maatwebsite\Excel\Facades\Excel;

// User
use App\Livewire\User\Dashboard\Index as DashboardIndexUser;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Auth routes (login, register, etc)
require __DIR__.'/auth.php';

// Setup account route untuk siswa/guru
Route::middleware(['auth'])->get('/setup-account', SetupAccount::class)->name('setup.account');

// Email verification handling
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('setup.account');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

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
    
    Volt::route('admin/profile', 'admin.profile')->name('admin.profile');
});

// User routes
Route::middleware(['auth', 'role:siswa,guru', 'check.default.password', 'ensure.email.verified'])
    ->group(function () {
        Route::get('/dashboard', DashboardIndexUser::class)->name('user.dashboard');
        Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
        Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');

        Volt::route('user/profile', 'user.profile')->name('user.profile');
    });



Route::get('/test-email-brevo', function () {
    Mail::raw('Tes email via Brevo SMTP', function ($message) {
        $message->to('roynashruddin@gmail.com') // ganti dengan email tujuanmu
                ->subject('Tes dari Laravel + Brevo');
    });

    return 'Email sedang dikirim...';
});


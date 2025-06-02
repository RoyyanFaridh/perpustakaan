<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'pages.auth.login')->name('login');
    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

// ===== AUTHENTICATED ROUTES =====
Route::middleware('auth')->group(function () {
    // Route untuk proses verifikasi email dari link yang dikirim
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // Memverifikasi email user
        return redirect()->route('setup.account'); // Tetap arahkan ke setup jika belum selesai
    })->middleware(['signed'])->name('verification.verify');

    // Route untuk mengirim ulang email verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Baru bisa akses ini kalau sudah login, password bukan default, dan email sudah diverifikasi
Route::middleware(['auth', 'check.default.password', 'ensure.email.verified'])->group(function () {
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');
    Volt::route('user/profile', 'user.profile')->name('user.profile');
    Volt::route('admin/profile', 'admin.profile')->name('admin.profile');
});

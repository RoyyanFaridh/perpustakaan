<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email'); // buat halaman verify email (buat notifikasi)
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('user.dashboard'); // atau route mana yang mau kamu arahkan
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')->name('register');
    Volt::route('login', 'pages.auth.login')->name('login');
    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

Route::middleware(['auth', 'check.default.password'])->group(function () {
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');
    Volt::route('user/profile', 'user.profile')->name('user.profile');
    Volt::route('admin/profile', 'admin.profile')->name('admin.profile');

    // Dashboard tetap sesuai user
    Volt::route('dashboard', 'user.dashboard')->name('user.dashboard');
});





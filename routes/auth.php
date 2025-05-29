<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')->name('register');
    Volt::route('login', 'pages.auth.login')->name('login');
    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

Route::middleware(['auth', 'check.default.password'])->group(function () {
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');
    Volt::route('change-password', 'pages.auth.change-password')->name('password.change');

    // Tambahkan route lain yang ingin dilindungi oleh middleware ini
    Volt::route('dashboard', 'user.dashboard')->name('user.dashboard');
});




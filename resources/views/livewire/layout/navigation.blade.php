<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 p-4 bg-gray-50 hidden sm:block fixed inset-0 bottom-0">
        <div class="flex flex-col h-full justify-between">
            <div>
                <!-- Logo -->
                <div class="h-16 flex items-center justify-center border-b">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="h-9 w-auto text-gray-800" />
                    </a>
                </div>

                <!-- Menu Utama -->
                <nav class="mt-2 space-y-2">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </nav>

                <!-- Dropdown Anggota -->
                <div x-data="{ anggotaOpen: false }" class="space-y-1 mt-2">
                    <button @click="anggotaOpen = !anggotaOpen"
                        class="flex items-center w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100 rounded-md">
                        <i class="fas fa-users mr-2"></i>
                        <span class="flex-1">Anggota</span>
                        <svg class="w-4 h-4 transform transition-transform duration-200"
                            :class="{ 'rotate-180': anggotaOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Submenu Anggota -->
                    <div x-show="anggotaOpen" x-transition class="ml-8 space-y-1">
                        <x-nav-link :href="route('anggota.guru')" :active="request()->routeIs('anggota.guru')">
                            {{ __('Guru') }}
                        </x-nav-link>
                        <x-nav-link :href="route('anggota.siswa')" :active="request()->routeIs('anggota.siswa')">
                            {{ __('Siswa') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Menu Buku -->
                <nav class="mt-2 space-y-2">
                    <x-nav-link :href="route('admin.buku.index')" :active="request()->routeIs('buku.*')">
                        {{ __('Buku') }}
                    </x-nav-link>
                </nav>

                <!-- Menu Peminjaman -->
                <nav class="mt-2 space-y-2">
                    <x-nav-link :href="route('admin.peminjaman.index')" :active="request()->routeIs('peminjaman.*')">
                        {{ __('Peminjaman') }}
                    </x-nav-link>
                </nav>

                <!-- Menu Broadcast -->
                <nav class="mt-2 space-y-2">
                    <x-nav-link :href="route('admin.broadcast.index')" :active="request()->routeIs('broadcast.*')">
                        {{ __('Broadcast') }}
                    </x-nav-link>
                </nav>
            </div>

            <!-- Profil dan Logout -->
            <div class="relative w-full px-2 pt-4 mt-auto">
                <x-dropdown align="left" width="48" position="top">
                    <x-slot name="trigger">
                        <div class="w-full flex items-center text-sm text-gray-700 cursor-pointer">
                            <svg class="h-6 w-6 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.657 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="flex-grow text-base"
                                  x-data="{ name: @js(auth()->user()->name) }"
                                  x-text="name"
                                  x-on:profile-updated.window="name = $event.detail.name"
                            ></span>
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white border hover:bg-gray-100 transition">
                                <svg class="h-4 w-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="text-red-500 hover:text-red-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</div>
</nav>

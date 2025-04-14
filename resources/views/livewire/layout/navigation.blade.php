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
                            <div class="h-16 flex items-center justify-center border-b">
                                <a href="{{ route('dashboard') }}" wire:navigate>
                                    <x-application-logo class="h-9 w-auto text-gray-800" />
                                </a>
                            </div>
                
                            <nav class="mt-2 space-y-2">
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </nav>
                
                            <nav class="mt-2 space-y-2">
                                <x-nav-link>
                                    {{ __('Buku') }}
                                </x-nav-link>
                            </nav>
                
                            <nav class="mt-2 space-y-2">
                                <x-nav-link>
                                    {{ __('Peminjaman') }}
                                </x-nav-link>
                            </nav>
                
                            <nav class="mt-2 space-y-2">
                                <x-nav-link>
                                    {{ __('Terlambat') }}
                                </x-nav-link>
                            </nav>
                
                            <nav class="mt-2 space-y-2">
                                <x-nav-link>
                                    {{ __('Broadcast') }}
                                </x-nav-link>
                            </nav>
                        </div>
                
                        <!-- Profile Dropdown Moved to the Bottom -->
                        <div class="relative w-full px-2 pt-4 mt-auto">
                            <x-dropdown align="left" width="48" position="top">
                                <x-slot name="trigger">
                                    <button class="w-full flex justify-between items-center text-sm text-gray-700 px-3 py-2 border rounded-md bg-white hover:bg-gray-100 transition">
                                        <span
                                            x-data="{ name: @js(auth()->user()->name) }"
                                            x-text="name"
                                            x-on:profile-updated.window="name = $event.detail.name">
                                        </span>
                                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>
                
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                
                                    <!-- Authentication -->
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
            
                <!-- Main Content Wrapper -->
                <div class="flex-1 flex flex-col">
                    <!-- Topbar untuk layar kecil -->
                    <div class="sm:hidden bg-white border-b border-gray-100">
                        <div class="flex items-center justify-between h-16 px-4">
                            <a href="{{ route('dashboard') }}" wire:navigate>
                                <x-application-logo class="h-8 w-auto" />
                            </a>
                            <button @click="open = ! open" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
            
                        <!-- Responsive Navigation Menu -->
                        <div :class="{'block': open, 'hidden': ! open}" class="hidden">
                            <div class="pt-2 pb-3 space-y-1 px-4">
                                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                                    {{ __('Dashboard') }}
                                </x-responsive-nav-link>
                            </div>
            
                            <div class="pt-4 pb-1 border-t border-gray-200 px-4">
                                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            
                                <div class="mt-3 space-y-1">
                                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>
            
                                    <!-- Authentication -->
                                    <button wire:click="logout" class="w-full text-start">
                                        <x-responsive-nav-link>
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Tempat konten halaman -->
                    <main class="flex-1">
                        {{ $slot ?? '' }}
                    </main>
                </div>
            
            </div>
            

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>

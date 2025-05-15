<?php

use App\Livewire\Forms\RegisterForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public RegisterForm $form;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->form->register();

        session()->flash('status', 'Registration successful! Please login.');

        $this->redirect(route('login'));
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <!-- NIS/NIP -->
        <div class="mt-4">
            <x-input-label for="nis_nip" :value="__('NIS/NIP')" />
            <x-text-input wire:model="form.nis_nip" id="nis_nip" class="block mt-1 w-full" type="text" name="nis_nip" required />
            <x-input-error :messages="$errors->get('form.nis_nip')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('form.password_confirmation')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="no_telp" :value="__('Nomor Telepon')" />
            <x-text-input wire:model="form.no_telp" id="no_telp" class="block mt-1 w-full" type="tel" name="no_telp" required />
            <x-input-error :messages="$errors->get('form.no_telp')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select wire:model="form.role" id="role" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="anggota">Siswa</option>
                <option value="petugas">Guru</option>
            </select>
            <x-input-error :messages="$errors->get('form.role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">{{ __('Already registered?') }}</span>
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold" wire:navigate>
                {{ __('Login') }}
            </a>
        </div>
    </form>
</div>
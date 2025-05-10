<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public ?string $role = null;
    public bool $agree = false;


    /**
     * Handle an incoming registration request.
     */

public function register(): void
{
    // Hanya untuk Guru dan Siswa, pastikan role divalidasi hanya jika ada
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        // Validasi role hanya jika role tidak kosong
        'role' => $this->role ? ['required', 'in:guru,siswa'] : [],
    ]);

    $validated['password'] = Hash::make($validated['password']);

    // Jika user memilih role, simpan role mereka
    if ($this->role) {
        $validated['role'] = $this->role;
    } else {
        // Jika tidak memilih role, otomatis set menjadi 'siswa' atau 'admin' jika pengguna admin
        $validated['role'] = 'siswa'; // Defaultkan jadi siswa
    }

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
}

}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div x-data="{ show: false }" class="relative">
                <x-input-label for="password" :value="__('Password')" />
                
                <div class="relative">
                    <input 
                        :type="show ? 'text' : 'password'" 
                        wire:model="password" 
                        id="password" 
                        name="password" 
                        required autocomplete="new-password"
                        class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
            
                    <!-- Eye Icon inside input -->
                    <button type="button" x-on:click="show = !show"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 p-1 flex items-center text-gray-500 focus:outline-none">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.961 9.961 0 012.105-3.507M9.88 9.88a3 3 0 104.24 4.24m3.212-1.368A9.964 9.964 0 0119.542 12c-1.274 4.057-5.064 7-9.542 7a9.96 9.96 0 01-4.807-1.222M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
                                   
        
            <!-- Confirm Password -->
            <div x-data="{ showConfirm: false }" class="relative">
                <x-input-label for="password" :value="__('Confirm Password')" />
                
                <div class="relative">
                    <input 
                        :type="showConfirm ? 'text' : 'password'" 
                        wire:model="password_confirmation" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required autocomplete="new-password"
                        class="block mt-1 w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
            
                    <!-- Eye Icon inside input -->
                    <button type="button" x-on:click="showConfirm = !showConfirm"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 p-1 flex items-center text-gray-500 focus:outline-none">
                        <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.961 9.961 0 012.105-3.507M9.88 9.88a3 3 0 104.24 4.24m3.212-1.368A9.964 9.964 0 0119.542 12c-1.274 4.057-5.064 7-9.542 7a9.96 9.96 0 01-4.807-1.222M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div> 

        <!-- Nomor Telepon -->
        <div x-data="{
            kodeNegara: '+62',
            nomor: @entangle('phone').defer,
            gabungNomor() {
                // Hapus karakter selain angka
                let clean = this.nomor.replace(/\D/g, '');
                // Pastikan tidak ada 0 di depan
                if (clean.startsWith('0')) {
                    clean = clean.substring(1);
                }
                this.nomor = clean;
            }
        }" class="mt-4">

            <x-input-label for="phone" :value="__('Nomor Telepon')" />

            <div class="flex space-x-2">
                <input type="text" readonly x-model="kodeNegara"
                    class="w-20 text-center border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />

                <input type="tel" id="phone" name="phone" autocomplete="tel"
                    x-model="nomor"
                    x-on:input.debounce.300ms="gabungNomor"
                    class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="" required />
            </div>

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email -->
        @if (is_null($role))
            <div class="mt-4">
                <x-input-label for="role" :value="__('Role')" />
                <select wire:model="role" id="role" name="role" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value=""></option>
                    <option value="guru">{{ __('Guru') }}</option>
                    <option value="siswa">{{ __('Siswa') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
        @endif

        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="agree" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">
                    {{ __('I agree to the') }} <a href="#" class="underline text-sm text-indigo-600 hover:text-indigo-900">{{ __('Privacy Policy') }}</a> {{ __('and') }} <a href="#" class="underline text-sm text-indigo-600 hover:text-indigo-900">{{ __('Terms') }}</a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('agree')" class="mt-2" />
        </div>        

        <div class="mt-4">
            <x-primary-button class="w-full" :disabled="!$agree">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        
        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">{{ __("Have an account?") }}</span>
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold" wire:navigate>
                {{ __('Login') }}
            </a>
        </div> 
    </form>
</div>

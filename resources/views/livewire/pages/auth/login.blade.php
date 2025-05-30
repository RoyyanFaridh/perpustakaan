<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();
            
            // Debug session
            logger()->info('Session Before Regenerate', [
                'session_id' => session()->getId(),
                'data' => session()->all()
            ]);

            Session::regenerate();

            // Debug setelah regenerate
            logger()->info('Session After Regenerate', [
                'session_id' => session()->getId(),
                'user_id' => auth()->id()
            ]);

            // Hard redirect untuk testing
            if(app()->environment('local')) {
                $route = auth()->user()->hasRole('admin') 
                    ? route('admin.dashboard')
                    : route('user.dashboard');
                    
                $this->js("window.location.href = '{$route}'");
                return;
            }

            $this->redirectIntended(
                default: auth()->user()->hasRole('admin') 
                    ? route('admin.dashboard') 
                    : route('user.dashboard'),
                navigate: true
            );

        } catch (ValidationException $e) {
            $this->addError('form.email', $e->getMessage());
        }
    }
}; ?>

<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Kiri: Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md space-y-6">
            <div class="flex justify-center">
                <a href="/" wire:navigate>
                    <x-application-logo class="h-12 w-auto" />
                </a>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit.prevent="login">
                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" required autofocus />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" required />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center">
                        <input wire:model="form.remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Kanan: Gambar -->
    <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('/images/gedungsmpn12ykasli.jpg');">
    </div>
</div>
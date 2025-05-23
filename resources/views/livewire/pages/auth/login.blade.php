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

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>
    
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
    
        <!-- Remember Me -->
        <div class="block mt-4">
            <div class="flex items-center justify-between">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
    
                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
    
        <div class="mt-4">
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">{{ __("Haven't an account?") }}</span>
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-semibold" wire:navigate>
                {{ __('Register') }}
            </a>
        </div> 
    </form>    
</div>

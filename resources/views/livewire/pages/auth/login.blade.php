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
    <!-- Kiri: Form Login -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 bg-white">
        <!-- Container utama -->
        <div class="bg-white p-10 max-w- w-full h-[90vh] max-h-[800px] rounded-2xl shadow-2xl overflow-hidden ml-4 mr-4 flex flex-col items-center relative">
            
            <!-- Logo -->
            <div class="absolute top-6 left-1/2 transform -translate-x-1/2 mt-10">
                <a href="/" wire:navigate>
                    <div class="flex items-center space-x-2">
                        <img src="/images/logo_smp12yk.png" alt="Logo" class="h-30">
                    </div>
                </a>
            </div>
<div class="min-h-screen flex flex-col md:flex-row bg-white">
  <!-- Kiri: Form Login -->
  <div
    class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 min-h-screen md:min-h-auto"
  >
    <!-- Container utama -->
    <div
      class="p-6 sm:p-10 w-full h-auto md:h-[90vh] max-h-[1000px] rounded-2xl shadow-lg overflow-hidden flex flex-col items-center"
      style="max-width: 100%;" 
    >
      <!-- Logo -->
      <div class="mb-6 flex justify-center">
        <a href="/" wire:navigate>
          <img src="/images/logo_smp12yk.png" alt="Logo" class="h-16 sm:h-20 w-auto" />
        </a>
      </div>

      <!-- Session status -->
      <x-auth-session-status class="mb-2 mt-2 sm:mt-4" :status="session('status')" />

      <!-- Form -->
      <form wire:submit.prevent="login" class="flex flex-col justify-center items-center flex-grow w-full mt-2 sm:mt-4 max-w-xl">
        <div class="w-full">
          <!-- NIS/NIP -->
          <div>
            <x-input-label for="nis_nip" :value="('NIS / NIP')" class="text-sm sm:text-base" />
            <x-text-input
              wire:model="form.nis_nip"
              id="nis_nip"
              class="block mt-1 w-full text-sm sm:text-base"
              type="text"
              name="nis_nip"
              required
              autofocus
              autocomplete="username"
            />
            <x-input-error :messages="$errors->get('form.nis_nip')" class="mt-2 text-xs sm:text-sm" />
          </div>

          <!-- Password -->
          <div class="mt-4">
            <x-input-label for="password" :value="('Password')" class="text-sm sm:text-base" />
            <x-text-input
              wire:model="form.password"
              id="password"
              class="block mt-1 w-full text-sm sm:text-base"
              type="password"
              name="password"
              required
              autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-xs sm:text-sm" />
          </div>

          <!-- Remember Me dan Forgot Password -->
          <div class="block mt-4">
            <div class="flex items-center justify-between text-xs sm:text-sm">
              <label for="remember" class="inline-flex items-center">
                <input
                  wire:model="form.remember"
                  id="remember"
                  type="checkbox"
                  class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                  name="remember"
                />
                <span class="ml-2 text-gray-600">{{ __('Remember me') }}</span>
              </label>

              @if (Route::has('password.request'))
              <a
                class="text-gray-600 hover:text-gray-900 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}"
                wire:navigate
              >
                {{ __('Forgot your password?') }}
              </a>
              @endif
            </div>
          </div>

          <!-- Submit -->
          <div class="mt-6 flex justify-center">
            <x-primary-button class="w-full text-sm sm:text-base">
              {{ __('Log in') }}
            </x-primary-button>
          </div>
        </div>
      </form>
    </div>
  </div>

    <!-- Kanan: Gambar dalam Card -->
    <div class="hidden md:flex md:w-1/2 items-center justify-center bg-white">
        <div class="w-full max-h-[800px] h-[90vh] rounded-2xl overflow-hidden mt-2 mb-2 mx-4">
            <img src="/images/cover.jpg" alt="Gambar Perpustakaan"
                class="object-cover w-full h-full rounded-2xl shadow-3xl">
        </div>
    </div>
  <!-- Kanan: Gambar dalam Card -->
  <div class="hidden md:flex md:w-1/2 items-center justify-center p-6">
    <div class="w-full max-h-[1000px] h-[90vh] rounded-2xl overflow-hidden mx-4">
      <img
        src="/images/cover.jpg"
        alt="Gambar Perpustakaan"
        class="object-cover w-full h-full rounded-2xl shadow-xl"
      />
    </div>
  </div>
</div>

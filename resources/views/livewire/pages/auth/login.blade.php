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

<!-- Wrapper tengah halaman -->
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
  <!-- Kontainer utama dibatasi lebarnya -->
  <div class="flex w-full max-w-4xl shadow-xl rounded-2xl overflow-hidden bg-white">
    
    <!-- Kiri: Form Login -->
    <div class="w-1/2 p-8 sm:p-12 flex flex-col justify-center">
      <!-- Logo -->
      <div class="mb-4 flex justify-center">
        <a href="/" wire:navigate>
          <img src="/images/logo_smp12yk.png" alt="Logo" class="h-12 sm:h-14 w-auto" />
        </a>
      </div>

      <!-- Session Status -->
      <x-auth-session-status class="mb-2 mt-2 sm:mt-4" :status="session('status')" />

      <!-- Form -->
      <form wire:submit.prevent="login" class="space-y-4 sm:space-y-4 mt-2 sm:mt-4 text-sm">
        <!-- NIS/NIP -->
        <div>
          <x-input-label for="nis_nip" :value="('NIS / NIP')" />
          <x-text-input wire:model="form.nis_nip" id="nis_nip"
            class="block mt-1 w-full text-sm"
            type="text" name="nis_nip" required autofocus autocomplete="username" />
          <x-input-error :messages="$errors->get('form.nis_nip')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="('Password')" />
          <x-text-input wire:model="form.password" id="password"
            class="block mt-1 w-full text-sm"
            type="password" name="password" required autocomplete="current-password" />
          <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-xs" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-xs mt-2">
          <label class="inline-flex items-center">
            <input wire:model="form.remember" type="checkbox"
              class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
            <span class="ml-2 text-gray-600">Remember me</span>
          </label>

          @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}"
            class="text-indigo-500 hover:text-indigo-700 underline"
            wire:navigate>Forgot your password?</a>
          @endif
        </div>

        <!-- Button -->
        <div class="pt-1">
          <x-primary-button class="w-full text-sm">Log in</x-primary-button>
        </div>
      </form>
    </div>

    <div class="hidden md:flex md:w-1/2 p-8 items-center justify-center overflow-hidden rounded-r-3xl">
  <img
    src="/images/library_07.jpg"
    alt="Gambar Perpustakaan"
    class="w-full h-auto object-contain rounded-r-3xl"
  />
</div>

  </div>
</div>


</div>

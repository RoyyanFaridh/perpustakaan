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
            $result = $this->form->authenticate();

            Session::regenerate();

            // Redirect ke ubah password
            if ($result['should_change_password']) {
                $this->js("window.location.href = '" . route('setup.password') . "'");
                return;
            }

            // Redirect sesuai role
            $this->js("window.location.href = '" . (
                $result['role'] === 'admin'
                    ? route('admin.dashboard')
                    : route('user.dashboard')
            ) . "'");
            
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            $this->dispatch('login-failed', message: $message);
            $this->addError('form.nis_nip', $message);
        }
    }


}; ?>

<!-- Wrapper tengah halaman -->
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 px-4 font-sans">
  <!-- Kontainer utama dibatasi lebarnya -->
  <div class="flex w-full max-w-4xl shadow-2xl rounded-2xl overflow-hidden transition-all duration-300 ease-in-out border border-gray-200">
    
    <!-- Kiri: Form Login -->
    <div class="w-full md:w-1/2 p-6 sm:p-12 bg-white flex flex-col justify-center">
      <!-- Logo -->
      <div class="mb-6 flex justify-center">
        <img src="/images/logo_smp12yk.png" alt="Logo" style="height: 65px; width: auto;" class=" object-contain drop-shadow-md transition duration-300 hover:scale-105" />
      </div>

      <!-- Session Status -->
      <x-auth-session-status class="mb-3" :status="session('status')" />

      <!-- Form -->
      <form wire:submit.prevent="login" class="space-y-6 text-sm py-4">
          <!-- NIS/NIP -->
          <div>
              <x-input-label for="nis_nip" :value="('NIS / NIP')" />
              <x-text-input wire:model="form.nis_nip" id="nis_nip"
                  class="block mt-1 w-full text-sm"
                  type="text" name="nis_nip" required autofocus autocomplete="username" />
              <x-input-error :messages="$errors->get('form.nis_nip')" class="mt-1 text-xs" />
          </div>

          <!-- Password -->
         <div class="relative">
            <input id="password" type="password"
                wire:model="form.password"
                class="block mt-1 w-full text-sm pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="password" required autocomplete="current-password" />

            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
          </div>

          <script>
              function togglePassword() {
                  const input = document.getElementById('password');
                  const icon = document.getElementById('eyeIcon');
                  if (input.type === 'password') {
                      input.type = 'text';
                      // optionally: change icon
                  } else {
                      input.type = 'password';
                      // optionally: change icon
                  }
              }
          </script>

          <!-- ❗ Error umum (di luar field) -->
          @if ($errors->has('form.email'))
              <div class="text-red-600 text-xs mb-2">
                  {{ $errors->first('form.email') }}
              </div>
          @endif

          <!-- Remember + Forgot -->
          <div class="flex items-center justify-between text-xs mt-2 text-gray-600">
              <label class="inline-flex items-center">
                  <input wire:model="form.remember" type="checkbox"
                      class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                  <span class="ml-2">Remember me</span>
              </label>

              @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}"
                  class="text-indigo-500 hover:text-indigo-700 underline transition"
                  wire:navigate>Forgot password?</a>
              @endif
          </div>

          <!-- Button -->
          <div class="pt-2">
              <x-primary-button class="w-full text-sm transition-all">Log in</x-primary-button>
          </div>
      </form>

    </div>

    <!-- Kanan: Gambar dengan gradien -->
    <div class="hidden md:flex md:w-1/2 p-8 items-center bg-blue-200 justify-center relative overflow-hidden rounded-r-2xl">
      <div class="absolute inset-0 bg-black/10 backdrop-blur-sm z-0"></div>
      <div class="relative z-10 text-center space-y-4">
        <img
          src="/images/library_07.png"
          alt="Gambar Perpustakaan"
          class="w-64 h-auto object-contain mx-auto mb-4 drop-shadow-xl rounded-xl transition-all duration-500"
        />
        <h2 class="text-lg font-semibold">Selamat Datang!</h2>
        <p class="text-sm text-indigo-100">Akses sistem informasi perpustakaan dengan mudah dan cepat.</p>
      </div>
    </div>

  </div>
  <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('login-failed', event => {
        Swal.fire({
            title: 'Login Gagal',
            text: event.message,
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    });
</script>
</div>

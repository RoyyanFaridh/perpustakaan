<div class="flex items-center justify-center min-h-screen px-4">
  <div class="flex w-full max-w-4xl shadow-xl rounded-2xl overflow-hidden bg-white">
    <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
      <!-- Logo -->
      <div class="mb-4 flex justify-center">
        <a href="/" wire:navigate>
          <img src="/images/logo_smp12yk.png" alt="Logo" class="h-12 sm:h-14 w-auto" />
        </a>
      </div>

      <h2 class="text-xl font-semibold mb-6 text-center">Setup Akun Anda</h2>

      @if(session('message'))
      <div class="mb-4 text-green-600 text-center">
        {{ session('message') }}
      </div>
      @endif

      <form wire:submit.prevent="updateAccount" class="space-y-4 sm:space-y-6 text-sm">
        <!-- Email -->
        <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input wire:model.defer="email" id="email" type="email" class="block mt-1 w-full" autocomplete="email" required />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Kirim ulang email verifikasi -->
        <div>
          <button type="button" wire:click="resendVerificationEmail" class="text-indigo-600 hover:text-indigo-800 underline text-xs">
            Kirim ulang link verifikasi email
          </button>
        </div>

        <!-- Password Baru -->
        <div>
          <x-input-label for="password" :value="__('Password Baru')" />
          <x-text-input wire:model.defer="password" id="password" type="password" class="block mt-1 w-full" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
          <x-text-input wire:model.defer="password_confirmation" id="password_confirmation" type="password" class="block mt-1 w-full" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
        </div>

        <div class="pt-1">
          <x-primary-button class="w-full text-sm">Selesaikan Setup</x-primary-button>
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

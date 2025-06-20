<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ubah Password</h3>

    <p class="text-sm text-gray-600 mb-4 flex items-center gap-2">
        Demi keamanan akun, gunakan password yang kuat dan tidak digunakan di layanan lain.
    </p>

    <form wire:submit.prevent="updatePassword" class="space-y-4 text-sm text-gray-700">
        {{-- Current Password --}}
        <div x-data="{ show: false }">
            <label for="current_password" class="block text-black text-xs mb-1">Password Saat Ini</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model.defer="current_password" id="current_password"
                    class="w-full border border-gray-200 shadow-sm rounded-md p-2 pr-10 focus:ring focus:ring-blue-100 focus:outline-none"
                    autocomplete="current-password">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-500 focus:outline-none">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.316-4.042M9.88 9.88a3 3 0 104.24 4.24M3 3l18 18" />
                    </svg>
                </button>
            </div>
            @error('current_password') <div class="text-red-600 text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- New Password --}}
        <div x-data="{ show: false }">
            <label for="password" class="block text-black text-xs mb-1">Password Baru</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model.defer="password" id="password"
                    class="w-full border border-gray-200 shadow-sm rounded-md p-2 pr-10 focus:ring focus:ring-blue-100 focus:outline-none"
                    autocomplete="new-password">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-500 focus:outline-none">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.316-4.042M9.88 9.88a3 3 0 104.24 4.24M3 3l18 18" />
                    </svg>
                </button>
            </div>
            @error('password') <div class="text-red-600 text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- Confirm Password --}}
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-black text-xs mb-1">Konfirmasi Password</label>
            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model.defer="password_confirmation" id="password_confirmation"
                    class="w-full border border-gray-200 shadow-sm rounded-md p-2 pr-10 focus:ring focus:ring-blue-100 focus:outline-none"
                    autocomplete="new-password">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-500 focus:outline-none">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 012.316-4.042M9.88 9.88a3 3 0 104.24 4.24M3 3l18 18" />
                    </svg>
                </button>
            </div>
            @error('password_confirmation') <div class="text-red-600 text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div>

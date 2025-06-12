<div class="container mx-auto max-w-md p-6 bg-white shadow rounded mt-10">
    <h2 class="text-2xl font-semibold mb-4 text-center">Ganti Password Awal</h2>

    @if ($message)
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <label for="new_password" class="block text-sm font-medium">Password Baru</label>
            <input type="password" wire:model.defer="new_password" id="new_password"
                class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
            @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" wire:model.defer="confirm_password" id="confirm_password"
                class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
            @error('confirm_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
            Simpan Password
        </button>
    </form>
</div>

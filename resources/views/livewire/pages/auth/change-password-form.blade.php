<div class="p-6 max-w-lg mx-auto">
    @if (session()->has('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <label>Password Baru</label>
            <input type="password" wire:model.defer="password" class="w-full border p-2">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" wire:model.defer="password_confirmation" class="w-full border p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>

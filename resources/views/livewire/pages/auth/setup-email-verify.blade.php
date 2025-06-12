<div class="container mx-auto p-4 max-w-md">
    <h2 class="text-xl font-semibold mb-4">Verifikasi Email</h2>

    @if ($message)
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ $message }}
        </div>
    @endif

    <form wire:submit.prevent="resendVerificationEmail">
        <label for="email" class="block mb-2 font-medium">Email Anda</label>
        <input type="email" id="email" wire:model="email" class="w-full p-2 border rounded mb-4" required />

        @error('email')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <p>Silakan cek inbox email Anda untuk tautan verifikasi. Jika belum menerima email, klik tombol di bawah untuk mengirim ulang.</p>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Kirim Ulang Email Verifikasi
        </button>
    </form>
</div>

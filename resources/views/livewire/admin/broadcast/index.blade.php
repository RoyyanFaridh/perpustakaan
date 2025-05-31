<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📢 Broadcast Pesan</h1>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Tabel Broadcast -->
    <div class="overflow-x-auto mb-8 w-full">
        <table class="min-w-full text-left border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Isi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($broadcast as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ $item->judul }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->isi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">Belum ada pesan broadcast.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Form Kirim Broadcast -->
    <form wire:submit.prevent="store" class="space-y-4">
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" id="judul" wire:model="judul"
                   class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Judul pesan...">
            @error('judul')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="isi" class="block text-sm font-medium text-gray-700">Isi Pesan</label>
            <textarea id="isi" wire:model="isi"
                      class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 h-32 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                      placeholder="Isi pesan..."></textarea>
            @error('isi')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition duration-200">
                Kirim
            </button>
        </div>
    </form>
</div>

<div class="p-6 space-y-6 w-full">
    <!-- Judul & Filter -->
    <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Buku</h2>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Kategori</label>
                <select wire:model.live="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}">{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Cari Judul</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Contoh: Laskar Pelangi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        @if(session()->has('message'))
            <div class="p-3 rounded bg-green-100 text-green-700">{{ session('message') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="p-3 rounded bg-red-100 text-red-700">{{ session('error') }}</div>
        @endif
    </div>

    <!-- Grid Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($books as $item)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition duration-300 w-full flex flex-col">
                <div class="flex gap-4">
                    <div class="w-[140px] h-[200px] flex-shrink-0 overflow-hidden rounded-md">
                        @if ($item->cover)
                            <img src="{{ asset('storage/' . $item->cover) }}"
                                 alt="Cover Buku {{ $item->judul }}"
                                 class="w-full h-full object-cover rounded-md"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.parentNode.innerHTML='<div class=\'w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-md\'>Tidak ada cover</div>';">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-md">
                                Tidak ada cover
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col justify-between flex-1 overflow-hidden">
                        <div>
                            <h3 class="text-lg font-bold text-black truncate" title="{{ $item->judul }}">{{ $item->judul }}</h3>
                            <span class="inline-block mt-1 mb-2 px-3 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded-full border border-green-300">
                                {{ $item->kategori }}
                            </span>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-3 break-words">{{ $item->deskripsi }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm text-gray-700">
                            <div class="space-y-1 overflow-hidden">
                                <p class="truncate"><span class="font-sm">Penulis:</span> {{ $item->penulis }}</p>
                                <p class="truncate"><span class="font-sm">Penerbit:</span> {{ $item->penerbit }}</p>
                                <p><span class="font-sm">Tahun:</span> {{ $item->tahun_terbit }}</p>
                            </div>
                            <div class="space-y-1 overflow-hidden">
                                <p class="truncate"><span class="font-sm">ISBN:</span> {{ $item->isbn }}</p>
                                <p><span class="font-sm">Stok:</span> {{ $item->jumlah_stok }}</p>
                                <p><span class="font-sm">Rak:</span> {{ $item->lokasi_rak }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Pinjam -->
                <div class="mt-4">
                    <button wire:click="pinjam({{ $item->id }})"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition disabled:opacity-50"
                            @if($item->jumlah_stok == 0) disabled @endif>
                        {{ $item->jumlah_stok > 0 ? 'Pinjam Buku' : 'Stok Habis' }}
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 text-gray-500">
                <p class="text-lg font-medium">Tidak ada buku ditemukan.</p>
                <p class="text-sm text-gray-400">Silakan coba kategori lain atau ubah kata kunci pencarian.</p>
            </div>
        @endforelse
    </div>
</div>

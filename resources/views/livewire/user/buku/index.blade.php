<div class="bg-white p-6 rounded-2xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Buku</h2>
    </div>
    <div class="mb-6">
        <input 
            type="text" 
            wire:model.debounce.300ms="search" 
            placeholder="Cari judul buku..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
    </div>

    <!-- Grid Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $item)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition-shadow duration-300 max-w-md mx-auto">
                <div class="flex gap-4">
                    {{-- Cover Buku --}}
                    @if ($item->cover)
                        <div class="w-[140px] h-[200px] flex-shrink-0 overflow-hidden rounded-md">
                            <img src="{{ asset('storage/' . $item->cover) }}" alt="Cover Buku" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-[140px] h-[200px] bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-sm">
                            Tidak ada cover
                        </div>
                    @endif

                    {{-- Konten Buku --}}
                    <div class="flex flex-col justify-between flex-1">
                        <div>
                            <h3 class="text-xl font-bold text-black">{{ $item->judul }}</h3>
                            <span class="inline-block mt-1 mb-2 px-4 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded-full border border-green-300">
                                {{ $item->kategori }}
                            </span>

                            <p class="text-sm text-gray-500 mb-3 line-clamp-3">
                                {{ $item->deskripsi }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm text-gray-700">
                            <div class="space-y-1">
                                <p><span class="font-sm">Penulis:</span> {{ $item->penulis }}</p>
                                <p><span class="font-sm">Penerbit:</span> {{ $item->penerbit }}</p>
                                <p><span class="font-sm">Tahun:</span> {{ $item->tahun_terbit }}</p>
                            </div>
                            <div class="space-y-1">
                                <p><span class="font-sm">ISBN:</span> {{ $item->isbn }}</p>
                                <p><span class="font-sm">Stok:</span> {{ $item->jumlah_stok }}</p>
                                <p><span class="font-sm">Rak:</span> {{ $item->lokasi_rak }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

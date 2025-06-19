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

        @if(session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
@endif
    </div>

    <!-- Grid Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $item)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 hover:shadow-md transition-shadow duration-300 max-w-md mx-auto">
                <div class="flex gap-4">
                    {{-- Cover Buku --}}
                    @if ($item->cover)
                        <div class="w-[140px] h-[200px] flex-shrink-0 overflow-hidden rounded-md">
                            @if ($item->cover && file_exists(public_path('storage/' . $item->cover)))
                                <img 
                                    src="{{ asset('storage/' . $item->cover) }}" 
                                    alt="Cover Buku {{ $item->judul }}" 
                                    class="w-full h-full object-cover rounded-md" 
                                    loading="lazy">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm rounded-md">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="w-[140px] h-[200px] bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-sm">
                            Tidak ada cover
                        </div>
                    @endif

                    {{-- Konten Buku --}}
                    <div class="flex flex-col justify-between flex-1 overflow-hidden">
                        <div>
                            {{-- Judul dengan truncate --}}
                            <h3 class="text-lg font-bold text-black truncate" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </h3>
                    
                            {{-- Kategori --}}
                            <span class="inline-block mt-1 mb-2 px-3 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded-full border border-green-300">
                                {{ $item->kategori }}
                            </span>
                    
                            {{-- Deskripsi maksimal 3 baris --}}
                            <p class="text-sm text-gray-500 mb-3 line-clamp-3 break-words">
                                {{ $item->deskripsi }}
                            </p>
                        </div>
                    
                        {{-- Detail --}}
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
                <div class="mt-4">
                @if($item->jumlah_stok > 0)
                    <button 
                        wire:click="pinjam({{ $item->id }})" 
                        class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm p-2 hover:bg-green-100 text-green-700 rounded-full">
                        Pinjam Buku
                    </button>
                @else
                    <button 
                        disabled 
                        class="bg-gray-400 cursor-not-allowed text-white px-4 py-2 rounded-lg shadow-sm">
                        Stok Habis
                    </button>
                @endif
            </div>
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Buku</h2>
    </div>
    <div class="mb-4">
        <input 
            type="text" 
            wire:model.debounce.300ms="search" 
            placeholder="Cari judul buku..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <!-- Tabel Daftar Buku -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Judul Buku</th>
                    <th class="px-4 py-3 font-semibold">Deskripsi</th>
                    <th class="px-4 py-3 font-semibold">Kategori</th>
                    <th class="px-4 py-3 font-semibold">Penulis</th>
                    <th class="px-4 py-3 font-semibold">Penerbit</th>
                    <th class="px-4 py-3 font-semibold">Tahun</th>
                    <th class="px-4 py-3 font-semibold">ISBN</th>
                    <th class="px-4 py-3 font-semibold">Jumlah Stok</th>
                    <th class="px-4 py-3 font-semibold">Lokasi Rak</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($books as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->judul }}</td>
                        <td class="px-4 py-2">{{ Str::limit($item->deskripsi, 100) }}...</td>
                        <td class="px-4 py-2">{{ $item->kategori }}</td>
                        <td class="px-4 py-2">{{ $item->penulis }}</td>
                        <td class="px-4 py-2">{{ $item->penerbit }}</td>
                        <td class="px-4 py-2">{{ $item->tahun_terbit }}</td>
                        <td class="px-4 py-2">{{ $item->isbn }}</td>
                        <td class="px-4 py-2">{{ $item->jumlah_stok }}</td>
                        <td class="px-4 py-2">{{ $item->lokasi_rak }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button wire:click="edit({{ $item->id }})" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow text-xs">Edit</button>
                            <button wire:click="delete({{ $item->id }})" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow text-xs">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

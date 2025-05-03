<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <!-- Judul dan Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Buku</h2>
        <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
            + Tambah Buku
        </button>        
    </div>
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
            <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}</h2>

            <div class="space-y-4 text-sm text-gray-600">
                <!-- Cover Buku -->
                <div>
                    <label for="cover" class="block text-black text-xs mb-1">Cover Buku</label>
                    <input type="file" wire:model="cover" id="cover"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                </div>
            
                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-black text-xs mb-1">Judul</label>
                    <input type="text" wire:model="judul" id="judul"
                        class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"
                        placeholder=" " />
                </div>
            
                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-black text-xs mb-1">Kategori</label>
                    <select wire:model="kategori" id="kategori"
                        class="w-full text-black border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                        <option value="" disabled selected></option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Nonfiksi">Nonfiksi</option>
                        <option value="Sains">Sains</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Biografi">Biografi</option>
                        <option value="Komik">Komik</option>
                    </select>
                </div>
            
                <!-- Penulis & Penerbit -->
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label for="penulis" class="block text-black text-xs mb-1">Penulis</label>
                        <input type="text" wire:model="penulis" id="penulis"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    </div>
                    <div class="w-1/2">
                        <label for="penerbit" class="block text-black text-xs mb-1">Penerbit</label>
                        <input type="text" wire:model="penerbit" id="penerbit"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    </div>
                </div>
            
                <!-- Tahun Terbit & ISBN -->
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label for="tahun_terbit" class="block text-black text-xs mb-1">Tahun Terbit</label>
                        <select wire:model="tahun_terbit" id="tahun_terbit"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                            <option value="" disabled selected></option>
                            @for ($year = date('Y'); $year >= 1900; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="isbn" class="block text-black text-xs mb-1">ISBN</label>
                        <input type="number" wire:model="isbn" id="isbn"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none">
                    </div>
                </div>
            </div>              

            <div class="flex justify-end space-x-2 mt-6">
                <button wire:click="closeModal"
                    class="bg-gray-100 border border-gray-300 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                    Batal
                </button>
            
                @if($isEdit)
                    <button wire:click="update"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Update Buku
                    </button>
                @else
                    <button wire:click="store"
                        class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                        Simpan Buku
                    </button>
                @endif
            </div>            
        </div>
    </div>
    @endif

    



    <!-- Pencarian -->
    <div class="mb-4">
        <input type="text" wire:model="search" placeholder="Cari Buku..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <!-- Tabel Daftar Buku -->
    <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 font-semibold">No</th>
                <th class="px-4 py-3 font-semibold">Judul Buku</th>
                <th class="px-4 py-3 font-semibold">Kategori</th>
                <th class="px-4 py-3 font-semibold">Penulis</th>
                <th class="px-4 py-3 font-semibold">Penerbit</th>
                <th class="px-4 py-3 font-semibold">Tahun</th>
                <th class="px-4 py-3 font-semibold">ISBN</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($buku as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->judul }}</td>
                    <td class="px-4 py-2">{{ $item->kategori }}</td>
                    <td class="px-4 py-2">{{ $item->penulis }}</td>
                    <td class="px-4 py-2">{{ $item->penerbit }}</td>
                    <td class="px-4 py-2">{{ $item->tahun_terbit }}</td>
                    <td class="px-4 py-2">{{ $item->isbn }}</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow text-xs">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow text-xs">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

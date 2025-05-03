<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Buku</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-5">
        <div>
            <label for="judul" class="block font-medium text-gray-700">Judul Buku</label>
            <input type="text" id="judul" wire:model="judul" class="mt-1 block w-full border rounded p-2" />
            @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="penulis" class="block font-medium text-gray-700">Penulis</label>
            <input type="text" id="penulis" wire:model="penulis" class="mt-1 block w-full border rounded p-2" />
            @error('penulis') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="penerbit" class="block font-medium text-gray-700">Penerbit</label>
            <input type="text" id="penerbit" wire:model="penerbit" class="mt-1 block w-full border rounded p-2" />
            @error('penerbit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tahun_terbit" class="block font-medium text-gray-700">Tahun Terbit</label>
            <input type="number" id="tahun_terbit" wire:model="tahun_terbit" class="mt-1 block w-full border rounded p-2" />
            @error('tahun_terbit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="isbn" class="block font-medium text-gray-700">ISBN</label>
            <input type="text" id="isbn" wire:model="isbn" class="mt-1 block w-full border rounded p-2" />
            @error('isbn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="kategori" class="block font-medium text-gray-700">Kategori</label>
            <select id="kategori" wire:model="kategori" class="mt-1 block w-full border rounded p-2">
                <option value="">-- Pilih Kategori --</option>
                <option value="Fiksi">Fiksi</option>
                <option value="Non-Fiksi">Non-Fiksi</option>
                <option value="Biografi">Biografi</option>
                <option value="Teknologi">Teknologi</option>
                <option value="Sejarah">Sejarah</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Komik">Komik</option>
                <option value="Sains">Sains</option>
                <option value="Agama">Agama</option>
                <option value="Sosial">Sosial</option>
            </select>
            @error('kategori') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="deskripsi" class="block font-medium text-gray-700">Deskripsi</label>
            <textarea id="deskripsi" wire:model="deskripsi" class="mt-1 block w-full border rounded p-2" rows="3"></textarea>
            @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="jumlah_stok" class="block font-medium text-gray-700">Jumlah Stok</label>
            <input type="number" id="jumlah_stok" wire:model="jumlah_stok" class="mt-1 block w-full border rounded p-2" />
            @error('jumlah_stok') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lokasi_rak" class="block font-medium text-gray-700">Lokasi Rak</label>
            <input type="text" id="lokasi_rak" wire:model="lokasi_rak" class="mt-1 block w-full border rounded p-2" />
            @error('lokasi_rak') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="cover_buku" class="block font-medium text-gray-700">Cover Buku</label>
            <input type="file" id="cover_buku" wire:model="cover_buku" class="mt-1 block w-full border rounded p-2" />
            @error('cover_buku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>

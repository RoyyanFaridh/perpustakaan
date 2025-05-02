<div>
    <h1 class="text-xl font-bold mb-4">Daftar Buku</h1>

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="mb-6">
        <input type="text" wire:model="judul" placeholder="Judul" class="border p-2 mr-2">
        <input type="text" wire:model="kategori" placeholder="Kategori" class="border p-2 mr-2">
        <input type="text" wire:model="penulis" placeholder="Penulis" class="border p-2 mr-2">
        <input type="text" wire:model="penerbit" placeholder="Penerbit" class="border p-2 mr-2">
        <input type="number" wire:model="tahun_terbit" placeholder="Tahun Terbit" class="border p-2 mr-2">
        <input type="text" wire:model="isbn" placeholder="ISBN" class="border p-2 mr-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Tambah</button>
    </form>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Penulis</th>
                <th class="border px-4 py-2">Penerbit</th>
                <th class="border px-4 py-2">Tahun Terbit</th>
                <th class="border px-4 py-2">ISBN</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->judul }}</td>
                    <td class="border px-4 py-2">{{ $item->kategori }}</td>
                    <td class="border px-4 py-2">{{ $item->penulis }}</td>
                    <td class="border px-4 py-2">{{ $item->penerbit }}</td>
                    <td class="border px-4 py-2">{{ $item->tahun_terbit }}</td>
                    <td class="border px-4 py-2">{{ $item->isbn }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $item->id }})" class="bg-yellow-400 px-2 py-1">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="bg-red-500 px-2 py-1">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

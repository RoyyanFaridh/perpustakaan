<div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
    <!-- Judul -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Anggota Perpustakaan</h2>
        <a href="{{ route('anggota.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
            + Tambah Anggota
        </a>        
    </div>

    <!-- Tabel Daftar Anggota -->
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nomor Induk</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kelas/Jurusan</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Alamat</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Telepon</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($anggota as $key => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $key + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->nomor_induk }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->kelas }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->alamat }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->telepon }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $item->email }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-medium rounded">
                            Edit
                        </button>
                        <button wire:click="delete({{ $item->id }})" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-400">
                        Tidak ada data anggota.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

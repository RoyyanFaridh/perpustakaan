<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Guru</h2>
            <div class="flex gap-2">
                <a href="{{ route('export.guru') }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
                    Export Excel
                </a>
                <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
                    + Tambah Guru
                </button> 
            </div>     
        </div>

        <div class="mb-4">
            <input 
                type="text" 
                wire:model.debounce.300ms="search" 
                placeholder="Cari guru..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        
        @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4">{{ $isEdit ? 'Edit Guru' : 'Tambah Guru' }}</h2>

                {{-- Validasi Error --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                        <strong class="font-medium">Terdapat kesalahan input:</strong>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4 text-sm text-gray-600">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-black text-xs mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                
                    <!-- Status & NIP dalam satu baris -->
                    <div class="flex gap-4">
                        <!-- Status -->
                        <div class="w-1/2">
                            <label for="status" class="block text-black text-xs mb-1">Status</label>
                            <select wire:model="status" id="status"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Status --</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- NIP -->
                        <div class="w-1/2">
                            <label for="nip" class="block text-black text-xs mb-1">Nomor Induk Pegawai (NIP)</label>
                            <input type="text" wire:model="nip" id="nip"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>
                    </div>

                    <!-- Jenis Kelamin & Nomor Telepon dalam satu baris -->
                    <div class="flex gap-4">
                        <!-- Jenis Kelamin -->
                        <div class="w-1/2">
                            <label for="jenis_kelamin" class="block text-black text-xs mb-1">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" id="jenis_kelamin"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="w-1/2">
                            <label for="no_telp" class="block text-black text-xs mb-1">Nomor Telepon</label>
                            <input type="text" wire:model="no_telp" id="no_telp"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-black text-xs mb-1">Alamat</label>
                        <textarea wire:model="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"></textarea>
                    </div>
                

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-black text-xs mb-1">Email</label>
                        <input type="email" wire:model="email" id="email"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
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
                            Update Guru
                        </button>
                    @else
                        <button wire:click.prevent="store"
                            type="submit" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Simpan Guru
                        </button>
                    @endif
                </div>            
            </div>
        </div>
        @endif

        <!-- Tabel Daftar Guru -->
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">NIP</th>
                    <th class="px-4 py-3 font-semibold">Jenis Kelamin</th>
                    <th class="px-4 py-3 font-semibold">Alamat</th>
                    <th class="px-4 py-3 font-semibold">Nomor Telepon</th>
                    <th class="px-4 py-3 font-semibold">Email</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($anggota as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->nama }}</td>
                        <td class="px-4 py-2">{{ $item->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td class="px-4 py-2">{{ $item->nis_nip }}</td>
                        <td class="px-4 py-2">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($item->alamat, 100) }}</td>
                        <td class="px-4 py-2">{{ $item->no_telp }}</td>
                        <td class="px-4 py-2">{{ $item->email }}</td>
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('confirm-delete', event => {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed) {
                Livewire.emit('deleteConfirmed');
            }
        });
    });
</script>

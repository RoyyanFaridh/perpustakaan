<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4 sm:gap-0">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Daftar Siswa</h2>
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <button wire:click="exportSiswa"
                    class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-3 sm:px-4 rounded-lg text-center">
                    Export Excel
                </button>
                <button wire:click="openModal"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 sm:px-4 rounded-lg text-center">
                    + Tambah Siswa
                </button>
            </div>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <!-- Filter Kelas -->
            <div class="relative w-full sm:w-1/3">
                <label class="block mb-1 text-sm font-medium text-gray-700">Filter Kelas</label>
                <select wire:model.live="kelas"
                        class="block w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="semua">Semua Kelas</option>
                    <option value="7">Kelas 7</option>
                    <option value="8">Kelas 8</option>
                    <option value="9">Kelas 9</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div class="relative w-full sm:w-1/3">
                <label class="block mb-1 text-sm font-medium text-gray-700">Filter Status</label>
                <select wire:model.live="filterStatus"
                        class="block w-full appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="semua">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                </select>
            </div>

            <!-- Pencarian -->
            <div class="w-full sm:w-1/3">
                <label class="block mb-1 text-sm font-medium text-gray-700">Cari Siswa</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Cari nama siswa..."
                       class="w-full px-4 py-2 pr-10 text-sm bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        
        <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4"><?php echo e($isEdit ? 'Edit Siswa' : 'Tambah Siswa'); ?></h2>

                <!--[if BLOCK]><![endif]--><?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                        <strong class="font-medium">Terdapat kesalahan input:</strong>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <div class="space-y-4 text-sm text-gray-600">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-black text-xs mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                
                    <!-- Status dan NIS berdampingan -->
                    <div class="flex gap-4">
                        <!-- Status -->
                        <div class="w-1/2">
                            <label for="status" class="block text-black text-xs mb-1">Status</label>
                            <select wire:model="status" id="status" 
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">Pilih Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- NIS -->
                        <div class="w-1/2">
                            <label for="nis" class="block text-black text-xs mb-1">Nomor Induk Siswa (NIS)</label>
                            <input type="text" wire:model="nis" id="nis"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>
                    </div>

                    <!-- Kelas dan Jenis Kelamin berdampingan -->
                    <div class="flex gap-4">
                        <!-- Kelas -->
                        <div class="w-1/2">
                            <label for="kelas" class="block text-black text-xs mb-1">Kelas</label>
                            <select wire:model="kelas" id="kelas" 
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">Pilih Kelas</option>
                                <option value="7">Kelas 7</option>
                                <option value="8">Kelas 8</option>
                                <option value="9">Kelas 9</option>
                            </select>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="w-1/2">
                            <label for="jenis_kelamin" class="block text-black text-xs mb-1">Jenis Kelamin</label>
                            <select wire:model="jenis_kelamin" id="jenis_kelamin" 
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-black text-xs mb-1">Alamat</label>
                        <textarea wire:model="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"></textarea>
                    </div>
                
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="no_telp" class="block text-black text-xs mb-1">Nomor Telepon</label>
                        <input type="text" wire:model="no_telp" id="no_telp"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
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
                
                    <!--[if BLOCK]><![endif]--><?php if($isEdit): ?>
                        <button wire:click="update"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Update Siswa
                        </button>
                    <?php else: ?>
                        <button wire:click.prevent="store"
                            type="submit" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Simpan Siswa
                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>            
            </div>
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

         <!-- Tabel Daftar Siswa -->
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
            <tr class="text-center">
                <th class="px-4 py-3 font-semibold">No</th>

                
                <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('nama')">
                    <div class="flex items-center justify-center gap-1 text-sm">
                        Nama
                        <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <!--[if BLOCK]><![endif]--><?php if($sortField === 'nama' && $sortDirection === 'asc'): ?>
                                <path d="M5 12l5-5 5 5H5z" /> 
                            <?php elseif($sortField === 'nama' && $sortDirection === 'desc'): ?>
                                <path d="M5 8l5 5 5-5H5z" /> 
                            <?php else: ?>
                                <path d="M5 8l5 5 5-5H5z" /> 
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </svg>
                    </div>
                </th>

                
                <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('status')">
                    <div class="flex items-center justify-center gap-1 text-sm">
                        Status
                        <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <!--[if BLOCK]><![endif]--><?php if($sortField === 'status' && $sortDirection === 'asc'): ?>
                                <path d="M5 12l5-5 5 5H5z" />
                            <?php elseif($sortField === 'status' && $sortDirection === 'desc'): ?>
                                <path d="M5 8l5 5 5-5H5z" />
                            <?php else: ?>
                                <path d="M5 8l5 5 5-5H5z" />
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </svg>
                    </div>
                </th>

                <th class="px-4 py-3 font-semibold">NIS</th>

                
                <th class="px-4 py-3 font-semibold cursor-pointer select-none" wire:click="sortBy('kelas')">
                    <div class="flex items-center justify-center gap-1 text-sm">
                        Kelas
                        <svg class="w-3 h-3 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <!--[if BLOCK]><![endif]--><?php if($sortField === 'kelas' && $sortDirection === 'asc'): ?>
                                <path d="M5 12l5-5 5 5H5z" />
                            <?php elseif($sortField === 'kelas' && $sortDirection === 'desc'): ?>
                                <path d="M5 8l5 5 5-5H5z" />
                            <?php else: ?>
                                <path d="M5 8l5 5 5-5H5z" />
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </svg>
                    </div>
                </th>

                <th class="px-4 py-3 font-semibold">Jenis Kelamin</th>
                <th class="px-4 py-3 font-semibold">Alamat</th>
                <th class="px-4 py-3 font-semibold">Nomor Telepon</th>
                <th class="px-4 py-3 font-semibold">Email</th>
                <th class="px-4 py-3 font-semibold">Aksi</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                <!--[if BLOCK]><![endif]--><?php if($anggota->isEmpty()): ?>
                        <tr>
                            <td colspan="11" class="text-center py-6 text-red-500 ">
                                Tidak ada data siswa ditemukan.
                            </td>
                        </tr>
                    <?php else: ?>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50 text-center">
                    <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                    <td class="px-4 py-2 text-left"><?php echo e($item->nama); ?></td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border
                            <?php echo e($item->status == 'active'
                                ? 'text-green-700 bg-green-200 border-green-500'
                                : 'text-red-700 bg-red-200 border-red-500'); ?>">
                            <?php echo e($item->status == 'active' ? 'Aktif' : 'Tidak Aktif'); ?>

                        </span>
                    </td>
                    <td class="px-4 py-2"><?php echo e($item->nis_nip); ?></td>
                    <td class="px-4 py-2"><?php echo e($item->kelas); ?></td>
                    <td class="px-4 py-2">
                        <!--[if BLOCK]><![endif]--><?php if($item->jenis_kelamin == 'L'): ?>
                            <span class="inline-block px-3 py-1 text-blue-700 bg-blue-200 border border-blue-500 rounded-full text-xs font-semibold">
                                Laki-laki
                            </span>
                        <?php else: ?>
                            <span class="inline-block px-3 py-1 text-pink-700 bg-pink-200 border border-pink-500 rounded-full text-xs font-semibold">
                                Perempuan
                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </td>
                    <td class="px-4 py-2 text-left"><?php echo e(\Illuminate\Support\Str::limit($item->alamat, 100)); ?></td>
                    <td class="px-4 py-2"><?php echo e($item->no_telp); ?></td>
                    <td><?php echo e($item->email ?: ($item->user->email ?? '-')); ?></td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex flex-col items-center space-y-2 md:flex-row md:justify-center md:space-y-0 md:space-x-2">
                            <button wire:click="edit(<?php echo e($item->id); ?>)"
                                    class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow text-xs">
                                Edit
                            </button>
                            <button wire:click="delete(<?php echo e($item->id); ?>)"
                                    class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow text-xs">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
</script><?php /**PATH D:\Perkuliahan Duniawi\New folder\New folder\perpustakaan\resources\views/livewire/admin/anggota/siswa.blade.php ENDPATH**/ ?>
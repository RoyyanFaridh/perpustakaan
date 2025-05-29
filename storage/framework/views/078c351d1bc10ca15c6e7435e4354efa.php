<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Anggota</h2>
            <div class="flex gap-2">
                <a href="<?php echo e(route('anggota.export')); ?>" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
                    Export Excel
                </a>
                <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
                    + Tambah Anggota
                </button>
            </div>
        </div>

        <div class="mb-4">
        <input 
            type="text" 
            wire:model.debounce.300ms="search" 
            placeholder="Cari anggota..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        
        <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><?php echo e($isEdit ? 'Edit Anggota' : 'Tambah Anggota'); ?></h2>

                
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
                    <!-- Nama Anggota -->
                    <div>
                        <label for="nama" class="block text-black text-xs mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                
                    <!-- Status -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="status" class="block text-black text-xs mb-1">Status</label>
                            <select wire:model="status" id="status" 
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Status --</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="role" class="block text-black text-xs mb-1">Role</label>
                            <select wire:model="role" id="role" 
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Role --</option>
                                <option value="siswa">Siswa</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- NIS dan Kelas (sejajar) -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="nis_nip" class="block text-black text-xs mb-1">NIS/NIP</label>
                            <input type="text" wire:model="nis_nip" id="nis_nip"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>

                        <div class="w-1/2">
                            <label for="kelas" class="block text-black text-xs mb-1">Kelas</label>
                            <select wire:model="kelas" id="kelas"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                                <option value="">-- Pilih Kelas --</option>
                                <option value="7">Kelas 7</option>
                                <option value="8">Kelas 8</option>
                                <option value="9">Kelas 9</option>
                            </select>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-black text-xs mb-1">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin" id="jenis_kelamin" 
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                
                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-black text-xs mb-1">Alamat</label>
                        <textarea wire:model="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm"></textarea>
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
                            Update Anggota
                        </button>
                    <?php else: ?>
                        <button wire:click.prevent="store"
                            type="submit" class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Simpan Anggota
                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>            
            </div>
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Tabel Daftar Anggota -->
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Role</th>
                    <th class="px-4 py-3 font-semibold">NIS</th>
                    <th class="px-4 py-3 font-semibold">Kelas</th>
                    <th class="px-4 py-3 font-semibold">Jenis Kelamin</th>
                    <th class="px-4 py-3 font-semibold">Alamat</th>
                    <th class="px-4 py-3 font-semibold">Email</th>
                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->nama); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->status == 'active' ? 'Aktif' : 'Tidak Aktif'); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->role == 'siswa' ? 'Siswa' : 'Guru'); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->nis_nip); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->kelas); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td class="px-4 py-2"><?php echo e(Str::limit($item->alamat, 100)); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->email); ?></td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button wire:click="edit(<?php echo e($item->id); ?>)" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow text-xs">Edit</button>
                            <button wire:click="delete(<?php echo e($item->id); ?>)" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow text-xs">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('anggotaUpdated', () => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data anggota berhasil diperbarui.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        });
    });
</script>
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/livewire/admin/anggota/index.blade.php ENDPATH**/ ?>
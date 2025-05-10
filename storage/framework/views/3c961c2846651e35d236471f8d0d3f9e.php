<div class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Anggota</h2>
            <button wire:click="openModal" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg">
                + Tambah Anggota
            </button>        
        </div>
        
        <!--[if BLOCK]><![endif]--><?php if($showModal): ?>
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4"><?php echo e($isEdit ? 'Edit Anggota' : 'Tambah Anggota'); ?></h2>

                <div class="space-y-4 text-sm text-gray-600">
                    Foto Anggota
                    <div>
                        <label for="foto" class="block text-black text-xs mb-1">Foto Anggota</label>
                        <input type="file" wire:model="foto" id="foto"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>

                    <!-- Nama Anggota -->
                    <div>
                        <label for="nama" class="block text-black text-xs mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama"
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                    </div>
                
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-black text-xs mb-1">Status</label>
                        <select wire:model="status" id="status" 
                            class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>

                    
                    <!-- NIS dan Kelas (sejajar) -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="nis" class="block text-black text-xs mb-1">Nomor Induk Siswa (NIS)</label>
                            <input type="text" wire:model="nis" id="nis"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm" />
                        </div>

                        <div class="w-1/2">
                            <label for="kelas" class="block text-black text-xs mb-1">Kelas</label>
                            <select wire:model="kelas" id="kelas"
                                class="w-full border border-gray-100 shadow-sm rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-100 focus:outline-none text-sm">
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
                            Update Anggota
                        </button>
                    <?php else: ?>
                        <button wire:click.prevent="store" type="button"
                            class="bg-blue-500 border border-blue-600 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105">
                            Simpan Anggota
                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>            
            </div>
        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Pencarian -->
        <div class="mb-4">
            <input type="text" wire:model="search" placeholder="Cari Anggota..." class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Tabel Daftar Anggota -->
    </div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">NIS</th>
                    <th class="px-4 py-3 font-semibold">Kelas</th>
                    <th class="px-4 py-3 font-semibold">Jenis Kelamin</th>
                    <th class="px-4 py-3 font-semibold">Alamat</th>
                    <th class="px-4 py-3 font-semibold">Nomor Telepon</th>
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
                        <td class="px-4 py-2"><?php echo e($item->nis); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->kelas); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->alamat); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->no_telp); ?></td>
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
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/pages/anggota/index.blade.php ENDPATH**/ ?>
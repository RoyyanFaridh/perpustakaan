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
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->judul); ?></td>
                        <td class="px-4 py-2"><?php echo e(Str::limit($item->deskripsi, 100)); ?>...</td>
                        <td class="px-4 py-2"><?php echo e($item->kategori); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->penulis); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->penerbit); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->tahun_terbit); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->isbn); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->jumlah_stok); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->lokasi_rak); ?></td>
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
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/livewire/user/buku/index.blade.php ENDPATH**/ ?>
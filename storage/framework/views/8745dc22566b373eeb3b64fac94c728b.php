<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Peminjaman</h2>

    <!-- Tabel Peminjaman -->
    <div class="overflow-x-auto shadow rounded-lg mb-6">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-left font-semibold">
                <tr>
                    <th class="px-4 py-2">Anggota ID</th>
                    <th class="px-4 py-2">Buku ID</th>
                    <th class="px-4 py-2">Tanggal Pinjam</th>
                    <th class="px-4 py-2">Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-4 py-2"><?php echo e($item->anggota_id); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->buku_id); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->tanggal_pinjam); ?></td>
                        <td class="px-4 py-2"><?php echo e($item->tanggal_kembali); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <!-- Form Peminjaman -->
    <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium mb-1">Anggota ID</label>
            <input type="number" wire:model="anggota_id" placeholder="Anggota ID" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Buku ID</label>
            <input type="number" wire:model="buku_id" placeholder="Buku ID" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Pinjam</label>
            <input type="date" wire:model="tanggal_pinjam" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Kembali</label>
            <input type="date" wire:model="tanggal_kembali" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300">
        </div>
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow">Pinjam</button>
        </div>
    </form>
</div>
<?php /**PATH D:\Perkuliahan Duniawi\New folder\New folder\perpustakaan\resources\views/pages/peminjaman/index.blade.php ENDPATH**/ ?>
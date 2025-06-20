<div class="p-6 space-y-6 max-w-7xl mx-auto">
    <!-- Judul & Filter -->
    <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">📚 Daftar Buku</h2>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <!-- Filter Kategori (kiri) -->
            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Kategori</label>
                <select wire:model.live="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="semua">Semua Kategori</option>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kat); ?>"><?php echo e($kat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </select>
            </div>

            <!-- Pencarian (kanan) -->
            <div class="w-full sm:w-1/2">
                <label class="block mb-1 text-sm font-medium text-gray-600">Cari Judul</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Contoh: Laskar Pelangi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
   
        <!-- Flash Message -->
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="p-3 rounded bg-green-100 text-green-700">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php if(session()->has('error')): ?>
            <div class="p-3 rounded bg-red-100 text-red-700">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Daftar Buku -->
    <!--[if BLOCK]><![endif]--><?php if($books->count() > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow p-4 flex flex-col justify-between h-full">
                    <!-- Cover -->
                    <div class="w-full h-48 bg-gray-100 rounded-md overflow-hidden mb-4">
                        <!--[if BLOCK]><![endif]--><?php if($item->cover): ?>
                            <img src="<?php echo e(asset('storage/' . $item->cover)); ?>" class="object-cover w-full h-full">
                        <?php else: ?>
                            <div class="flex items-center justify-center h-full text-gray-400">Tidak ada cover</div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <!-- Info Buku -->
                    <div class="space-y-1 mb-3">
                        <h3 class="text-lg font-bold text-gray-800 truncate"><?php echo e($item->judul); ?></h3>
                        <span class="inline-block text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full"><?php echo e($item->kategori); ?></span>
                        <p class="text-sm text-gray-500 line-clamp-3"><?php echo e($item->deskripsi); ?></p>
                    </div>
                    <!-- Metadata -->
                    <div class="text-sm text-gray-600 space-y-1">
                        <p>Penulis: <?php echo e($item->penulis); ?></p>
                        <p>Penerbit: <?php echo e($item->penerbit); ?></p>
                        <p>Tahun: <?php echo e($item->tahun_terbit); ?></p>
                        <p>Stok: <?php echo e($item->jumlah_stok); ?> | Rak: <?php echo e($item->lokasi_rak); ?></p>
                    </div>
                    <!-- Tombol -->
                    <div class="mt-4">
                        <!--[if BLOCK]><![endif]--><?php if($item->jumlah_stok > 0): ?>
                            <button wire:click="pinjam(<?php echo e($item->id); ?>)"
                                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                                Pinjam Buku
                            </button>
                        <?php else: ?>
                            <button disabled
                                class="w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">
                                Stok Habis
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php else: ?>
        <div class="text-center py-20 text-gray-500">
            <p class="text-lg font-medium">Tidak ada buku ditemukan.</p>
            <p class="text-sm text-gray-400">Silakan coba kategori lain atau ubah kata kunci pencarian.</p>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/livewire/user/buku/index.blade.php ENDPATH**/ ?>
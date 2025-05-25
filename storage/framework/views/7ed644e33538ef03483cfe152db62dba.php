<div class="bg-white p-6 rounded-2xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Buku</h2>
    </div>
    <div class="mb-6">
        <input 
            type="text" 
            wire:model.debounce.300ms="search" 
            placeholder="Cari judul buku..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
    </div>

    <!-- Grid Daftar Buku -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <!--[if BLOCK]><![endif]--><?php if($item->cover): ?>
                    <img src="<?php echo e(asset('storage/' . $item->cover)); ?>" alt="Cover Buku" class="w-full h-48 object-cover rounded-lg mb-4">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center mb-4 text-gray-400 text-sm">
                        Tidak ada cover
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <h3 class="text-lg font-semibold text-gray-900"><?php echo e($item->judul); ?></h3>
                <span class="inline-block mt-1 mb-2 px-2 py-0.5 text-xs font-medium bg-green-100 text-green-700 rounded-full"><?php echo e($item->kategori); ?></span>
                
                <p class="text-sm text-gray-600 mb-4 line-clamp-3"><?php echo e($item->deskripsi); ?></p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 text-sm text-gray-700 mt-2">
                    <div class="space-y-1">
                        <p><span class="font-medium">Penulis:</span> <?php echo e($item->penulis); ?></p>
                        <p><span class="font-medium">Penerbit:</span> <?php echo e($item->penerbit); ?></p>
                        <p><span class="font-medium">Tahun:</span> <?php echo e($item->tahun_terbit); ?></p>
                    </div>
                    <div class="space-y-1">
                        <p><span class="font-medium">ISBN:</span> <?php echo e($item->isbn); ?></p>
                        <p><span class="font-medium">Stok:</span> <?php echo e($item->jumlah_stok); ?></p>
                        <p><span class="font-medium">Rak:</span> <?php echo e($item->lokasi_rak); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/livewire/user/buku/index.blade.php ENDPATH**/ ?>
<div>
    <h1 class="text-xl font-bold mb-4">Daftar Buku</h1>

    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo e($item->judul); ?></td>
                    <td class="border px-4 py-2"><?php echo e($item->kategori); ?></td>
                    <td class="border px-4 py-2"><?php echo e($item->penulis); ?></td>
                    <td class="border px-4 py-2"><?php echo e($item->penerbit); ?></td>
                    <td class="border px-4 py-2"><?php echo e($item->tahun_terbit); ?></td>
                    <td class="border px-4 py-2"><?php echo e($item->isbn); ?></td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit(<?php echo e($item->id); ?>)" class="bg-yellow-400 px-2 py-1">Edit</button>
                        <button wire:click="delete(<?php echo e($item->id); ?>)" class="bg-red-500 px-2 py-1">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/livewire/buku/buku-component.blade.php ENDPATH**/ ?>
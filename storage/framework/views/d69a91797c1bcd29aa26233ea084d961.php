<div class="container mt-4">
    <h1 class="mb-4">Daftar Buku</h1>

    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="alert alert-success"><?php echo e(session('message')); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="d-flex justify-content-between mb-3">
        <input type="text" wire:model="search" placeholder="Cari Buku..." class="form-control w-25">
        <button wire:click="resetForm" class="btn btn-primary">+ Tambah Buku</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($item->judul); ?></td>
                    <td><?php echo e($item->kategori); ?></td>
                    <td><?php echo e($item->penulis); ?></td>
                    <td><?php echo e($item->penerbit); ?></td>
                    <td><?php echo e($item->tahun_terbit); ?></td>
                    <td><?php echo e($item->isbn); ?></td>
                    <td>
                        <button wire:click="edit(<?php echo e($item->id); ?>)" class="btn btn-warning btn-sm">Edit</button>
                        <button wire:click="delete(<?php echo e($item->id); ?>)" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>

    
    <div class="mt-4">
        <h4><?php echo e($isEdit ? 'Edit Buku' : 'Tambah Buku'); ?></h4>
        <form wire:submit.prevent="<?php echo e($isEdit ? 'update' : 'store'); ?>">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" wire:model="judul" class="form-control">
                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" wire:model="kategori" class="form-control">
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" wire:model="penulis" class="form-control">
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" wire:model="penerbit" class="form-control">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" wire:model="tahun_terbit" class="form-control">
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" wire:model="isbn" class="form-control">
            </div>
            <button class="btn btn-success mt-2"><?php echo e($isEdit ? 'Update' : 'Simpan'); ?></button>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/pages/buku/index.blade.php ENDPATH**/ ?>
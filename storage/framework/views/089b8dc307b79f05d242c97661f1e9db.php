<div>
    <h1>Peminjaman</h1>
    <table class="table">
        <thead>
            <tr><th>Anggota ID</th><th>Buku ID</th><th>Tanggal Pinjam</th><th>Kembali</th></tr>
        </thead>
        <tbody>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->anggota_id); ?></td>
                    <td><?php echo e($item->buku_id); ?></td>
                    <td><?php echo e($item->tanggal_pinjam); ?></td>
                    <td><?php echo e($item->tanggal_kembali); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>

    <form wire:submit.prevent="store">
        <input type="number" wire:model="anggota_id" placeholder="Anggota ID">
        <input type="number" wire:model="buku_id" placeholder="Buku ID">
        <input type="date" wire:model="tanggal_pinjam">
        <input type="date" wire:model="tanggal_kembali">
        <button type="submit">Pinjam</button>
    </form>
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/pages/peminjaman/index.blade.php ENDPATH**/ ?>
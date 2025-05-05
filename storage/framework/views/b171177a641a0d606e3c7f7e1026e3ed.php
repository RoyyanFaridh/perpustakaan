<div>
    <h1>Broadcast</h1>
    <table class="table">
        <thead><tr><th>Judul</th><th>Isi</th></tr></thead>
        <tbody>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $broadcast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr><td><?php echo e($item->judul); ?></td><td><?php echo e($item->isi); ?></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>

    <form wire:submit.prevent="store">
        <input type="text" wire:model="judul" placeholder="Judul">
        <textarea wire:model="isi" placeholder="Isi Pesan"></textarea>
        <button type="submit">Kirim</button>
    </form>
</div>
<?php /**PATH C:\Users\ACER\perpustakaan\resources\views/pages/broadcast/index.blade.php ENDPATH**/ ?>
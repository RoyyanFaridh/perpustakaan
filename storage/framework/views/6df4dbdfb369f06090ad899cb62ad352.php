<div class="container mx-auto p-4 max-w-md">
    <h2 class="text-xl font-semibold mb-4">Verifikasi Email</h2>

    <!--[if BLOCK]><![endif]--><?php if($message): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <form wire:submit.prevent="resendVerificationEmail">
        <label for="email" class="block mb-2 font-medium">Email Anda</label>
        <input type="email" id="email" wire:model="email" class="w-full p-2 border rounded mb-4" required />

        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-red-600 mb-4"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

        <p>Silakan cek inbox email Anda untuk tautan verifikasi. Jika belum menerima email, klik tombol di bawah untuk mengirim ulang.</p>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Kirim Ulang Email Verifikasi
        </button>
    </form>
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/livewire/pages/auth/setup-email-verify.blade.php ENDPATH**/ ?>
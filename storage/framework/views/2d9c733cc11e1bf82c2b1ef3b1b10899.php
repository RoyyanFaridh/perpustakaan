<div class="p-6 max-w-lg mx-auto">
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="text-green-600 mb-4"><?php echo e(session('success')); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <label>Password Baru</label>
            <input type="password" wire:model.defer="password" class="w-full border p-2">
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" wire:model.defer="password_confirmation" class="w-full border p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
<?php /**PATH C:\Users\ASUS\perpustakaan\resources\views/livewire/pages/auth/change-password-form.blade.php ENDPATH**/ ?>
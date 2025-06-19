<div class="container mx-auto max-w-md p-6 bg-white shadow rounded mt-10">
    <h2 class="text-2xl font-semibold mb-4 text-center">Ganti Password Awal</h2>

    <!--[if BLOCK]><![endif]--><?php if($message): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            <?php echo e($message); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <label for="new_password" class="block text-sm font-medium">Password Baru</label>
            <input type="password" wire:model.defer="new_password" id="new_password"
                class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" wire:model.defer="confirm_password" id="confirm_password"
                class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
            Simpan Password
        </button>
    </form>
</div>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/livewire/pages/auth/setup-password.blade.php ENDPATH**/ ?>
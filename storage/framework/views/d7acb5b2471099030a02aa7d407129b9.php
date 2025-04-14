<div>
    <div class="flex">
        <button wire:click="$set('showForm', 'login')" class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
            Login
        </button>
        <button wire:click="$set('showForm', 'register')" class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
            Register
        </button>
    </div>

    <!-- Debug -->
    <p>Debug: <?php echo e($showForm); ?></p>

    <!-- Area Dinamis untuk Form -->
    <!--[if BLOCK]><![endif]--><?php if($showForm === 'login'): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages.auth.login');

$__html = app('livewire')->mount($__name, $__params, 'lw-512760188-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php elseif($showForm === 'register'): ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages.auth.register');

$__html = app('livewire')->mount($__name, $__params, 'lw-512760188-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div><?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views\livewire/auth-forms.blade.php ENDPATH**/ ?>
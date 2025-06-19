<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Profil Pengguna</h2>

    
    <!--[if BLOCK]><![endif]--><?php if(session('force_fill_email')): ?>
        <div class="p-4 mb-4 rounded-md bg-red-50 border border-red-300 text-red-800 text-sm">
            Silakan lengkapi alamat email Anda sebelum melanjutkan.
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <!--[if BLOCK]><![endif]--><?php if(auth()->user()->is_default_password): ?>
        <div class="p-4 mb-4 rounded-md bg-yellow-50 border border-yellow-300 text-yellow-800 text-sm">
            Anda masih menggunakan password default. Harap ganti password dan lengkapi email Anda.
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Profil</h3>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.update-profile-information-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-382907967-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

    
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Keamanan</h3>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.update-password-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-382907967-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>

    
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Akun</h3>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('admin.profile.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-382907967-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
</div><?php /**PATH C:\Users\ASUS\perpustakaan\resources\views\livewire/admin/profile/index.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginal951024bfcf58033c82ac11d797616473 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal951024bfcf58033c82ac11d797616473 = $attributes; } ?>
<?php $component = App\View\Components\UserLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\UserLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Profil Pengguna')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            
            <!--[if BLOCK]><![endif]--><?php if(auth()->user()->is_default_password): ?>
                <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded shadow">
                    <strong>Perhatian:</strong> Anda masih menggunakan password default. Silakan ganti password dan lengkapi email Anda.
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(session('force_fill_email')): ?>
                <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
                    Silakan lengkapi email Anda terlebih dahulu untuk melanjutkan.
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user.profile', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3293778005-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>

            <div class="mb-4">
                <?php if(auth()->user()->hasVerifiedEmail()): ?>
                    <div class="text-green-700 font-semibold">
                        Email sudah terverifikasi.
                    </div>
                <?php else: ?>
                    <div class="text-red-700">
                        Email belum terverifikasi. Silakan cek email Anda untuk verifikasi.
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal951024bfcf58033c82ac11d797616473)): ?>
<?php $attributes = $__attributesOriginal951024bfcf58033c82ac11d797616473; ?>
<?php unset($__attributesOriginal951024bfcf58033c82ac11d797616473); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal951024bfcf58033c82ac11d797616473)): ?>
<?php $component = $__componentOriginal951024bfcf58033c82ac11d797616473; ?>
<?php unset($__componentOriginal951024bfcf58033c82ac11d797616473); ?>
<?php endif; ?>
<?php /**PATH C:\Users\ASUS\perpustakaan\resources\views/livewire/user/profile.blade.php ENDPATH**/ ?>
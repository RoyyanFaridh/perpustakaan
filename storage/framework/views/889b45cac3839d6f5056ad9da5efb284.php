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
            <?php echo e(__('Profile')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user.profile.update-profile-information-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3316369868-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->is_default_password): ?>
                    <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
                        Anda masih menggunakan password default. Harap ganti password dan lengkapi email Anda.
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="max-w-xl">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user.profile.update-password-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3316369868-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user.profile.delete-user-form', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3316369868-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
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
<?php /**PATH D:\Perkuliahan Duniawi\New folder\New folder\perpustakaan\resources\views/livewire/user/profile.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
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
[$__name, $__params] = $__split('profile.update-profile-information-form', []);

<<<<<<<< HEAD:storage/framework/views/eb4db3fef48f358354fa746c5d6f7172.php
$__html = app('livewire')->mount($__name, $__params, 'lw-1202851093-0', $__slots ?? [], get_defined_vars());
========
$__html = app('livewire')->mount($__name, $__params, 'lw-1933153792-0', $__slots ?? [], get_defined_vars());
>>>>>>>> origin/putri:storage/framework/views/13403cfc93c8761d82d3575741bf7a4c.php

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
[$__name, $__params] = $__split('profile.update-password-form', []);

<<<<<<<< HEAD:storage/framework/views/eb4db3fef48f358354fa746c5d6f7172.php
$__html = app('livewire')->mount($__name, $__params, 'lw-1202851093-1', $__slots ?? [], get_defined_vars());
========
$__html = app('livewire')->mount($__name, $__params, 'lw-1933153792-1', $__slots ?? [], get_defined_vars());
>>>>>>>> origin/putri:storage/framework/views/13403cfc93c8761d82d3575741bf7a4c.php

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
[$__name, $__params] = $__split('profile.delete-user-form', []);

<<<<<<<< HEAD:storage/framework/views/eb4db3fef48f358354fa746c5d6f7172.php
$__html = app('livewire')->mount($__name, $__params, 'lw-1202851093-2', $__slots ?? [], get_defined_vars());
========
$__html = app('livewire')->mount($__name, $__params, 'lw-1933153792-2', $__slots ?? [], get_defined_vars());
>>>>>>>> origin/putri:storage/framework/views/13403cfc93c8761d82d3575741bf7a4c.php

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
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<<<<<<<< HEAD:storage/framework/views/eb4db3fef48f358354fa746c5d6f7172.php
<?php /**PATH C:\Users\ACER\perpustakaan\resources\views/pages/profile.blade.php ENDPATH**/ ?>
========
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/pages/profile.blade.php ENDPATH**/ ?>
>>>>>>>> origin/putri:storage/framework/views/13403cfc93c8761d82d3575741bf7a4c.php

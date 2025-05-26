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
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            <?php echo e(__('> Buku')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            <div class="container mx-auto">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('peminjaman-component');

$__html = app('livewire')->mount($__name, $__params, 'lw-2365502996-0', $__slots ?? [], get_defined_vars());

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
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/livewire/user/peminjaman.blade.php ENDPATH**/ ?>
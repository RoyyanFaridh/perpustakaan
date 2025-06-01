<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['on']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['on']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div x-data="{ shown: false, timeout: null }"
     x-init="window.Livewire.find('<?php echo e($_instance->getId()); ?>').on('<?php echo e($on); ?>', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
     x-show.transition.out.opacity.duration.1500ms="shown"
     x-transition:leave.opacity.duration.1500ms
     style="display: none;"
    <?php echo e($attributes->merge(['class' => 'text-sm text-gray-600'])); ?>>
    <?php echo e($slot->isEmpty() ? __('Saved.') : $slot); ?>

</div>
<<<<<<<< HEAD:storage/framework/views/aabea0fdff0e27224511943c34bf5fbf.php
<?php /**PATH C:\Users\ACER\perpustakaan\resources\views/components/action-message.blade.php ENDPATH**/ ?>
========
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/components/action-message.blade.php ENDPATH**/ ?>
>>>>>>>> origin/putri:storage/framework/views/62fec2756383b8c851c1dded954982ed.php

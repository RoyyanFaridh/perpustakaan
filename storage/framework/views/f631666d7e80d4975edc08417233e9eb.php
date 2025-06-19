<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r hidden sm:block">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.user-navigation', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1967333979-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </aside>

            <!-- Mobile Navbar -->
            <div class="sm:hidden w-full">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.user-navigation', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1967333979-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>

            <!-- Main Content -->
            <div class="flex-auto bg-white m-2 border border-gray-100 rounded-md ">
                <!-- Page Heading -->
                <?php if(isset($header)): ?>
                    <header>
                        <div class="mx-auto p-4">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>

                <!-- Page Content -->
                <main class="">
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH C:\Users\ACER\perpustakaan\resources\views/layouts/user.blade.php ENDPATH**/ ?>
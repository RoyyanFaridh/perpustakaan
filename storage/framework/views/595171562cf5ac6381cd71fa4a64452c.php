<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Perpustakaan Digital SMP 12 Yogyakarta</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen flex">
            <!-- Bagian Kiri -->
            <div class="w-1/2 flex flex-col items-center justify-center bg-blue-50 p-6">
                <h1 class="text-4xl font-bold text-blue-900 text-center">
                    Selamat Datang Di Perpustakaan Digital SMP 12 Yogyakarta
                </h1>
                <p class="mt-6 text-lg text-gray-700 text-center">
                    Jelajahi koleksi buku digital kami dan temukan informasi menarik untuk mendukung belajar Anda!
                </p>
            </div>

            <!-- Bagian Kanan -->
            <div class="w-1/2 flex flex-col items-center justify-center p-10">
                <h2 class="text-2xl font-semibold text-blue-800 mb-6">Akses Perpustakaan</h2>
                <a
                    href="/login"
                    class="block w-full text-center py-4 mb-4 rounded-lg bg-blue-500 text-white font-bold hover:bg-blue-600 transition"
                >
                    Login
                </a>
                <a
                    href="/register"
                    class="block w-full text-center py-4 rounded-lg bg-blue-500 text-white font-bold hover:bg-blue-600 transition"
                >
                    Register
                </a>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\MSI Computer\Herd\perpustakaan\resources\views/pages/welcome.blade.php ENDPATH**/ ?>
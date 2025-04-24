<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r hidden sm:block">
                <livewire:layout.navigation />
            </aside>

            <!-- Mobile Navbar -->
            <div class="sm:hidden w-full">
                <livewire:layout.navigation />
            </div>

            <!-- Main Content -->
            <div class="flex-auto bg-white m-2 border border-gray-100 rounded-md ">
                <!-- Page Heading -->
                @if (isset($header))
                    <header>
                        <div class="mx-auto p-4">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>

<div x-data="{ open: false }" class="w-full">
    <!-- Header -->
    <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4">
        <!-- Kiri: Brand + Desktop Nav -->
        <div class="flex items-center space-x-6">
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6 text-sm text-gray-700 dark:text-gray-300">
                <a href="#hero" class="hover:underline">Beranda</a>
                <a href="#tentang" class="hover:underline">Tentang</a>
                <a href="#kontak" class="hover:underline">Kontak</a>
            </div>
        </div>

        <!-- Kanan: Hamburger + Login/Dashboard -->
        <div class="flex items-center space-x-3">
            <!-- Hamburger (mobile only) -->
            <button
                @click="open = !open"
                class="md:hidden text-black focus:outline-none"
            >
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Always visible Login/Dashboard button -->
            <?php if(auth()->guard()->check()): ?>
                <a
                    href="<?php echo e(url('/dashboard')); ?>"
                    class="rounded-md px-4 py-2 text-white bg-green-600 hover:bg-green-700 transition text-sm"
                >
                    Dashboard
                </a>
            <?php else: ?>
                <a
                    href="<?php echo e(route('login')); ?>"
                    class="rounded-md px-4 py-2 text-white bg-red-400 hover:bg-red-500 transition text-sm"
                >
                    Login
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Nav Dropdown -->
    <div x-show="open" x-transition class="md:hidden px-4 pb-4 space-y-2 text-gray-700 dark:text-gray-300">
        <a href="#hero" class="block hover:underline">Beranda</a>
        <a href="#tentang" class="block hover:underline">Tentang</a>
        <a href="#kontak" class="block hover:underline">Kontak</a>
    </div>
</div>
<?php /**PATH D:\Perkuliahan Duniawi\New folder\New folder\perpustakaan\resources\views/livewire/welcome/navigation.blade.php ENDPATH**/ ?>
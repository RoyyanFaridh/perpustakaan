<div x-data="{ open: false, active: '#hero' }" class="relative w-full">
    <!-- Header -->
    <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-2">
        <!-- Navigasi Kiri -->
        <div class="flex items-center">
            <div class="hidden md:flex items-center space-x-8 text-sm text-black">
                <a href="#hero" :class="{ 'font-bold': active === '#hero' }" @click="active = '#hero'" class="transition">Beranda</a>
                <a href="#tentang" :class="{ 'font-bold': active === '#tentang' }" @click="active = '#tentang'" class="transition">Tentang</a>
                <a href="#kontak" :class="{ 'font-bold': active === '#kontak' }" @click="active = '#kontak'" class="transition">Kontak</a>
            </div>
        </div>

        <!-- Navigasi Kanan -->
        <div class="flex items-center">
            <!-- Hamburger -->
            <button @click="open = !open" class="md:hidden text-black mr-4">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Login -->
            <a href="{{ route('login') }}"
               class="rounded-md px-8 py-2 text-white bg-red-400 hover:bg-red-500 transition text-sm md:ml-12 lg:ml-20">
                Login
            </a>
        </div>
    </div>

    <!-- Dropdown Mengambang (Mobile) -->
    <div x-show="open" x-transition
         class="absolute right-4 top-16 w-64 bg-white rounded-lg shadow-lg z-50 border px-4 py-3 space-y-2 text-black md:hidden">
        <a href="#hero" @click="active = '#hero'; open = false"
           :class="{ 'font-bold': active === '#hero' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
            Beranda
        </a>
        <a href="#tentang" @click="active = '#tentang'; open = false"
           :class="{ 'font-bold': active === '#tentang' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
            Tentang
        </a>
        <a href="#kontak" @click="active = '#kontak'; open = false"
           :class="{ 'font-bold': active === '#kontak' }" class="block transition hover:bg-gray-100 px-2 py-1 rounded">
            Kontak
        </a>
    </div>
</div>

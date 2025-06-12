<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan Digital SMP 12 Yogyakarta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  @livewireStyles
</head>
<body class="font-sans antialiased text-gray-800">
  <header class="sticky top-0 z-50 bg-white shadow-md px-4 py-3 md:px-8 md:py-3" x-data="{ open: false, active: '#hero' }">
    <div class="flex items-center justify-between w-full">
      <!-- Logo -->
      <div class="flex items-center space-x-4">
        <img src="/images/logo_smp12yk.png" class="h-12 w-auto" alt="Logo SMPN 12 Yogyakarta" />
      </div>

      <!-- Navigasi Desktop -->
      <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
        <a href="#hero" :class="{ 'font-bold text-blue-800': active === '#hero' }" @click="active = '#hero'">Beranda</a>
        <a href="#statistik" :class="{ 'font-bold text-blue-800': active === '#statistik' }" @click="active = '#statistik'">Statistik</a>
        <a href="#informasi" :class="{ 'font-bold text-blue-800': active === '#informasi' }" @click="active = '#informasi'">Informasi</a>
        <a href="#kontak" :class="{ 'font-bold text-blue-800': active === '#kontak' }" @click="active = '#kontak'">Kontak</a>
        <a href="#berita" :class="{ 'font-bold text-blue-800': active === '#berita' }" @click="active = '#berita'">Berita</a>
      </nav>


      <!-- Hamburger & Login -->
      <div class="flex items-center space-x-4">
        <!-- Hamburger button untuk mobile -->
        <button @click="open = !open" class="md:hidden focus:outline-none" aria-label="Toggle Menu">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <!-- Tombol Login -->
        <a href="{{ route('login') }}" class="rounded px-4 py-2 bg-blue-500 text-white hover:bg-blue-700 text-sm transition">
          Login
        </a>
      </div>
    </div>

    <!-- Dropdown menu mobile -->
    <div x-show="open" x-transition class="md:hidden mt-2 space-y-1 px-4 pb-4 border-t border-gray-200 bg-white">
      <a href="#hero" @click="active = '#hero'; open = false" 
        :class="{ 'font-bold text-blue-800': active === '#hero' }" 
        class="block py-2 px-3 rounded hover:bg-gray-100 transition">
        Beranda
      </a>
      <a href="#statistik" @click="active = '#statistik'; open = false" 
        :class="{ 'font-bold text-blue-800': active === '#statistik' }" 
        class="block py-2 px-3 rounded hover:bg-gray-100 transition">
        Statistik
      </a>
      <a href="#informasi" @click="active = '#informasi'; open = false" 
        :class="{ 'font-bold text-blue-800': active === '#informasi' }" 
        class="block py-2 px-3 rounded hover:bg-gray-100 transition">
        Informasi
      </a>
      <a href="#kontak" @click="active = '#kontak'; open = false" 
        :class="{ 'font-bold text-blue-800': active === '#kontak' }" 
        class="block py-2 px-3 rounded hover:bg-gray-100 transition">
        Kontak
      </a>
      <a href="#berita" @click="active = '#berita'; open = false" 
        :class="{ 'font-bold text-blue-800': active === '#berita' }" 
        class="block py-2 px-3 rounded hover:bg-gray-100 transition">
        Berita
      </a>
    </div>
  </header>


  <section id="hero" class="relative bg-white py-20 min-h-[320px]">
    <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-b from-transparent to-gray-200 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-col lg:flex-row items-start relative z-10">
      <!-- Teks -->
      <div class="w-full md:w-full lg:w-2/3 text-center md:text-center lg:text-left px-10 md:px-10 lg:pr-8 space-y-10 order-2 md:order-2 lg:order-1">
        <h1 class="text-4xl lg:text-5xl font-bold leading-tight text-blue-800">
          Sistem Informasi Perpustakaan <br class="hidden md:block"> SMP Negeri 12 Yogyakarta
        </h1>
        <p class="text-gray-600 max-w-md mx-auto md:mx-auto lg:mx-0">
          Selamat datang di platform digital kami yang menyediakan berbagai layanan informasi dan peminjaman buku secara daring untuk mendukung kegiatan belajar siswa dan guru.
        </p>
      </div>
      <!-- Gambar -->
      <div class="w-full md:w-full lg:w-1/3 mb-8 md:mb-8 lg:mb-0 flex justify-center lg:justify-end order-1 md:order-1 lg:order-2">
        <img src="/images/perpus_4.png" alt="Perpustakaan" 
          class="max-w-sm md:max-w-md lg:max-w-lg h-auto object-contain pr-0">
      </div>
    </div>
  </section>
  <!-- Statistik Section -->
  <section class="relative z-10 px-16 md:px-16 py-2 bg-gray-200 min-h-[250px]">
    <div class="absolute bottom-0 left-0 w-full h-14 bg-gradient-to-b from-transparent to-white pointer-events-none"></div>
    <div class="flex flex-wrap gap-4">
        @foreach ($cardData as $card)
          <x-card
              :title="$card['title']"
              :value="$card['value']"
              :periode="$card['periode'] ?? null"
              :delta="$card['delta'] ?? null"
              :icon="$card['icon'] ?? null"
              :bgColor="$card['bgColor'] ?? '#f43f5e'"
          />
      @endforeach
    </div>
  </section>

  <!-- Statistik Pengunjung -->
  <section id="statistik" class="relative z-10 px-6 md:px-20 py-20 bg-white text-gray-800">
    <!-- Gradasi bagian bawah -->
    <div class="absolute bottom-0 left-0 w-full h-14 bg-gradient-to-b from-white to-gray-200 pointer-events-none"></div>

    <div class="max-w-4xl mx-auto">
      <!-- Judul -->
      <div class="relative mb-6">
        <h2 class="text-4xl font-bold text-blue-800 text-left inline-block">
          <span class="relative">
            <span class="absolute -bottom-1 left-0 w-16 h-1 bg-blue-800 rounded-full"></span>
            Statistik Pengunjung
          </span>
        </h2>
      </div>

      <!-- Grafik -->
      <div class="bg-gray-100 shadow-lg rounded-lg p-6 h-[400px] flex items-center justify-center">
        <canvas id="statistikChart" class="w-full h-full max-w-full max-h-full"></canvas>
      </div>
    </div>
  </section>


  <!-- Informasi Perpustakaan -->
  <section id="informasi" class="relative z-10 px-10 md:px-10 py-12 bg-gradient-to-b from-gray-200 via-white to-gray-200 text-gray-800 scroll-mt-24">
    
    <!-- Gradasi bagian atas -->
    <div class="absolute top-0 left-0 w-full h- bg-gradient-to-t from-gray-200 to-white pointer-events-none"></div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

      <!-- Gambar -->
      <div class="overflow-hidden rounded-lg shadow-md transform transition duration-500 hover:scale-105">
        <img src="images/gedungsmpn12ykasli.jpg" alt="Gedung SMPN 12 Yogyakarta" class="w-full h-auto object-cover" />
      </div>

      <!-- Teks -->
      <div>
        <h2 class="text-4xl font-bold text-blue-800 mb-6 text-center md:text-left relative inline-block">
          Informasi Perpustakaan Digital
          <span class="block w-16 h-1 bg-blue-800 mt-2 rounded-full"></span>
        </h2>
        <p class="text-sm md:text-base leading-relaxed mb-4 text-justify">
          Perpustakaan merupakan jantung literasi dan pembelajaran di sekolah. 
          SMP Negeri 12 Yogyakarta menghadirkan Perpustakaan Digital sebagai inovasi untuk mendukung kebutuhan belajar siswa dan guru secara fleksibel, modern, dan inklusif. 
          Koleksinya mencakup buku pelajaran, bacaan umum, hingga referensi yang dapat diakses daring kapan saja dan di mana saja. 
          Layanan ini mendukung pembelajaran mandiri, membiasakan literasi digital, serta memudahkan guru menyediakan sumber belajar tambahan yang relevan.
        </p>
        <p class="text-sm md:text-base leading-relaxed mb-4 text-justify">
          Jam Operasional : 08.00 - 16.00 WIB
        </p>
      </div>
    </div>
  </section>

  <section id="berita" class="relative z-10 px-10 md:px-10 py-16 bg-white text-gray-800 scroll-mt-24 border-t border-gray-200">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-blue-800 mb-8 text-center md:text-left relative inline-block">
        Berita Terkini
        <span class="block w-16 h-1 bg-blue-800 mt-2 rounded-full"></span>
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($berita as $item)
          <div class="p-5 bg-blue-50 border-l-4 border-blue-400 rounded shadow-sm">
            <a href="{{ $item['link'] }}" target="_blank" class="text-blue-800 font-semibold text-lg hover:underline">
              [{{ $item['sumber'] }}] {{ $item['judul'] }}
            </a>
            <p class="text-sm text-gray-600 mt-1">{{ $item['tanggal'] }}</p>
          </div>
        @empty
          <p class="text-gray-500">Tidak ada berita tersedia.</p>
        @endforelse
      </div>
    </div>
  </section>


  @livewireScripts

  <script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($bulanLabels),
        datasets: [
          {
            label: '{{ $tahunSebelumnya }}',
            data: @json($jumlahPengunjungTahunLalu),
            borderColor: '#60A5FA',
            backgroundColor: 'rgba(96, 165, 250, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
          },
          {
            label: '{{ $tahunSekarang }}',
            data: @json($jumlahPengunjungTahunIni),
            borderColor: '#EF4444',
            backgroundColor: 'rgba(239, 68, 68, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, // 🔥 kunci agar tinggi container bekerja
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: '#374151',
              font: { weight: 'bold' }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { color: '#6B7280' },
            grid: { color: '#E5E7EB' }
          },
          x: {
            ticks: { color: '#6B7280' },
            grid: { display: false }
          }
        }
      }
    });
  </script>
</body>
<footer id="kontak" class="bg-blue-800 text-white px-6 md:px-20 py-10 border-t border-blue-700 shadow-2xl">
  <div class="w-full flex flex-col md:flex-row justify-between px-0 md:px-0 ...">

    <div class="md:w-1/2 text-left mb-8 md:mb-0">
      <h3 class="text-xl font-bold mb-3">SMP Negeri 12 Yogyakarta</h3>
      <p class="text-sm mb-1">Jalan Tentara Pelajar No.9, Yogyakarta 55272</p>
      <p class="text-sm mb-1">Telp: (0274) 563012</p>
      <p class="text-sm">
        Website:
        <a href="https://smpn12jogja.sch.id" target="_blank" class="underline hover:text-gray-200">
          smpn12jogja.sch.id
        </a>
      </p>
    </div>

    <div class="md:w-1/2 text-left md:text-right">
      <h3 class="text-xl font-bold mb-3">Ikuti Kami</h3>
      <ul class="space-y-2 text-sm">
        <li>
          <a href="https://www.instagram.com/smpn12jogja" target="_blank" class="hover:text-gray-200 transition">
            Instagram: @smpn12jogja
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/smpn12jogja" target="_blank" class="hover:text-gray-200 transition">
            Facebook: SMPN 12 Jogja
          </a>
        </li>
        <li>
          <a href="mailto:smpn12jogja@gmail.com" class="hover:text-gray-200 transition">
            Email: smpn12jogja@gmail.com
          </a>
        </li>
      </ul>
    </div>

  </div>

  <!-- Copyright -->
  <div class="mt-10 border-t border-white pt-4 text-center text-sm text-white">
    &copy; {{ date('Y') }} Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</html>

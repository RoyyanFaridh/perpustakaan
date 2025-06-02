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
  <header class="sticky top-0 z-50 bg-white shadow-md px-4 py-3 md:px-8 md:py-3">
    <div class="flex items-center justify-between w-full">
      <div class="flex items-center space-x-4">
        <!-- Logo -->
        <img src="/images/logo_smp12yk.png" class="h-12 w-auto" alt="Logo">
      </div>
      <!-- Navigasi dan Login -->
      <div class="flex items-center space-x-4">
        <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
          <a href="#beranda" class="hover:text-blue-800 font-semibold">Beranda</a>
          <a href="#statistik" class="hover:text-blue-800 font-semibold">Statistik</a>
          <a href="#tentang" class="hover:text-blue-800 font-semibold">Tentang</a>
          <a href="#kontak" class="hover:text-blue-800 font-semibold">Kontak</a>
        </nav>
        <a href="{{ route('login') }}" class="rounded px-4 py-2 bg-blue-500 text-white hover:bg-blue-700 text-sm transition">
          Login
        </a>
      </div>
    </div>
  </header>

  <section id="beranda" class="relative bg-white py-20 min-h-[320px]">
  <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-b from-transparent to-gray-200 pointer-events-none"></div>
  <div class="max-w-7xl mx-auto px-6 flex flex-col-reverse md:flex-row items-start relative z-10">
      <div class="w-full md:w-2/3 text-center md:text-left px-10 md:pr-8 space-y-10">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight text-blue-800">
          Sistem Informasi Perpustakaan <br class="hidden md:block"> SMP Negeri 12 Yogyakarta
        </h1>
        <p class="text-gray-600 max-w-md mx-auto md:mx-0">
          Selamat datang di platform digital kami yang menyediakan berbagai layanan informasi dan peminjaman buku secara daring untuk mendukung kegiatan belajar siswa dan guru.
        </p>
      </div>
      <div class="w-full md:w-1/3 mb-8 md:mb-0 flex justify-center md:justify-end">
        <img src="/images/perpus_4.png" alt="Perpustakaan" class="max-w-md md:max-w-lg h-auto object-contain pr-8">
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


<!-- Tentang Perpustakaan -->
<section id="tentang" class="relative z-10 px-10 md:px-10 py-12 bg-gradient-to-b from-gray-200 via-white to-gray-200 text-gray-800 scroll-mt-24">
  
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
        Tentang Perpustakaan Digital
        <span class="block w-16 h-1 bg-blue-800 mt-2 rounded-full"></span>
      </h2>
      <p class="text-sm md:text-base leading-relaxed mb-4 text-justify">
        Perpustakaan merupakan jantung dari kegiatan literasi dan pembelajaran di sekolah. Di era digital saat ini, 
        SMP Negeri 12 Yogyakarta turut berinovasi dengan menghadirkan layanan Perpustakaan Digital sebagai bentuk komitmen untuk mendukung kebutuhan belajar siswa dan guru secara lebih fleksibel, modern, dan inklusif.
      </p>
      <p class="text-sm md:text-base leading-relaxed mb-4 text-justify">
        Perpustakaan digital ini menyediakan berbagai koleksi buku pelajaran, bacaan umum, serta referensi lainnya yang dapat diakses secara daring kapan pun dan di mana pun. 
        Dengan demikian, siswa tidak lagi terbatas oleh ruang dan waktu dalam menjelajahi ilmu pengetahuan.
      </p>
      <p class="text-sm md:text-base leading-relaxed text-justify">
        Selain itu, perpustakaan digital ini juga menjadi sarana pembelajaran mandiri dan pembiasaan literasi digital bagi siswa. 
        Guru pun dimudahkan dalam menyediakan sumber belajar tambahan yang relevan dan cepat diakses.
      </p>
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

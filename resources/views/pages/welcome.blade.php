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
  <header x-data="{ open: false, active: '#hero' }" class="sticky top-0 z-50 bg-white shadow-md px-4 py-3 md:px-6 md:py-2">
    <div class="flex items-center justify-between w-full py-2">
      <div class="flex-shrink-0">
        <img src="/images/logo_smp12yk.png" class="h-10 w-auto" />
      </div>

      <nav class="hidden md:flex flex-grow justify-center space-x-8 text-sm text-gray-700">
        <a href="#hero" :class="{ 'font-bold': active === '#hero' }" @click="active = '#hero'" class="transition">Beranda</a>
        <a href="#tentang" :class="{ 'font-bold': active === '#tentang' }" @click="active = '#tentang'" class="transition">Tentang</a>
        <a href="#kontak" :class="{ 'font-bold': active === '#kontak' }" @click="active = '#kontak'" class="transition">Kontak</a>
      </nav>

      <div class="flex items-center">
        <button @click="open = !open" class="md:hidden text-black mr-4 z-50 relative">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <a href="{{ route('login') }}" class="rounded px-5 py-2 bg-red-400 text-white hover:bg-red-500 text-sm transition">
          Login
        </a>
      </div>
    </div>

    <div x-show="open" x-transition
        class="md:hidden absolute right-4 top-full mt-2 w-64 bg-white shadow-lg rounded border px-4 py-3 space-y-2 z-40 text-black">
      <a href="#hero" @click="active = '#hero'; open = false"
        :class="{ 'font-bold': active === '#hero' }" class="block hover:bg-gray-100 px-2 py-1 rounded transition">
        Beranda
      </a>
      <a href="#tentang" @click="active = '#tentang'; open = false"
        :class="{ 'font-bold': active === '#tentang' }" class="block hover:bg-gray-100 px-2 py-1 rounded transition">
        Tentang
      </a>
      <a href="#kontak" @click="active = '#kontak'; open = false"
        :class="{ 'font-bold': active === '#kontak' }" class="block hover:bg-gray-100 px-2 py-1 rounded transition">
        Kontak
      </a>
    </div>
  </header>

  <section id="hero"
    class="relative flex items-start justify-start text-white bg-cover bg-center pt-40
           min-h-[60vh] sm:min-h-[70vh] md:min-h-screen"
    style="background-image: url('/images/gedungsmpn12ykasli.jpg');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

    <div class="relative z-10">
        <div class="mb-2 max-w-3xl px-4 sm:px-6 md:px-12 lg:px-20">
            <span class="inline-block px-4 py-1 text-sm font-medium rounded-full bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20">
                Hai, Selamat Datang
            </span>
        </div>

        <div class="w-full px-4 sm:px-6 md:px-12 lg:px-20">
            <h1 class="text-6xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight">
                Sistem Informasi Perpustakaan <br class="hidden sm:block">
                SMP Negeri 12 Yogyakarta
            </h1>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-b from-transparent to-gray-100 z-0"></div>
  </section>

  <!-- Statistik Section -->
  <section class="relative z-10 px-6 md:px-20 py-8 bg-gray-100">
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

  <!-- Tentang Perpustakaan dan Statistik Pengunjung -->
  <section id="tentang" class="px-6 md:px-20 py-8 bg-gray-100 text-gray-800">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start gap-y-8">
      <!-- Tentang Perpustakaan -->
      <div>
        <h2 class="text-3xl font-semibold mb-6 text-red-400">Tentang Perpustakaan Digital</h2>
        <p class="text-sm sm:text-sm md:text-base lg:text-lg leading-relaxed mb-4">
          Perpustakaan merupakan jantung dari kegiatan literasi dan pembelajaran di sekolah. Di era digital saat ini, 
          SMP Negeri 12 Yogyakarta turut berinovasi dengan menghadirkan layanan Perpustakaan Digital sebagai bentuk komitmen untuk mendukung kebutuhan belajar siswa dan guru secara lebih fleksibel, modern, dan inklusif.
        </p>
        <p class="text-sm sm:text-sm md:text-base lg:text-lg leading-relaxed mb-4">
          Perpustakaan digital ini menyediakan berbagai koleksi buku pelajaran, bacaan umum, serta referensi lainnya yang dapat diakses secara daring kapan pun dan di mana pun. 
          Dengan demikian, siswa tidak lagi terbatas oleh ruang dan waktu dalam menjelajahi ilmu pengetahuan. 
          Cukup melalui perangkat gawai atau komputer yang terhubung ke internet, setiap pengguna dapat membuka dan membaca buku sesuai kebutuhan mereka.
        </p>
        <p class="text-sm sm:text-sm md:text-base lg:text-lg leading-relaxed mb-4">
          Selain itu, perpustakaan digital ini juga menjadi sarana pembelajaran mandiri dan pembiasaan literasi digital bagi siswa. 
          Guru pun dimudahkan dalam menyediakan sumber belajar tambahan yang relevan dan cepat diakses. 
          Melalui fitur-fitur yang interaktif dan terintegrasi, perpustakaan digital diharapkan dapat menjadi bagian tak terpisahkan dari ekosistem pendidikan yang adaptif terhadap perkembangan zaman.
        </p>
      </div>

      <!-- Statistik Pengunjung -->
      <div>
        <h2 class="text-3xl font-semibold mb-6 text-red-400">Statistik Pengunjung</h2>
        <div class="p-6 h-[500px] relative">
          <canvas id="statistikChart" class="absolute inset-0 w-full h-full"></canvas>
        </div>
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
<footer id="kontak" class="bg-red-400 text-white px-6 md:px-20 py-10 border-t border-red-300 shadow-2xl">
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
  <div class="mt-10 border-t border-red-300 pt-4 text-center text-sm text-white">
    &copy; {{ date('Y') }} Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</html>

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

  <!-- Navbar Sticky -->
  <header class="sticky top-0 z-50 flex justify-between items-center p-6 bg-white shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-4">
      <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-10 w-auto" />
    </div>

    <!-- Menu + Login (dibungkus agar lebih dekat) -->
    <div class="flex items-center space-x-6">
      <nav class="space-x-6 text-sm text-gray-700">
        <a href="#hero" class="hover:underline">Beranda</a>
        <a href="#tentang" class="hover:underline">Tentang</a>
        <a href="#kontak" class="hover:underline">Kontak</a>
      </nav>
      <a href="{{ route('login') }}" class="px-5 py-2 rounded bg-red-400 text-white hover:bg-red-500 transition">Login</a>
    </div>
  </header>

  <section id="hero"
    class="relative flex items-start justify-start text-white bg-cover bg-center pt-40
           min-h-[60vh] sm:min-h-[70vh] md:min-h-screen"
    style="background-image: url('/images/gedungsmpn12ykasli.jpg');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

    <!-- Isi konten -->
    <div class="relative z-10">
        <!-- Welcome Message -->
        <div class="mb-2 max-w-3xl px-4 sm:px-6 md:px-12 lg:px-20">
            <span class="inline-block px-4 py-1 text-sm font-medium rounded-full bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20">
                Hai, Selamat Datang
            </span>
        </div>

        <!-- Heading -->
        <div class="w-full px-4 sm:px-6 md:px-12 lg:px-20">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold leading-tight">
                Perpustakaan Digital <br class="hidden sm:block">
                SMP Negeri 12 Yogyakarta
            </h1>
        </div>
    </div>

    <!-- Gradasi bawah -->
    <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-b from-transparent to-gray-100 z-0"></div>
  </section>

  <!-- Statistik Section -->
  <section class="relative z-10 px-6 md:px-20 py-20 bg-gray-100">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach ($cardData as $card)
        <div class="bg-white shadow-md rounded-lg p-6">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ $card['bgColor'] }}">
              {!! $card['icon'] !!}
            </div>
            <h3 class="text-lg font-semibold" style="color: {{ $card['bgColor'] }}">{{ $card['title'] }}</h3>
          </div>
          <div class="flex items-center justify-between mt-4">
            <p class="text-3xl font-bold">{{ $card['value'] }}</p>
            @if (!is_null($card['delta']))
              <span class="text-sm font-semibold px-3 py-1 rounded {{ $card['delta'] >= 0 ? 'bg-green-100 text-green-500 border border-green-500' : 'bg-red-100 text-red-600' }}">
                {{ $card['delta'] >= 0 ? '+' : '' }}{{ number_format($card['delta'], 0, ',', '.') }}
              </span>
            @endif
          </div>
          <p class="text-xs text-gray-500 mt-2">pada {{ $card['periode'] }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <!-- Tentang Perpustakaan dan Statistik Pengunjung -->
  <section id="tentang" class="px-6 md:px-20 py-16 bg-gray-100 text-gray-800">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start gap-y-16">
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

<!-- Footer -->
<footer id="kontak" class="bg-red-400 text-white px-6 md:px-20 py-10 border-t border-gray-200 shadow-2xl">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-6 md:space-y-0">
    <!-- Informasi Sekolah -->
    <div>
      <h3 class="text-lg font-semibold mb-2 text-white">SMP Negeri 12 Yogyakarta</h3>
      <p class="text-sm text-white">Jalan Tentara Pelajar No.9 Yogyakarta 55272</p>
      <p class="text-sm text-white">Telp : (0274) 563012</>
      <p class="text-sm text-white">Website: <a href="https://smpn12jogja.sch.id" target="_blank" class="text-white hover:underline">smpn12jogja.sch.id</a></p>
    </div>

    <!-- Sosial Media -->
    <div>
      <h3 class="text-lg font-semibold mb-2 text-white">Ikuti Kami</h3>
      <ul class="space-y-1">
        <li>
          <a href="https://www.instagram.com/smpn12jogja" target="_blank" class="hover:text-white transition">Instagram: @smpn12jogja</a>
        </li>
        <li>
          <a href="https://www.facebook.com/smpn12jogja" target="_blank" class="hover:text-white transition">Facebook: SMPN 12 Jogja</a>
        </li>
        <li>
          <a href="mailto:smpn12jogja@gmail.com" class="hover:text-white transition">Email: smpn12jogja@gmail.com</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Copyright -->
  <div class="mt-8 text-center text-sm text-white">
    &copy; {{ date('Y') }} Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</html>

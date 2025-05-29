<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan Digital SMP 12 Yogyakarta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @livewireStyles
</head>
<body class="font-sans antialiased text-gray-800">

  <!-- Navbar -->
  <header class="sticky top-0 z-50 flex justify-between items-center px-6 py-4 bg-white border-b">
    <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-10" />
    <div class="space-x-3">
      <a href="{{ route('login') }}" class="px-4 py-1.5 rounded bg-red-500 text-white hover:bg-red-600 transition">Login</a>
    </div>
  </header>

  <!-- Hero -->
  <section class="relative min-h-[80vh] flex items-center px-6 md:px-20 bg-cover bg-center text-white" style="background-image: url('/images/gedungsmpn12ykasli.jpg');">
    <div class="absolute inset-0 bg-black/50"></div> <!-- sebelumnya bg-black/60 -->
    <div class="relative z-10 max-w-2xl text-gray-900"> <!-- supaya teks terbaca di atas putih -->
      <h1 class="text-4xl md:text-5xl text-white font-bold mb-3 leading-tight">Perpustakaan Digital<br>SMP Negeri 12 Yogyakarta</h1>
      <p class="text-lg text-white">Akses buku digital dari mana saja dengan mudah dan cepat.</p>
    </div>
  </section>

  <!-- Tentang -->
  <section class="px-6 md:px-20 py-16 bg-white">
    <h2 class="text-2xl font-semibold text-red-500 mb-6">Tentang Perpustakaan</h2>
    <div class="space-y-4 text-base leading-relaxed">
      <p>Perpustakaan adalah jantung literasi sekolah. Dengan hadirnya versi digital, SMPN 12 Yogyakarta ingin menjangkau seluruh siswa dan guru di era modern.</p>
      <p>Semua koleksi dapat diakses secara online — dari buku pelajaran hingga referensi umum — cukup melalui perangkat yang terhubung internet.</p>
      <p>Tujuannya adalah mempermudah pembelajaran mandiri, meningkatkan literasi digital, dan memberi kemudahan guru menyediakan sumber belajar yang relevan.</p>
    </div>
  </section>

  <!-- Statistik Koleksi -->
  <section class="px-6 md:px-20 py-16 bg-white">
    <h2 class="text-3xl font-semibold mb-6 text-red-400">Statistik Koleksi</h2>
    <div class="flex flex-wrap gap-4">
      <x-card 
        title="Total Koleksi Buku"
        bgColor="#ED5565" 
        :value="number_format($totalKoleksiBuku, 0, ',', '.')"
        periode="Mei 2025"
        :delta="8"
        :icon="view('components.icon.books')->render()"
      />

      <x-card 
        title="Total Anggota"
        bgColor="#1C84C6"  
        :value="number_format($totalAnggota, 0, ',', '.')"
        periode="Mei 2025"
        :delta="8" 
        :icon="view('components.icon.users')->render()"
      />

      <x-card 
        title="Total Peminjaman"
        bgColor="#23C6C8"  
        :value="number_format($totalPeminjaman, 0, ',', '.')"
        periode="Mei 2025"
        :delta="8"
        :icon="view('components.icon.calendar-clock')->render()" 
      />

      <x-card 
        title="Total Keterlambatan"
        bgColor="#1AB394"  
        :value="number_format($totalKeterlambatan, 0, ',', '.')"
        periode="Mei 2025"
        :delta="8"
        :icon="view('components.icon.calendar-x-2')->render()"  
      />
    </div>
  </section>

  <!-- Statistik Pengunjung -->
  <section class="px-6 md:px-20 py-16 bg-white">
    <h2 class="text-2xl font-semibold text-red-500 mb-6">Statistik Pengunjung</h2>
    <div class="bg-white p-6 rounded border">
      <canvas id="statistikChart" height="100"></canvas>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white px-6 md:px-20 py-10 border-t text-sm">
    <div class="flex flex-col md:flex-row justify-between gap-6">
      <div>
        <h3 class="font-semibold text-red-500 mb-2">SMP Negeri 12 Yogyakarta</h3>
        <p>Jl. Tegal Gendu No.16, Pringgokusuman, Gedong Tengen, Yogyakarta</p>
        <p>Website: <a href="https://smpn12jogja.sch.id" class="text-red-500 hover:underline">smpn12jogja.sch.id</a></p>
      </div>
      <div>
        <h3 class="font-semibold text-red-500 mb-2">Ikuti Kami</h3>
        <ul>
          <li><a href="https://instagram.com/smpn12jogja" class="hover:underline">Instagram</a></li>
          <li><a href="https://facebook.com/smpn12jogja" class="hover:underline">Facebook</a></li>
          <li><a href="mailto:info@smpn12jogja.sch.id" class="hover:underline">Email</a></li>
        </ul>
      </div>
    </div>
    <div class="mt-8 text-center text-gray-500">&copy; {{ date('Y') }} Perpustakaan Digital SMP Negeri 12 Yogyakarta.</div>
  </footer>

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
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan Digital SMP 12 Yogyakarta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="font-sans antialiased text-gray-800">

  <!-- Navbar Sticky -->
  <header class="sticky top-0 z-50 flex justify-between items-center p-6 bg-white shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-4">
      <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-10 w-auto" />
    </div>

    <!-- Menu + Login (dibungkus agar lebih dekat) -->
    <div class="flex items-center justify-between w-full md:w-auto">
      <nav class="space-x-3 sm:space-x-6 text-sm text-gray-700">
        <a href="#hero" class="hover:underline">Beranda</a>
        <a href="#tentang" class="hover:underline">Tentang</a>
        <a href="#kontak" class="hover:underline">Kontak</a>
      </nav>
      <a href="<?php echo e(route('login')); ?>" class="mx-10 px-5 py-2 rounded bg-red-400 text-white hover:bg-red-500 transition">Login</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="hero" class="relative min-h-screen flex items-start justify-start text-white bg-cover bg-center pt-40" style="background-image: url('/images/gedungsmpn12ykasli.jpg');">
    <!-- Overlay hitam semi-transparan -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

    <!-- Kontainer isi -->
    <div class="relative z-10">
      <div class="mb-2 max-w-3xl px-6 sm:px-12 md:pl-20">
        <span class="inline-block px-4 py-1 text-sm font-medium rounded-full bg-white bg-opacity-10 backdrop-blur-sm border border-white border-opacity-20">
          Hai, Selamat Datang
        </span>
      </div>
      <div class="w-full max-w-8xl pl-20">
        <h1 class="text-4xl sm:text-5xl md:text-8xl font-bold leading-tight">
          Perpustakaan Digital <br> SMP Negeri 12 Yogyakarta
        </h1>
      </div>
    </div>

    <!-- Gradasi transisi -->
    <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-b from-transparent to-gray-100 z-0"></div>
  </section>

  <!-- Statistik Section -->
  <section class="relative z-10 px-6 md:px-20 py-20 bg-gray-100">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Total Koleksi Buku -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-pink-600">Total Koleksi Buku</h3>
        <p class="text-3xl font-bold mt-4"><?php echo e(number_format($totalKoleksiBuku, 0, ',', '.')); ?></p> 
        <p class="text-xs text-gray-500 mt-2">pada Maret 2025</p>
      </div>

      <!-- Total Anggota -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-600">Total Anggota</h3>
        <p class="text-3xl font-bold mt-4"><?php echo e(number_format($totalAnggota, 0, ',', '.')); ?></p> 
        <p class="text-xs text-gray-500 mt-2">pada Maret 2025</p>
      </div>

      <!-- Total Peminjaman Buku -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-teal-600">Total Peminjaman Buku</h3>
        <p class="text-3xl font-bold mt-4"><?php echo e(number_format($totalPeminjaman, 0, ',', '.')); ?></p> 
        <p class="text-xs text-gray-500 mt-2">pada Maret 2025</p>
      </div>

      <!-- Total Terlambat Pengembalian -->
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-green-600">Total Terlambat Pengembalian</h3>
        <p class="text-3xl font-bold mt-4"><?php echo e(number_format($totalKeterlambatan, 0, ',', '.')); ?></p> 
        <p class="text-xs text-gray-500 mt-2">pada Maret 2025</p>
      </div>
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

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


  <script>
    const ctx = document.getElementById('statistikChart').getContext('2d');
    const statistikChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
        datasets: [
          {
            label: '<?php echo e($tahunSebelumnya); ?>',
            data: <?php echo json_encode($jumlahPengunjungTahunLalu, 15, 512) ?>,
            borderColor: '#60A5FA',
            backgroundColor: 'rgba(96, 165, 250, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
          },
          {
            label: '<?php echo e($tahunSekarang); ?>',
            data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
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
    &copy; <?php echo e(date('Y')); ?> Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</html>
<?php /**PATH C:\Users\ASUS\perpustakaan\resources\views/pages/welcome.blade.php ENDPATH**/ ?>
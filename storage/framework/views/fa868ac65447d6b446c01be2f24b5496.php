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
<body class="font-sans antialiased bg-white">

  <!-- Navbar Sticky -->
  <header class="sticky top-0 z-50 flex justify-between items-center p-6 bg-white shadow-md">
    <div class="flex items-center space-x-4">
      <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-12 w-auto" />
    </div>
    <div class="space-x-4">
      <a href="<?php echo e(route('login')); ?>" class="px-5 py-2 rounded bg-red-400 text-white hover:bg-red-400">Login</a>
      <a href="<?php echo e(route('register')); ?>" class="px-5 py-2 rounded border-2 border-red-400 text-red-400 hover:bg-red-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150">Register</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="relative min-h-screen flex items-center justify-start text-white bg-cover bg-center" style="background-image: url('/images/gedungsmpn12ykasli.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative px-6 md:px-20 z-10 max-w-3xl">
      <h1 class="text-5xl font-bold mb-4 leading-tight">Perpustakaan Digital<br>SMP Negeri 12 Yogyakarta</h1>
      <p class="text-lg">Akses buku digital sekolah dari mana saja dengan mudah dan cepat.</p>
    </div>
  </section>

  <!-- Konten Tambahan agar dapat discroll -->
  <section class="px-6 md:px-20 py-16 bg-gray-100 text-gray-800">
    <h2 class="text-3xl font-semibold mb-6 text-red-400">Tentang Perpustakaan Digital SMP Negeri 12 Yogyakarta</h2>
    <p class="text-lg leading-relaxed mb-4">
      Perpustakaan merupakan jantung dari kegiatan literasi dan pembelajaran di sekolah. Di era digital saat ini, 
      SMP Negeri 12 Yogyakarta turut berinovasi dengan menghadirkan layanan Perpustakaan Digital sebagai bentuk komitmen untuk mendukung kebutuhan belajar siswa dan guru secara lebih fleksibel, modern, dan inklusif.
    </p>
    <p class="text-lg leading-relaxed mb-4">
      Perpustakaan digital ini menyediakan berbagai koleksi buku pelajaran, bacaan umum, serta referensi lainnya yang dapat diakses secara daring kapan pun dan di mana pun. 
      Dengan demikian, siswa tidak lagi terbatas oleh ruang dan waktu dalam menjelajahi ilmu pengetahuan. 
      Cukup melalui perangkat gawai atau komputer yang terhubung ke internet, setiap pengguna dapat membuka dan membaca buku sesuai kebutuhan mereka.
    </p>
    <p class="text-lg leading-relaxed">
      Selain itu, perpustakaan digital ini juga menjadi sarana pembelajaran mandiri dan pembiasaan literasi digital bagi siswa. 
      Guru pun dimudahkan dalam menyediakan sumber belajar tambahan yang relevan dan cepat diakses. 
      Melalui fitur-fitur yang interaktif dan terintegrasi, perpustakaan digital diharapkan dapat menjadi bagian tak terpisahkan dari ekosistem pendidikan yang adaptif terhadap perkembangan zaman.
    </p>
    
  </section>

  <section class="px-6 md:px-20 py-16 bg-red-400 text-gray-800"> 
    <h2 class="text-3xl font-semibold mb-6 text-white">Statistik Koleksi</h2> 
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"> 
      <div class="p-4 bg-red-100 text-center rounded shadow"> 
        <h3 class="text-lg font-bold">Total Buku</h3> 
        <p class="text-2xl"><?php echo e(number_format($totalKoleksiBuku, 0, ',', '.')); ?></p> 
      </div> 
      <div class="p-4 bg-blue-100 text-center rounded shadow"> 
        <h3 class="text-lg font-bold">Total Anggota</h3> 
        <p class="text-2xl"><?php echo e(number_format($totalAnggota, 0, ',', '.')); ?></p> 
      </div> <div class="p-4 bg-teal-100 text-center rounded shadow"> 
        <h3 class="text-lg font-bold">Total Peminjaman</h3> 
        <p class="text-2xl"><?php echo e(number_format($totalPeminjaman, 0, ',', '.')); ?></p> 
      </div> <div class="p-4 bg-green-100 text-center rounded shadow"> 
        <h3 class="text-lg font-bold">Total Keterlambatan</h3> 
        <p class="text-2xl"><?php echo e(number_format($totalKeterlambatan, 0, ',', '.')); ?></p> 
      </div> 
    </div> 
  </section>

  <section class="bg-white px-6 md:px-20 py-16">
    <h2 class="text-3xl font-semibold mb-6 text-red-400">Statistik Pengunjung</h2>
    <div class="bg-white p-6 rounded shadow">
      <canvas id="statistikChart" height="100"></canvas>
    </div>
  </section>

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
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
                    tension: 0.4
                },
                {
                    label: '<?php echo e($tahunSekarang); ?>',
                    data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
                    borderColor: '#FB7185',
                    backgroundColor: 'rgba(251, 113, 133, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
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
                },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: { mode: 'nearest', intersect: false },
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

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

<!-- Footer -->
<footer class="bg-red-400 text-white px-6 md:px-20 py-10 border-t border-gray-200 shadow-2xl">
  <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-6 md:space-y-0">
    <!-- Informasi Sekolah -->
    <div>
      <h3 class="text-lg font-semibold mb-2 text-white">SMP Negeri 12 Yogyakarta</h3>
      <p class="text-sm text-white">Jl. Tegal Gendu No.16, Pringgokusuman, Gedong Tengen, Kota Yogyakarta</p>
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
          <a href="mailto:info@smpn12jogja.sch.id" class="hover:text-white transition">Email: info@smpn12jogja.sch.id</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Copyright -->
  <div class="mt-8 text-center text-sm text-white">
    &copy; <?php echo e(date('Y')); ?> Perpustakaan Digital SMP Negeri 12 Yogyakarta. All rights reserved.
  </div>
</footer>
</html><?php /**PATH D:\Perkuliahan Duniawi\New folder\New folder\perpustakaan\resources\views/pages/welcome.blade.php ENDPATH**/ ?>
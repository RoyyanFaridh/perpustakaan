<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan Digital SMP 12 Yogyakarta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @livewireStyles

</head>
<body class="font-sans antialiased bg-white">

  <!-- Navbar Sticky -->
  <header class="sticky top-0 z-50 flex justify-between items-center p-6 bg-white shadow-md">
    <div class="flex items-center space-x-4">
      <img src="/images/logo_smp12yk.png" alt="Logo SMPN 12 Yogyakarta" class="h-12 w-auto" />
    </div>
    <div class="space-x-4">
      <a href="{{ route('login') }}" class="px-5 py-2 rounded bg-red-400 text-white hover:bg-red-400">Login</a>
      <a href="{{ route('register') }}" class="px-5 py-2 rounded border-2 border-red-400 text-red-400 hover:bg-red-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150">Register</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="relative min-h-screen flex items-center justify-start text-white bg-cover bg-center" style="background-image: url('/images/gedungsmpn12yk.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative px-6 md:px-20 z-10 max-w-3xl">
      <h1 class="text-5xl font-bold mb-4 leading-tight">Perpustakaan Digital<br>SMP Negeri 12 Yogyakarta</h1>
      <p class="text-lg">Akses buku digital sekolah dari mana saja dengan mudah dan cepat.</p>
    </div>
  </section>

  <!-- Konten Tambahan agar dapat discroll -->
  <section class="px-6 md:px-20 py-16 bg-gray-100 text-gray-800">
    <h2 class="text-3xl font-semibold mb-6 text-red-400">Tentang Perpustakaan</h2>
    <p class="text-lg leading-relaxed mb-4">
      Perpustakaan digital SMP Negeri 12 Yogyakarta menyediakan akses mudah ke berbagai koleksi buku pelajaran dan referensi untuk mendukung proses belajar mengajar.
    </p>
    <p class="text-lg leading-relaxed">
      Siswa dan guru dapat membaca buku secara online kapan saja dan di mana saja, menjadikan pembelajaran lebih fleksibel dan efisien.
    </p>
    
  </section>

@livewireScripts
</body>
</html>
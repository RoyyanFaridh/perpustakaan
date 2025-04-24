<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            {{ __('> Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            <div class="font-bold text-3xl text-gray-900 mb-4">
                {{ __("Statistik Pengunjung") }}
            </div>
    
            <!-- Wrapper untuk Card -->
            <div class="d-flex mb-4" style="display: flex; gap: 20px; justify-content: space-between;">
                <!-- Card 1: Total Koleksi Buku -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Koleksi Buku</h5>
                        <p class="card-text">{{ $totalKoleksiBuku }}</p>
                    </div>
                </div>
    
                <!-- Card 2: Total Anggota -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggota</h5>
                        <p class="card-text">{{ $totalAnggota }}</p>
                    </div>
                </div>
    
                <!-- Card 3: Total Peminjaman Buku -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Peminjaman Buku</h5>
                        <p class="card-text">{{ $totalPeminjamanBuku }}</p>
                    </div>
                </div>
    
                <!-- Card 4: Total Keterlambatan Pengembalian -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Keterlambatan Pengembalian Buku</h5>
                        <p class="card-text">{{ $totalKeterlambatanPengembalian }}</p>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Chart --}}
        <div class="bg-white p-6 rounded shadow">
            <canvas id="statistikChart" height="100"></canvas>
        </div>
    </div>
    
    <script>
        const ctx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulanLabels),  // Menampilkan bulan (format: YYYY-MM)
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: @json($jumlahPengunjung),  // Menampilkan jumlah pengunjung per bulan
                    backgroundColor: '#4B5563',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>

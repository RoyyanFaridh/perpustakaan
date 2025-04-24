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
            <div class="flex flex-wrap gap-4 mb-4">
                <x-card 
                title="Total Koleksi Buku"
                bgColor="#ED5565" 
                :value="number_format($totalKoleksiBuku, 0, ',', '.')"
                periode="Maret 2025"
                :delta="8"
                />

                <x-card 
                title="Total Anggota"
                bgColor="#1C84C6"  
                :value="number_format($totalAnggota, 0, ',', '.')"
                periode="Maret 2025"
                :delta="8" 
                />

                <x-card 
                title="Total Peminjaman"
                bgColor="#23C6C8"  
                :value="number_format($totalPeminjaman, 0, ',', '.')"
                periode="Maret 2025"
                :delta="8" 
                />

                <x-card 
                title="Total Keterlambatan"
                bgColor="#1AB394"  
                :value="number_format($totalKeterlambatan, 0, ',', '.')"
                periode="Maret 2025"
                :delta="8" 
                />
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

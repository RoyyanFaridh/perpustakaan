<x-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            {{ __('> Dashboard') }}
        </h2>
    </x-slot>

    {{-- Modal input email akan muncul jika session ada --}}
    @if(session('show_email_modal'))
        @livewire('input-email-modal')
    @endif

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            <!-- Wrapper untuk Card -->
            <div class="flex flex-wrap gap-4 mb-4">
                <x-card 
                    title="Total Koleksi Buku"
                    bgColor="#ED5565" 
                    :value="number_format($totalKoleksiBuku, 0, ',', '.')"
                    periode="Maret 2025"
                    :delta="8"
                    :icon="view('components.icon.books')->render()"
                />

                <x-card 
                    title="Total Anggota"
                    bgColor="#1C84C6"  
                    :value="number_format($totalAnggota, 0, ',', '.')"
                    periode="Maret 2025"
                    :delta="8" 
                    :icon="view('components.icon.users')->render()"
                />

                <x-card 
                    title="Total Peminjaman"
                    bgColor="#23C6C8"  
                    :value="number_format($totalPeminjaman, 0, ',', '.')"
                    periode="Maret 2025"
                    :delta="8"
                    :icon="view('components.icon.calendar-clock')->render()" 
                />

                <x-card 
                    title="Total Keterlambatan"
                    bgColor="#1AB394"  
                    :value="number_format($totalKeterlambatan, 0, ',', '.')"
                    periode="Maret 2025"
                    :delta="8"
                    :icon="view('components.icon.calendar-x-2')->render()"  
                />
            </div>
        </div>

        <div class="font-bold text-3xl text-gray-900 mb-4 ml-4">
            {{ __("Statistik Pengunjung") }}
        </div>
        {{-- Chart --}}
        <div class="bg-white p-6 rounded shadow">
            <canvas id="statistikChart" height="100"></canvas>
        </div>
    </div>

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
                        borderColor: '#60A5FA', // biru muda
                        backgroundColor: 'rgba(96, 165, 250, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 4,
                        tension: 0.4
                    },
                    {
                        label: '{{ $tahunSekarang }}',
                        data: @json($jumlahPengunjungTahunIni),
                        borderColor: '#FB7185', // merah muda
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
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-user-layout>

<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Dashboard</h2>

    <!-- Card Summary -->
    <div class="flex flex-wrap gap-4 mb-4">
        @foreach($cardData as $card)
            <x-card
                :title="$card['title']"
                :bgColor="$card['bgColor']"
                :value="$card['value']"
                :periode="$card['periode']"
                :delta="$card['delta']"
                :icon="$card['icon']"
            />
        @endforeach
    </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-gray-800 text-base mb-3">Statistik Pengunjung</h3>
            <div class="relative" style="height: 14rem;">
                <canvas id="chartKunjungan" class="absolute inset-0 w-full h-full"></canvas>
            </div>
        </div>

</div>

{{-- Script --}}
<script>
    const chartBaseOptions = (title) => ({
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#374151',
                    font: { weight: 'bold' }
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
            title: {
                display: false
            }
        },
        interaction: {
            mode: 'nearest',
            intersect: false
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
    });

    // Chart Kunjungan
    new Chart(document.getElementById('chartKunjungan').getContext('2d'), {
        type: 'line',
        data: {
            labels: @json($bulanLabels),
            datasets: [
                {
                    label: '{{ $tahunSebelumnya }}',
                    data: @json($jumlahPengunjungTahunLalu),
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 3,
                    tension: 0.4
                },
                {
                    label: '{{ $tahunSekarang }}',
                    data: @json($jumlahPengunjungTahunIni),
                    borderColor: '#FB7185',
                    backgroundColor: 'rgba(251, 113, 133, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 3,
                    tension: 0.4
                }
            ]
        },
        options: chartBaseOptions('Statistik Kunjungan')
    });
</script>
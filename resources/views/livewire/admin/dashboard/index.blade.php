<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4"> Dashboard</h2>
    <!-- Wrapper untuk Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        @foreach($cardData as $card)
            <a href="{{ $card['url'] ?? '#' }}">
                <x-card
                    :title="$card['title']"
                    :bgColor="$card['bgColor']"
                    :value="$card['value']"
                    :periode="$card['periode']"
                    :delta="$card['delta']"
                    :icon="$card['icon']"
                />
            </a>
        @endforeach
    </div>






    <div class="font-bold text-3xl text-gray-900 mb-4 ml-2">
        {{ __("Statistik Pengunjung") }}
    </div>

    {{-- Chart --}}
    <div class="bg-white p-6 rounded shadow w-full">
        <canvas id="statistikChart" class="w-full h-96 sm:h-80 md:h-96"></canvas>
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
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 4,
                    tension: 0.4
                },
                {
                    label: '{{ $tahunSekarang }}',
                    data: @json($jumlahPengunjungTahunIni),
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
            maintainAspectRatio: false, // Penting agar CSS height bekerja
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
        }
    });
</script>
<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4"> Dashboard</h2>
    <!-- Wrapper untuk Card -->
    <div class="flex flex-wrap gap-4 mb-4">
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

    <div class="font-bold text-3xl text-gray-900 mb-4 ml-2">
        {{ __("Statistik Pengunjung") }}
    </div>

    {{-- Chart --}}
    <div class="bg-white p-6 rounded shadow w-full">
        <canvas id="statistikChart" class="w-full h-64 sm:h-80 md:h-96"></canvas>
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
<x-app-layout>
    <x-slot name="header">
        <h2>Test Dashboard</h2>
    </x-slot>

    <div class="py-4">
        <pre>
            @php
                print_r([
                    'bulanLabels' => $bulanLabels,
                    'tahunIni' => $jumlahPengunjungTahunIni,
                    'tahunLalu' => $jumlahPengunjungTahunLalu
                ])
            @endphp
        </pre>
    </div>
</x-app-layout>
<?php

namespace App\Livewire\User\Dashboard;

use App\Models\User;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengunjung;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    protected function getCardData()
    {
        $now = Carbon::now();
        $bulanIni = $now->format('F Y'); 
        
        $akhirBulanLalu = $now->copy()->startOfMonth()->subDay();
        $totalBukuSebelumnya = Buku::where('created_at', '<=', $akhirBulanLalu)->count();
        $totalBukuSaatIni = Buku::count();
        $deltaBuku = $totalBukuSaatIni - $totalBukuSebelumnya;

        $totalAnggotaSebelumnya = Anggota::where('created_at', '<=', $akhirBulanLalu)->count();
        $totalAnggotaSaatIni = Anggota::count();
        $deltaAnggota = $totalAnggotaSaatIni - $totalAnggotaSebelumnya;

        $bulanIniNum = $now->format('m');
        $tahunIni = $now->year;
        $bulanLalu = $now->copy()->subMonth();
        $bulanLaluNum = $bulanLalu->format('m');
        $tahunLalu = $bulanLalu->year;

        $peminjamanBulanIni = Peminjaman::whereYear('created_at', $tahunIni)
            ->whereMonth('created_at', $bulanIniNum)
            ->count();
        $peminjamanBulanLalu = Peminjaman::whereYear('created_at', $tahunLalu)
            ->whereMonth('created_at', $bulanLaluNum)
            ->count();
        $deltaPeminjaman = $peminjamanBulanIni - $peminjamanBulanLalu;

        $keterlambatanBulanIni = Peminjaman::where('status', 'terlambat')
            ->whereYear('created_at', $tahunIni)
            ->whereMonth('created_at', $bulanIniNum)
            ->count();
        $keterlambatanBulanLalu = Peminjaman::where('status', 'terlambat')
            ->whereYear('created_at', $tahunLalu)
            ->whereMonth('created_at', $bulanLaluNum)
            ->count();
        $deltaKeterlambatan = $keterlambatanBulanIni - $keterlambatanBulanLalu;

        return [
            [
                'title' => 'Total Koleksi Buku',
                'bgColor' => '#ED5565',
                'value' => number_format($totalBukuSaatIni, 0, ',', '.'),
                'periode' => $bulanIni,
                'delta' => $deltaBuku,
                'icon' => view('components.icon.books')->render(),
            ],
            [
                'title' => 'Total Anggota',
                'bgColor' => '#1C84C6',
                'value' => number_format($totalAnggotaSaatIni, 0, ',', '.'),
                'periode' => $bulanIni,
                'delta' => $deltaAnggota,
                'icon' => view('components.icon.users')->render(),
            ],
            [
                'title' => 'Total Peminjaman',
                'bgColor' => '#23C6C8',
                'value' => number_format($peminjamanBulanIni, 0, ',', '.'),
                'periode' => $bulanIni,
                'delta' => $deltaPeminjaman,
                'icon' => view('components.icon.calendar-clock')->render(),
            ],
            [
                'title' => 'Total Keterlambatan',
                'bgColor' => '#1AB394',
                'value' => number_format($keterlambatanBulanIni, 0, ',', '.'),
                'periode' => $bulanIni,
                'delta' => $deltaKeterlambatan,
                'icon' => view('components.icon.calendar-x-2')->render(),
            ],
        ];
    }

    public function render()
    {
        $userId = auth()->id();
        $tahunSekarang = now()->year;
        $tahunSebelumnya = $tahunSekarang - 1;
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $jumlahPengunjungTahunIni = [];
        $jumlahPengunjungTahunLalu = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlahPengunjungTahunIni[] = Pengunjung::where('user_id', $userId)
                ->whereYear('tanggal', $tahunSekarang)
                ->whereMonth('tanggal', $i)
                ->count();

            $jumlahPengunjungTahunLalu[] = Pengunjung::where('user_id', $userId)
                ->whereYear('tanggal', $tahunSebelumnya)
                ->whereMonth('tanggal', $i)
                ->count();
        }

        $cardData = $this->getCardData();

        return view('livewire.user.dashboard.index', compact(
            'bulanLabels',
            'jumlahPengunjungTahunIni',
            'jumlahPengunjungTahunLalu',
            'tahunSekarang',
            'tahunSebelumnya',
            'cardData'
        ))->layout('layouts.user');
    }
}

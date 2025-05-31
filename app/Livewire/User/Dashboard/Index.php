<?php

namespace App\Livewire\User\Dashboard;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $tahunSekarang = Carbon::now()->year;
        $tahunSebelumnya = $tahunSekarang - 1;

        $jumlahPengunjungTahunIni = array_fill(0, 12, 0);
        $jumlahPengunjungTahunLalu = array_fill(0, 12, 0);

        $pengunjungPerBulan = DB::table('borrowings')
            ->select(
                DB::raw("strftime('%m', tanggal_pinjam) as bulan"),
                DB::raw("strftime('%Y', tanggal_pinjam) as tahun"),
                DB::raw("count(*) as jumlah")
            )
            ->whereIn(DB::raw("strftime('%Y', tanggal_pinjam)"), [$tahunSekarang, $tahunSebelumnya])
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        foreach ($pengunjungPerBulan as $data) {
            $index = intval($data->bulan) - 1;
            if ($data->tahun == $tahunSebelumnya) {
                $jumlahPengunjungTahunLalu[$index] = $data->jumlah;
            } elseif ($data->tahun == $tahunSekarang) {
                $jumlahPengunjungTahunIni[$index] = $data->jumlah;
            }
        }

        $totalKoleksiBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalPeminjaman = Peminjaman::count();
        $totalKeterlambatan = Peminjaman::where('status', 'terlambat')->count();

        return view('livewire.user.dashboard', compact(
            'bulanLabels',
            'jumlahPengunjungTahunIni',
            'jumlahPengunjungTahunLalu',
            'tahunSekarang',
            'tahunSebelumnya',
            'totalKoleksiBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalKeterlambatan'
        ))->layout('layouts.user');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Model Buku untuk total koleksi buku
use App\Models\Anggota; // Model Anggota untuk total anggota
use App\Models\Peminjaman; // Model Peminjaman untuk total peminjaman
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    
    public function index()
    {
        return view('welcome');
    }

    public function UserDashboard()
    {
        $user = Auth::user();
        

        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $tahunSekarang = Carbon::now()->year;
        $tahunSebelumnya = $tahunSekarang - 1;

        $jumlahPengunjungTahunIni = array_fill(0, 12, 0);
        $jumlahPengunjungTahunLalu = array_fill(0, 12, 0);


        $pengunjungPerBulan = DB::table('pengunjung')
            ->select(
                DB::raw("strftime('%m', tanggal) as bulan"),
                DB::raw("strftime('%Y', tanggal) as tahun"),
                DB::raw("count(*) as jumlah")
            )
            ->whereIn(DB::raw("strftime('%Y', tanggal)"), [$tahunSekarang, $tahunSebelumnya])
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        foreach ($pengunjungPerBulan as $data) {
            $index = $data->bulan - 1;
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

        return view('pages.user.dashboard', compact(
        'bulanLabels',
        'jumlahPengunjungTahunIni',
        'jumlahPengunjungTahunLalu',
        'tahunSekarang',
        'tahunSebelumnya',
        'totalKoleksiBuku',
        'totalAnggota',
        'totalPeminjaman',
        'totalKeterlambatan'
        ));
    }
}

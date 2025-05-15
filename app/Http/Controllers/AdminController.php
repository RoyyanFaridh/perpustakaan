<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Model Buku untuk total koleksi buku
use App\Models\Anggota; // Model Anggota untuk total anggota
use App\Models\Peminjaman; // Model Peminjaman untuk total peminjaman
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    
    public function index()
    {
        return view('welcome');
    }

    public function AdminDashboard()
    {
        $tahunSekarang = Carbon::now()->year;
        $tahunSebelumnya = $tahunSekarang - 1;

        // Query pengunjung yang kompatibel dengan SQLite
        $pengunjungPerBulan = DB::table('pengunjung')
            ->select(
                DB::raw("CAST(strftime('%m', tanggal) AS INTEGER) as bulan"),
                DB::raw("strftime('%Y', tanggal) as tahun"),
                DB::raw("COUNT(*) as jumlah")
            )
            ->where(DB::raw("strftime('%Y', tanggal)"), $tahunSekarang)
            ->orWhere(DB::raw("strftime('%Y', tanggal)"), $tahunSebelumnya)
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        // Proses data pengunjung
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $jumlahPengunjungTahunIni = array_fill(0, 12, 0);
        $jumlahPengunjungTahunLalu = array_fill(0, 12, 0);

        foreach ($pengunjungPerBulan as $data) {
            $index = $data->bulan - 1;
            if ($data->tahun == $tahunSebelumnya) {
                $jumlahPengunjungTahunLalu[$index] = $data->jumlah;
            } elseif ($data->tahun == $tahunSekarang) {
                $jumlahPengunjungTahunIni[$index] = $data->jumlah;
            }
        }

        return view('pages.admin.dashboard', [
            'bulanLabels' => $bulanLabels,
            'jumlahPengunjungTahunIni' => $jumlahPengunjungTahunIni,
            'jumlahPengunjungTahunLalu' => $jumlahPengunjungTahunLalu,
            'tahunSekarang' => $tahunSekarang,
            'tahunSebelumnya' => $tahunSebelumnya,
            'totalKoleksiBuku' => Buku::count(),
            'totalAnggota' => Anggota::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'totalKeterlambatan' => Peminjaman::where('status', 'terlambat')->count()
        ]);
    }
}

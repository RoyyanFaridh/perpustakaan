<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Model Buku untuk total koleksi buku
use App\Models\Anggota; // Model Anggota untuk total anggota
use App\Models\Peminjaman; // Model Peminjaman untuk total peminjaman
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        // Ambil data pengunjung per bulan untuk dua tahun terakhir
        $pengunjungPerBulan = DB::table('pengunjung')
            ->select(DB::raw("strftime('%m', tanggal) as bulan"), DB::raw("strftime('%Y', tanggal) as tahun"), DB::raw('count(*) as jumlah'))
            ->whereBetween('tanggal', ['2023-01-01 00:00:00', '2025-12-31 23:59:59'])
            ->groupBy(DB::raw("strftime('%Y', tanggal), strftime('%m', tanggal)"))
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();

        // Format data untuk chart
        $bulanLabels = [];
        $jumlahPengunjung = [];
        foreach ($pengunjungPerBulan as $data) {
            $bulanLabels[] = $data->tahun . '-' . str_pad($data->bulan, 2, '0', STR_PAD_LEFT); // Label bulan format YYYY-MM
            $jumlahPengunjung[] = $data->jumlah;
        }

        // Mengambil data untuk card statistics
        $totalKoleksiBuku = Buku::count();  // Total koleksi buku
        $totalAnggota = Anggota::count();  // Total anggota
        $totalPeminjamanBuku = Peminjaman::count();  // Total peminjaman buku
        $totalKeterlambatanPengembalian = Peminjaman::where('status', 'terlambat')->count();  // Total keterlambatan pengembalian

        return view('pages.dashboard', compact(
            'bulanLabels', 'jumlahPengunjung',
            'totalKoleksiBuku', 'totalAnggota', 'totalPeminjamanBuku', 'totalKeterlambatanPengembalian'
        ));
    }
}

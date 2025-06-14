<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\User;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
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
                'value' => number_format(Buku::count(), 0, ',', '.'),
                'periode' => $bulanIni,
                'delta' => $deltaBuku,
                'icon' => view('components.icon.books')->render(),
            ],
            [
                'title' => 'Total Anggota',
                'bgColor' => '#1C84C6',
                'value' => number_format(Anggota::count(), 0, ',', '.'),
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
    public function index()
    {
        $tahunSekarang = now()->year;
        $tahunSebelumnya = $tahunSekarang - 1;
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $jumlahPengunjungTahunIni = [];
        $jumlahPengunjungTahunLalu = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlahPengunjungTahunIni[] = Pengunjung::whereYear('created_at', $tahunSekarang)
                ->whereMonth('created_at', $i)
                ->count();

            $jumlahPengunjungTahunLalu[] = Pengunjung::whereYear('created_at', $tahunSebelumnya)
                ->whereMonth('created_at', $i)
                ->count();
        }

        $totalKoleksiBuku = Buku::count();
        $totalAnggota = User::whereIn('role', ['siswa', 'guru'])->count();
        $totalPeminjaman = Peminjaman::count();
        $totalKeterlambatan = Peminjaman::whereColumn('tanggal_kembali', '>', 'batas_pengembalian')->count();

        $cardData = $this->getCardData();

        // ✅ Ambil Berita dari RSS
        $berita = [];
        $feeds = [
            'CNN Indonesia' => 'https://www.cnnindonesia.com/nasional/rss',
            'Kompas' => 'https://www.kompas.com/edu/rss'
        ];

        foreach ($feeds as $sumber => $url) {
            try {
                $xml = simplexml_load_file($url);
                if ($xml && isset($xml->channel->item)) {
                    foreach ($xml->channel->item as $item) {
                        $berita[] = [
                            'sumber' => $sumber,
                            'judul' => (string) $item->title,
                            'link' => (string) $item->link,
                            'tanggal' => date('d M Y', strtotime((string) $item->pubDate)),
                        ];
                    }
                }
            } catch (\Exception $e) {
                // Optional: log error or skip
            }
        }

        // Ambil 5 berita terbaru
        usort($berita, fn($a, $b) => strtotime($b['tanggal']) - strtotime($a['tanggal']));
        $berita = array_slice($berita, 0, 5);

        return view('pages.welcome', compact(
            'bulanLabels',
            'jumlahPengunjungTahunIni',
            'jumlahPengunjungTahunLalu',
            'tahunSekarang',
            'tahunSebelumnya',
            'totalKoleksiBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalKeterlambatan',
            'cardData',
            'berita' // ✅ kirim ke view
        ));
    }
}

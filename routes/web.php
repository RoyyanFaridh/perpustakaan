<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengunjung;
use App\Livewire\Pages\Auth\Register;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Anggota\Siswa;
use App\Livewire\Admin\Anggota\Guru;
use App\Livewire\Admin\Buku\Index as BukuIndexAdmin;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;
use App\Livewire\Admin\Anggota\Export;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Admin\Broadcast\Index as BroadcastIndex;

// User
use App\Livewire\User\Dashboard\Index as DashboardIndex;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;
use \App\Livewire\User\Profile as ProfileIndexUser;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;


// Public routes
Route::get('/register', Register::class)->name('register');

// Broadcast routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
//     Route::get('/broadcast/create', [BroadcastController::class, 'create'])->name('broadcast.create');
//     Route::post('/broadcast', [BroadcastController::class, 'store'])->name('broadcast.store');
//     Route::get('/broadcast/{id}', [BroadcastController::class, 'show'])->name('broadcast.show');
// });

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/anggota', AnggotaIndex::class)->name('admin.anggota.index');
    Route::get('/anggota/export/siswa', fn() => Excel::download(new Export('siswa'), 'daftar_siswa.xlsx'))->name('export.siswa');
    Route::get('/anggota/export/guru', fn() => Excel::download(new Export('guru'), 'daftar_guru.xlsx'))->name('export.guru');
    Route::get('/anggota/siswa', Siswa::class)->name('anggota.siswa');
    Route::get('/anggota/guru', Guru::class)->name('anggota.guru');
    Route::get('/buku', BukuIndexAdmin::class)->name('admin.buku.index');
    Route::get('/peminjaman', PeminjamanIndex::class)->name('admin.peminjaman.index');
    Route::get('/broadcast', BroadcastIndex::class)->name('admin.broadcast.index');
    Route::view('/profile', 'livewire.admin.profile')->name('admin.profile');
});

// Siswa & Guru routes
Route::middleware(['auth', 'verified', 'role:siswa,guru', 'check.default.password', 'check.anggota.email'])->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('user.dashboard');
    Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
    Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
});

Route::middleware(['auth', 'verified', 'role:siswa,guru'])->get('/profile', ProfileIndexUser::class)->name('user.profile');

Route::get('/test-email', function () {
    Mail::raw('Tes kirim email Laravel menggunakan Gmail SMTP.', function ($message) {
        $message->to('roynashruddin18@gmail.com')
                ->subject('Test Email');
    });

    return 'Email terkirim (jika tidak error).';
});

// Auth routes (login, register, etc)
require __DIR__.'/auth.php';

// Halaman utama dengan statistik
Route::get('/', function () {
    $tahunSekarang = now()->year;
    $tahunSebelumnya = now()->year - 1;
    $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    $jumlahPengunjungTahunIni = [];
    $jumlahPengunjungTahunLalu = [];

    for ($i = 1; $i <= 12; $i++) {
        $jumlahPengunjungTahunIni[] = Pengunjung::whereYear('created_at', $tahunSekarang)
            ->whereMonth('created_at', $i)->count();

        $jumlahPengunjungTahunLalu[] = Pengunjung::whereYear('created_at', $tahunSebelumnya)
            ->whereMonth('created_at', $i)->count();
    }

    $totalKoleksiBuku = Buku::count();
    $totalAnggota = User::whereIn('role', ['siswa', 'guru'])->count();
    $totalPeminjaman = Peminjaman::count();
    $totalKeterlambatan = Peminjaman::where('tanggal_kembali', '>', 'batas_pengembalian')->count();

    return view('pages.welcome', compact(
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
})->name('welcome');

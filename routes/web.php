<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pengunjung; // Tambahkan ini
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\LoginPage;
use App\Http\Controllers\BroadcastController;

//Admin
use App\Http\Controllers\Admin\AdminController;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Buku\Index as BukuIndex;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;

//User
use App\Http\Controllers\User\UserController;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

// Route untuk halaman depan dengan statistik pengunjung
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

    return view('pages.welcome', compact(
        'bulanLabels',
        'jumlahPengunjungTahunIni',
        'jumlahPengunjungTahunLalu',
        'tahunSekarang',
        'tahunSebelumnya'
    ));
})->name('welcome');

Route::get('/register', Register::class)->name('register');

Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
Route::get('/broadcast/create', [BroadcastController::class, 'create'])->name('broadcast.create');
Route::post('/broadcast', [BroadcastController::class, 'store'])->name('broadcast.store');
Route::get('/broadcast/{id}', [BroadcastController::class, 'show']);

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/anggota', AnggotaIndex::class)->name('admin.anggota.index');
    Route::get('/buku', BukuIndex::class)->name('admin.buku.index');
    Route::get('/peminjaman', PeminjamanIndex::class)->name('admin.peminjaman.index');
    Route::view('/broadcast', 'livewire.admin.broadcast')->name('admin.broadcast.index');
});

// Untuk guru dan siswa
Route::middleware(['auth', 'verified', 'role:siswa,guru'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
    Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
});

// Route profile hanya membutuhkan auth, tidak perlu verified
Route::view('/profile', 'pages.profile')
    ->middleware('auth')
    ->name('profile');

// Route auth bawaan Laravel (login, register, dll)
require __DIR__.'/auth.php';

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

// Total Data
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
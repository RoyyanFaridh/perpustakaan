<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pengunjung;
use App\Livewire\Pages\Auth\Register;
use App\Http\Controllers\BroadcastController;
use App\Livewire\Pages\Auth\ChangePasswordForm;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Anggota\Siswa;
use App\Livewire\Admin\Anggota\Guru;
use App\Livewire\Admin\Buku\Index as BukuIndexAdmin;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;
use App\Livewire\Admin\Anggota\Export;
use Maatwebsite\Excel\Facades\Excel;

// User
use App\Livewire\User\Dashboard;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

// Public routes
Route::get('/', fn() => view('pages.welcome'))->name('welcome');
Route::get('/register', Register::class)->name('register');

// Broadcast routes (boleh di middleware auth kalau perlu)
Route::middleware(['auth'])->group(function () {
    Route::get('/broadcast', [BroadcastController::class, 'index'])->name('broadcast.index');
    Route::get('/broadcast/create', [BroadcastController::class, 'create'])->name('broadcast.create');
    Route::post('/broadcast', [BroadcastController::class, 'store'])->name('broadcast.store');
    Route::get('/broadcast/{id}', [BroadcastController::class, 'show']);
});


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
    Route::view('/broadcast', 'livewire.admin.broadcast')->name('admin.broadcast.index');
});

// Routes untuk guru dan siswa
Route::middleware(['auth', 'verified', 'role:siswa,guru', 'check.default.password', 'email.filled'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('user.dashboard');
    Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
    Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
});

// Route ganti password
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password-form', ChangePasswordForm::class)->name('password.change.form');
});

// Profile route
Route::view('/profile', 'pages.profile')->middleware('auth')->name('profile');

// Auth routes default Laravel
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
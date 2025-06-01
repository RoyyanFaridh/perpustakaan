<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
    ];

    // Relasi ke model Anggota (member)
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Relasi ke model Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public $showModal = false;
    public $isEdit = false;

    public function openModal()
    {
        $this->resetForm(); // (opsional)
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    // /**
    //  * Hitung denda keterlambatan (jika ada)
    //  * @param int $tarifDendaPerHari dalam satuan mata uang
    //  * @return int total denda
    //  */
    // public function hitungDenda(int $tarifDendaPerHari = 1000): int
    // {
    //     if (!$this->tanggal_kembali) {
    //         // Belum dikembalikan, hitung dari tanggal sekarang
    //         $tanggalKembali = now();
    //     } else {
    //         $tanggalKembali = \Carbon\Carbon::parse($this->tanggal_kembali);
    //     }

    //     $tanggalJatuhTempo = \Carbon\Carbon::parse($this->tanggal_pinjam)->addDays(7); // contoh jatuh tempo 7 hari

    //     if ($tanggalKembali->gt($tanggalJatuhTempo)) {
    //         $hariTerlambat = $tanggalKembali->diffInDays($tanggalJatuhTempo);
    //         return $hariTerlambat * $tarifDendaPerHari;
    //     }

    //     return 0;
    // }
}

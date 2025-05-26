<?php

namespace App\Livewire\User\Buku;

use Livewire\Component;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class Index extends Component
{
    public $books = [];
    public $search = '';

    public function mount()
    {
        $this->loadBooks();
    }

    public function loadBooks()
    {
        $query = Buku::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        $this->books = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadBooks();
    }

    public function pinjam($bookId)
    {
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk meminjam buku.');
            return;
        }

        // Ambil anggota berdasarkan relasi nis_nip
        $anggota = $user->anggota; // Relasi sudah kita definisikan: hasOne(Anggota::class, 'nis_nip', 'nis_nip')

        if (!$anggota) {
            session()->flash('error', 'Profil anggota tidak ditemukan.');
            return;
        }

        $book = Buku::find($bookId);

        if ($book && $book->jumlah_stok > 0) {
            // Kurangi stok buku
            $book->jumlah_stok -= 1;
            $book->save();

            // Simpan peminjaman
            Peminjaman::create([
                'anggota_id' => $anggota->id,
                'buku_id' => $book->id,
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => null, // Belum dikembalikan
            ]);

            session()->flash('message', 'Berhasil meminjam buku: ' . $book->judul);
            $this->loadBooks(); // kalau kamu punya method untuk reload data buku
        } else {
            session()->flash('error', 'Stok buku tidak cukup.');
        }
    }


    public function render()
    {
        return view('livewire.user.buku.index')
            ->layout('layouts.user'); // Ganti sesuai layoutmu
    }
}

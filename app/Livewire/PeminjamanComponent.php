<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminjaman;

class PeminjamanComponent extends Component
{
    public $anggota_id, $buku_id, $tanggal_pinjam, $tanggal_kembali;

    protected $rules = [
        'anggota_id' => 'required|integer',
        'buku_id' => 'required|integer',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date',
    ];

    public function store()
    {
        $this->validate();
        Peminjaman::create([
            'anggota_id' => $this->anggota_id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('pages.peminjaman.index', ['peminjaman' => Peminjaman::all()]);
    }
}

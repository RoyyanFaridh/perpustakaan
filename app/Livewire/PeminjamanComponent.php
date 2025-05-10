<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;

class PeminjamanComponent extends Component
{
    public $peminjaman, $anggota_id, $buku_id, $tanggal_pinjam, $tanggal_kembali;
    public $isEdit = false, $showModal = false, $peminjamanId;

    protected $rules = [
        'anggota_id' => 'required|integer',
        'buku_id' => 'required|integer',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['anggota_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'peminjamanId']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        Peminjaman::create([
            'anggota_id' => $this->anggota_id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $this->peminjamanId = $peminjaman->id;
        $this->anggota_id = $peminjaman->anggota_id;
        $this->buku_id = $peminjaman->buku_id;
        $this->tanggal_pinjam = $peminjaman->tanggal_pinjam;
        $this->tanggal_kembali = $peminjaman->tanggal_kembali;

        $this->showModal = true;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $peminjaman = Peminjaman::findOrFail($this->peminjamanId);

        $peminjaman->update([
            'anggota_id' => $this->anggota_id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
        ]);

        $this->closeModal();
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
    }

    public function render()
    {
    return view('pages.peminjaman.index', [
        'peminjaman' => Peminjaman::with(['anggota', 'buku'])->get(),
        'anggotaList' => Anggota::all(),
        'bukuList' => Buku::all(),
    ]);
    }
}

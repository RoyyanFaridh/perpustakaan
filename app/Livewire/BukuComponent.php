<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Buku as BukuModel;  // Menggunakan alias untuk Model Buku

class BukuComponent extends Component  // Ganti nama class menjadi BukuComponent
{
    public $buku, $judul, $pengarang, $tahun_terbit, $bukuId;

    // Fungsi untuk render data buku
    public function render()
    {
        $this->buku = BukuModel::all();  // Gunakan BukuModel untuk referensi ke Model Buku
        return view('livewire.buku.index');
    }

    // Fungsi untuk menyimpan buku
    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|integer',
        ]);

        BukuModel::create([  // Gunakan BukuModel di sini
            'judul' => $this->judul,
            'pengarang' => $this->pengarang,
            'tahun_terbit' => $this->tahun_terbit,
        ]);

        session()->flash('message', 'Buku berhasil ditambahkan!');
        $this->reset();  // Reset form setelah disubmit
    }

    // Fungsi untuk mengedit buku
    public function edit($id)
    {
        $buku = BukuModel::find($id);
        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->pengarang = $buku->pengarang;
        $this->tahun_terbit = $buku->tahun_terbit;
    }

    // Fungsi untuk menghapus buku
    public function delete($id)
    {
        BukuModel::find($id)->delete();
        session()->flash('message', 'Buku berhasil dihapus!');
    }
}

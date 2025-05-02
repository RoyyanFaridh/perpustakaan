<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Buku as BukuModel;

class BukuComponent extends Component
{
    public $buku, $judul, $kategori, $penulis, $penerbit, $tahun_terbit, $isbn, $bukuId;

    // Fungsi render untuk menampilkan halaman
    public function render()
    {
        $this->buku = BukuModel::all();
        return view('livewire.buku.buku-component'); // Pastikan view-nya sesuai
    }

    // Menyimpan data buku baru
    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|integer',
        ]);

        BukuModel::create([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
        ]);

        session()->flash('message', 'Buku berhasil ditambahkan!');
        $this->resetForm();
    }

    // Menyiapkan form edit
    public function edit($id)
    {
        $buku = BukuModel::findOrFail($id);
        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->isbn = $buku->isbn;
    }

    // Menyimpan hasil edit
    public function update()
    {
        $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|integer',
        ]);

        $buku = BukuModel::findOrFail($this->bukuId);
        $buku->update([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
        ]);

        session()->flash('message', 'Buku berhasil diperbarui!');
        $this->resetForm();
    }

    // Menghapus buku
    public function delete($id)
    {
        BukuModel::findOrFail($id)->delete();
        session()->flash('message', 'Buku berhasil dihapus!');
    }

    // Reset form input
    private function resetForm()
    {
        $this->judul = '';
        $this->kategori = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->tahun_terbit = '';
        $this->isbn = '';
        $this->bukuId = null;
    }
}


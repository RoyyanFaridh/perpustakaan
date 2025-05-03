<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Jangan lupa untuk import ini
use App\Models\Buku as BukuModel;
use Illuminate\Support\Facades\Storage;

class BukuComponent extends Component
{
    use WithFileUploads;  // Agar dapat menangani file upload

    public $buku, $judul, $kategori, $penulis, $penerbit, $tahun_terbit, $isbn, $cover, $bukuId;
    public $isEdit = false;
    public $showModal = false;

    // Fungsi render untuk menampilkan halaman
    public function render()
    {
        $this->buku = BukuModel::all();
        return view('pages.buku.index'); // Pastikan view-nya sesuai
    }

    // Menyimpan data buku baru
    public function store()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file cover
        ]);

        $coverPath = null;
        if ($this->cover) {
            // Menyimpan file cover
            $coverPath = $this->cover->store('covers', 'public');
        }

        BukuModel::create([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'cover' => $coverPath,  // Simpan path file cover
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

        $this->isEdit = true; // mode edit aktif
    }

    // Menyimpan hasil edit
    public function update()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file cover
        ]);

        $buku = BukuModel::findOrFail($this->bukuId);
        $coverPath = $buku->cover;  // Pertahankan cover lama jika tidak ada file baru

        if ($this->cover) {
            // Menghapus cover lama jika ada
            if ($coverPath) {
                \Storage::disk('public')->delete($coverPath);
            }
            // Menyimpan file cover yang baru
            $coverPath = $this->cover->store('covers', 'public');
        }

        $buku->update([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'cover' => $coverPath,  // Update cover
        ]);

        session()->flash('message', 'Buku berhasil diperbarui!');
        $this->resetForm();
    }

    // Reset form input
    public function resetForm()
    {
        $this->judul = '';
        $this->kategori = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->tahun_terbit = '';
        $this->isbn = '';
        $this->bukuId = null;
        $this->cover = null;  // Reset cover
        $this->isEdit = false;
    }

    public function openModal()
    {
        $this->resetForm(); // pastikan form kosong
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

<?php

namespace App\Livewire\Admin\Buku;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Buku as BukuModel;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $buku;
    public $judul, $kategori, $penulis, $penerbit, $tahun_terbit, $isbn, $cover, $deskripsi, $jumlah_stok, $lokasi_rak;
    public $bukuId;
    public $isEdit = false;
    public $showModal = false;
    public $search = '';

    public function render()
    {
        // Menampilkan buku berdasarkan pencarian
        $this->buku = BukuModel::where('judul', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.buku.index')->layout('layouts.app');
    }

    public function store()
    {
        // dd($this->judul, $this->kategori, $this->penulis, $this->penerbit, $this->tahun_terbit, $this->isbn, $this->deskripsi, $this->jumlah_stok, $this->lokasi_rak); // Debug data
        // Validasi inputan
        $this->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:1000',
            'jumlah_stok' => 'required|integer|min:0',
            'lokasi_rak' => 'required|string|max:50',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd('validasi sukses');

        // Menyimpan gambar cover jika ada
        $coverPath = null;
        if ($this->cover) {
            $coverPath = $this->cover->store('covers', 'public');
        }

        // Membuat entri buku baru
        BukuModel::create([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'deskripsi' => $this->deskripsi,
            'jumlah_stok' => $this->jumlah_stok,
            'lokasi_rak' => $this->lokasi_rak,
            'cover' => $coverPath,
        ]);

        session()->flash('message', 'Buku berhasil ditambahkan!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $buku = BukuModel::findOrFail($id);
        // Mengisi data yang ada pada form modal untuk edit
        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->isbn = $buku->isbn;
        $this->deskripsi = $buku->deskripsi;
        $this->jumlah_stok = $buku->jumlah_stok;
        $this->lokasi_rak = $buku->lokasi_rak;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        // Validasi inputan saat melakukan update
        $this->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:1000',
            'jumlah_stok' => 'required|integer|min:0',
            'lokasi_rak' => 'required|string|max:50',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil data buku yang akan diperbarui
        $buku = BukuModel::findOrFail($this->bukuId);
        $coverPath = $buku->cover;

        // Proses upload gambar cover jika ada
        if ($this->cover) {
            // Hapus gambar lama jika ada
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }
            // Simpan gambar baru
            $coverPath = $this->cover->store('covers', 'public');
        }

        // Perbarui data buku
        $buku->update([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'deskripsi' => $this->deskripsi,
            'jumlah_stok' => $this->jumlah_stok,
            'lokasi_rak' => $this->lokasi_rak,
            'cover' => $coverPath,
        ]);

        // Emit event untuk memberitahukan bahwa buku telah diperbarui
        $this->emit('bookUpdated'); 

        session()->flash('message', 'Buku berhasil diperbarui!');
        $this->resetForm();
    }

    public function delete($id)
    {
        $buku = BukuModel::findOrFail($id);

        // Hapus gambar cover jika ada
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        // Hapus data buku dari database
        $buku->delete();

        session()->flash('message', 'Buku berhasil dihapus!');
    }

    public function resetForm()
    {
        $this->judul = '';
        $this->kategori = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->tahun_terbit = '';
        $this->isbn = '';
        $this->deskripsi = '';
        $this->jumlah_stok = '';
        $this->lokasi_rak = '';
        $this->cover = null;
        $this->bukuId = null;
        $this->isEdit = false;
        $this->showModal = false;
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

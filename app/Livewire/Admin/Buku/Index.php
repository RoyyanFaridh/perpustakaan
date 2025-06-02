<?php

namespace App\Livewire\Admin\Buku;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Buku;
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
    public $showKategoriDropdown = false;
    public $sortKategori = null;
    public $kategoriSortIndex = 0;
    public $kategoriList = ['Fiksi', 'Non-Fiksi', 'Biografi', 'Teknologi', 'Sejarah', 'Pendidikan', 'Komik', 'Sains', 'Agama', 'Sosial'];

    public function render()
    {
        $query = Buku::query();

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }
        if ($this->sortKategori) {
            $query->where('kategori', $this->sortKategori);
        }
        $this->buku = $query->get();
        return view('livewire.admin.buku.index');
    }

    public function store()
    {
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

        $coverPath = null;
        if ($this->cover) {
            $coverPath = $this->cover->store('covers', 'public');
        }

        Buku::create([
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
        $buku = Buku::findOrFail($id);

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

        $buku = Buku::findOrFail($this->bukuId);
        $coverPath = $buku->cover;

        if ($this->cover) {
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }
            $coverPath = $this->cover->store('covers', 'public');
        }

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

        session()->flash('message', 'Buku berhasil diperbarui!');
        $this->resetForm();
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

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
    
    public function mount()
    {
        $this->kategoriList = Buku::select('kategori')->distinct()->pluck('kategori')->toArray();
    }

    public function setKategoriFilter($kategori)
    {
        $this->sortKategori = $kategori ?: null; // kosongkan filter jika parameter kosong
        $this->showKategoriDropdown = false; // tutup dropdown setelah pilih
    }

    public function toggleKategoriSort()
    {
        $this->showKategoriDropdown = !$this->showKategoriDropdown;
    }

    public function closeKategoriDropdown()
    {
        $this->showKategoriDropdown = false;
    }

}

<?php

namespace App\Livewire\User\Buku;

use Livewire\Component;
use App\Models\Buku;

class Index extends Component
{
    public $books = [];

    public $judul = '';
    public $kategori = '';
    public $penulis = '';
    public $penerbit = '';
    public $tahun_terbit = '';
    public $isbn = '';
    public $deskripsi = '';
    public $jumlah_stok = '';
    public $lokasi_rak = '';
    public $cover = null;
    public $bukuId = null;

    public function mount()
    {
        $this->books = Buku::all();
    }

    public function render()
    {
    return view('livewire.user.buku.index')
        ->layout('layouts.user'); // <--- Ganti ke layout yang sesuai
    }
}

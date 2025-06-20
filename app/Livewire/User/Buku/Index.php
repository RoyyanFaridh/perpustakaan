<?php

namespace App\Livewire\User\Buku;

use Livewire\Component;
use App\Models\Buku;

class Index extends Component
{
    public $books = [];
    public $search = '';
    public $kategori = 'semua';
    public $kategoriList = [];
    public $sortField = 'judul';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->kategoriList = Buku::select('kategori')->distinct()->pluck('kategori')->toArray();
        $this->loadBooks();
    }

    public function updatedSearch()
    {
        $this->loadBooks();
    }

    public function updatedKategori()
    {
        $this->loadBooks();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadBooks();
    }

    public function loadBooks()
    {
        $query = Buku::query();

        if ($this->kategori !== 'semua') {
            $query->where('kategori', $this->kategori);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%')
                  ->orWhere('penerbit', 'like', '%' . $this->search . '%')
                  ->orWhere('isbn', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);
        $this->books = $query->get();
    }

    public function render()
    {
        return view('livewire.user.buku.index')
            ->layout('layouts.user');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anggota;

class AnggotaComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function delete($id)
    {
        Anggota::findOrFail($id)->delete();
        session()->flash('message', 'Anggota berhasil dihapus.');
    }

    public function render()
    {
        return view('pages.anggota.index', [
            'anggota' => Anggota::orderBy('nama')->paginate(10),
        ])->layout('layouts.app');
    }
}

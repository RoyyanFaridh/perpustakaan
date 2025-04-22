<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;

class AnggotaComponent extends Component
{
    public $nama, $alamat, $kelas;

    protected $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'kelas' => 'required',
    ];

    public function store()
    {
        $this->validate();
        Anggota::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'kelas' => $this->kelas,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.anggota.index', ['anggota' => Anggota::all()]);
    }
}

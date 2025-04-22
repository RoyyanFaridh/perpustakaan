<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Terlambat;

class TerlambatComponent extends Component
{
    public $anggota_id, $jumlah_hari, $denda;

    protected $rules = [
        'anggota_id' => 'required|integer',
        'jumlah_hari' => 'required|integer',
        'denda' => 'required|numeric',
    ];

    public function store()
    {
        $this->validate();
        Terlambat::create([
            'anggota_id' => $this->anggota_id,
            'jumlah_hari' => $this->jumlah_hari,
            'denda' => $this->denda,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.terlambat.index', ['terlambat' => Terlambat::all()]);
    }
}

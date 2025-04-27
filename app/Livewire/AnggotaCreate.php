<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;

class AnggotaCreate extends Component
{
    public $nama, $nomor_induk, $alamat, $kelas, $telepon, $email;

    protected $rules = [
        'nama' => 'required|string',
        'nomor_induk' => 'required|string',
        'alamat' => 'required|string',
        'kelas' => 'required|string',
        'telepon' => 'required|string',
        'email' => 'required|email',
    ];

    public function store()
    {
        $this->validate();

        Anggota::create([
            'nama' => $this->nama,
            'nomor_induk' => $this->nomor_induk,
            'alamat' => $this->alamat,
            'kelas' => $this->kelas,
            'telepon' => $this->telepon,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Anggota berhasil ditambahkan.');

        // Reset form
        $this->reset();
    }

    public function render()
    {
        return view('pages.anggota.create')->layout('layouts.app');
    }
}

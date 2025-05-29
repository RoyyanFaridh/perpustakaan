<?php

// File: app/Http/Livewire/Guru.php
namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\Anggota;

class Guru extends Component
{
    public $anggota, $search = '', $showModal = false, $isEdit = false;
    public $nama, $status, $role = 'guru', $nip, $jenis_kelamin, $alamat, $no_telp, $email, $selectedId;

    protected $rules = [
        'nama' => 'required',
        'status' => 'required',
        'nip' => 'required|numeric',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'email' => 'required|email',
    ];

    public function render()
    {
        $this->anggota = Anggota::where('role', 'guru')
            ->where('nama', 'like', '%'.$this->search.'%')->get();
        return view('livewire.admin.anggota.guru')->layout('layouts.app');
    }

    public function openModal() { $this->resetInput(); $this->showModal = true; $this->isEdit = false; }
    public function closeModal() { $this->showModal = false; }

    public function store()
    {
        $this->validate();
        Anggota::create([
            'nama' => $this->nama,
            'status' => $this->status,
            'role' => $this->role,  // ← Tambahkan ini
            'nis_nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ]);
        $this->closeModal();
        $this->dispatch('anggotaUpdated');
    }

    public function edit($id)
    {
        $data = Anggota::findOrFail($id);
        $this->selectedId = $id;
        $this->nama = $data->nama;
        $this->status = $data->status;
        $this->nip = $data->nis_nip;
        $this->jenis_kelamin = $data->jenis_kelamin;
        $this->alamat = $data->alamat;
        $this->no_telp = $data->no_telp;
        $this->email = $data->email;
        $this->showModal = true;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        if ($this->selectedId) {
            $data = Anggota::find($this->selectedId);
            $data->update([
                'nama' => $this->nama,
                'status' => $this->status,
                'role' => $this->role,  // ← Tambahkan ini
                'nis_nip' => $this->nip,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email,
            ]);
        }
        $this->closeModal();
        $this->dispatch('anggota-updated');
    }

    public function delete($id)
    {
        Anggota::find($id)->delete();
    }

    private function resetInput()
    {
        $this->nama = $this->status = $this->nip = $this->jenis_kelamin = $this->alamat = $this->no_telp = $this->email = '';
        $this->selectedId = null;

        $this->role = 'guru';
    }
}

<?php

// File: app/Http/Livewire/Guru.php
namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
        // 'no_telp' => 'required',
        // 'email' => 'required|email',
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
        $plainPassword = Str::random(8);

        $email = $this->email !== '' ? $this->email : null;

        DB::transaction(function () use ($plainPassword, $email) {
            Anggota::create([
                'nama' => $this->nama,
                'status' => $this->status,
                'role' => $this->role,
                'nis_nip' => $this->nip,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $email,
                'plain_password' => $plainPassword,
            ]);

            User::create([
                'name' => $this->nama,
                'nis_nip' => $this->nip,
                'email' => $email,
                'password' => Hash::make($plainPassword),
                'is_default_password' => true,
                'no_telp' => $this->no_telp,
            ])->assignRole($this->role);
        });

        $this->closeModal();
        $this->dispatch('anggotaUpdated');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        $this->selectedId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->status = $anggota->status;
        $this->nip = $anggota->nis_nip;
        $this->jenis_kelamin = $anggota->jenis_kelamin;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->email = $anggota->email;

        $this->isEdit = true;
        $this->showModal = true;
    }
    public function update()
    {
        $this->validate();

        $email = $this->email !== '' ? $this->email : null;

        if ($this->selectedId) {
            $data = Anggota::find($this->selectedId);
            $data->update([
                'nama' => $this->nama,
                'status' => $this->status,
                'role' => $this->role,
                'nis_nip' => $this->nip,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $email,
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

    public function exportGuru()
    {
        return Excel::download(new Export('guru'), 'data-guru.xlsx');
    }
}

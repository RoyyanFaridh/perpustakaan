<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class Siswa extends Component
{
    public $anggota, $search = '', $showModal = false, $isEdit = false;
    public $nama, $status, $role = 'siswa', $nis, $kelas, $jenis_kelamin, $alamat, $no_telp, $email, $selectedId;

    protected $rules = [
        'nama' => 'required',
        'status' => 'required',
        'nis' => 'required|numeric',
        'kelas' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
    ];

    public function render()
    {
        $this->anggota = Anggota::where('role', 'siswa')
            ->where('nama', 'like', '%'.$this->search.'%')->get();
        return view('livewire.admin.anggota.siswa')->layout('layouts.app');
    }

    public function openModal()
    {
        $this->resetInput();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();
        $plainPassword = Str::random(8);

        DB::transaction(function () use ($plainPassword) {
            Anggota::create([
                'nama' => $this->nama,
                'status' => $this->status,
                'role' => $this->role,
                'nis_nip' => $this->nis,
                'kelas' => $this->kelas,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email, // boleh kosong
                'plain_password' => $plainPassword,
            ]);

            $user = User::create([
                'name' => $this->nama,
                'nis_nip' => $this->nis,
                'email' => $this->email, // boleh kosong
                'password' => Hash::make($plainPassword),
                'is_default_password' => true,
                'no_telp' => $this->no_telp,
            ]);

            $user->assignRole($this->role);
        });

        $this->closeModal();
        $this->dispatch('anggotaUpdated');
    }

    public function edit($id)
    {
        $data = Anggota::findOrFail($id);
        $this->selectedId = $id;
        $this->nama = $data->nama;
        $this->status = $data->status;
        $this->nis = $data->nis_nip;
        $this->kelas = $data->kelas;
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
                'role' => $this->role,
                'nis_nip' => $this->nis,
                'kelas' => $this->kelas,
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
        Anggota::find($id)?->delete();
    }

    private function resetInput()
    {
        $this->nama = $this->status = $this->nis = $this->kelas = $this->jenis_kelamin = $this->alamat = $this->no_telp = $this->email = '';
        $this->selectedId = null;
        $this->role = 'siswa';
    }

    public function exportSiswa()
    {
        return Excel::download(new Export('siswa'), 'data-siswa.xlsx');
    }
}

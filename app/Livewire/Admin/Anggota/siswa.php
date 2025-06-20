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
    public $search = '';
    public $showModal = false;
    public $isEdit = false;
    public $nama, $status, $role = 'siswa', $nis, $kelas, $jenis_kelamin, $alamat, $no_telp, $email, $selectedId;
    public $filterStatus;
    public $sortField = 'nama';
    public $sortDirection = 'asc';
    public $old_nis;

    protected $rules = [
        'nama' => 'required',
        'status' => 'required',
        'nis' => 'required|numeric',
        'kelas' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
    ];

    public function mount()
    {
        $this->filterStatus = 'semua';
        $this->kelas = 'semua';
        $this->status = 'active';
    }

    public function render()
    {
        $anggota = Anggota::where('role', 'siswa')
            ->when($this->filterStatus !== 'semua', fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->kelas !== 'semua', fn($q) => $q->where('kelas', $this->kelas))
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.admin.anggota.siswa', [
            'anggota' => $anggota, 
        ])->layout('layouts.app');
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
                'email' => $this->email,
                'plain_password' => $plainPassword,
            ]);

            $user = User::create([
                'name' => $this->nama,
                'nis_nip' => $this->nis,
                'email' => $this->email,
                'password' => Hash::make($plainPassword),
                'is_default_password' => true,
                'no_telp' => $this->no_telp,
                'status' => $this->status,
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
        $this->old_nis = $data->nis_nip;
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
            $anggota = Anggota::find($this->selectedId);
            $anggota->update([
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

            $user = User::where('nis_nip', $this->old_nis)->first();
            if ($user) {
                $user->update([
                    'name' => $this->nama,
                    'email' => $this->email,
                    'no_telp' => $this->no_telp,
                    'status' => $this->status,
                    'nis_nip' => $this->nis,
                ]);
            }
        }

        $this->closeModal();
        $this->dispatch('anggota-updated');
    }

    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);

        DB::transaction(function () use ($anggota) {
            $user = User::where('nis_nip', $anggota->nis_nip)->first();
            if ($user) {
                $user->delete();
            }

            $anggota->delete();
        });

        session()->flash('message', 'Anggota dan akun user berhasil dihapus!');
    }

    private function resetInput()
    {
        $this->nama = '';
        $this->status = 'active';
        $this->nis = '';
        $this->kelas = 'semua'; // default ke 'semua'
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->email = '';
        $this->selectedId = null;
        $this->role = 'siswa';
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
            $this->sortField = $field;
        }
    }

    public function updatedStatus($value)
    {
        if ($this->isEdit && $this->old_nis) {
            $user = User::where('nis_nip', $this->old_nis)->first();
            if ($user) {
                $user->status = $value;
                $user->save();
            }
        }
    }

    public function exportSiswa()
    {
        return Excel::download(
            new Export(
                'siswa',
                $this->filterStatus,
                $this->kelas,
                $this->search
            ),
            'data-siswa-terfilter.xlsx'
        );
    }
}

<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use App\Models\Anggota as AnggotaModel;

class Index extends Component
{
    public $anggota;
    public $nama, $nis, $nip, $alamat, $no_telp, $email;
    public $status = '';
    public $kelas = '';
    public $jenis_kelamin = '';
    public $role = '';

    public $anggotaId;
    public $isEdit = false;
    public $showModal = false;
    public $search = '';

    public $roleFilter; // Tambahan: role dari URL
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount()
    {
        if (request()->routeIs('anggota.siswa')) {
            $this->roleFilter = 'siswa';
        } elseif (request()->routeIs('anggota.guru')) {
            $this->roleFilter = 'guru';
        } else {
            $this->roleFilter = null;
        }
    }

    public function render()
    {
        $query = AnggotaModel::query()
            ->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nis_nip', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        if ($this->roleFilter) {
            $query->where('role', $this->roleFilter);
        }

        $this->anggota = $query->get();

        return view('livewire.admin.anggota.index')->layout('layouts.app');
    }

    protected function rules()
    {
        $uniqueNisRule = 'unique:members,nis_nip';
        $uniqueNipRule = 'unique:members,nis_nip';

        if ($this->anggotaId) {
            $uniqueNisRule .= ',' . $this->anggotaId;
            $uniqueNipRule .= ',' . $this->anggotaId;
        }

        $rules = [
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'role' => 'required|in:siswa,guru',
        ];

        if ($this->role === 'siswa') {
            $rules['nis'] = ['required', 'numeric', $uniqueNisRule];
            $rules['kelas'] = 'required|in:7,8,9';
            $this->nip = null;
        } elseif ($this->role === 'guru') {
            $rules['nip'] = ['required', 'numeric', $uniqueNipRule];
            $this->nis = null;
            $this->kelas = null;
        }

        return $rules;
    }

    public function store()
    {
        $this->validate();

        AnggotaModel::create([
            'nama' => $this->nama,
            'status' => $this->status,
            'role' => $this->role,
            'nis_nip' => $this->role === 'siswa' ? $this->nis : $this->nip,
            'kelas' => $this->role === 'siswa' ? $this->kelas : null,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Anggota berhasil ditambahkan!');
        $this->resetForm();
        $this->closeModal();
    }

    public function edit($id)
    {
        $anggota = AnggotaModel::findOrFail($id);

        $this->anggotaId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->status = $anggota->status;
        $this->role = $anggota->role;
        $this->nis = $anggota->role === 'siswa' ? $anggota->nis_nip : '';
        $this->nip = $anggota->role === 'guru' ? $anggota->nis_nip : '';
        $this->kelas = $anggota->kelas;
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

        $anggota = AnggotaModel::findOrFail($this->anggotaId);
        $anggota->update([
            'nama' => $this->nama,
            'status' => $this->status,
            'role' => $this->role,
            'nis_nip' => $this->role === 'siswa' ? $this->nis : $this->nip,
            'kelas' => $this->role === 'siswa' ? $this->kelas : null,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Anggota berhasil diperbarui!');
        $this->resetForm();
        $this->closeModal();

        $this->emit('anggotaUpdated');
    }

    public function delete($id)
    {
        $anggota = AnggotaModel::findOrFail($id);
        $anggota->delete();

        session()->flash('message', 'Anggota berhasil dihapus!');
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->status = '';
        $this->nis = '';
        $this->nip = '';
        $this->kelas = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->email = '';
        $this->role = '';
        $this->anggotaId = null;
        $this->isEdit = false;
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

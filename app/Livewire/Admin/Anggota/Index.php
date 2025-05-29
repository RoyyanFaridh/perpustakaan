<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Anggota as AnggotaModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Index extends Component{

    use WithFileUploads;

    public $anggota;
    public $nama, $nis_nip, $alamat, $no_telp, $email;

    public $status = '';
    public $role = '';
    public $kelas = '';
    public $jenis_kelamin = '';

    public $anggotaId;
    public $isEdit= false;
    public $showModal = false;
    public $search = '';
    

    public function render(){
        $this->anggota = AnggotaModel::where('nama', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.anggota.index')->layout('layouts.app');
    }

    public function store()
    {
        // Buat password acak
        $plainPassword = Str::random(8);

        // Validasi input
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:siswa,guru',
            'nis_nip' => 'required|string|max:20|unique:members,nis_nip',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            // 'no_telp' => 'required|string|max:20',
            // 'email' => 'required|email|max:255|unique:members,email',
        ]);


        DB::transaction(function () use ($plainPassword){
            AnggotaModel::create([
                'nama' => $this->nama,
                'status' => $this->status,
                'role' => $this->role,
                'nis_nip' => $this->nis_nip,
                'kelas' => $this->kelas,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email,
                'plain_password' => $plainPassword,
            ]);
            // Simpan akun user login
            $user = User::create([
                'name' => $this->nama,
                'nis_nip' => $this->nis_nip,
                'email' => $this->email,
                'password' => Hash::make($plainPassword),
                'is_default_password' => true,
                'no_telp' => $this->no_telp,
            ]);

            // Beri role
            $user->assignRole($this->role);
        });
        
        // Feedback UI
        session()->flash('message', 'Anggota dan akun berhasil ditambahkan!');
        $this->resetForm();
        $this->closeModal();
    }

    public function edit($id){
        $anggota = AnggotaModel::findOrFail($id);
        $this->anggotaId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->email = $anggota->email;
        $this->nis_nip = $anggota->nis_nip;
        $this->kelas = $anggota->kelas;
        $this->jenis_kelamin = $anggota->jenis_kelamin;
        $this->status = $anggota->status;
        $this->role = $anggota->role;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        // Validasi
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:siswa,guru',
            'nis_nip' => 'required|string|max:20|unique:members,nis_nip',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            // 'no_telp' => 'required|string|max:20',
            // 'email' => 'required|email|max:255|unique:members,email',
        ]);


        $anggota = AnggotaModel::findOrFail($this->anggotaId);
        $anggota->update([
            'nama' => $this->nama,
            'status' => $this->status,
            'role' => $this->role,
            'nis_nip' => $this->nis_nip,
            'kelas' => $this->kelas,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ]);

        $this->resetForm();
        $this->showModal = false;
    }


     // Menghapus anggota
     public function delete($id)
     {
         $anggota = AnggotaModel::findOrFail($id);
 
         $anggota->delete();
 
         session()->flash('message', 'Anggota berhasil dihapus!');
     }
 
     // Reset form input
     public function resetForm()
    {
        $this->nama = '';
        $this->status = '';
        $this->role = '';
        $this->nis_nip = '';
        $this->kelas = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->email = '';
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

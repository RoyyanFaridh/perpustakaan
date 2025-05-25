<?php

namespace App\Livewire\Admin\Anggota;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Anggota as AnggotaModel;

class Index extends Component{

    use WithFileUploads;

    public $anggota;
    public $nama, $nis_nip, $alamat, $no_telp, $email;

    public $status = '';
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

    public function store(){
        
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'nis_nip' => 'required|string|max:20',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        

        AnggotaModel::create([
            'nama' => $this->nama,
            'status' => $this->status,
            'nis_nip' => $this->nis_nip,
            'kelas' => $this->kelas,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,             
        ]);
            
            session()->flash('message', 'Anggota berhasil ditambahkan!');
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

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        // Validasi
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'nis_nip' => 'required|string|max:20|unique:members,nis_nip,' . $this->anggotaId,
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $anggota = AnggotaModel::findOrFail($this->anggotaId);
        $anggota->update([
            'nama' => $this->nama,
            'status' => $this->status,
            'nis_nip' => $this->nis_nip,
            'kelas' => $this->kelas,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ]);

        $this->resetForm(); // Reset input form
        $this->showModal = false; // Tutup modal

         // Emit event ke browser
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

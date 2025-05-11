<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Anggota as AnggotaModel;

class AnggotaComponent extends Component{

    use WithFileUploads;

    public $anggota;
    public $nama, $nis, $alamat, $no_telp, $email;

    public $status = '';
    public $kelas = '';
    public $jenis_kelamin = '';

    public $anggotaId;
    public $isEdit= false;
    public $showModal = false;
    public $search = '';

    public function render(){
        $this->anggota = AnggotaModel::where('nama', 'like', '%' . $this->search . '%')->get();
        return view('pages.anggota.index');

    }

    public function store(){
        
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'nis' => 'required|string|max:20',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        

        AnggotaModel::create([
            'nama' => $this->nama,
            'status' => $this->status,
            'nis' => $this->nis,
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
        $this->nis = $anggota->nis;
        $this->kelas = $anggota->kelas;
        $this->jenis_kelamin = $anggota->jenis_kelamin;
        $this->status = $anggota->status;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update() {
        
        $this->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'nis' => 'required|string|max:20|unique:anggotas,nis',
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
            'nis' => $this->nis,
            'kelas' => $this->kelas,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,  
        ]);
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
        $this->nis = '';
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

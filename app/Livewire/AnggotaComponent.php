<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;

class AnggotaComponent extends Component{

    use WithFileUploads;

    public $anggota;
    public $nama, $alamat, $no_telp, $email, $status, $nis, $kelas, $jenis_kelamin, $foto;
    public $anggotaId;
    public $isEdit= false;
    public $showModal = false;
    public $search = '';

    public function render(){
        $this->anggota = Anggota::where('nama', 'like', '%' . $this->search . '%')
        ->orWhere('nis', 'like', '%' . $this->search . '%')
        ->get();
        return view('pages.anggota.index');

    }

    public function store(){
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nis' => 'required|string|max:20|unique:anggotas,nis',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'status' => 'required|in:active,inactive',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($this->foto) {
            // Menyimpan file foto
            $fotoPath = $this->foto->store('fotos', 'public');
        }

        try {

            Anggota::create([
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'no_telp' => $this->no_telp,
                'email' => $this->email,
                'foto' => $fotoPath,
                'nis' => $this->nis,
                'kelas' => $this->kelas,
                'jenis_kelamin' => $this->jenis_kelamin,
                'status' => $this->status,
            ]);
            
            session()->flash('message', 'Anggota berhasil ditambahkan!');
            $this->reset();
            $this->closeModal(); // Tutup modal
            $this->emit('anggotaUpdated');

        } catch (\Exception $e) {
            dump("Error saat menyimpan data: " . $e->getMessage());
            // Atau, Anda bisa menggunakan Log::error('Gagal menyimpan anggota: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan anggota.');
        }
        
    }

    public function edit($id){
        $anggota = Anggota::findOrFail($id);
        $this->anggotaId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->email = $anggota->email;
        $this->foto = $anggota->foto;
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
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nis' => 'required|string|max:20|unique:anggotas,nis,' . $this->anggotaId,
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'status' => 'required|in:active,inactive',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $anggota = Anggota::findOrFail($this->anggotaId);
        $fotoPath = $anggota->foto;  // Pertahankan foto lama jika tidak ada file baru

        if ($this->foto) {
            // Menghapus foto lama jika ada
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            // Menyimpan file foto yang baru
            $fotoPath = $this->foto->store('fotos', 'public');
        }

        $anggota->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'foto' => $fotoPath,
            'nis' => $this->nis,
            'kelas' => $this->kelas,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
        ]);
    }

     // Menghapus anggota
     public function delete($id)
     {
         $anggota = Anggota::findOrFail($id);
 
         // Menghapus foto jika ada
         if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
         }
 
         $anggota->delete();
 
         session()->flash('message', 'Anggota berhasil dihapus!');
     }
 
     // Reset form input
     public function resetForm()
     {
         $this->nama = '';
         $this->alamat = '';
         $this->no_telp = '';
         $this->email = '';
         $this->nis = '';
         $this->kelas = '';
         $this->jenis_kelamin = '';
         $this->anggotaId = null;
         $this->foto = null;  // Reset foto
         $this->isEdit = false;
     }
 
     public function openModal()
     {
        $this->reset();        // pastikan form kosong
         $this->showModal = true;
     }
 
     public function closeModal()
     {
         $this->showModal = false;
     }
    
}

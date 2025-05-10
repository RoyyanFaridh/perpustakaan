<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota as AnggotaModel; // Menggunakan model Anggota
use Livewire\WithFileUploads; // Jangan lupa untuk import ini

class AnggotaComponent extends Component
{
    use WithFileUploads;  // Agar dapat menangani file upload

    public $anggota, $nama, $alamat, $no_telp, $email, $foto, $anggotaId;
    public $isEdit = false;
    public $showModal = false;

    // Fungsi render untuk menampilkan halaman
    public function render()
    {
        $this->anggota = AnggotaModel::all();
        return view('pages.anggota.index'); // Pastikan view-nya sesuai
    }

    // Menyimpan data anggota baru
    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file foto
        ]);

        $fotoPath = null;
        if ($this->foto) {
            // Menyimpan file foto
            $fotoPath = $this->foto->store('fotos', 'public');
        }

        AnggotaModel::create([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'foto' => $fotoPath,  // Simpan path file foto
        ]);

        session()->flash('message', 'Anggota berhasil ditambahkan!');
        $this->resetForm();
    }

    // Menyiapkan form edit
    public function edit($id)
    {
        $anggota = AnggotaModel::findOrFail($id);
        $this->anggotaId = $anggota->id;
        $this->nama = $anggota->nama;
        $this->alamat = $anggota->alamat;
        $this->no_telp = $anggota->no_telp;
        $this->email = $anggota->email;
        $this->foto = $anggota->foto;

        $this->isEdit = true; // mode edit aktif
    }

    // Menyimpan hasil edit
    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file foto
        ]);

        $anggota = AnggotaModel::findOrFail($this->anggotaId);
        $fotoPath = $anggota->foto;  // Pertahankan foto lama jika tidak ada file baru

        if ($this->foto) {
            // Menghapus foto lama jika ada
            if ($fotoPath) {
                \Storage::disk('public')->delete($fotoPath);
            }
            // Menyimpan file foto yang baru
            $fotoPath = $this->foto->store('fotos', 'public');
        }

        $anggota->update([
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
            'foto' => $fotoPath,  // Update foto
        ]);

        session()->flash('message', 'Anggota berhasil diperbarui!');
        $this->resetForm();
    }

    // Menghapus anggota
    public function delete($id)
    {
        $anggota = AnggotaModel::findOrFail($id);

        // Menghapus foto jika ada
        if ($anggota->foto) {
            \Storage::disk('public')->delete($anggota->foto);
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
        $this->anggotaId = null;
        $this->foto = null;  // Reset foto
        $this->isEdit = false;
    }

    public function openModal()
    {
        $this->resetForm(); // pastikan form kosong
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

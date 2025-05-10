<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    // Menambahkan buku baru
    public function store(Request $request)
    {
        
        // Validasi inputan
        $request->validate([
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

        // Menangani upload cover buku jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Menyimpan file cover
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        // Membuat entri buku baru
        Anggota::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin, 
            'status' => $request->status, 
            'foto' => $fotoPath, 
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Memperbarui buku yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
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

        $anggota = Anggota::findOrFail($id);
        $fotoPath = $anggota->foto;

    
        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            // Menyimpan foto yang baru
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        // Memperbarui data buku
        $anggota->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin, 
            'status' => $request->status, 
            'foto' => $fotoPath
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil diperbarui!');

    }

    public function index(){
        $anggota = Anggota::all(); // ✅ aman tanpa relasi
        return view('anggota.index', compact('anggota'));
    }    
    

}

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
        ]);

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
        ]);

        $anggota = Anggota::findOrFail($id);

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
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil diperbarui!');

    }

    public function index(){
        $anggota = Anggota::all(); // ✅ aman tanpa relasi
        return view('anggota.index', compact('anggota'));
    }    
    

}

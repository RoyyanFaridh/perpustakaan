<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class AnggotaController extends Controller
{
    // Menambahkan buku baru
    public function store(Request $request)
    {
        
        // Validasi inputan
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'nis_nip' => 'required|string|max:20',
            'kelas' => 'required|in:7,8,9',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',           
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);
        dd('validasi masuk');

        // Membuat entri buku baru
        Anggota::create([
            'nama' => $request->nama,
            'status' => $request->status, 
            'nis_nip' => $request->nis_nip,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin, 
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email, 
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
        'nis_nip' => [
            'required',
            'string',
            'max:20',
            Rule::unique('members', 'nis_nip')->ignore($id),
        ],
        'kelas' => 'required|in:7,8,9',
        'jenis_kelamin' => 'required|in:L,P',
        'alamat' => 'required|string|max:255',
        'no_telp' => 'required|string|max:20',
        'email' => 'required|email|max:255',
    ]);

    $anggota = Anggota::findOrFail($id);

    $anggota->update([
        'nama' => $request->nama,
        'status' => $request->status,
        'nis_nip' => $request->nis_nip,
        'kelas' => $request->kelas,
        'jenis_kelamin' => $request->jenis_kelamin,
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
    ]);

    return redirect()->back()->with('success', 'Anggota berhasil diperbarui!');
}
}

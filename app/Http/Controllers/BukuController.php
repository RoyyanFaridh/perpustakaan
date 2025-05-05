<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // Menambahkan buku baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:1000',  // Menambahkan validasi untuk deskripsi
            'jumlah_stok' => 'required|integer|min:0', // Menambahkan validasi untuk jumlah stok
            'lokasi_rak' => 'required|string|max:50',  // Menambahkan validasi untuk lokasi rak
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Menangani upload cover buku jika ada
        $coverPath = null;
        if ($request->hasFile('cover')) {
            // Menyimpan file cover
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // Membuat entri buku baru
        Buku::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,  // Menyimpan deskripsi
            'jumlah_stok' => $request->jumlah_stok,  // Menyimpan jumlah stok
            'lokasi_rak' => $request->lokasi_rak,  // Menyimpan lokasi rak
            'cover' => $coverPath, // Menyimpan path file cover
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    // Memperbarui buku yang sudah ada
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:1000',  // Validasi untuk deskripsi
            'jumlah_stok' => 'required|integer|min:0', // Validasi untuk jumlah stok
            'lokasi_rak' => 'required|string|max:50',  // Validasi untuk lokasi rak
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        $buku = Buku::findOrFail($id);

        // Menyimpan cover lama jika tidak ada cover baru
        $coverPath = $buku->cover;

        // Mengupload cover baru jika ada
        if ($request->hasFile('cover')) {
            // Menghapus cover lama jika ada
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }
            // Menyimpan cover yang baru
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // Memperbarui data buku
        $buku->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,  // Update deskripsi
            'jumlah_stok' => $request->jumlah_stok,  // Update jumlah stok
            'lokasi_rak' => $request->lokasi_rak,  // Update lokasi rak
            'cover' => $coverPath,  // Update cover
        ]);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }
}

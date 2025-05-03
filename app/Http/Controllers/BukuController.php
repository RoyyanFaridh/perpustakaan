<?php

// BukuController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;


class BukuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Menangani upload cover buku
        $coverPath = null;
        if ($request->hasFile('cover')) {
            // Menyimpan file cover
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Buku::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'cover' => $coverPath, // Simpan path file cover
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    // Update untuk menambahkan cover baru jika ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        $buku = Buku::findOrFail($id);

        $coverPath = $buku->cover;  // Pertahankan cover lama jika tidak ada file baru

        if ($request->hasFile('cover')) {
            // Menghapus cover lama jika ada
            if ($coverPath) {
                \Storage::disk('public')->delete($coverPath);
            }
            // Menyimpan file cover yang baru
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $buku->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn' => $request->isbn,
            'cover' => $coverPath,  // Update cover
        ]);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }
}


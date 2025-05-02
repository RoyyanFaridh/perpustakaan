<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'penulis'      => 'required|string|max:100',
            'penerbit'     => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn'         => 'required|string|max:20',
        ]);

        Buku::create([
            'judul'        => $request->judul,
            'kategori'     => $request->kategori,
            'penulis'      => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn'         => $request->isbn,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }
}

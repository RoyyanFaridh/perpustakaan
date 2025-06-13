<?php

namespace App\Mail;

use App\Models\Peminjaman;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengingatPengembalianBuku extends Mailable
{
    use Queueable, SerializesModels;

    public $peminjaman;
    public $sisaHari;

    public function __construct(Peminjaman $peminjaman, $sisaHari)
    {
        $this->peminjaman = $peminjaman;
        $this->sisaHari = $sisaHari;
    }

    public function build()
    {
        return $this->subject('Pengingat Pengembalian Buku')
                    ->view('emails.pengingat-pengembalian')
                    ->with([
                        'nama' => $this->peminjaman->anggota->nama,
                        'judul' => $this->peminjaman->buku->judul,
                        'tanggal_kembali' => $this->peminjaman->tanggal_kembali->format('d-m-Y'),
                        'sisa_hari' => $this->sisaHari,
                    ]);
    }
}


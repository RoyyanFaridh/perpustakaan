<?php

namespace App\Livewire\Admin\Peminjaman;

use Log;
use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Anggota;
use Livewire\Component;
use App\Models\Peminjaman;
use App\Mail\PengingatKembaliMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $peminjaman, $anggota_id, $buku_id, $tanggal_pinjam, $tanggal_kembali, $status;
    public $isEdit = false, $showModal = false;
    public $peminjamanId = null;

    protected $rules = [
        'anggota_id' => 'required|exists:anggota,id',
        'buku_id' => 'required|exists:buku,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required|in:booking,dipinjam,dikembalikan',
    ];



    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'anggota_id', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'status', 'peminjamanId'
        ]);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        Peminjaman::create([
            'anggota_id' => $this->anggota_id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data peminjaman berhasil ditambahkan.');
        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        $peminjaman = Peminjaman::findOrFail($this->peminjamanId);

        $peminjaman->update([
            'anggota_id' => $this->anggota_id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data peminjaman berhasil diperbarui.');
        $this->closeModal();
    }


    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->buku->jumlah_stok <= 0) {
            session()->flash('error', 'Stok buku habis. Tidak bisa disetujui.');
            return;
        }

        if ($peminjaman->status === 'booking') {
            $anggota = $peminjaman->anggota;

            // Tentukan lama peminjaman berdasarkan nip/nis
            if (!empty($anggota->nip)) {
                $lamaPinjam = 14;
            } elseif (!empty($anggota->nis)) {
                $lamaPinjam = 7;
            } else {
                session()->flash('error', 'Anggota tidak memiliki NIS atau NIP.');
                return;
            }

            $peminjaman->status = 'dipinjam';
            $peminjaman->tanggal_pinjam = now();
            $peminjaman->tanggal_kembali = now()->addDays($lamaPinjam);

            $peminjaman->buku->decrement('jumlah_stok');
            $peminjaman->save();

            session()->flash('message', 'Peminjaman telah disetujui.');
        }
    }


    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman || strtolower($peminjaman->status) !== 'dipinjam') {
            session()->flash('error', 'Data peminjaman tidak valid.');
            return;
        }

        // Update status dan tanggal kembali
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->tanggal_kembali = now(); // <-- inilah tanggal saat tombol diklik
        $peminjaman->save();

        // Tambah stok buku
        $buku = $peminjaman->buku;
        $buku->jumlah_stok += 1;
        $buku->save();

        session()->flash('message', 'Buku berhasil dikembalikan.');
    }

    public function kirimPengingat()
    {
        $peminjamanList = Peminjaman::with(['anggota.user', 'buku'])
            ->where('status', 'dipinjam')
            ->get();

        $emailBerhasil = 0;

        foreach ($peminjamanList as $peminjaman) {
            $user = $peminjaman->anggota->user;

            if ($user && $user->email) {
                try {
                    Mail::to($user->email)->send(new PengingatKembaliMail($peminjaman));
                    $emailBerhasil++;
                } catch (\Exception $e) {
                    Log::error("Gagal kirim email ke {$user->email}: " . $e->getMessage());
                }
            }
        }

        if ($emailBerhasil > 0) {
            session()->flash('message', "$emailBerhasil pengingat berhasil dikirim ke semua peminjam.");
        } else {
            session()->flash('message', 'Tidak ada email yang berhasil dikirim.');
        }
    }



    public function build()
    {
        return $this->subject('Pengingat Pengembalian Buku')
                    ->view('emails.pengingat');
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
    }

    public function render()
    {
        
        return view('livewire.admin.peminjaman.index', [
            'listPeminjaman' => Peminjaman::with(['anggota', 'buku'])
                ->latest()
                ->get(),
            'anggotaList' => Anggota::all(), // kalau untuk dropdown
            'bukuList' => Buku::all(),
        ])->layout('layouts.app');
    }

}

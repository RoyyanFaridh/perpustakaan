<?php

namespace App\Livewire\Admin\Broadcast;

use Livewire\Component;
use App\Models\Broadcast;
use App\Models\User;
use App\Mail\BroadcastMail;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $judul, $isi;

    protected $rules = [
        'judul' => 'required',
        'isi' => 'required',
    ];

    public function store()
    {
        $this->validate();

        // Simpan ke database
        Broadcast::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
        ]);

        // Kirim ke semua user
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new BroadcastMail($this->judul, $this->isi));
        }

        // Reset form
        $this->reset();

        // Optional: notifikasi
        session()->flash('message', 'Broadcast berhasil dikirim ke semua pengguna.');
        Mail::to($user->email)->send(new BroadcastMail($this->judul, $this->isi));

    }


    public function render()
    {
        return view('livewire.admin.broadcast.index', ['broadcast' => Broadcast::all()]);
    }
}

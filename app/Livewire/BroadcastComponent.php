<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Broadcast;

class BroadcastComponent extends Component
{
    public $judul, $isi;

    protected $rules = [
        'judul' => 'required',
        'isi' => 'required',
    ];

    public function store()
    {
        $this->validate();
        Broadcast::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.broadcast.index', ['broadcast' => Broadcast::all()]);
    }
}

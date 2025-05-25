<?php

namespace App\Livewire\Admin\Broadcast;

use Livewire\Component;
use App\Models\Broadcast;

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
        Broadcast::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
        ]);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.broadcast.index', ['broadcast' => Broadcast::all()]);
    }
}

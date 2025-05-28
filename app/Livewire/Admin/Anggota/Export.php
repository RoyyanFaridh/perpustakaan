<?php

namespace App\Livewire\Admin\Anggota;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Anggota::select('nama', 'nis_nip', 'email', 'plain_password')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIS/NIP',
            'Email',
            'Password Default',
        ];
    }
}

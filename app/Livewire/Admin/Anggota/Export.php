<?php

namespace App\Livewire\Admin\Anggota;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    protected $role;
    protected $filterStatus;
    protected $kelas;
    protected $search;

    public function __construct($role, $filterStatus = 'semua', $kelas = null, $search = '')
    {
        $this->role         = $role;
        $this->filterStatus = $filterStatus;
        $this->kelas        = $kelas;
        $this->search       = $search;
    }

    public function collection()
    {
        $query = Anggota::query()
            ->where('role', $this->role)
            ->when($this->filterStatus !== 'semua', fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'));

        if ($this->role === 'siswa' && $this->kelas && $this->kelas !== 'semua') {
            $query->where('kelas', $this->kelas);
        }

        return $query->get()->map(function ($item) {
            $password = $item->status === 'inactive' ? '' : $item->plain_password;

            if ($this->role === 'siswa') {
                return [
                    'nama'           => $item->nama,
                    'kelas'          => $item->kelas,
                    'status'         => $item->status,
                    'nis_nip'        => $item->nis_nip,
                    'jenis_kelamin'  => $item->jenis_kelamin,
                    'alamat'         => $item->alamat,
                    'no_telp'        => $item->no_telp,
                    'email'          => $item->email,
                    'plain_password' => $password,
                ];
            }

            return [
                'nama'           => $item->nama,
                'status'         => $item->status,
                'nis_nip'        => $item->nis_nip,
                'jenis_kelamin'  => $item->jenis_kelamin,
                'alamat'         => $item->alamat,
                'no_telp'        => $item->no_telp,
                'email'          => $item->email,
                'plain_password' => $password,
            ];
        });
    }

    public function headings(): array
    {
        $headings = [
            'Nama',
        ];

        if ($this->role === 'siswa') {
            $headings[] = 'Kelas';
        }

        $headings = array_merge($headings, [
            'Status',
            $this->role === 'siswa' ? 'NIS' : 'NIP',
            'Jenis Kelamin',
            'Alamat',
            'No Telepon',
            'Email',
            'Password Default',
        ]);

        return $headings;
    }
}

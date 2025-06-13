<?php

namespace App\Livewire\Admin\Anggota;

use App\Models\Anggota;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        $anggota = Anggota::where('role', $this->role)->get();

        return $anggota->map(function ($item) {
            // Kosongkan password jika status tidak aktif
            $password = $item->status === 'inactive' ? '' : $item->plain_password;

            if ($this->role === 'siswa') {
                return [
                    'nama' => $item->nama,
                    'status' => $item->status,
                    'nis_nip' => $item->nis_nip,
                    'kelas' => $item->kelas,
                    'jenis_kelamin' => $item->jenis_kelamin,
                    'alamat' => $item->alamat,
                    'no_telp' => $item->no_telp,
                    'email' => $item->email,
                    'plain_password' => $password,
                ];
            } else { // guru
                return [
                    'nama' => $item->nama,
                    'status' => $item->status,
                    'nis_nip' => $item->nis_nip,
                    'jenis_kelamin' => $item->jenis_kelamin,
                    'alamat' => $item->alamat,
                    'no_telp' => $item->no_telp,
                    'email' => $item->email,
                    'plain_password' => $password,
                ];
            }
        });
    }

    public function headings(): array
    {
        if ($this->role === 'siswa') {
            return [
                'Nama',
                'Status',
                'NIS',
                'Kelas',
                'Jenis Kelamin',
                'Alamat',
                'No Telepon',
                'Email',
                'Password Default',
            ];
        } else {
            return [
                'Nama',
                'Status',
                'NIP',
                'Jenis Kelamin',
                'Alamat',
                'No Telepon',
                'Email',
                'Password Default',
            ];
        }
    }
}

<?php

namespace App\Http\Controllers;


class DashboardSiswaController extends Controller
{
    /**
     * Tampilkan halaman dashboard siswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.siswa'); // Sesuaikan dengan tampilan yang diinginkan
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Peminjam | Home',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ]);

        // Jika peminjam tidak login dan mencoba mengakses halaman peminjaman barang, arahkan kembali dan beri pesan
        if (!$this->session->has('islogin') || session()->get('id_jabatan') != 2) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        } else {
            return view('peminjam/home/index', $data); // Tampilkan home jika peminjam sudah login
        }
    }
}

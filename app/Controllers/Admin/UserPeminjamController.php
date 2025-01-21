<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserPeminjamController extends BaseController
{
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman User Peminjam',
            'tb_user_peminjam' => $this->m_user_peminjam->getAllSorted(),
        ]);

        return view('admin/user_peminjam/index', $data);
    }

    public function cek_data($nama_lengkap)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data User Peminjam',
            'tb_user_peminjam' => $this->m_user_peminjam->getByNamaLengkap($nama_lengkap),
        ]);

        return view('admin/user_peminjam/cek_data', $data);
    }
}

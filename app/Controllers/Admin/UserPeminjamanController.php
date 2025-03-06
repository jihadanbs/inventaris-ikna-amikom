<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserPeminjamanController extends BaseController
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
            'tb_user' => $this->m_user->getUserByJabatan(),
        ]);

        return view('admin/user-peminjam/index', $data);
    }

    public function profile($username)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data User Peminjam',
            'tb_user' => $this->m_user->getByNama($username),
        ]);

        return view('admin/user-peminjam/profile', $data);
    }
}

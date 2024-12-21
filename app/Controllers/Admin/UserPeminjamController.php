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
            'tb_user_peminjam' => $this->m_user_peminjam->getAllData(),
        ]);

        return view('admin/user_peminjam/index', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangMasukController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Masuk',
            'tb_barang_masuk' => $this->m_barang_masuk->getAllSorted(),
        ]);

        return view('admin/barang_masuk/index', $data);
    }
}

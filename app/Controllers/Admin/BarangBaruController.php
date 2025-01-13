<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangBaruController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Baru',
            'barang_baru' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/barang_baru/index', $data);
    }
}

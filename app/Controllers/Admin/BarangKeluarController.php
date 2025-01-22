<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangKeluarController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Keluar',
            'tb_barang_keluar' => $this->m_barang_keluar->getAllSorted(),
        ]);

        return view('admin/barang_keluar/index', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TransaksiController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang',
            'tb_user_peminjam' => $this->m_user_peminjam->getAllSorted(),
        ]);

        return view('admin/transaksi/index', $data);
    }

    public function cek_data($nama_lengkap)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Transaksi Barang',
            'tb_user_peminjam' => $this->m_user_peminjam->getByNamaLengkap($nama_lengkap),
        ]);

        return view('admin/transaksi/cek_data', $data);
    }
}

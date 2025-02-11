<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DetailBarangController extends BaseController
{
    public function barangdetail($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $data = [
            'title' => 'Peminjam | Halaman Peminjaman Barang',
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
        ];

        return view('peminjam/barang-detail', $data);
    }

    // public function index()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSessionPeminjam() !== true) {
    //         return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
    //     }

    //     // Menyiapkan data untuk tampilan
    //     $data = array_merge([
    //         'title' => 'Admin | Halaman Peminjaman Barang',
    //         'tb_barang' => $this->m_barang->getAllSorted(),
    //     ]);

    //     return view('admin/barang/index', $data);
    // }
}

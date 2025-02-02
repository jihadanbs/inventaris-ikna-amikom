<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangBaikController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Rusak',
            'tb_barang_baik' => $this->m_barang_baik->getAllSorted(),
        ]);

        return view('admin/barang_baik/index', $data);
    }

    public function totalData()
    {
        $totalData = $this->m_barang_baik->getTotalBarangBaik();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function update($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Metode request tidak valid'
            ]);
        }

        if (!$id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID barang tidak ditemukan'
            ]);
        }

        $json = $this->request->getJSON();

        // Validasi input
        if (!isset($json->jumlah_total_baik) || $json->jumlah_total_baik < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jumlah barang harus lebih dari 0'
            ]);
        }

        if (empty(trim($json->keterangan_baik))) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keterangan tidak boleh kosong'
            ]);
        }

        // Update database
        $update = $this->db->table('tb_barang_baik')
            ->where('id_barang_baik', $id)
            ->update([
                'jumlah_total_baik' => $json->jumlah_total_baik,
                'keterangan_baik' => $json->keterangan_baik
            ]);

        if (!$update) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui data barang'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Data berhasil diperbarui'
        ]);
    }
}

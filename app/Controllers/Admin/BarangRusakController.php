<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangRusakController extends BaseController
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
            'tb_barang_rusak' => $this->m_barang_rusak->getAllSorted(),
        ]);

        return view('admin/barang_rusak/index', $data);
    }

    public function totalData()
    {
        $totalData = $this->m_barang_rusak->getTotalBarangRusak();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function update($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Metode request tidak valid']);
        }

        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID diperlukan']);
        }

        // Get JSON input
        $json = $this->request->getJSON();

        if (!isset($json->jumlah_total_rusak) || !isset($json->keterangan_rusak)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data input tidak lengkap']);
        }

        // Validasi jumlah rusak
        if ($json->jumlah_total_rusak <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Jumlah rusak harus lebih besar dari 0']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Ambil data barang rusak saat ini
            $query = $this->db->table('tb_barang_rusak')
                ->where('id_barang_rusak', $id)
                ->get();

            if (!$query) {
                throw new \Exception('Query barang gagal dieksekusi');
            }

            $barangRusak = $query->getRowArray();
            if (!$barangRusak) {
                throw new \Exception('Data barang tidak ditemukan');
            }

            // Hitung selisih jumlah rusak
            $jumlahRusakLama = (int)$barangRusak['jumlah_total_rusak'];
            $jumlahRusakBaru = (int)$json->jumlah_total_rusak;
            $selisih = $jumlahRusakLama - $jumlahRusakBaru;

            // Ambil id_barang dari barang rusak
            $idBarang = $barangRusak['id_barang'];

            // Ambil data barang dari tb_barang untuk memeriksa jumlah total
            $queryBarang = $db->table('tb_barang')
                ->where('id_barang', $idBarang)
                ->get();

            if (!$queryBarang) {
                throw new \Exception('Query tb_barang gagal dieksekusi');
            }

            $dataBarang = $queryBarang->getRowArray();
            if (!$dataBarang) {
                throw new \Exception('Data di tb_barang tidak ditemukan');
            }

            $jumlahTotalBarang = (int)$dataBarang['jumlah_total'];

            // Ambil data barang baik dengan id_barang yang sama
            $queryBarangBaik = $db->table('tb_barang_baik')
                ->where('id_barang', $idBarang)
                ->get();

            if (!$queryBarangBaik) {
                throw new \Exception('Query barang baik gagal dieksekusi');
            }

            $barangBaik = $queryBarangBaik->getRowArray();
            if (!$barangBaik) {
                throw new \Exception('Data barang baik tidak ditemukan');
            }

            // Update jumlah barang baik
            // Jika selisih positif (jumlah rusak berkurang), tambahkan ke barang baik
            // Jika selisih negatif (jumlah rusak bertambah), kurangi dari barang baik
            $jumlahBaikBaru = (int)$barangBaik['jumlah_total_baik'] + $selisih;

            // Pastikan jumlah barang baik tidak kurang dari 0
            if ($jumlahBaikBaru < 0) {
                throw new \Exception('Jumlah barang baik tidak mencukupi');
            }

            // Validasi total barang
            $totalSetelaPerubahan = $jumlahBaikBaru + $jumlahRusakBaru + $dataBarang['jumlah_dipinjam'];
            if ($totalSetelaPerubahan > $jumlahTotalBarang) {
                throw new \Exception('Total barang baik, rusak, dan dipinjam melebihi jumlah total di master barang');
            }

            // Update tb_barang_baik
            $updateBaik = $db->table('tb_barang_baik')
                ->where('id_barang_baik', $barangBaik['id_barang_baik'])
                ->update([
                    'jumlah_total_baik' => $jumlahBaikBaru
                ]);

            if ($updateBaik === false) {
                throw new \Exception('Gagal memperbarui data barang baik');
            }

            // Update tb_barang_rusak
            $updateResult = $this->db->table('tb_barang_rusak')
                ->where('id_barang_rusak', $id)
                ->update([
                    'jumlah_total_rusak' => $json->jumlah_total_rusak,
                    'keterangan_rusak' => $json->keterangan_rusak
                ]);

            if ($updateResult === false) {
                throw new \Exception('Gagal memperbarui data barang rusak');
            }

            $db->transCommit();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data barang rusak berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}

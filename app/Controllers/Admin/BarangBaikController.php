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

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Ambil data barang baik saat ini
            $queryBarangBaik = $db->table('tb_barang_baik')
                ->where('id_barang_baik', $id)
                ->get();

            if (!$queryBarangBaik) {
                throw new \Exception('Query barang baik gagal dieksekusi');
            }

            $barangBaik = $queryBarangBaik->getRowArray();
            if (!$barangBaik) {
                throw new \Exception('Data barang baik tidak ditemukan');
            }

            // Hitung selisih jumlah baik
            $jumlahBaikLama = (int)$barangBaik['jumlah_total_baik'];
            $jumlahBaikBaru = (int)$json->jumlah_total_baik;
            $selisih = $jumlahBaikLama - $jumlahBaikBaru;

            // Ambil id_barang dari barang baik
            $idBarang = $barangBaik['id_barang'];

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

            // Ambil data barang rusak dengan id_barang yang sama
            $queryBarangRusak = $db->table('tb_barang_rusak')
                ->where('id_barang', $idBarang)
                ->get();

            if (!$queryBarangRusak) {
                throw new \Exception('Query barang rusak gagal dieksekusi');
            }

            $barangRusak = $queryBarangRusak->getRowArray();
            if (!$barangRusak) {
                throw new \Exception('Data barang rusak tidak ditemukan');
            }

            // Update jumlah barang rusak
            // Jika selisih positif (jumlah baik berkurang), tambahkan ke barang rusak
            // Jika selisih negatif (jumlah baik bertambah), kurangi dari barang rusak
            $jumlahRusakBaru = (int)$barangRusak['jumlah_total_rusak'] + $selisih;

            // Pastikan jumlah barang rusak tidak kurang dari 0
            if ($jumlahRusakBaru < 0) {
                throw new \Exception('Jumlah barang rusak tidak mencukupi untuk perubahan ini');
            }

            // Validasi total barang
            $totalSetelaPerubahan = $jumlahBaikBaru + $jumlahRusakBaru + $dataBarang['jumlah_dipinjam'];
            if ($totalSetelaPerubahan > $jumlahTotalBarang) {
                throw new \Exception('Total barang baik, rusak, dan dipinjam melebihi jumlah total di master barang');
            }

            // Update tb_barang_rusak
            $updateRusak = $db->table('tb_barang_rusak')
                ->where('id_barang', $idBarang)
                ->update([
                    'jumlah_total_rusak' => $jumlahRusakBaru
                ]);

            if ($updateRusak === false) {
                throw new \Exception('Gagal memperbarui data barang rusak');
            }

            // Update tb_barang_baik
            $updateBaik = $db->table('tb_barang_baik')
                ->where('id_barang_baik', $id)
                ->update([
                    'jumlah_total_baik' => $json->jumlah_total_baik,
                    'keterangan_baik' => $json->keterangan_baik
                ]);

            if ($updateBaik === false) {
                throw new \Exception('Gagal memperbarui data barang baik');
            }

            $db->transCommit();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil diperbarui'
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

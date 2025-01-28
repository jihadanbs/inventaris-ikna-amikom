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
            return $this->response->setJSON(['success' => false, 'message' => 'Metode request tidak valid']);
        }

        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'ID diperlukan']);
        }

        // Get JSON input
        $json = $this->request->getJSON();

        if (!isset($json->jumlah_total_baik) || !isset($json->keterangan_baik)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data input tidak lengkap']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $query = $this->db->table('tb_barang_baik')
                ->where('id_barang_baik', $id)
                ->get();

            if (!$query) {
                throw new \Exception('Query barang gagal dieksekusi');
            }

            $barangBaik = $query->getRowArray();
            if (!$barangBaik) {
                throw new \Exception('Data barang tidak ditemukan');
            }

            // Update tb_barang_baik
            $updateResult = $this->db->table('tb_barang_baik')
                ->where('id_barang_baik', $id)
                ->update([
                    'jumlah_total_baik' => $json->jumlah_total_baik,
                    'keterangan_baik' => $json->keterangan_baik
                ]);

            if ($updateResult === false) {
                throw new \Exception('Gagal memperbarui data barang baik');
            }

            $queryRusak = $this->db->table('tb_barang_rusak')
                ->where('id_barang', $barangBaik['id_barang'])
                ->select('COALESCE(SUM(jumlah_total_rusak), 0) as total_rusak')
                ->get();

            if (!$queryRusak) {
                throw new \Exception('Query barang rusak gagal dieksekusi');
            }

            $jumlah_rusak = $queryRusak->getRowArray();
            if (!$jumlah_rusak) {
                $jumlah_rusak = ['total_rusak' => 0];
            }

            $queryDipinjam = $this->db->table('tb_barang')
                ->where('id_barang', $barangBaik['id_barang'])
                ->select('COALESCE(SUM(jumlah_dipinjam), 0) as total_dipinjam')
                ->get();

            if (!$queryDipinjam) {
                throw new \Exception('Query peminjaman gagal dieksekusi');
            }

            $jumlah_dipinjam = $queryDipinjam->getRowArray();
            if (!$jumlah_dipinjam) {
                $jumlah_dipinjam = ['total_dipinjam' => 0];
            }

            // Hitung total baru
            $new_total = $json->jumlah_total_baik +
                $jumlah_rusak['total_rusak'] +
                $jumlah_dipinjam['total_dipinjam'];

            // Update jumlah_total di tb_barang
            $updateTotalResult = $this->db->table('tb_barang')
                ->where('id_barang', $barangBaik['id_barang'])
                ->update(['jumlah_total' => $new_total]);

            if ($updateTotalResult === false) {
                throw new \Exception('Gagal memperbarui total barang');
            }

            $db->transCommit();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'details' => [
                    'total_baik' => $json->jumlah_total_baik,
                    'total_rusak' => $jumlah_rusak['total_rusak'],
                    'total_dipinjam' => $jumlah_dipinjam['total_dipinjam'],
                    'total_keseluruhan' => $new_total
                ]
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

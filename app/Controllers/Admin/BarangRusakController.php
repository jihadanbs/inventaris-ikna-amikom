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

        $db = \Config\Database::connect();
        $db->transStart();

        try {
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

            // Update tb_barang_rusak
            $updateResult = $this->db->table('tb_barang_rusak')
                ->where('id_barang_rusak', $id)
                ->update([
                    'jumlah_total_rusak' => $json->jumlah_total_rusak,
                    'keterangan_rusak' => $json->keterangan_rusak
                ]);

            if ($updateResult === false) {
                throw new \Exception('Gagal memperbarui data barang baik');
            }

            $queryBaik = $this->db->table('tb_barang_baik')
                ->where('id_barang', $barangRusak['id_barang'])
                ->select('COALESCE(SUM(jumlah_total_baik), 0) as total_baik')
                ->get();

            if (!$queryBaik) {
                throw new \Exception('Query barang baik gagal dieksekusi');
            }

            $jumlah_baik = $queryBaik->getRowArray();
            if (!$jumlah_baik) {
                $jumlah_baik = ['total_baik' => 0];
            }

            $queryDipinjam = $this->db->table('tb_barang')
                ->where('id_barang', $barangRusak['id_barang'])
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
            $new_total = $json->jumlah_total_rusak +
                $jumlah_baik['total_baik'] +
                $jumlah_dipinjam['total_dipinjam'];

            // Update jumlah_total di tb_barang
            $updateTotalResult = $this->db->table('tb_barang')
                ->where('id_barang', $barangRusak['id_barang'])
                ->update(['jumlah_total' => $new_total]);

            if ($updateTotalResult === false) {
                throw new \Exception('Gagal memperbarui total barang');
            }

            $db->transCommit();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'details' => [
                    'total_baik' => $jumlah_baik['total_baik'],
                    'total_rusak' => $json->jumlah_total_rusak,
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

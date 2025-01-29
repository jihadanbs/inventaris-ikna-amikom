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

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_barang_keluar' => $this->m_barang_keluar->getAllSorted(),
            'tb_barang' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/barang_keluar/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Ambil id_barang dari input
        $id_barang = $this->request->getPost('id_barang');
        $total_barang = $this->request->getPost('total_barang');

        // Mengambil barang saat ini
        $barang = $this->m_barang->where('id_barang', $id_barang)->get()->getRowArray();
        if (!$barang) {
            return redirect()->back()->with('error', 'Data barang tidak ditemukan !');
        }

        // Get jumlah barang baik
        $barang_baik = $this->db->table('tb_barang_baik')
            ->where('id_barang', $id_barang)
            ->get()
            ->getRowArray();

        // Check jumlah barang keluar tidak boleh melebihi stok barang baik
        if ($total_barang > $barang_baik['jumlah_total_baik']) {
            return redirect()->back()->withInput()->with('errors', ['total_barang' => 'Jumlah barang keluar melebihi stok barang baik yang tersedia!']);
        }

        $rules = [
            'id_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Barang Harus Dipilih !',
                ]
            ],
            'total_barang' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Total Barang Harus Diisi !',
                    'numeric' => 'Total Barang Harus Berupa Angka !',
                    'greater_than_equal_to' => 'Total Barang Yang Keluar Tidak Boleh Negatif !',
                ]
            ],
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Keluar Harus Diisi !',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Harus Diisi !',
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Start database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Siapkan data untuk insert ke tb_barang_keluar
            $data = [
                'id_barang' => $id_barang,
                'id_user_peminjam' => null,
                'total_barang' => $total_barang,
                'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
                'keterangan' => $this->request->getPost('keterangan')
            ];

            // Insert ke tb_barang_keluar
            $this->m_barang_keluar->insert($data);

            // 1. Kurangi jumlah barang baik di tb_barang_baik
            $db->table('tb_barang_baik')
                ->where('id_barang', $id_barang)
                ->set('jumlah_total_baik', 'jumlah_total_baik - ' . $total_barang, false)
                ->update();

            // 2. Tambah jumlah barang rusak di tb_barang_rusak
            $existingRusak = $db->table('tb_barang_rusak')
                ->where('id_barang', $id_barang)
                ->get()
                ->getRowArray();

            if ($existingRusak) {
                // Update jika sudah ada
                $db->table('tb_barang_rusak')
                    ->where('id_barang', $id_barang)
                    ->set('jumlah_total_rusak', 'jumlah_total_rusak + ' . $total_barang, false)
                    ->update();
            } else {
                // Insert jika belum ada
                $db->table('tb_barang_rusak')
                    ->insert([
                        'id_barang' => $id_barang,
                        'jumlah_total_rusak' => $total_barang
                    ]);
            }

            // Total di tb_barang tidak perlu diubah karena barang masih ada (hanya pindah status)
            $db->transCommit();
            return redirect()->to('admin/barang_keluar')->with('pesan', 'Barang keluar berhasil ditambahkan !');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('errors', ['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}

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

    public function dipinjamkan($nama_lengkap)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Dipinjamkan Transaksi Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user_peminjam' => $this->m_user_peminjam->getByNamaLengkap($nama_lengkap),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dipinjamkan', $data);
    }

    public function proses_dipinjamkan($id_user_peminjam)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();

        //validasi input 
        $rules = [
            'catatan_peminjaman' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'keterangan' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
                ]
            ],
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Keluar Barang !'
                ]
            ],
            'tanggal_dipinjamkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Dipinjamkan Barang !'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data user peminjam
        $userPeminjam = $this->m_user_peminjam->find($id_user_peminjam);
        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Update data di tb_user_peminjam
            $dataUpdatePeminjam = [
                'id_user_peminjam' => $id_user_peminjam,
                'id_barang' => $userPeminjam['id_barang'],
                'catatan_peminjaman' => $data['catatan_peminjaman'],
                'tanggal_dipinjamkan' => $data['tanggal_dipinjamkan'],
                'status' => 'Dipinjamkan',
            ];

            if (!$this->m_user_peminjam->update($id_user_peminjam, $dataUpdatePeminjam)) {
                throw new \Exception('Gagal mengupdate data peminjam');
            }

            // Simpan data ke tb_barang_keluar
            $dataBarangKeluar = [
                'id_barang' => $userPeminjam['id_barang'],
                'id_user_peminjam' => $id_user_peminjam,
                'tanggal_keluar' => $data['tanggal_keluar'],
                'total_barang' => $data['total_barang'],
                'keterangan' => $this->getKeteranganKeluar($data['tanggal_keluar'], $data['keterangan'] ?? ''),
            ];

            if (!$this->m_barang_keluar->insert($dataBarangKeluar)) {
                throw new \Exception('Gagal menyimpan data barang keluar');
            }

            // Commit transaksi jika semua berhasil
            $this->db->transCommit();
            return redirect()->to('/admin/transaksi')->with('pesan', 'Barang berhasil dipinjamkan !');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal meminjamkan barang: ' . $e->getMessage());
        }
    }

    private function getKeteranganKeluar($tanggal, $keterangan)
    {
        if (empty(trim($keterangan))) {
            // Format tanggal ke format Indonesia
            $tanggal_formatted = date('d F Y', strtotime($tanggal));
            return "Barang telah dipinjamkan pada tanggal " . $tanggal_formatted;
        }
        return $keterangan;
    }
}

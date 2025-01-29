<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PinjamBarangController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Setting Pinjam Barang',
            'tb_setting_pinjam_barang' => $this->m_pinjam_barang->getAllSorted(),
        ]);

        return view('admin/setting-pinjam-barang/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Setting Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_barang' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/setting-pinjam-barang/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil id_barang dari input
        $id_barang = $this->request->getPost('id_barang');

        // Ambil nama_barang berdasarkan id_barang
        $nama_barang = $this->m_barang->where('id_barang', $id_barang)->get()->getRowArray()['nama_barang'] ?? null;

        if (!$nama_barang) {
            return redirect()->back()->with('errors', 'Data barang tidak ditemukan !');
        }

        $rules = [
            'id_barang' => [
                'rules' => 'required|is_unique[tb_setting_pinjam_barang.id_barang]',
                'errors' => [
                    'required' => 'Barang harus dipilih !',
                    'is_unique' => 'Barang ini sudah memiliki pengaturan peminjaman !'
                ]
            ],
            'masa_pinjam' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Masa pinjam harus diisi !',
                    'numeric' => 'Masa pinjam harus berupa angka !',
                    'greater_than' => 'Masa pinjam harus lebih dari 0 Hari !'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi harus diisi !'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'masa_pinjam' => $this->request->getPost('masa_pinjam'),
            'slug' => url_title($nama_barang, '-', true),
            'is_tampil' => $this->request->getPost('is_tampil') ? 1 : 0,
            'lokasi' => $this->request->getPost('lokasi'),
        ];

        $this->m_pinjam_barang->insert($data);
        return redirect()->to('admin/setting-pinjam-barang')->with('pesan', 'Pengaturan peminjaman berhasil ditambahkan !');
    }

    public function edit($id_setting_pinjam_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data setting pinjam barang berdasarkan ID
        $setting_pinjam = $this->m_pinjam_barang->getBarangBySlug($id_setting_pinjam_barang);

        // Jika data tidak ditemukan, redirect dengan pesan error
        if (!$setting_pinjam) {
            return redirect()->to('admin/setting-pinjam-barang')->with('error', 'Data barang tidak ditemukan !');
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Ubah Setting Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_setting_pinjam_barang' => $setting_pinjam,
            'tb_barang' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/setting-pinjam-barang/edit', $data);
    }

    public function update($id_setting_pinjam_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Cari data barang
        $barang = $this->m_pinjam_barang->find($id_setting_pinjam_barang);
        if (!$barang) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang tidak ditemukan');
        }

        // Ambil id_barang dari input
        $id_barang = $this->request->getPost('id_barang');

        // Ambil nama_barang berdasarkan id_barang
        $nama_barang = $this->m_barang->where('id_barang', $id_barang)->get()->getRowArray()['nama_barang'] ?? null;

        if (!$nama_barang) {
            return redirect()->back()->with('errors', 'Data barang tidak ditemukan !');
        }

        $rules = [
            'id_barang' => [
                'rules' => 'required|check_unique_id_barang[id_setting_pinjam_barang]',
                'errors' => [
                    'required' => 'Barang harus dipilih !',
                    'check_unique_id_barang' => 'Barang ini sudah memiliki pengaturan peminjaman !'
                ]
            ],
            'masa_pinjam' => [
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'Masa pinjam harus diisi !',
                    'numeric' => 'Masa pinjam harus berupa angka !',
                    'greater_than' => 'Masa pinjam harus lebih dari 0 Hari !'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi harus diisi !'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data baru dari input
        $data = [
            'id_barang' => $id_barang,
            'masa_pinjam' => $this->request->getPost('masa_pinjam'),
            'slug' => url_title($nama_barang, '-', true),
            'is_tampil' => $this->request->getPost('is_tampil') ? 1 : 0,
            'lokasi' => $this->request->getPost('lokasi')
        ];

        // Bandingkan dengan data lama
        $isDataChanged = false;
        foreach ($data as $key => $value) {
            if ($barang[$key] != $value) {
                $isDataChanged = true;
                break;
            }
        }

        // Jika tidak ada perubahan data
        if (!$isDataChanged) {
            return redirect()->to('admin/setting-pinjam-barang')->with('warning', 'Data tidak ada yang diubah !');
        }

        // Lakukan update jika ada perubahan
        $this->m_pinjam_barang->update($id_setting_pinjam_barang, $data);
        return redirect()->to('admin/setting-pinjam-barang')->with('pesan', 'Pengaturan peminjaman berhasil diubah !');
    }

    public function updateStatusTampil()
    {
        if ($this->request->isAJAX()) {
            // Get raw input data
            $json = $this->request->getJSON(true);

            // Extract values from JSON
            $id = $json['id'] ?? null;
            $isTampil = isset($json['is_tampil']) ? (int)$json['is_tampil'] : null;

            // Log for debugging
            // log_message('info', 'ID yang diterima: ' . $id);
            // log_message('info', 'is_tampil: ' . $isTampil);

            // Validasi data
            if (!$id || $isTampil === null) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak lengkap'
                ]);
            }

            // Cek keberadaan data
            $data = $this->m_pinjam_barang->find($id);
            if (!$data) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            try {
                // Update data
                $this->m_pinjam_barang->update($id, ['is_tampil' => $isTampil]);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status berhasil diperbarui'
                ]);
            } catch (\Exception $e) {
                log_message('error', 'Error updating status: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui data'
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Permintaan tidak valid'
        ]);
    }

    public function delete($id)
    {
        $setting = $this->m_pinjam_barang->find($id);

        if (!$setting) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pengaturan peminjaman tidak ditemukan !'
            ]);
        }

        $this->m_pinjam_barang->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pengaturan peminjaman berhasil dihapus !'
        ]);
    }

    public function delete2($id)
    {
        $setting = $this->m_pinjam_barang->find($id);

        if (!$setting) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pengaturan peminjaman tidak ditemukan !'
            ]);
        }

        $this->m_pinjam_barang->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pengaturan peminjaman berhasil dihapus !'
        ]);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KategoriInformasiPublikController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Kategori Informasi Publik',
            'tb_kategori_informasi_publik' => $this->m_kategori_informasi->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/kategori_informasi_publik/index', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Cek apakah request datang dari AJAX
        if ($this->request->isAJAX()) {
            // Ambil data dari request AJAX
            $nama_kategori = $this->request->getPost('nama_kategori');

            // Validasi data
            if (empty($nama_kategori)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori harus diisi !']);
            }

            // Cek apakah nama_kategori sudah ada dalam database
            $existing_data = $this->m_kategori_informasi->where('nama_kategori', $nama_kategori)->first();

            if ($existing_data) {
                // Jika nama_kategori sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_kategori_informasi->save([
                'nama_kategori' => $nama_kategori,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/kategori_informasi_publik');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_kategori_informasi = $this->request->getPost('id_kategori_informasi_publik');

        if ($this->m_kategori_informasi->delete($id_kategori_informasi)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function simpan_perubahan()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $dataToSave = $this->request->getPost('dataToSave');

        // Array untuk menyimpan nama_kategori yang sudah ada di database
        $existingNamaKategori = [];

        // Looping untuk mendapatkan nama_kategori yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_kategori_informasi = $data['id_kategori_informasi_publik'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk mendapatkan nama_kategori yang sudah ada di database
            $existingData = $this->m_kategori_informasi->where('nama_kategori', $nama_kategori)->first();
            if ($existingData) {
                // Jika nama_kategori sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama kategori sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama_kategori yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_kategori_informasi = $data['id_kategori_informasi_publik'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_kategori_informasi->update($id_kategori_informasi, [
                'nama_kategori' => $nama_kategori
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

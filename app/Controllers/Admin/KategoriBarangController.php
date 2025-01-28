<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KategoriBarangController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Kategori Barang',
            'tb_kategori' => $this->m_kategori_barang->getAllData(),
        ]);

        return view('admin/kategori_barang/index', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Cek apakah request datang dari AJAX
        if ($this->request->isAJAX()) {
            // Ambil data dari request AJAX
            $nama_kategori = $this->request->getPost('nama_kategori');

            // Validasi data
            if (empty($nama_kategori)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori Barang harus diisi !']);
            }

            // Cek apakah nama_kategori barang sudah ada dalam database
            $existing_data = $this->m_kategori_barang->where('nama_kategori', $nama_kategori)->first();

            if ($existing_data) {
                // Jika nama_kategori barang sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori Barang sudah ada dalam penyimpanan database !']);
            }

            // Simpan data ke dalam database
            $this->m_kategori_barang->save([
                'nama_kategori' => $nama_kategori,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/kategori_barang');
    }

    public function delete($id_kategori_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Pastikan id_kategori_barang tidak kosong
        if (empty($id_kategori_barang)) {
            return $this->response->setJSON(['error' => 'ID kategori barang tidak valid.']);
        }

        if ($this->m_kategori_barang->delete($id_kategori_barang)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function simpan_perubahan()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Mengambil data menggunakan getRawInput untuk PUT
        $dataToSave = $this->request->getRawInput()['dataToSave'];

        // Array untuk menyimpan nama kategori barang yang sudah ada di database
        $existingNamaKategori = [];

        // Looping untuk mendapatkan nama kategori barang yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_kategori_barang = $data['id_kategori_barang'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk mendapatkan nama kategori barang yang sudah ada di database
            $existingData = $this->m_kategori_barang->where('nama_kategori', $nama_kategori)->first();
            if ($existingData) {
                // Jika nama kategori barang sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama kategori barang sudah ada dalam penyimpanan database !']);
            }
        }

        // Jika tidak ada nama kategori barang yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_kategori_barang = $data['id_kategori_barang'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_kategori_barang->update($id_kategori_barang, [
                'nama_kategori' => $nama_kategori
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

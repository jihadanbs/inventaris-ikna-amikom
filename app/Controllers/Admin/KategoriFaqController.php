<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KategoriFaqController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Kategori FAQ',
            'tb_kategori_faq' => $this->m_kategori_faq->getAllData(),
        ]); // Meload data umum admin

        return view('admin/kategori_faq/index', $data);
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
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori FAQ harus diisi !']);
            }

            // Cek apakah nama_dinas sudah ada dalam database
            $existing_data = $this->m_kategori_faq->where('nama_kategori', $nama_kategori)->first();

            if ($existing_data) {
                // Jika nama_dinas sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kategori FAQ sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_kategori_faq->save([
                'nama_kategori' => $nama_kategori,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/kategori');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Pastikan id_kategori_faq tidak kosong
        if (empty($id_kategori_faq)) {
            return $this->response->setJSON(['error' => 'ID kategori FAQ tidak valid.']);
        }

        if ($this->m_kategori_faq->delete($id_kategori_faq)) {
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

        $dataToSave = $this->request->getRawInput()['dataToSave'];

        // Array untuk menyimpan nama dinas yang sudah ada di database
        $existingNamaKategoriFaq = [];

        // Looping untuk mendapatkan nama dinas yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_kategori_faq = $data['id_kategori_faq'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk mendapatkan nama dinas yang sudah ada di database
            $existingData = $this->m_kategori_faq->where('nama_kategori', $nama_kategori)->first();
            if ($existingData) {
                // Jika nama dinas sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama kategori FAQ sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama dinas yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_kategori_faq = $data['id_kategori_faq'];
            $nama_kategori = $data['nama_kategori'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_kategori_faq->update($id_kategori_faq, [
                'nama_kategori' => $nama_kategori
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

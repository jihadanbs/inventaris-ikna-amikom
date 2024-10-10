<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LembagaController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Lembaga',
            'tb_lembaga' => $this->m_lembaga->getAllData(),
        ], $this->loadCommonData());

        return view('admin/lembaga/index', $data);
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
            $nama_dinas = $this->request->getPost('nama_dinas');

            // Validasi data
            if (empty($nama_dinas)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Dinas harus diisi !']);
            }

            // Cek apakah nama_dinas sudah ada dalam database
            $existing_data = $this->m_lembaga->where('nama_dinas', $nama_dinas)->first();

            if ($existing_data) {
                // Jika nama_dinas sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Dinas sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_lembaga->save([
                'nama_dinas' => $nama_dinas,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/lembaga');
    }


    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_lembaga = $this->request->getPost('id_lembaga');

        if ($this->m_lembaga->delete($id_lembaga)) {
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

        // Array untuk menyimpan nama dinas yang sudah ada di database
        $existingNamaDinas = [];

        // Looping untuk mendapatkan nama dinas yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_lembaga = $data['id_lembaga'];
            $nama_dinas = $data['nama_dinas'];

            // Panggil model untuk mendapatkan nama dinas yang sudah ada di database
            $existingData = $this->m_lembaga->where('nama_dinas', $nama_dinas)->first();
            if ($existingData) {
                // Jika nama dinas sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama Dinas sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama dinas yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_lembaga = $data['id_lembaga'];
            $nama_dinas = $data['nama_dinas'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_lembaga->update($id_lembaga, [
                'nama_dinas' => $nama_dinas
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

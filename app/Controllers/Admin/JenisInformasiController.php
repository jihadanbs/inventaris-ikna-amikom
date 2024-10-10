<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class JenisInformasiController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Jenis Informasi',
            'tb_jenis' => $this->m_jenis->getAllData(),
        ], $this->loadCommonData());

        return view('admin/jenis_informasi/index', $data);
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
            $nama_jenis = $this->request->getPost('nama_jenis');

            // Validasi data
            if (empty($nama_jenis)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Jenis Informasi harus diisi !']);
            }

            // Cek apakah nama_jenis sudah ada dalam database
            $existing_data = $this->m_jenis->where('nama_jenis', $nama_jenis)->first();

            if ($existing_data) {
                // Jika nama_jenis sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Jenis Informasi sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_jenis->save([
                'nama_jenis' => $nama_jenis,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/jenis_informasi');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $id_jenis = $this->request->getPost('id_jenis');

        if ($this->m_jenis->delete($id_jenis)) {
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

        $dataToSave = $this->request->getPost('dataToSave');

        // Array untuk menyimpan nama jenis informasi yang sudah ada di database
        $existingNamaJenis = [];

        // Looping untuk mendapatkan nama jenis informasi yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_jenis = $data['id_jenis'];
            $nama_jenis = $data['nama_jenis'];

            // Panggil model untuk mendapatkan nama jenis informasi yang sudah ada di database
            $existingData = $this->m_jenis->where('nama_jenis', $nama_jenis)->first();
            if ($existingData) {
                // Jika nama jenis informasi sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'nama Jenis Informasi sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama jenis informasi yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_jenis = $data['id_jenis'];
            $nama_jenis = $data['nama_jenis'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_jenis->update($id_jenis, [
                'nama_jenis' => $nama_jenis
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class MendapatSalinanInformasiController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Mendapat Salinan Informasi',
            'tb_mendapat_salinan_informasi' => $this->m_mendapat->getAllData(),
        ], $this->loadCommonData());

        return view('admin/mendapat_salinan_informasi/index', $data);
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
            $deskripsi = $this->request->getPost('deskripsi');

            // Validasi data
            if (empty($deskripsi)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Deskripsi harus diisi !']);
            }

            // Cek apakah deskripsi sudah ada dalam database
            $existing_data = $this->m_mendapat->where('deskripsi', $deskripsi)->first();

            if ($existing_data) {
                // Jika deskripsi sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Deskripsi sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_mendapat->save([
                'deskripsi' => $deskripsi,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/mendapat_salinan_informasi');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_mendapat_salinan_informasi = $this->request->getPost('id_mendapat_salinan_informasi');

        if ($this->m_mendapat->delete($id_mendapat_salinan_informasi)) {
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

        // Array untuk menyimpan deskripsi yang sudah ada di database
        $existingDeskripsi = [];

        // Looping untuk mendapatkan deskripsi yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_mendapat_salinan_informasi = $data['id_mendapat_salinan_informasi'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk mendapatkan deskripsi yang sudah ada di database
            $existingData = $this->m_mendapat->where('deskripsi', $deskripsi)->first();
            if ($existingData) {
                // Jika deskripsi sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Deskripsi sudah ada dalam database !']);
            }
        }

        // Jika tidak ada deskripsi yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_mendapat_salinan_informasi = $data['id_mendapat_salinan_informasi'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_mendapat->update($id_mendapat_salinan_informasi, [
                'deskripsi' => $deskripsi
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

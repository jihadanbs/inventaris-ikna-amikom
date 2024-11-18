<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AlasanController extends BaseController
{
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Alasan',
            'tb_alasan' => $this->m_alasan->getAllData(),
        ], $this->loadCommonData());

        return view('admin/alasan/index', $data);
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

            // Cek apakah nama_dinas sudah ada dalam database
            $existing_data = $this->m_alasan->where('deskripsi', $deskripsi)->first();

            if ($existing_data) {
                // Jika nama_dinas sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Deskripsi sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_alasan->save([
                'deskripsi' => $deskripsi,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/alasan');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_alasan = $this->request->getPost('id_alasan');

        if ($this->m_alasan->delete($id_alasan)) {
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
        $existingDeskripsi = [];

        // Looping untuk mendapatkan nama dinas yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_alasan = $data['id_alasan'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk mendapatkan nama dinas yang sudah ada di database
            $existingData = $this->m_alasan->where('deskripsi', $deskripsi)->first();
            if ($existingData) {
                // Jika nama dinas sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Deskripsi sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama dinas yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_alasan = $data['id_alasan'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_alasan->update($id_alasan, [
                'deskripsi' => $deskripsi
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

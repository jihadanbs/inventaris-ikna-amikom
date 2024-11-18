<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class MemperolehInformasiController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Memperoleh Informasi',
            'tb_memperoleh_informasi' =>  $this->m_memperoleh->getAllData(),
        ], $this->loadCommonData());

        return view('admin/memperoleh_informasi/index', $data);
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
            $existing_data = $this->m_memperoleh->where('deskripsi', $deskripsi)->first();

            if ($existing_data) {
                // Jika nama_dinas sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Deskripsi sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_memperoleh->save([
                'deskripsi' => $deskripsi,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan.']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/memperoleh_informasi');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_memperoleh_informasi = $this->request->getPost('id_memperoleh_informasi');

        if ($this->m_memperoleh->delete($id_memperoleh_informasi)) {
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
            $id_memperoleh_informasi = $data['id_memperoleh_informasi'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk mendapatkan nama dinas yang sudah ada di database
            $existingData = $this->m_memperoleh->where('deskripsi', $deskripsi)->first();
            if ($existingData) {
                // Jika nama dinas sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Deskripsi sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama dinas yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_memperoleh_informasi = $data['id_memperoleh_informasi'];
            $deskripsi = $data['deskripsi'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_memperoleh->update($id_memperoleh_informasi, [
                'deskripsi' => $deskripsi
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

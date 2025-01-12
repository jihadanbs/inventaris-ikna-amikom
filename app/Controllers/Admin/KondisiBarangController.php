<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class KondisiBarangController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Kondisi Barang',
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/kondisi_barang/index', $data);
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
            $nama_kondisi = $this->request->getPost('nama_kondisi');

            // Validasi data
            if (empty($nama_kondisi)) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kondisi Barang harus diisi !']);
            }

            // Cek apakah nama_dinas sudah ada dalam database
            $existing_data = $this->m_kondisi_barang->where('nama_kondisi', $nama_kondisi)->first();

            if ($existing_data) {
                // Jika nama_dinas sudah ada dalam database, kirim pesan error
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Nama Kondisi Barang sudah ada dalam database !']);
            }

            // Simpan data ke dalam database
            $this->m_kondisi_barang->save([
                'nama_kondisi' => $nama_kondisi,
            ]);

            // Berikan respons jika berhasil
            return $this->response->setJSON(['success' => 'Data berhasil disimpan']);
        }

        // Jika berhasil disimpan, kembalikan ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to('admin/kondisi_barang');
    }

    public function delete($id_kondisi_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Pastikan id_kondisi_barang tidak kosong
        if (empty($id_kondisi_barang)) {
            return $this->response->setJSON(['error' => 'ID Kondisi barang tidak valid.']);
        }

        if ($this->m_kondisi_barang->delete($id_kondisi_barang)) {
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

        // Array untuk menyimpan nama dinas yang sudah ada di database
        $existingNamaKategori = [];

        // Looping untuk mendapatkan nama dinas yang sudah ada di database
        foreach ($dataToSave as $data) {
            $id_kondisi_barang = $data['id_kondisi_barang'];
            $nama_kondisi = $data['nama_kondisi'];

            // Panggil model untuk mendapatkan nama dinas yang sudah ada di database
            $existingData = $this->m_kondisi_barang->where('nama_kondisi', $nama_kondisi)->first();
            if ($existingData) {
                // Jika nama dinas sudah ada di database, kirimkan pesan kesalahan
                return $this->response->setJSON(['success' => false, 'message' => 'Nama Kondisi Barang sudah ada dalam database !']);
            }
        }

        // Jika tidak ada nama dinas yang sama, lanjutkan penyimpanan perubahan ke database
        foreach ($dataToSave as $data) {
            $id_kondisi_barang = $data['id_kondisi_barang'];
            $nama_kondisi = $data['nama_kondisi'];

            // Panggil model untuk melakukan penyimpanan perubahan
            $this->m_kondisi_barang->update($id_kondisi_barang, [
                'nama_kondisi' => $nama_kondisi
            ]);
        }

        // Kirimkan respons ke client jika berhasil
        return $this->response->setJSON(['success' => true]);
    }
}

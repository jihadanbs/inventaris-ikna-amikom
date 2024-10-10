<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\LaporanValidation;

class LaporanController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Laporan',
            'tb_laporan' => $this->m_laporan->getAllData(),
        ], $this->loadCommonData());

        return view('admin/laporan/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Laporan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/laporan/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan LaporanValidation
        if (!$this->validate(LaporanValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_laporan->save([
            'slug' => url_title($this->request->getVar('judul_laporan'), '-', true),
            'judul_laporan' => $this->request->getVar('judul_laporan'),
            'tanggal_file' => $this->request->getVar('tanggal_file'),
            'file_laporan' => uploadFilePDF('file_laporan', 'dokumen/laporan/'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/laporan');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_laporan = $this->request->getPost('id_laporan');

        $this->db->transStart();

        try {
            $dataFiles = $this->m_laporan->getFilesById($id_laporan);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_laporan.');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_laporan->deleteById($id_laporan);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $this->db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function edit($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit Laporan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_laporan' => $this->m_laporan->getLaporan($slug),
            'slug' => $slug,
        ], $this->loadCommonData());

        return view('admin/laporan/edit', $data);
    }

    public function update($id_laporan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan LaporanValidation
        if (!$this->validate(LaporanValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFilePDF
        $oldFileName = $this->request->getVar('old_file_laporan'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_laporan')->isValid() ?
            updateFilePDF('file_laporan', 'dokumen/laporan/', $oldFileName) : $oldFileName;

        // Simpan data ke dalam database
        $this->m_laporan->save([
            'id_laporan' => $id_laporan,
            'judul_laporan' => $this->request->getVar('judul_laporan'),
            'tanggal_file' => $this->request->getVar('tanggal_file'),
            'slug' => url_title($this->request->getVar('judul_laporan'), '-', true),
            'file_laporan' => $newFileName,
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/laporan');
    }

    public function cek_data($id_laporan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Laporan',
            'tb_laporan' => $this->m_laporan->getAll($id_laporan),
            'dokumen' => $this->m_laporan->getDokumenById($id_laporan),
        ], $this->loadCommonData());

        // print_r($data['tb_laporan']); // Cetak nilai tb_laporan untuk debugging

        return view('admin/laporan/cek_data', $data);
    }

    public function downloadFile($id_laporan)
    {
        $data = $this->m_laporan->find($id_laporan);
        if (!$data) {
            return 'Data tidak ditemukan';
        }
        if (!isset($data['file_laporan'])) {
            return 'Berkas tidak ditemukan';
        }
        $pathToFile = ROOTPATH . 'public/' . $data['file_laporan'];
        return $this->response->download($pathToFile, null);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\WebsiteValidation;

class WebsiteController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Website Wilayah',
            'tb_wilayah' => $this->m_wilayah->getAllData(),
        ], $this->loadCommonData());

        return view('admin/website/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Website Wilayah',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/website/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan WebsiteValidation
        if (!$this->validate(WebsiteValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_wilayah->save([
            'nama_wilayah' => $this->request->getVar('nama_wilayah'),
            'link_wilayah' => $this->request->getVar('link_wilayah'),
            'gambar_wilayah' => uploadFile('gambar_wilayah', 'dokumen/gambar_wilayah/'),
            'slug' => url_title($this->request->getVar('nama_wilayah'), '-', true)
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/website');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_wilayah = $this->request->getPost('id_wilayah');

        $this->db->transStart();

        try {
            $dataFiles = $this->m_wilayah->getFilesById($id_wilayah);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_wilayah.');
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

            $this->m_wilayah->deleteById($id_wilayah);

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

    public function edit($id_wilayah)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit Website Wilayah',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_wilayah' => $this->m_wilayah->getWilayah($id_wilayah),
        ], $this->loadCommonData());

        return view('admin/website/edit', $data);
    }
    public function update($id_wilayah)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan WebsiteValidation
        if (!$this->validate(WebsiteValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFilePDF
        $oldFileName = $this->request->getVar('old_gambar_wilayah'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('gambar_wilayah')->isValid() ?
            updateFile('gambar_wilayah', 'dokumen/gambar_wilayah/', $oldFileName) : $oldFileName;

        // Simpan data ke dalam database
        $this->m_wilayah->save([
            'id_wilayah' => $id_wilayah,
            'nama_wilayah' => $this->request->getVar('nama_wilayah'),
            'link_wilayah' => $this->request->getVar('link_wilayah'),
            'slug' => url_title($this->request->getVar('nama_wilayah'), '-', true),

            'gambar_wilayah' => $newFileName,
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/website');
    }

    public function cek_data($id_wilayah)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Website',
            'tb_wilayah' => $this->m_wilayah->getAll($id_wilayah),
            'dokumen' => $this->m_wilayah->getDokumenById($id_wilayah),
        ], $this->loadCommonData());

        return view('admin/website/cek_data', $data);
    }
}

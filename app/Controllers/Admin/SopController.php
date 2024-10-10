<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\SopValidation;

class sopController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman SOP',
            'tb_sop' => $this->m_sop->getAllData(),
        ], $this->loadCommonData());

        return view('admin/sop/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah SOP',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/sop/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan SopValidation
        if (!$this->validate(SopValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_sop->save([
            'judul_sop' => $this->request->getVar('judul_sop'),
            'slug' => url_title($this->request->getVar('judul_sop'), '-', true),
            'file_sop' => uploadFilePDF('file_sop', 'dokumen/sop/'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/sop');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_sop = $this->request->getPost('id_sop');

        $this->db->transStart();

        try {
            $dataFiles = $this->m_sop->getFilesById($id_sop);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_sop.');
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

            $this->m_sop->deleteById($id_sop);

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
            'title' => 'Admin | Halaman Edit Sop',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_sop' => $this->m_sop->getSop($slug),
            'slug' => $slug,
        ], $this->loadCommonData());

        return view('admin/sop/edit', $data);
    }
    public function update($id_sop)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan SopValidation
        if (!$this->validate(SopValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFilePDF
        $oldFileName = $this->request->getVar('old_file_sop'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_sop')->isValid() ?
            updateFilePDF('file_sop', 'dokumen/sop/', $oldFileName) : $oldFileName;

        // Simpan data ke dalam database
        $this->m_sop->save([
            'id_sop' => $id_sop,
            'judul_sop' => $this->request->getVar('judul_sop'),
            'slug' => url_title($this->request->getVar('judul_sop'), '-', true),
            'file_sop' => $newFileName,
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/sop');
    }

    public function cek_data($id_sop)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data SOP',
            'tb_sop' => $this->m_sop->getAll($id_sop),
            'dokumen' => $this->m_sop->getDokumenById($id_sop),
        ], $this->loadCommonData());

        return view('admin/sop/cek_data', $data);
    }
}

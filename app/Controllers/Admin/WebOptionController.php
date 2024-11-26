<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\WebOptionValidation;

class WebOptionController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Web Option',
            'tb_web_option' => $this->m_web_option->getAllData(),
        ]);

        return view('admin/web_option/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Web Option',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_web_option' => $this->m_web_option->getAllData(),
        ]);

        return view('admin/web_option/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan WebOptionValidation
        if (!$this->validate(WebOptionValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_web_option->save([
            'name' => $this->request->getVar('name'),
            'value' => $this->request->getVar('value'),
            'path_file' => uploadFileUmum('path_file', 'dokumen/web_option/'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/web_option');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_web_option = $this->request->getPost('id_web_option');

        $this->db->transStart();

        try {
            $dataFiles = $this->m_web_option->getFilesById($id_web_option);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_web_option.');
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

            $this->m_web_option->deleteById($id_web_option);

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

    public function edit($id_web_option)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit Web Option',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_web_option' => $this->m_web_option->getWeb($id_web_option),
        ]);

        return view('admin/web_option/edit', $data);
    }
    public function update($id_web_option)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan WebOptionValidation
        if (!$this->validate(WebOptionValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFileProfile
        $oldFileName = $this->request->getVar('old_path_file'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('path_file')->isValid() ?
            updateFileProfile('path_file', 'dokumen/web_option/', $oldFileName) : $oldFileName;

        // Simpan data ke dalam database
        $this->m_web_option->save([
            'id_web_option' => $id_web_option,
            'name' => $this->request->getVar('name'),
            'value' => $this->request->getVar('value'),
            'path_file' => $newFileName // Simpan nama file baru ke database
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/web_option');
    }

    public function cek_data($id_web_option)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Web Option',
            'tb_web_option' => $this->m_web_option->getAll($id_web_option),
            'dokumen' => $this->m_web_option->getDokumenById($id_web_option),
        ]);

        // print_r($data['tb_web_option']); // Cetak nilai tb_web_option untuk debugging

        return view('admin/web_option/cek_data', $data);
    }
}

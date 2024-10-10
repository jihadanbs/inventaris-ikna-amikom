<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LogoController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $tb_logo = $this->m_logo->getAllData();
        $tb_user = $this->m_user->getAll();
        $tb_pemohon = $this->m_pemohon->getAllSorted();
        $unreadCount = $this->m_pemohon->countUnreadEntries();
        $unread = $this->m_pemohon->getUnreadEntries();

        $data = [
            'title' => 'Admin | Halaman Logo',
            'tb_logo' => $tb_logo,
            'tb_user' => $tb_user,
            'tb_pemohon' => $tb_pemohon,
            'unreadCount' => $unreadCount,
            'unread' => $unread
        ];

        return view('admin/logo/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $tb_user = $this->m_user->getAll();
        $tb_pemohon = $this->m_pemohon->getAllSorted();
        $unreadCount = $this->m_pemohon->countUnreadEntries();
        $unread = $this->m_pemohon->getUnreadEntries();

        $data = [
            'title' => 'Admin | Halaman Tambah Logo',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user' => $tb_user,
            'tb_pemohon' => $tb_pemohon,
            'unreadCount' => $unreadCount,
            'unread' => $unread
        ];

        return view('admin/logo/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input 

        if (!$this->validate([
            'gambar_logo' => [
                'rules' => 'uploaded[gambar_logo]|mime_in[gambar_logo,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar_logo,5024]',
                'errors' => [
                    'uploaded' => 'Kolom Gambar Logo harus diisi',
                    'mime_in' => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB',
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/logo/tambah')->withInput();
        }

        // Panggil helper uploadFile
        $uploadFile = uploadFile('gambar_logo', 'dokumen/logo/');

        if (!$uploadFile) {
            // Jika file tidak berhasil diunggah, tampilkan pesan error
            session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi.');
            return redirect()->to('/admin/logo/tambah')->withInput();
        }

        $this->m_logo->save([
            'gambar_logo' => $uploadFile,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/logo');
    }
    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_logo = $this->request->getPost('id_logo');

        if ($this->m_logo->delete($id_logo)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function edit($id_logo)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $tb_user = $this->m_user->getAll();
        $tb_logo = $this->m_logo->getLogo($id_logo);
        $tb_pemohon = $this->m_pemohon->getAllSorted();
        $unreadCount = $this->m_pemohon->countUnreadEntries();
        $unread = $this->m_pemohon->getUnreadEntries();

        $data = [
            'title' => 'Admin | Halaman Edit Data Logo',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_logo' => $tb_logo,
            'id_logo' => $id_logo,
            'tb_user' => $tb_user,
            'tb_pemohon' => $tb_pemohon,
            'unreadCount' => $unreadCount,
            'unread' => $unread
        ];

        return view('admin/logo/edit', $data);
    }
    public function update($id_logo)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate([
            'gambar_logo' => [
                'rules' => 'uploaded[gambar_logo]|mime_in[gambar_logo,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar_logo,5024]',
                'errors' => [
                    'uploaded' => 'Kolom Gambar Logo harus diisi',
                    'mime_in' => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, PNG, atau GIF',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/logo/edit/' . $this->request->getVar('slug'))->withInput();
        }

        // Panggil helper updateFile
        $oldFileName = $this->request->getVar('gambar_logo');
        $newFileName = updateFile('gambar_logo', 'dokumen/logo/', $oldFileName);
        $this->m_logo->save([
            'id_logo' => $id_logo,
            'gambar_logo' => $newFileName // Simpan nama file baru ke database
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/logo');
    }
}

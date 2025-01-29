<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserPeminjamController extends BaseController
{
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman User Peminjam',
            'tb_user_peminjam' => $this->m_user_peminjam->getAllSorted(),
        ]);

        return view('admin/user_peminjam/index', $data);
    }

    public function cek_data($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data User Peminjam',
            'tb_user_peminjam' => $this->m_user_peminjam->getNamaLengkapBySlug($slug),
        ]);

        return view('admin/user_peminjam/cek_data', $data);
    }

    public function delete($id)
    {
        $userPeminjam = $this->m_user_peminjam->find($id);

        if (!$userPeminjam) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User peminjam tidak ditemukan !'
            ]);
        }

        $this->m_user_peminjam->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User Peminjam berhasil dihapus !'
        ]);
    }
}

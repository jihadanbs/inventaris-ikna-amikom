<?php

namespace App\Controllers;

class RoleController extends BaseController
{
    public function index()
    {
        // Cek session
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        // Arahkan pengguna sesuai dengan id_jabatan mereka
        switch (session()->get('id_jabatan')) {
            case 1:
                return redirect()->to('admin/dashboard');
            case 2:
                return redirect()->to('barang-detail');
            default:
                return redirect()->to('authentication/login')->with('gagal', 'Akses tidak diizinkan');
        }
    }
}

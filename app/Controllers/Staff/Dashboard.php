<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Jika pengguna tidak login dan mencoba mengakses halaman staff dashboard, arahkan kembali dan beri pesan
        if (!$this->session->has('islogin') || session()->get('id_jabatan') != 2) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
            // echo ('staff');
        } else {
            return view('staff/dashboard/index'); // Tampilkan dashboard jika pengguna sudah login
        }
    }
}

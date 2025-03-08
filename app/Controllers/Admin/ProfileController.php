<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Profile',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_jabatan' => $this->m_jabatan->getAll(),
        ]);

        return view('admin/profile/index', $data);
    }

    public function update($id_user)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|trim|max_length[255]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan nama tidak boleh melebihi 255 karakter !',
                    'min_length' => 'Inputan nama tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'username' => [
                'rules' => 'required|trim|max_length[10]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Username Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan username tidak boleh melebihi 10 karakter !',
                    'min_length' => 'Inputan username tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Anda Tidak Boleh Kosong !',
                    'valid_email' => 'Format Email tidak valid !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|trim|max_length[20]|numeric',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan No. Telepon tidak boleh melebihi 20 karakter !',
                    'numeric' => 'No. Telepon harus berupa angka !'
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFile
        $oldFileName = $this->request->getVar('old_file_profil'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_profil')->isValid() ?
            updateFile('file_profil', 'dokumen/profile/', $oldFileName) :
            $oldFileName;

        // Simpan data ke dalam database
        $this->m_user->update($id_user, [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'file_profil' => $newFileName
        ]);

        // Perbarui nilai sesi setelah menyimpan ke database
        session()->set([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'file_profil' => $newFileName
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !');

        return redirect()->to('/admin/profile');
    }

    public function updateUser()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }
    
        // Ambil ID user dari session
        $id_user = session()->get('id_user');
    
        // Validasi input
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required|trim|max_length[255]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan nama tidak boleh melebihi 255 karakter !',
                    'min_length' => 'Inputan nama tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'username' => [
                'rules' => 'required|trim|max_length[10]|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Username Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan username tidak boleh melebihi 10 karakter !',
                    'min_length' => 'Inputan username tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Anda Tidak Boleh Kosong !',
                    'valid_email' => 'Format Email tidak valid !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|trim|max_length[20]|numeric',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan No. Telepon tidak boleh melebihi 20 karakter !',
                    'numeric' => 'No. Telepon harus berupa angka !'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required|trim|max_length[100]',
                'errors' => [
                    'required' => 'Kolom Pekerjaan Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan Pekerjaan tidak boleh melebihi 100 karakter !'
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim|max_length[500]',
                'errors' => [
                    'required' => 'Kolom Alamat Anda Tidak Boleh Kosong !',
                    'max_length' => 'Inputan Alamat tidak boleh melebihi 500 karakter !'
                ]
            ]
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }
    
        // Panggil helper updateFile
        $oldFileName = $this->request->getVar('old_file_profil'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_profil')->isValid() 
            ? updateFile('file_profil', 'dokumen/profile/', $oldFileName) 
            : $oldFileName;
    
        // Simpan data ke dalam database
        $this->m_user->save([
            'id_user' => $id_user,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'alamat' => $this->request->getVar('alamat'),
            'file_profil' => $newFileName
        ]);
    
        // Perbarui nilai sesi setelah menyimpan ke database
        session()->set([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'alamat' => $this->request->getVar('alamat'),
            'file_profil' => $newFileName
        ]);
    
        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');
    
        return redirect()->to('/admin/profile');
    }

    public function resetPassword()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Atur Ulang Kata Sandi',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_jabatan' => $this->m_jabatan->getAll(),
        ]);

        return view('admin/profile/resetpassword', $data);
    }

    public function updateSandi()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate([
            'sandi_lama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                ],
            ],
            'sandi_baru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                    'min_length' => 'Kata Sandi Baru harus memiliki panjang minimal 6 karakter &#128548'
                ]
            ],
            'konfirmasi_sandi_baru' => [
                'rules' => 'required|matches[sandi_baru]',
                'errors' => [
                    'required' => 'Wajib diisi &#128541',
                    'matches' => 'Konfirmasi Kata Sandi Baru ini harus sama dengan Kata Sandi Baru Anda Yang Diatas Ya.. &#129303'
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data pengguna dari sesi
        $id_user = session('id_user');

        // Pastikan id_user ada dalam sesi
        if (!$id_user) {
            session()->setFlashdata('gagal', 'ID pengguna tidak ditemukan dalam sesi');
            return redirect()->to('authentication/login');
        }

        // Ambil data pengguna berdasarkan id_user
        $user = $this->m_user->getUserById($id_user);

        // Pastikan $user adalah objek sebelum mengakses propertinya
        if ($user && password_verify($this->request->getVar('sandi_lama'), $user->password)) {
            // Generate hash baru untuk kata sandi baru
            $new_password_hash = password_hash($this->request->getVar('sandi_baru'), PASSWORD_DEFAULT);

            // Update kata sandi baru dan kolom password_last_reset
            $this->m_user->updateData($id_user, [
                'password' => $new_password_hash,
                'password_last_reset' => date('Y-m-d H:i:s'),
            ]);

            // Perbarui nilai sesi setelah menyimpan ke database
            session()->set([
                'password_last_reset' => date('Y-m-d H:i:s'),
            ]);

            // Setelah update sukses, tampilkan pesan berhasil
            session()->setFlashdata('pesan', 'Kata sandi berhasil diubah');
            return redirect()->to('admin/profile/resetpassword');
        } else {
            // Jika kata sandi lama tidak cocok
            session()->setFlashdata('gagal', 'Kata sandi lama tidak cocok');
            return redirect()->to('admin/profile/resetpassword')->withInput();
        }
    }
}

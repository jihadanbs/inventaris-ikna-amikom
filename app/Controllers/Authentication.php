<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Authentication extends BaseController
{
    public function login()
    {
        // Jika pengguna sudah login, arahkan kembali dan beri pesan
        if ($this->session->has('islogin')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login PPID',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pesan' => session()->getFlashdata('pesan'),
            'gagal' => session()->getFlashdata('gagal')
        ];

        return view('users/login', $data);
    }

    public function cekLogin()
    {
        if ($this->session->has('islogin')) {
            return redirect()->back()->with('pesan', 'Anda Sudah Login');
        }

        $session = $this->session;

        if ($this->request->getPost()) {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username atau Email harus di isi!',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus di isi!',
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $usernameOrEmail = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                // Periksa apakah pengguna menggunakan email atau username
                $user = $this->m_user->where('email', $usernameOrEmail)
                    ->orWhere('username', $usernameOrEmail)
                    ->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['status'] == 'aktif') {
                            // Periksa apakah password perlu direset
                            if (!empty($user['password_last_reset'])) {
                                $passwordLastReset = new \DateTime($user['password_last_reset']);
                                $currentDate = $this->date;
                                $interval = $passwordLastReset->diff($currentDate);

                                if ($interval->days > 30) {
                                    return redirect()->to('authentication/lupaPassword')->with('warning', 'Password Anda sudah kadaluarsa. Silakan reset password Anda.');
                                }
                            }

                            // Perbarui kolom terakhir_login
                            $this->m_user->updateData($user['id_user'], ['terakhir_login' => date('Y-m-d H:i:s')]);

                            // Set session data
                            $session->set([
                                'id_user' => $user['id_user'],
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'id_jabatan' => $user['id_jabatan'],
                                'nama_lengkap' => $user['nama_lengkap'],
                                'no_telepon' => $user['no_telepon'],
                                'password_last_reset' => $user['password_last_reset'],
                                'terakhir_login' => $user['terakhir_login'],
                                'file_profil' => $user['file_profil'],
                                'islogin' => true
                            ]);

                            // Log the session data for debugging
                            log_message('debug', 'User logged in: ' . json_encode($session->get()));

                            if ($user['id_jabatan'] == 1) {
                                return redirect()->to('admin/dashboard');
                            } elseif ($user['id_jabatan'] == 2) {
                                return redirect()->to('staff/dashboard');
                            }
                        } elseif ($user['status'] == 'tidak aktif') {
                            $session->setFlashdata('gagal', 'Akun anda dinonaktifkan');
                        }
                    } else {
                        $session->setFlashdata('validation', ['password' => 'Password yang Anda masukkan salah!']);
                    }
                } else {
                    $session->setFlashdata('validation', ['username' => 'Username / Email tidak ditemukan!']);
                }
            } else {
                $session->setFlashdata('validation', $this->validator->getErrors());
            }
        }

        return redirect()->to('authentication/login')->withInput()->with('gagal', 'Silahkan Login Ulang!');
    }


    public function lupaPassword()
    {
        $err = [];

        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');

            // Validasi username/email tidak boleh kosong
            if (empty($username)) {
                $err['username'] = "Silahkan masukkan username atau email yang sudah terdaftar";
            } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $err['username'] = "Format username atau email tidak valid";
            }

            if (empty($err)) {
                $data = $this->m_user->getData($username);

                if (empty($data)) {
                    $err['username'] = "Akun yang kamu masukkan tidak terdaftar";
                }
            }

            if (empty($err)) {
                $email = $data['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("authentication/resetPassword/?email=$email&token=$token");

                // Load template php dari file
                $emailTemplate = file_get_contents(APPPATH . 'Views/gmail/reset_password_gmail.php');

                // Replace placeholders dengan nilai sebenarnya
                $emailContent = str_replace(['{reset_link}', '{token}'], [$link, $token], $emailTemplate);

                // Konfigurasi email
                $this->email->setNewline("\r\n");
                $this->email->setMailType('html');
                $this->email->setTo($email);
                $this->email->setSubject('Reset Password');
                $this->email->setMessage($emailContent);

                if ($this->email->send()) {
                    $dataUpdate = [
                        'token' => $token
                    ];
                    $this->m_user->updateData($data['id_user'], $dataUpdate);
                    session()->setFlashdata("success", "Link recovery sudah kami kirimkan ke email anda");
                } else {
                    session()->setFlashdata("error", "Gagal mengirim email.");
                }
            }

            if ($err) {
                session()->setFlashdata("username", $username);
                session()->setFlashdata("validation", $err);
            }

            return redirect()->to("authentication/lupaPassword");
        }

        $data = [
            'title' => 'Lupa Password PPID',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];

        return view('users/lupaPassword', $data);
    }

    public function resetPassword()
    {
        $dataAkun = null;
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        if ($email != '' && $token != '') {
            $dataAkun = $this->m_user->getData($email);
            if (!$dataAkun || $dataAkun['token'] != $token) {
                // Jika tidak ada data akun atau token tidak valid, arahkan pengguna ke halaman yang sesuai
                return redirect()->to('authentication/lupaPassword')->with('warning', 'Token Sudah Tidak Valid');
            }
        } else {
            // Jika email atau token kosong, arahkan pengguna ke halaman yang sesuai
            return redirect()->to('authentication/lupaPassword')->with('warning', 'Parameter Yang Dikirimkan Tidak Valid');
        }

        if ($this->request->getPost()) {
            $rules = [
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Kata Sandi Baru harus memiliki panjang minimal 6 karakter',
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[6]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                        'min_length' => 'Konfirmasi password minimal 6 karakter',
                        'matches' => 'Konfirmasi password tidak sama dengan password di atas'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('validation', $this->validator->getErrors());
            } else {
                if ($dataAkun && isset($dataAkun['id_user'])) {
                    $id_user = $dataAkun['id_user'];
                    $dataUpdate = [
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        'password_last_reset' => date('Y-m-d H:i:s'),
                        'token' => null
                    ];
                    $this->m_user->updateData($id_user, $dataUpdate);

                    // Mengirim email dengan informasi password baru
                    $username = $dataAkun['username'];
                    $emailTemplate = file_get_contents(APPPATH . 'Views/gmail/password_baru.php');
                    $emailContent = str_replace(['{username}', '{email}', '{password}'], [$username, $email, $this->request->getVar('password')], $emailTemplate);

                    // Konfigurasi email
                    $this->email->setNewline("\r\n");
                    $this->email->setMailType('html');
                    $this->email->setTo($email);
                    $this->email->setSubject('Password Login Baru');
                    $this->email->setMessage($emailContent);

                    if ($this->email->send()) {
                        session()->setFlashdata('success', 'Password berhasil direset, silahkan login menggunakan password baru anda dan cek email untuk informasi lebih lanjut');
                    } else {
                        session()->setFlashdata('error', 'Password berhasil direset, tetapi gagal mengirim email');
                    }

                    return redirect()->to('authentication/login');
                } else {
                    session()->setFlashdata('error', 'Terjadi kesalahan saat mereset password');
                }
            }
        }

        $data = [
            'title' => 'Reset Password PPID',
            'validation' => session()->getFlashdata('validation') ?? [],
            'old_input' => $this->request->getPost(),
        ];

        return view('users/resetPassword', $data);
    }

    public function logout()
    {
        // Menghapus semua data sesi
        $this->session->destroy();
        // Mengatur pesan flash sebelum mengarahkan kembali
        return redirect()->to('authentication/login')->with('pesan', 'Anda Berhasil Logout!');
    }
}

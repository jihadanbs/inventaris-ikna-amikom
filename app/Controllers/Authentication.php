<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Authentication extends BaseController
{
    public function registrasi()
    {
        $data = [
            'title' => 'Registrasi Akun Peminjam',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pesan' => session()->getFlashdata('pesan'),
            'gagal' => session()->getFlashdata('gagal')
        ];

        return view('users/registrasi', $data);
    }

    public function cekRegistrasi()
    {
        // Log untuk debug
        // log_message('debug', 'Data Registrasi: ' . print_r($this->request->getPost(), true));

        // Validasi input 
        $rules = [
            'nama_lengkap' => [
                'rules' => 'required|nama_check[tb_user,nama_lengkap]',
                'errors' => [
                    'required' => 'Masukkan Nama lengkap anda !',
                    'nama_check' => 'Nama sudah terdaftar dalam sistem !'
                ]
            ],
            'username' => [
                'rules' => 'required|trim|max_length[10]|min_length[5]|username_check[tb_user,username]',
                'errors' => [
                    'required' => 'Kolom Username tidak boleh kosong !',
                    'max_length' => 'Username tidak boleh melebihi 10 karakter !',
                    'min_length' => 'Username tidak boleh kurang dari 5 karakter !',
                    'username_check' => 'Username sudah dipakai oleh user lain !'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom Pekerjaan tidak boleh kosong !',
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kolom Alamat tidak boleh kosong !',
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email|email_check[tb_user,email]',
                'errors' => [
                    'required' => 'Kolom Email tidak boleh kosong !',
                    'valid_email' => 'Email tidak valid gunakan @ !',
                    'email_check' => 'Email sudah terdaftar !'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric|check_no_telepon',
                'errors' => [
                    'required' => 'No. Whatsapp tidak boleh kosong !',
                    'numeric' => 'No. Whatsapp harus berupa angka !',
                    'check_no_telepon' => 'No. Whatsapp tidak boleh diawali dengan "62", gunakan angka "0" sebagai pengganti !'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Kolom Kata Sandi tidak boleh kosong !',
                    'min_length' => 'Kata Sandi tidak boleh kurang dari 8 karakter !'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Kolom Konfirmasi Kata Sandi tidak boleh kosong !',
                    'matches' => 'Konfirmasi Kata Sandi tidak sesuai dengan Kata Sandi !'
                ]
            ],
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            session()->setFlashdata('validation', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        $this->m_user->save([
            'id_jabatan' => 2,
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'konfirmasi_password' => $this->request->getPost('konfirmasi_password')
        ]);

        session()->setFlashdata('pesan', 'Anda berhasil melakukan registrasi !');

        return redirect()->to('authentication/login');
    }

    public function login()
    {
        // Jika pengguna sudah login, arahkan kembali dan beri pesan
        if ($this->session->has('islogin')) {
            if ($this->session->get('id_jabatan') == 1) {
                return redirect()->to('admin/dashboard');
            } elseif ($this->session->get('id_jabatan') == 2) {
                return redirect()->to('barang-detail');
            }
        }

        $data = [
            'title' => 'Login IKNAventory'
        ];

        return view('users/login', $data);
    }

    public function cekLogin()
    {
        if ($this->session->has('islogin')) {
            return redirect()->back()->with('pesan', 'Anda Sudah Login !');
        }

        $session = $this->session;

        // validasi jika belum ada inputan username dan password di form login
        if ($this->request->getPost()) {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username atau Email harus di isi !',
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus di isi !',
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                // mengambil inputan username dan password pada form login
                $usernameOrEmail = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                // Periksa apakah pengguna sudah menginputkan email atau username
                $user = $this->m_user->where('email', $usernameOrEmail)
                    ->orWhere('username', $usernameOrEmail)
                    ->first();

                if ($user) {
                    // mengecek password user setelah mengecek username / email
                    if (password_verify($password, $user['password'])) {
                        // jika status user aktif
                        if ($user['status'] == 'aktif') {
                            // Periksa apakah password perlu direset
                            if (!empty($user['password_last_reset'])) {
                                $passwordLastReset = new \DateTime($user['password_last_reset']);
                                $currentDate = $this->date;
                                $interval = $passwordLastReset->diff($currentDate);

                                if ($interval->days > 30) {
                                    return redirect()->to('authentication/lupaPassword')->with('warning', 'Password Anda sudah kadaluarsa. Silakan reset password Anda !');
                                }
                            }

                            // Perbarui kolom terakhir_login
                            $this->m_user->updateData($user['id_user'], ['terakhir_login' => date('Y-m-d H:i:s')]);

                            // mengecek data pengguna
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

                            // jika benar maka tertuju ke halaman dashboard
                            if ($user['id_jabatan'] == 1) {
                                return redirect()->to('admin/dashboard');
                            } elseif ($user['id_jabatan'] == 2) {
                                return redirect()->to('barang-detail');
                            }
                        } elseif ($user['status'] == 'tidak aktif') {
                            $session->setFlashdata('gagal', 'Akun anda dinonaktifkan');
                        }
                    } else {
                        // jika password salah maka muncul notifikasi
                        $session->setFlashdata('validation', ['password' => 'Password yang Anda masukkan salah !']);
                    }
                } else {
                    // jika username salah maka muncul notifikasi
                    $session->setFlashdata('validation', ['username' => 'Username / Email tidak ditemukan !']);
                }
            } else {
                $session->setFlashdata('validation', $this->validator->getErrors());
            }
        }
        // setiap salah maka akan kembali kehalaman login dengan notifkasi gagal
        return redirect()->to('authentication/login')->withInput()->with('gagal', 'Silahkan Login Ulang !');
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
            'title' => 'Lupa Password IKNAventory',
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
            'title' => 'Reset Password IKNAventory',
            'validation' => session()->getFlashdata('validation') ?? [],
            'old_input' => $this->request->getPost(),
        ];

        return view('users/resetPassword', $data);
    }

    public function logout()
    {
        // Menghapus semua data sesi
        $this->session->destroy();

        // Set cookie dengan pesan
        setcookie('logout_message', 'Anda berhasil logout !', time() + 5, "/");

        // Redirect ke login
        return redirect()->to('authentication/login');
    }
}

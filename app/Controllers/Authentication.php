<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\BaseController;

class Authentication extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function updateUser()
    {
        // Check if user is logged in
        if (!session()->has('islogin')) {
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu!');
            return redirect()->back();
        }

        $userId = session()->get('id_user');
        $userData = $this->userModel->find($userId);

        if (!$userData) {
            session()->setFlashdata('error', 'Data pengguna tidak ditemukan!');
            return redirect()->back();
        }

        // Validation rules
        $rules = [
            'nama_lengkap' => [
                'rules' => 'required|min_length[3]|max_length[255]|alpha_space',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                    'min_length' => 'Nama lengkap minimal 3 karakter!',
                    'max_length' => 'Nama lengkap maksimal 255 karakter!',
                    'alpha_space' => 'Nama lengkap hanya boleh berisi huruf dan spasi!'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[3]|max_length[10]|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Username wajib diisi!',
                    'min_length' => 'Username minimal 3 karakter!',
                    'max_length' => 'Username maksimal 10 karakter!',
                    'alpha_numeric_punct' => 'Username hanya boleh berisi huruf, angka, dan underscore!'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi!',
                    'valid_email' => 'Format email tidak valid!'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Nomor telepon wajib diisi!',
                    'numeric' => 'Nomor telepon hanya boleh berisi angka!',
                    'min_length' => 'Nomor telepon minimal 10 digit!',
                    'max_length' => 'Nomor telepon maksimal 15 digit!'
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Pekerjaan wajib diisi!',
                    'min_length' => 'Pekerjaan minimal 3 karakter!',
                    'max_length' => 'Pekerjaan maksimal 100 karakter!'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[10]|max_length[500]',
                'errors' => [
                    'required' => 'Alamat wajib diisi!',
                    'min_length' => 'Alamat minimal 10 karakter!',
                    'max_length' => 'Alamat maksimal 500 karakter!'
                ]
            ],
            'file_profil' => [
                'rules' => 'max_size[file_profil,2048]',
                'errors' => [
                    'max_size' => 'Ukuran foto profil maksimal 2MB!',
                ]
            ],
        ];

        if ($userData['username'] !== $this->request->getPost('username')) {
            $rules['username']['rules'] .= '|is_unique[tb_user.username,id_user,' . $userId . ']';
            $rules['username']['errors']['is_unique'] = 'Username sudah digunakan!';
        }

        if ($userData['email'] !== $this->request->getPost('email')) {
            $rules['email']['rules'] .= '|is_unique[tb_user.email,id_user,' . $userId . ']';
            $rules['email']['errors']['is_unique'] = 'Email sudah terdaftar!';
        }

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Validasi gagal. Harap periksa kembali data Anda.');
            return redirect()->back()->withInput();
        }

        // Prepare update data
        $updateData = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $file = $this->request->getFile('file_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($userData['file_profil']) && file_exists($userData['file_profil'])) {
                @unlink($userData['file_profil']);
            }

            $newName = $file->getRandomName();

            $file->move('file_upload/dokumen/foto-peminjam/', $newName);

            $updateData['file_profil'] = 'file_upload/dokumen/foto-peminjam/' . $newName;
        }

        if (!$this->userModel->update($userId, $updateData)) {
            session()->setFlashdata('error', 'Gagal memperbarui data profil!');
            return redirect()->back()->withInput();
        }

        $updatedData = $this->userModel->find($userId);

        session()->set([
            'nama_lengkap' => $updatedData['nama_lengkap'],
            'username' => $updatedData['username'],
            'email' => $updatedData['email'],
            'no_telepon' => $updatedData['no_telepon'],
            'pekerjaan' => $updatedData['pekerjaan'],
            'alamat' => $updatedData['alamat'],
            'file_profil' => $updatedData['file_profil'],
        ]);

        session()->setFlashdata('pesan', 'Profil berhasil diperbarui !');

        return redirect()->back();
    }

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
            'file_profil' => [
                'rules' => 'uploaded[file_profil]|max_size[file_profil,2048]',
                'errors' => [
                    'uploaded' => 'Foto Wajib Diunggah !',
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                ],
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
            'file_profil' => uploadFile('file_profil', 'dokumen/foto-peminjam/'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'konfirmasi_password' => $this->request->getPost('konfirmasi_password')
        ]);

        session()->setFlashdata('pesan', 'Berhasil Registrasi !');

        return redirect()->to('authentication/login');
    }

    public function login()
    {
        // Jika pengguna sudah login, arahkan kembali dan beri pesan
        if ($this->session->has('islogin')) {
            if ($this->session->get('id_jabatan') == 1) {
                return redirect()->to('admin/dashboard');
            } elseif ($this->session->get('id_jabatan') == 2) {
                // Cek apakah ada slug yang tersimpan (misal setelah klik barang sebelum login)
                $slug = $this->session->get('slug');

                // Jika ada slug yang tersimpan, redirect ke detail barang
                if ($slug) {
                    return redirect()->to('barang-detail/' . $slug);
                } else {
                    // Redirect ke halaman barang secara default
                    return redirect()->to('barang');
                }
            }
        }

        // Jika ini adalah request POST (form login disubmit)
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Validasi input
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Cari user berdasarkan username
            $user = $this->m_user->where('username', $username)->first();

            // Jika user ditemukan dan password cocok
            if ($user && password_verify($password, $user['password'])) {
                // Set session data - MAKE SURE ALL FIELDS ARE INCLUDED
                $this->session->set([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'email' => $user['email'],
                    'pekerjaan' => $user['pekerjaan'],
                    'alamat' => $user['alamat'],
                    'file_profil' => $user['file_profil'],
                    'no_telepon' => $user['no_telepon'],
                    'id_jabatan' => $user['id_jabatan'],
                    'islogin' => true
                ]);

                // Redirect berdasarkan role
                if ($user['id_jabatan'] == 1) {
                    return redirect()->to('admin/dashboard');
                } else {
                    // Redirect regular user (id_jabatan == 2)
                    $slug = $this->session->get('slug');
                    if ($slug) {
                        return redirect()->to('barang-detail/' . $slug);
                    } else {
                        return redirect()->to('barang');
                    }
                }
            } else {
                // Login gagal
                return redirect()->back()->withInput()->with('error', 'Username atau password salah');
            }
        }

        // Tampilkan halaman login (jika bukan POST request)
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
                $usernameOrEmail = $this->request->getPost('username');
                $password = $this->request->getPost('password');

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

                            // mengecek data pengguna - MAKE SURE ALL FIELDS ARE INCLUDED
                            $session->set([
                                'id_user' => $user['id_user'],
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'id_jabatan' => $user['id_jabatan'],
                                'nama_lengkap' => $user['nama_lengkap'],
                                'no_telepon' => $user['no_telepon'],
                                'pekerjaan' => $user['pekerjaan'], // Ensure this is included
                                'alamat' => $user['alamat'], // Ensure this is included
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
                                // Cek apakah ada slug yang tersimpan (misal setelah klik barang sebelum login)
                                $slug = $this->session->get('slug');

                                // Jika ada slug yang tersimpan, redirect ke detail barang
                                if ($slug) {
                                    return redirect()->to('barang-detail/' . $slug);
                                } else {
                                    // Redirect ke halaman barang secara default
                                    return redirect()->to('barang');
                                }
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

        if ($this->request->getVar()) {
            $username = $this->request->getVar('username');

            // Validasi username/email tidak boleh kosong
            if (empty($username)) {
                $err['username'] = "Silahkan masukkan username atau email yang sudah terdaftar !";
            } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $err['username'] = "Format username atau email tidak valid";
            }

            if (empty($err)) {
                $data = $this->m_user->getData($username);

                if (empty($data)) {
                    $err['username'] = "Akun yang kamu masukkan tidak terdaftar !";
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
                return redirect()->to('authentication/lupaPassword')->with('warning', 'Token Sudah Tidak Valid !');
            }
        } else {
            // Jika email atau token kosong, arahkan pengguna ke halaman yang sesuai
            return redirect()->to('authentication/lupaPassword')->with('warning', 'Parameter Yang Dikirimkan Tidak Valid !');
        }

        if ($this->request->getVar()) {
            $rules = [
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi !',
                        'min_length' => 'Kata Sandi Baru harus memiliki panjang minimal 6 karakter !',
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[6]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi !',
                        'min_length' => 'Konfirmasi password minimal 6 karakter !',
                        'matches' => 'Konfirmasi password tidak sama dengan password di atas !'
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
                        session()->setFlashdata('success', 'Password berhasil direset, silahkan login menggunakan password baru anda dan cek email untuk informasi lebih lanjut !');
                    } else {
                        session()->setFlashdata('error', 'Password berhasil direset, tetapi gagal mengirim email !');
                    }

                    return redirect()->to('authentication/login');
                } else {
                    session()->setFlashdata('error', 'Terjadi kesalahan saat mereset password !');
                }
            }
        }

        $data = [
            'title' => 'Reset Password IKNAventory',
            'validation' => session()->getFlashdata('validation') ?? [],
            'old_input' => $this->request->getVar(),
            'email' => $email,
            'token' => $token
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

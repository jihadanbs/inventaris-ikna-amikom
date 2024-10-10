<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PermohonanController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Permohonan',
            'tb_cara_mendapat_salinan_informasi' => $this->m_cara->getAllData(),
            'tb_mendapat' => $this->m_mendapat->getAllData(),
            'tb_memperoleh' => $this->m_memperoleh->getAllData(),
            'tb_lembaga' => $this->m_lembaga->getAllData(),
            'tb_kategori' => $this->m_kategori->getAllData(),
        ], $this->loadCommonData());

        return view('admin/permohonan/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Permohonan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_cara_mendapat_salinan_informasi' => $this->m_cara->getAllData(),
            'tb_mendapat' => $this->m_mendapat->getAllData(),
            'tb_memperoleh' => $this->m_memperoleh->getAllData(),
            'tb_lembaga' => $this->m_lembaga->getAllData(),
            'tb_kategori' => $this->m_kategori->getAllData(),
        ], $this->loadCommonData());

        return view('admin/permohonan/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari request
        $id_kategori = $this->request->getVar('id_kategori');
        $id_lembaga = $this->request->getVar('id_lembaga');
        $nik = $this->request->getVar('nik');
        $nama_pemohon = $this->request->getVar('nama_pemohon');
        $tanggal_pengajuan = $this->request->getVar('tanggal_pengajuan');
        $alamat = $this->request->getVar('alamat');
        $email = $this->request->getVar('email');
        $no_telepon = $this->request->getVar('no_telepon');
        $pekerjaan = $this->request->getVar('pekerjaan');
        $rincian_informasi = $this->request->getVar('rincian_informasi');
        $tujuan = $this->request->getVar('tujuan');
        $id_memperoleh_informasi = $this->request->getVar('id_memperoleh_informasi');
        $id_mendapat_salinan_informasi = $this->request->getVar('id_mendapat_salinan_informasi');
        $id_cara_mendapat_salinan_informasi = $this->request->getVar('id_cara_mendapat_salinan_informasi');

        $nama_kategori = $this->m_pemohon->getNamaKategori($id_kategori);
        $nama_dinas = $this->m_pemohon->getNamaDinas($id_lembaga);

        // Validasi input dasar
        $validationRules = [
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kategori Pengajuan',
                ]
            ],
            'id_memperoleh_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'id_mendapat_salinan_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'id_cara_mendapat_salinan_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Pemohon Tidak Boleh Kosong',
                    'min_length' => 'Nama Lengkap Minimal dari 5 karakter',
                ]
            ],
            'tanggal_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Pengajuan Tidak Boleh Kosong',
                ]
            ],
            'nik' => [
                'rules' => 'required|numeric|min_length[16]|max_length[16]',
                'errors' => [
                    'required' => 'Kolom NIK Tidak Boleh Kosong',
                    'numeric' => 'NIK harus berupa angka',
                    'min_length' => 'NIK harus terdiri dari 16 karakter',
                    'max_length' => 'NIK harus terdiri dari 16 karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong',
                    'valid_email' => 'Email Tidak Valid'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric|trim|max_length[20]',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong',
                    'numeric' => 'No. Telepon harus berupa angka',
                    'max_length' => 'Inputan tidak boleh melebihi 20 karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Alamat Tidak Boleh Kosong',
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Pekerjaan Tidak Boleh Kosong'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tujuan Penggunaan Informasi Tidak Boleh Kosong'
                ]
            ],
            'rincian_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Rincian Informasi Tidak Boleh Kosong'
                ]
            ],
        ];

        // Tambahkan validasi untuk file jika kategori bukan Perorangan
        if ($id_kategori != 'Perorangan') {
            $validationRules = array_merge($validationRules, [
                'id_lembaga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan Pilih SKPD Tujuan',
                    ]
                ],
            ]);
        }

        // Tambahkan validasi untuk file jika kategori bukan Kelompok Orang
        if ($id_kategori != 'Kelompok Orang') {
            $validationRules = array_merge($validationRules, [
                'id_lembaga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan Pilih SKPD Tujuan',
                    ]
                ],
            ]);
        }


        // Validasi input
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Upload file yang diperlukan
        $uploadFileKtp = uploadFilePDF('file_ktp', 'permohonan_informasi_publik/file_ktp/');
        $uploadFileKuasa = $id_kategori != 'Perorangan' ? uploadFilePDF('surat_kuasa', 'permohonan_informasi_publik/file_surat_kuasa/') : null;
        $uploadFileNotaris = $id_kategori != 'Perorangan' ? uploadFilePDF('akta_notaris_lembaga', 'permohonan_informasi_publik/file_akta_notaris_lembaga/') : null;
        $uploadFilePendirianLembaga = $id_kategori != 'Perorangan' ? uploadFilePDF('file_pendirian_lembaga', 'permohonan_informasi_publik/file_pendirian_lembaga/') : null;
        $uploadFileKesbangpol = $id_kategori != 'Perorangan' ? uploadFilePDF('surat_kesbangpol', 'permohonan_informasi_publik/file_kesbangpol/') : null;

        // Generate kode permohonan
        $kode_permohonan = $this->m_pemohon->generateKodePermohonan();

        // Simpan data ke database
        $data = [
            'id_kategori' => $id_kategori,
            'id_lembaga' => $id_kategori != 'Perorangan' ? $id_lembaga : null,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'alamat' => $alamat,
            'email' => $email,
            'kode_permohonan' => $kode_permohonan,
            'no_telepon' => $no_telepon,
            'pekerjaan' => $pekerjaan,
            'rincian_informasi' => $rincian_informasi,
            'tujuan' => $tujuan,
            'id_memperoleh_informasi' => $id_memperoleh_informasi,
            'id_mendapat_salinan_informasi' => $id_mendapat_salinan_informasi,
            'id_cara_mendapat_salinan_informasi' => $id_cara_mendapat_salinan_informasi,
            'file_ktp' => $uploadFileKtp,
            'surat_kuasa' => $uploadFileKuasa,
            'akta_notaris_lembaga' => $uploadFileNotaris,
            'file_pendirian_lembaga' => $uploadFilePendirianLembaga,
            'surat_kesbangpol' => $uploadFileKesbangpol,
        ];

        // Buat template email dengan data
        $emailData = [
            'kode_permohonan' => $kode_permohonan,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'nama_kategori' => $nama_kategori,
            'nama_dinas' => $nama_dinas,
        ];

        // Load view template email
        $emailBody = view('Views/gmail/permohonan_info_publik.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Permohonan Informasi Publik');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Permohonan Berhasil Diajukan Dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi. Mungkin Email Tersebut Tidak Aktif.');
        }

        // Simpan data ke database
        $this->m_pemohon->save($data);

        return redirect()->to('/admin/permohonan');
    }

    public function kirim()
    {
        // Ambil data dari request
        $id_kategori = $this->request->getVar('id_kategori');
        $id_lembaga = $this->request->getVar('id_lembaga');
        $nik = $this->request->getVar('nik');
        $nama_pemohon = $this->request->getVar('nama_pemohon');
        $tanggal_pengajuan = $this->request->getVar('tanggal_pengajuan');
        $alamat = $this->request->getVar('alamat');
        $email = $this->request->getVar('email');
        $no_telepon = $this->request->getVar('no_telepon');
        $pekerjaan = $this->request->getVar('pekerjaan');
        $rincian_informasi = $this->request->getVar('rincian_informasi');
        $tujuan = $this->request->getVar('tujuan');
        $id_memperoleh_informasi = $this->request->getVar('id_memperoleh_informasi');
        $id_mendapat_salinan_informasi = $this->request->getVar('id_mendapat_salinan_informasi');
        $id_cara_mendapat_salinan_informasi = $this->request->getVar('id_cara_mendapat_salinan_informasi');

        $nama_kategori = $this->m_pemohon->getNamaKategori($id_kategori);
        $nama_dinas = $this->m_pemohon->getNamaDinas($id_lembaga);

        // Validasi input dasar
        $validationRules = [
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kategori Pengajuan',
                ]
            ],
            'id_memperoleh_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'id_mendapat_salinan_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'id_cara_mendapat_salinan_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih ',
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Nama Pemohon Tidak Boleh Kosong',
                    'min_length' => 'Nama Lengkap Minimal dari 5 karakter',
                ]
            ],
            'tanggal_pengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Pengajuan Tidak Boleh Kosong',
                ]
            ],
            'nik' => [
                'rules' => 'required|numeric|min_length[16]|max_length[16]',
                'errors' => [
                    'required' => 'Kolom NIK Tidak Boleh Kosong',
                    'numeric' => 'NIK harus berupa angka',
                    'min_length' => 'NIK harus terdiri dari 16 karakter',
                    'max_length' => 'NIK harus terdiri dari 16 karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong',
                    'valid_email' => 'Email Tidak Valid'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric|trim|max_length[20]',
                'errors' => [
                    'required' => 'Kolom No. Telepon Anda Tidak Boleh Kosong',
                    'numeric' => 'No. Telepon harus berupa angka',
                    'max_length' => 'Inputan tidak boleh melebihi 20 karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Alamat Tidak Boleh Kosong',
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Pekerjaan Tidak Boleh Kosong'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tujuan Penggunaan Informasi Tidak Boleh Kosong'
                ]
            ],
            'rincian_informasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Rincian Informasi Tidak Boleh Kosong'
                ]
            ],
        ];

        // Tambahkan validasi untuk file jika kategori bukan Perorangan
        if ($id_kategori != 'Perorangan') {
            $validationRules = array_merge($validationRules, [
                'id_lembaga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan Pilih SKPD Tujuan',
                    ]
                ],
            ]);
        }

        // Tambahkan validasi untuk file jika kategori bukan Kelompok Orang
        if ($id_kategori != 'Kelompok Orang') {
            $validationRules = array_merge($validationRules, [
                'id_lembaga' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan Pilih SKPD Tujuan',
                    ]
                ],
            ]);
        }


        // Validasi input
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Upload file yang diperlukan
        $uploadFileKtp = uploadFilePDF('file_ktp', 'permohonan_informasi_publik/file_ktp/');
        $uploadFileKuasa = $id_kategori != 'Perorangan' ? uploadFilePDF('surat_kuasa', 'permohonan_informasi_publik/file_surat_kuasa/') : null;
        $uploadFileNotaris = $id_kategori != 'Perorangan' ? uploadFilePDF('akta_notaris_lembaga', 'permohonan_informasi_publik/file_akta_notaris_lembaga/') : null;
        $uploadFilePendirianLembaga = $id_kategori != 'Perorangan' ? uploadFilePDF('file_pendirian_lembaga', 'permohonan_informasi_publik/file_pendirian_lembaga/') : null;
        $uploadFileKesbangpol = $id_kategori != 'Perorangan' ? uploadFilePDF('surat_kesbangpol', 'permohonan_informasi_publik/file_kesbangpol/') : null;

        // Generate kode permohonan
        $kode_permohonan = $this->m_pemohon->generateKodePermohonan();

        // Simpan data ke database
        $data = [
            'id_kategori' => $id_kategori,
            'id_lembaga' => $id_kategori != 'Perorangan' ? $id_lembaga : null,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'alamat' => $alamat,
            'email' => $email,
            'kode_permohonan' => $kode_permohonan,
            'no_telepon' => $no_telepon,
            'pekerjaan' => $pekerjaan,
            'rincian_informasi' => $rincian_informasi,
            'tujuan' => $tujuan,
            'id_memperoleh_informasi' => $id_memperoleh_informasi,
            'id_mendapat_salinan_informasi' => $id_mendapat_salinan_informasi,
            'id_cara_mendapat_salinan_informasi' => $id_cara_mendapat_salinan_informasi,
            'file_ktp' => $uploadFileKtp,
            'surat_kuasa' => $uploadFileKuasa,
            'akta_notaris_lembaga' => $uploadFileNotaris,
            'file_pendirian_lembaga' => $uploadFilePendirianLembaga,
            'surat_kesbangpol' => $uploadFileKesbangpol,
        ];

        // Buat template email dengan data
        $emailData = [
            'kode_permohonan' => $kode_permohonan,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'nama_kategori' => $nama_kategori,
            'nama_dinas' => $nama_dinas,
        ];

        // Load view template email
        $emailBody = view('Views/gmail/permohonan_info_publik.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Permohonan Informasi Publik');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Permohonan Berhasil Diajukan Dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi.');
        }

        // Simpan data ke database
        $this->m_pemohon->save($data);

        return redirect()->to('/formpermohonan');
    }

    public function cek_data($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $this->m_pemohon->updateStatusBaca($id_pemohon);

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data',
            'pemohon' => $this->m_pemohon->getAll($id_pemohon),
            'memperoleh' => $this->m_pemohon->getMemperolehById($id_pemohon),
            'mendapat' => $this->m_pemohon->getMendapatById($id_pemohon),
            'cara_mendapat' => $this->m_pemohon->getCaraMendapatById($id_pemohon),
            'dokumen' => $this->m_pemohon->getDokumenById($id_pemohon),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/permohonan/cek_data', $data);
    }

    public function diproses($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Proses Permohonan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pemohon' => $this->m_pemohon->getPemohon($id_pemohon),
            'id_pemohon' => $id_pemohon,
        ], $this->loadCommonData());

        return view('admin/permohonan/diproses', $data);
    }

    public function proses($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari form
        $tanggal_diproses = $this->request->getVar('tanggal_diproses');
        $catatan = $this->request->getVar('catatan');

        // Validasi input
        if (!$this->validate([
            'tanggal_diproses' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Pemrosesan Tidak Boleh Kosong',
                ]
            ],
            'catatan' => [
                'rules' => 'required|trim|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Catatan Pemrosesan Tidak Boleh Kosong',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter.',
                    'max_length' => 'Catatan tidak boleh melebihi 255 karakter.',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/permohonan/diproses/' . $id_pemohon)->withInput();
        }

        // Ambil nama pemohon dari database
        $tb_pemohon = $this->m_pemohon->getAllSorted_1($id_pemohon);
        if (!$tb_pemohon) {
            session()->setFlashdata('gagal', 'Data pemohon tidak ditemukan.');
            return redirect()->to('/admin/permohonan');
        }

        $nama_pemohon = $tb_pemohon->nama_pemohon;
        $email = $tb_pemohon->email;
        $nama_kategori = $tb_pemohon->nama_kategori;
        $nama_dinas = $tb_pemohon->nama_dinas;
        $nik = $tb_pemohon->nik;
        $tanggal_pengajuan = $tb_pemohon->tanggal_pengajuan;
        $alamat = $tb_pemohon->alamat;
        $no_telepon = $tb_pemohon->no_telepon;
        $kode_permohonan = $tb_pemohon->kode_permohonan;
        $tujuan = $tb_pemohon->tujuan;
        $rincian_informasi = $tb_pemohon->rincian_informasi;

        $data = [
            'id_pemohon' => $id_pemohon,
            'tanggal_diproses' => $tanggal_diproses,
            'catatan' => $catatan,
            'status' => 'Diproses',
        ];

        // Buat template email dengan data
        $emailData = [
            'kode_permohonan' => $kode_permohonan,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'nama_kategori' => $nama_kategori,
            'nama_dinas' => $nama_dinas,
            'alamat' => $alamat,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'tanggal_diproses' => $tanggal_diproses,
            'rincian_informasi' => $rincian_informasi,
            'tujuan' => $tujuan,
            'catatan' => $catatan
        ];

        // Load view template email
        $emailBody = view('Views/gmail/permohonan_diproses_gmail.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Permohonan Informasi Publik "Diproses"');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Pemrosesan Permohonan</strong> ' . htmlspecialchars($nama_pemohon) . ' dan pengiriman email ke alamat ' . htmlspecialchars($email) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($email) . ' Silakan Coba Lagi. Atau Mungkin Alamat Email Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_pemohon->save($data);


        return redirect()->to('/admin/permohonan');
    }

    public function ditolak($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tolak Permohonan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pemohon' => $this->m_pemohon->getPemohon($id_pemohon),
            'id_pemohon' => $id_pemohon,
        ], $this->loadCommonData());

        return view('admin/permohonan/ditolak', $data);
    }

    public function reject($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari form
        $tanggal_ditolak = $this->request->getVar('tanggal_ditolak');
        $catatan = $this->request->getVar('catatan');

        // Validasi input
        if (!$this->validate([
            'catatan' => [
                'rules' => "required|trim|min_length[5]|max_length[255]",
                'errors' => [
                    'required' => 'Kolom Catatan Penolakan Tidak Boleh Kosong',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter.',
                    'max_length' => 'Catatan tidak boleh melebihi 255 karakter.',
                ]
            ],
            'tanggal_ditolak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Penolakan Tidak Boleh Kosong',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/permohonan/ditolak/' . $id_pemohon)->withInput();
        }

        // Ambil nama pemohon dari database
        $tb_pemohon = $this->m_pemohon->getAllSorted_1($id_pemohon);
        if (!$tb_pemohon) {
            session()->setFlashdata('gagal', 'Data pemohon tidak ditemukan.');
            return redirect()->to('/admin/permohonan');
        }

        $nama_pemohon = $tb_pemohon->nama_pemohon;
        $email = $tb_pemohon->email;
        $nama_kategori = $tb_pemohon->nama_kategori;
        $nama_dinas = $tb_pemohon->nama_dinas;
        $nik = $tb_pemohon->nik;
        $tanggal_pengajuan = $tb_pemohon->tanggal_pengajuan;
        $alamat = $tb_pemohon->alamat;
        $no_telepon = $tb_pemohon->no_telepon;
        $kode_permohonan = $tb_pemohon->kode_permohonan;
        $tujuan = $tb_pemohon->tujuan;
        $rincian_informasi = $tb_pemohon->rincian_informasi;

        $data = [
            'id_pemohon' => $id_pemohon,
            'tanggal_ditolak' => $tanggal_ditolak,
            'catatan' => $catatan,
            'status' => 'Ditolak',
        ];

        // Buat template email dengan data
        $emailData = [
            'kode_permohonan' => $kode_permohonan,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'nama_kategori' => $nama_kategori,
            'nama_dinas' => $nama_dinas,
            'alamat' => $alamat,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'tanggal_ditolak' => $tanggal_ditolak,
            'rincian_informasi' => $rincian_informasi,
            'tujuan' => $tujuan,
            'catatan' => $catatan
        ];

        // Load view template email
        $emailBody = view('Views/gmail/permohonan_ditolak_gmail.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Permohonan Informasi Publik "Ditolak"');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Penolakan Permohonan</strong> ' . htmlspecialchars($nama_pemohon) . ' dan pengiriman email ke alamat ' . htmlspecialchars($email) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($email) . ' Silakan Coba Lagi. Atau Mungkin Alamat Email Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_pemohon->save($data);

        return redirect()->to('/admin/permohonan');
    }

    public function diberikan($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Pemberian Permohonan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'pemohon' => $this->m_pemohon->getPemohon($id_pemohon),
            'id_pemohon' => $id_pemohon,
        ], $this->loadCommonData());

        return view('admin/permohonan/diberikan', $data);
    }

    public function berikan($id_pemohon)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari form
        $tanggal_diberikan = $this->request->getVar('tanggal_diberikan');
        $catatan = $this->request->getVar('catatan');

        // Validasi input
        if (!$this->validate([
            'catatan' => [
                'rules' => "required|trim|min_length[5]|max_length[255]",
                'errors' => [
                    'required' => 'Kolom Catatan Pemberian Tidak Boleh Kosong',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter.',
                    'max_length' => 'Catatan tidak boleh melebihi 255 karakter.',
                ]
            ],
            'tanggal_diberikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Tanggal Pemberian Tidak Boleh Kosong',
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/permohonan/diberikan/' . $id_pemohon)->withInput();
        }

        $uploadFileSetuju = uploadFileUmum('file_setuju_1', 'permohonan_informasi_publik/file_diberikan/');

        // Ambil nama pemohon dari database
        $tb_pemohon = $this->m_pemohon->getAllSorted_1($id_pemohon);
        if (!$tb_pemohon) {
            session()->setFlashdata('gagal', 'Data pemohon tidak ditemukan.');
            return redirect()->to('/admin/permohonan');
        }

        $nama_pemohon = $tb_pemohon->nama_pemohon;
        $email = $tb_pemohon->email;
        $nama_kategori = $tb_pemohon->nama_kategori;
        $nama_dinas = $tb_pemohon->nama_dinas;
        $nik = $tb_pemohon->nik;
        $tanggal_pengajuan = $tb_pemohon->tanggal_pengajuan;
        $alamat = $tb_pemohon->alamat;
        $no_telepon = $tb_pemohon->no_telepon;
        $kode_permohonan = $tb_pemohon->kode_permohonan;
        $tujuan = $tb_pemohon->tujuan;
        $rincian_informasi = $tb_pemohon->rincian_informasi;

        $data = [
            'id_pemohon' => $id_pemohon,
            'tanggal_diberikan' => $tanggal_diberikan,
            'catatan' => $catatan,
            'status' => 'Diberikan',
            'file_setuju_1' => $uploadFileSetuju
        ];

        // Buat template email dengan data
        $emailData = [
            'kode_permohonan' => $kode_permohonan,
            'nik' => $nik,
            'nama_pemohon' => $nama_pemohon,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'nama_kategori' => $nama_kategori,
            'nama_dinas' => $nama_dinas,
            'alamat' => $alamat,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'tanggal_diberikan' => $tanggal_diberikan,
            'rincian_informasi' => $rincian_informasi,
            'tujuan' => $tujuan,
            'catatan' => $catatan,
            'file_setuju_1' => base_url($uploadFileSetuju),
        ];

        // Load view template email
        $emailBody = view('Views/gmail/permohonan_diberikan_gmail.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email);
        $this->email->setSubject('Permohonan Informasi Publik "Diberikan"');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Pemberian Permohonan</strong> ' . htmlspecialchars($nama_pemohon) . ' dan pengiriman email ke alamat ' . htmlspecialchars($email) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($email) . ' Silakan Coba Lagi. Atau Mungkin Alamat Email Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_pemohon->save($data);

        return redirect()->to('/admin/permohonan');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mendapatkan id_pemohon dari input POST
        $id_pemohon = $this->request->getPost('id_pemohon');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Ambil data terkait dari database berdasarkan id_pemohon
            $dataFiles = $this->m_pemohon->getFilesByPemohonId($id_pemohon);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk diberikan ke id_pemohon.');
            }

            // Hapus setiap file yang ditemukan di database
            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        unlink($fullFilePath);
                    }
                }
            }

            // Hapus data di database
            $this->m_pemohon->deleteByPemohonId($id_pemohon);

            // Selesaikan transaksi
            $this->db->transComplete();

            // Periksa apakah transaksi berhasil
            if ($this->db->transStatus() === false) {
                // Transaksi gagal, rollback perubahan
                $this->db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            // Transaksi berhasil, commit perubahan
            $this->db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            // Transaksi gagal, rollback perubahan
            $this->db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mendapatkan id_pemohon dari input POST
        $id_pemohon = $this->request->getPost('id_pemohon');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Ambil data terkait dari database berdasarkan id_pemohon
            $dataFiles = $this->m_pemohon->getFilesByPemohonId($id_pemohon);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk diberikan ke id_pemohon.');
            }

            // Hapus setiap file yang ditemukan di database
            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        unlink($fullFilePath);
                    }
                }
            }

            // Hapus data di database
            $this->m_pemohon->deleteByPemohonId($id_pemohon);

            // Selesaikan transaksi
            $this->db->transComplete();

            // Periksa apakah transaksi berhasil
            if ($this->db->transStatus() === false) {
                // Transaksi gagal, rollback perubahan
                $this->db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            // Transaksi berhasil, commit perubahan
            $this->db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            // Transaksi gagal, rollback perubahan
            $this->db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function totalData()
    {
        $totalData = $this->m_pemohon->getTotalPemohon();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function totalByStatus($status)
    {
        $total = $this->m_pemohon->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }

    public function getPemohonData($kode_permohonan)
    {
        // Ambil data dari tabel tb_pemohon
        $tb_pemohon = $this->m_pemohon->getKode($kode_permohonan);

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($tb_pemohon);
    }
}

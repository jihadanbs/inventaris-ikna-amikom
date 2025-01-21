<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($page = 1)
    {

        $perPage = 8; // Jumlah data per halaman
        $offset = ($page - 1) * $perPage;
        // Ambil data dari database
        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);


        // Kirim data ke view
        $data = [
            'title' => 'Galeri Kegiatan',
            'galeriKegiatan' => $galeriKegiatan,
            'pengurus' => $this->fotoPengurusModel->findAll(),
        ];


        return view('index', $data);
    }

    public function about()
    {


        $data = [];


        return view('about', $data);
    }

    public function galeri($page = 1)
    {
        $perPage = 8;
        $offset = ($page - 1) * $perPage;

        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);
        $totalData = $this->galeriKegiatanModel->countAll();

        $data = [
            'title' => 'Galeri Kegiatan',
            'galeriKegiatan' => $galeriKegiatan,
            'currentPage' => $page,
            'totalPages' => ceil($totalData / $perPage),
        ];

        return view('galeri', $data);
    }

    public function kontak()
    {
        $allFaqs = $this->m_faq->getAllSorted();
        $faqCount = count($allFaqs);

        $data = [
            'faqs' => $allFaqs,
            'faqCount' => $faqCount
        ];

        return view('kontak', $data);
    }

    public function barang()
    {
        $perPage = 12;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $perPage;

        $total = $this->m_pinjam_barang->countAllTampil();

        $pager = service('pager');
        $pager->setPath('barang');

        $data = [
            'tb_setting_pinjam_barang' => $this->m_pinjam_barang->getTampil($perPage, $offset),
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page
        ];

        $pager->makeLinks($page, $perPage, $total);

        return view('barang', $data);
    }

    public function barangdetail($slug)
    {
        $data = [
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
        ];

        return view('barang-detail', $data);
    }

    public function ajukan()
    {
        try {
            // Atur rules validasi
            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap harus diisi'
                    ]
                ],
                'pekerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan harus diisi'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Format email tidak valid'
                    ]
                ],
                'no_telepon' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'No. Telepon harus diisi',
                        'numeric' => 'No. Telepon harus berupa angka'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi'
                    ]
                ],
                'kepentingan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kepentingan harus diisi'
                    ]
                ]
            ];

            // Jalankan validasi
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Jika validasi sukses, lanjutkan dengan proses data
            $data = [
                'id_barang' => $this->request->getPost('id_barang'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'email' => $this->request->getPost('email'),
                'no_telepon' => $this->request->getPost('no_telepon'),
                'alamat' => $this->request->getPost('alamat'),
                'kepentingan' => $this->request->getPost('kepentingan'),
            ];

            // Generate kode peminjaman
            $kodePeminjaman = $this->generateKodePeminjaman(
                $data['no_telepon'],
                $data['nama_lengkap']
            );

            // Tambah kode peminjaman dan status ke data
            $data['kode_peminjaman'] = $kodePeminjaman;
            $data['status'] = 'pending';
            $data['tanggal_pengajuan'] = date('Y-m-d H:i:s');

            // Insert data
            if (!$this->m_user_peminjam->insert($data)) {
                return redirect()->back()->withInput()
                    ->with('errors', $this->m_user_peminjam->errors());
            }

            session()->setFlashdata('pesan', 'Pengajuan berhasil dikirim ! Kode peminjaman Anda: ' . $kodePeminjaman);
            return redirect()->back();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return redirect()->back()->withInput()
                ->with('errors', ['system' => 'Terjadi kesalahan sistem. Silakan coba lagi.']);
        }
    }

    // Sweatalert
    // public function ajukan()
    // {
    //     try {
    //         // Atur rules validasi
    //         $rules = [
    //             'nama_lengkap' => [
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => 'Nama lengkap harus diisi !'
    //                 ]
    //             ],
    //             'pekerjaan' => [
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => 'Pekerjaan harus diisi !'
    //                 ]
    //             ],
    //             'email' => [
    //                 'rules' => 'required|valid_email',
    //                 'errors' => [
    //                     'required' => 'Email harus diisi !',
    //                     'valid_email' => 'Format email tidak valid !'
    //                 ]
    //             ],
    //             'no_telepon' => [
    //                 'rules' => 'required|numeric',
    //                 'errors' => [
    //                     'required' => 'No. Telepon harus diisi !',
    //                     'numeric' => 'No. Telepon harus berupa angka !'
    //                 ]
    //             ],
    //             'alamat' => [
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => 'Alamat harus diisi !'
    //                 ]
    //             ],
    //             'kepentingan' => [
    //                 'rules' => 'required|min_length[10]',
    //                 'errors' => [
    //                     'required' => 'Kepentingan harus diisi !',
    //                     'min_length' => 'Kepentingan minimal 10 karakter kata !'
    //                 ]
    //             ]
    //         ];

    //         // Jalankan validasi
    //         if (!$this->validate($rules)) {
    //             // Set flashdata untuk alert jika gagal validasi
    //             session()->setFlashdata('gagal', 'Ada beberapa kesalahan dalam pengisian formulir.');
    //             return $this->response->setJSON([
    //                 'errors' => $this->validator->getErrors()
    //             ]);
    //         }

    //         // Proses data
    //         $data = [
    //             'id_barang' => $this->request->getPost('id_barang'),
    //             'nama_lengkap' => $this->request->getPost('nama_lengkap'),
    //             'pekerjaan' => $this->request->getPost('pekerjaan'),
    //             'email' => $this->request->getPost('email'),
    //             'no_telepon' => $this->request->getPost('no_telepon'),
    //             'alamat' => $this->request->getPost('alamat'),
    //             'kepentingan' => $this->request->getPost('kepentingan'),
    //         ];

    //         // Generate kode peminjaman
    //         $kodePeminjaman = $this->generateKodePeminjaman(
    //             $data['no_telepon'],
    //             $data['nama_lengkap']
    //         );

    //         $data['kode_peminjaman'] = $kodePeminjaman;
    //         $data['status'] = 'pending';
    //         $data['tanggal_pengajuan'] = date('Y-m-d H:i:s');

    //         if (!$this->m_user_peminjam->insert($data)) {
    //             // Set flashdata jika insert gagal
    //             return $this->response->setJSON([
    //                 'status' => 'error',
    //                 'pesan' => 'Pengajuan gagal dikirim. Silakan coba lagi.'
    //             ]);
    //         }

    //         // Set flashdata untuk pesan sukses
    //         session()->setFlashdata('pesan', 'Pengajuan berhasil dikirim. Kode peminjaman Anda: ' . $kodePeminjaman);
    //         return $this->response->setJSON([
    //             'status' => 'success',
    //             'pesan' => 'Pengajuan berhasil dikirim. Kode peminjaman Anda: ' . $kodePeminjaman
    //         ]);
    //     } catch (\Exception $e) {
    //         log_message('error', '[ERROR] {exception}', ['exception' => $e]);
    //         // Set flashdata untuk pesan error umum
    //         session()->setFlashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
    //         return $this->response->setJSON([
    //             'status' => 'error',
    //             'pesan' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
    //         ]);
    //     }
    // }

    private function generateKodePeminjaman($noTelepon, $namaLengkap)
    {
        $phoneLast4 = substr($noTelepon, -4);
        $nameFirst3 = strtoupper(substr($namaLengkap, 0, 3));
        $timestamp = date('Ymd');
        $random = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        return $nameFirst3 . $phoneLast4 . $timestamp . $random;
    }
}

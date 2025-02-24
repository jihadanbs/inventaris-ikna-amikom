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
        // Simpan slug ke sesi kalau pengguna belum login
        if (!$this->session->has('islogin')) {
            $this->session->set('slug', $slug);
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        $data = [
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
        ];

        return view('barang-detail', $data);
    }

    public function keranjang_barang()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $id_user = session()->get('id_user');

        $data = [
            'id_user' => $id_user
        ];

        return view('keranjang-barang', $data);
    }

    public function ajukanPeminjaman()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $json = $this->request->getJSON();
        $id_barang = $json->id_barang;
        $slug = $json->slug;

        // Buat data peminjaman baru
        $dataPeminjaman = [
            'id_barang' => $id_barang,
            'total_dipinjam' => 1,
            'slug' => $slug,
            'status' => 'keranjang',
            'tanggal_pengajuan' => date('Y-m-d H:i:s')
        ];

        $this->m_peminjaman_barang->insert($dataPeminjaman);

        // Update stok barang
        $this->m_barang->where('id_barang', $id_barang)
            ->set('jumlah_dipinjam', 'jumlah_dipinjam + 1', false)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Barang berhasil diajukan'
        ]);
    }

    public function masukKeranjang()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        // Ambil data JSON yang dikirim
        $json = $this->request->getJSON();
        $id_barang = $json->id_barang;
        $slug = $json->slug;

        // Cek apakah barang sudah ada di keranjang
        $existing = $this->m_peminjaman_barang
            ->where([
                'id_barang' => $id_barang,
                'status' => 'keranjang'
            ])
            ->first();

        if ($existing) {
            // Update quantity
            $this->m_peminjaman_barang->update($existing->id_peminjaman, [
                'total_dipinjam' => $existing->total_dipinjam + 1
            ]);
        } else {
            // Buat baru
            $dataPeminjaman = [
                'id_barang' => $id_barang,
                'total_dipinjam' => 1,
                'slug' => $slug,
                'status' => 'keranjang',
                'tanggal_pengajuan' => date('Y-m-d H:i:s')
            ];

            $this->m_peminjaman_barang->insert($dataPeminjaman);
        }

        // Update stok barang
        $this->m_barang->where('id_barang', $id_barang)
            ->set('jumlah_dipinjam', 'jumlah_dipinjam + 1', false)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Barang telah ditambahkan ke keranjang'
        ]);
    }

    public function simpanPeminjaman()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        $rules = [
            'kepentingan' => 'required',
            'dokumen_jaminan' => 'uploaded[dokumen_jaminan]|max_size[dokumen_jaminan,2048]|ext_in[dokumen_jaminan,pdf,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil file
        $file = $this->request->getFile('dokumen_jaminan');
        $fileName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/jaminan', $fileName);

        // Simpan data peminjaman
        $selectedItems = json_decode($this->request->getPost('selectedItems'), true);

        foreach ($selectedItems as $item) {
            $dataPeminjaman = [
                'id_barang' => $item['id_barang'],
                'total_dipinjam' => $item['quantity'],
                'kepentingan' => $this->request->getPost('kepentingan'),
                'dokumen_jaminan' => $fileName,
                'status' => 'pending',
                'tanggal_pengajuan' => date('Y-m-d H:i:s')
            ];

            $this->m_peminjaman_barang->insert($dataPeminjaman);

            // Update stok barang
            $this->m_barang->where('id_barang', $item['id_barang'])
                ->set('jumlah_dipinjam', 'jumlah_dipinjam + ' . $item['quantity'], false)
                ->update();
        }

        // Bersihkan keranjang di session storage menggunakan JavaScript
        return redirect()->to('riwayat-peminjaman')->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    public function cek_barang()
    {
        return view('cek_barang');
    }

    public function cek_resi()
    {
        $kode_peminjaman = $this->request->getPost('kode_peminjaman');
        if (!empty($kode_peminjaman)) {
            $result = $this->m_user_peminjam->getByKodePeminjaman($kode_peminjaman);

            return view('cek_barang', [
                'result' => $result,
                'searched' => true,
                'kode_peminjaman' => $kode_peminjaman
            ]);
        }

        return view('cek_barang', [
            'result' => null,
            'searched' => true,
            'kode_peminjaman' => null
        ]);
    }

    public function ajukan()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        try {
            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap harus diisi !'
                    ]
                ],
                'total_dipinjam' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Total pinjam harus diisi !',
                        'numeric' => 'Total pinjam harus berupa angka !',
                    ]
                ],
                'pekerjaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pekerjaan harus diisi !'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi !',
                        'valid_email' => 'Format email tidak valid !'
                    ]
                ],
                'no_telepon' => [
                    'rules' => 'required|numeric|check_no_telepon',
                    'errors' => [
                        'required' => 'No. Telepon harus diisi !',
                        'numeric' => 'No. Telepon harus berupa angka !',
                        'check_no_telepon' => 'No. Telepon tidak boleh diawali dengan "62", gunakan angka "0" sebagai pengganti !'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi !'
                    ]
                ],
                'kepentingan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kepentingan harus diisi !'
                    ]
                ]
            ];

            // Jalankan validasi
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Ambil data stok barang
            $idBarang = $this->request->getPost('id_barang');
            $stokBarang = $this->m_barang_baik->where('id_barang', $idBarang)->first();

            if (!$stokBarang) {
                return redirect()->back()->withInput()
                    ->with('errors', ['id_barang' => 'Barang tidak ditemukan!']);
            }

            $jumlahTotalBaik = $stokBarang['jumlah_total_baik'];
            $totalDipinjam = $this->request->getPost('total_dipinjam');

            // Validasi jumlah barang yang dipinjam
            if ($totalDipinjam > $jumlahTotalBaik) {
                return redirect()->back()->withInput()
                    ->with('errors', ['total_dipinjam' => 'Total barang yang dipinjam melebihi stok unit yang tersedia !']);
            }

            // Format nomor telepon
            $no_telepon = $this->request->getPost('no_telepon');
            $formatted_phone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $no_telepon));

            // Jika validasi sukses, lanjutkan dengan proses data
            $data = [
                'id_barang' => $idBarang,
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'slug' => $this->generateUniqueSlug($this->request->getPost('nama_lengkap')),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'email' => $this->request->getPost('email'),
                'no_telepon' => $no_telepon,
                'alamat' => $this->request->getPost('alamat'),
                'kepentingan' => $this->request->getPost('kepentingan'),
                'total_dipinjam' => $totalDipinjam,
                'kode_peminjaman' => $this->generateKodePeminjaman($no_telepon, $this->request->getPost('nama_lengkap')),
                'status' => 'Belum Diproses',
                'tanggal_pengajuan' => date('Y-m-d H:i:s')
            ];

            // Insert data peminjaman
            if (!$this->m_user_peminjam->insert($data)) {
                return redirect()->back()->withInput()
                    ->with('errors', $this->m_user_peminjam->errors());
            }

            // Update jumlah stok barang
            $this->m_barang_baik->update($idBarang, [
                'jumlah_total_baik' => $jumlahTotalBaik - $totalDipinjam
            ]);

            // Ambil data jumlah dipinjam yang sudah ada
            $currentBorrow = $this->m_barang->where('id_barang', $idBarang)->first();
            $existingBorrowed = $currentBorrow['jumlah_dipinjam'];

            // Update jumlah dipinjam dengan menambahkan nilai yang sudah ada
            $this->m_barang->update($idBarang, [
                'jumlah_dipinjam' => $existingBorrowed + $totalDipinjam
            ]);

            // Siapkan pesan WhatsApp
            $message = "
            
*Yth. {$data['nama_lengkap']}*

Dokumentasi peminjaman barang dengan detail:

*Kode Peminjaman*: {$data['kode_peminjaman']}
*Total Dipinjam*: {$data['total_dipinjam']} unit
*Tanggal Pengajuan*: {$data['tanggal_pengajuan']}
*Kepentingan*: {$data['kepentingan']}

Silakan simpan kode peminjaman ini untuk keperluan cek data barang.
Kami akan segera memproses pengajuan Anda.

Terima kasih,
*IKNA AMIKOM YOGYAKARTA*
        ";

            // Encode pesan untuk URL
            $encoded_message = urlencode($message);

            // Buat link WhatsApp
            $whatsapp_link = "https://api.whatsapp.com/send/?phone={$formatted_phone}&text={$encoded_message}&type=phone_number&app_absent=0";

            // Simpan link WhatsApp ke session untuk digunakan di view
            session()->setFlashdata('whatsapp_link', $whatsapp_link);
            session()->setFlashdata('pesan', 'Pengajuan berhasil dikirim! Kode peminjaman Anda: <strong style="color: black;">' . esc($data['kode_peminjaman']) . '</strong>');

            return redirect()->back();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return redirect()->back()->withInput()
                ->with('errors', ['system' => 'Terjadi kesalahan sistem, Silakan coba lagi!']);
        }
    }

    // Fungsi untuk generate unique slug
    private function generateUniqueSlug($nama_lengkap)
    {
        // Buat slug dasar
        $baseSlug = url_title($nama_lengkap, '-', true);
        $slug = $baseSlug;
        $counter = 1;

        // Cek apakah slug sudah ada di database
        while ($this->m_user_peminjam->where('slug', $slug)->first()) {
            // Jika ada, tambahkan timestamp atau counter
            $slug = $baseSlug . '-' . time() . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function generateKodePeminjaman($noTelepon, $namaLengkap)
    {
        // Generate komponen-komponen kode
        $timestamp = date('ymd'); // 240130 (6 digit)
        $random = bin2hex(random_bytes(2)); // 4 karakter hex random
        $phonePart = substr(sha1($noTelepon), 0, 3); // 3 karakter dari hash telefon
        $namePart = substr(md5($namaLengkap), 0, 3); // 3 karakter dari hash nama

        // Gabungkan dengan format yang kompleks (total 19 karakter)
        $code = sprintf(
            "PMJ%s%s%s%s",
            $timestamp,      // 6 karakter
            strtoupper($random), // 4 karakter
            $phonePart,     // 3 karakter
            $namePart       // 3 karakter
        );

        // Bagi menjadi 4 grup
        return implode('-', str_split($code, 5));
    }

    public function updateStok($id_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $data = $this->request->getJSON();

        $result = $this->m_barang_baik->where('id_barang', $id_barang)
            ->set(['jumlah_total_baik' => $data->stok])
            ->update();

        return $this->response->setJSON([
            'success' => $result,
            'message' => $result ? 'Stok berhasil diupdate' : 'Gagal mengupdate stok'
        ]);
    }
}

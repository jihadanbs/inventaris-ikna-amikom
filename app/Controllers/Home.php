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
        if (!$this->session->has('islogin')) {
            $this->session->set('slug', $slug);
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login !');
        }

        // Ambil data pengguna yang login
        $id_user = $this->session->get('id_user');
        $user = $this->m_user->getById($id_user);
        $barang = $this->m_barang->getBarangBySlug($slug);

        // Gabungkan nama lengkap dan slug barang
        $slugUserBarang = url_title($user['nama_lengkap'] . '-' . $barang['slug'], '-', true);

        $data = [
            'tb_barang' => $barang,
            'tb_user' => $user,
            'slugUserBarang' => $slugUserBarang
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

        // Ambil data keranjang dari database berdasarkan id_user
        $keranjang = $this->m_peminjaman_barang
            ->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang')
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang')
            ->where('tb_transaksi.id_user', $id_user)
            ->where('tb_peminjaman.status', 'keranjang')
            ->findAll();

        $data = [
            'id_user' => $id_user,
            'keranjang' => $keranjang
        ];

        return view('keranjang-barang', $data);
    }

    public function getKeranjang()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $id_user = session()->get('id_user');

        // Ambil data keranjang dari database
        $keranjang = $this->m_peminjaman_barang
            ->select('tb_peminjaman.id_peminjaman, GROUP_CONCAT(DISTINCT tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang, tb_peminjaman.id_barang, tb_peminjaman.total_dipinjam, tb_peminjaman.slug, tb_barang.nama_barang, tb_kategori_barang.nama_kategori, tb_barang_baik.jumlah_total_baik')
            ->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang')
            ->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left')
            ->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left')
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang')
            ->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left')
            ->where('tb_transaksi.id_user', $id_user)
            ->where('tb_peminjaman.status', 'keranjang')
            ->groupBy('tb_peminjaman.id_peminjaman')
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $keranjang
        ]);
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
        $id_user = session()->get('id_user');

        // Cek stok barang baik
        $barangBaik = $this->m_barang_baik->where('id_barang', $id_barang)->first();
        if (!$barangBaik || $barangBaik['jumlah_total_baik'] <= 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah barang telah habis dipinjam'
            ]);
        }

        // Cek apakah barang sudah ada di keranjang user
        $existing = $this->m_peminjaman_barang
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->where([
                'tb_peminjaman.id_barang' => $id_barang,
                'tb_peminjaman.status' => 'keranjang',
                'tb_transaksi.id_user' => $id_user
            ])
            ->first();

        if ($existing) {
            $this->m_peminjaman_barang->update($existing['id_peminjaman'], [
                'total_dipinjam' => $existing['total_dipinjam'] + 1
            ]);
        } else {
            // Buat baru jika belum ada
            $dataTransaksi = [
                'id_barang' => $id_barang,
                'total_dipinjam' => 1,
                'slug' => $slug,
                'status' => 'keranjang',
                'tanggal_pengajuan' => date('Y-m-d H:i:s')
            ];

            // Insert ke tb_peminjaman dan dapatkan id_peminjaman
            $id_peminjaman = $this->m_peminjaman_barang->insert($dataTransaksi);

            // Simpan ke tb_transaksi untuk mengaitkan dengan id_user
            $dataTransaksi = [
                'id_user' => $id_user,
                'id_peminjaman' => $id_peminjaman
            ];

            $this->m_transaksi->insert($dataTransaksi);
        }

        // Update stok jumlah barang baik
        $this->m_barang_baik->where('id_barang', $id_barang)
            ->set('jumlah_total_baik', 'jumlah_total_baik - 1', false)
            ->update();

        // Update stok barang
        $this->m_barang->where('id_barang', $id_barang)
            ->set('jumlah_dipinjam', 'jumlah_dipinjam + 1', false)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan ke keranjang'
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
        $id_user = session()->get('id_user');

        // Cek stok barang baik
        $barangBaik = $this->m_barang_baik->where('id_barang', $id_barang)->first();
        if (!$barangBaik || $barangBaik['jumlah_total_baik'] <= 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah barang telah habis dipinjam'
            ]);
        }

        // Cek apakah barang sudah ada di keranjang user
        $existing = $this->m_peminjaman_barang
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->where([
                'tb_peminjaman.id_barang' => $id_barang,
                'tb_peminjaman.status' => 'keranjang',
                'tb_transaksi.id_user' => $id_user
            ])
            ->first();

        if ($existing) {
            $this->m_peminjaman_barang->update($existing['id_peminjaman'], [
                'total_dipinjam' => $existing['total_dipinjam'] + 1
            ]);
        } else {
            // Buat baru jika belum ada
            $dataPeminjaman = [
                'id_barang' => $id_barang,
                'total_dipinjam' => 1,
                'slug' => $slug,
                'status' => 'keranjang',
                'tanggal_pengajuan' => date('Y-m-d H:i:s')
            ];

            // Insert ke tb_peminjaman dan dapatkan id_peminjaman
            $id_peminjaman = $this->m_peminjaman_barang->insert($dataPeminjaman);

            // Simpan ke tb_transaksi untuk mengaitkan dengan id_user
            $dataTransaksi = [
                'id_user' => $id_user,
                'id_peminjaman' => $id_peminjaman
            ];

            $this->m_transaksi->insert($dataTransaksi);
        }

        // Update stok jumlah barang baik
        $this->m_barang_baik->where('id_barang', $id_barang)
            ->set('jumlah_total_baik', 'jumlah_total_baik - 1', false)
            ->update();

        // Update stok barang
        $this->m_barang->where('id_barang', $id_barang)
            ->set('jumlah_dipinjam', 'jumlah_dipinjam + 1', false)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Barang telah ditambahkan ke keranjang'
        ]);
    }

    public function hapusItemKeranjang($id_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $id_user = session()->get('id_user');

        // Ambil data peminjaman
        $peminjaman = $this->m_peminjaman_barang
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->where('tb_peminjaman.id_peminjaman', $id_peminjaman)
            ->where('tb_transaksi.id_user', $id_user)
            ->first();

        if (!$peminjaman) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item tidak ditemukan'
            ]);
        }

        // Kembalikan stok
        $this->m_barang->where('id_barang', $peminjaman['id_barang'])
            ->set('jumlah_dipinjam', 'jumlah_dipinjam - ' . $peminjaman['total_dipinjam'], false)
            ->update();

        // Update stok jumlah barang baik
        $this->m_barang_baik->where('id_barang', $peminjaman['id_barang'])
            ->set('jumlah_total_baik', 'jumlah_total_baik + ' . $peminjaman['total_dipinjam'], false)
            ->update();

        // Hapus dari tb_transaksi
        $this->m_transaksi->where('id_peminjaman', $id_peminjaman)->delete();

        // Hapus dari tb_peminjaman
        $this->m_peminjaman_barang->delete($id_peminjaman);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Item berhasil dihapus dari keranjang'
        ]);
    }

    public function updateJumlahKeranjang($id_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        $json = $this->request->getJSON();
        $jumlah_baru = $json->jumlah;
        $id_user = session()->get('id_user');

        // Ambil data peminjaman
        $peminjaman = $this->m_peminjaman_barang
            ->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman')
            ->where('tb_peminjaman.id_peminjaman', $id_peminjaman)
            ->where('tb_transaksi.id_user', $id_user)
            ->first();

        if (!$peminjaman) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item tidak ditemukan'
            ]);
        }

        // Hitung perubahan jumlah
        $selisih = $jumlah_baru - $peminjaman['total_dipinjam'];

        // Update jumlah di peminjaman
        $this->m_peminjaman_barang->update($id_peminjaman, [
            'total_dipinjam' => $jumlah_baru
        ]);

        // Update stok barang
        $this->m_barang->where('id_barang', $peminjaman['id_barang'])
            ->set('jumlah_dipinjam', 'jumlah_dipinjam + ' . $selisih, false)
            ->update();

        // Update stok jumlah barang baik
        $this->m_barang_baik->where('id_barang', $peminjaman['id_barang'])
            ->set('jumlah_total_baik', 'jumlah_total_baik - ' . $selisih, false)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Jumlah berhasil diupdate'
        ]);
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
            $result = $this->m_peminjaman_barang->getKodePeminjaman($kode_peminjaman);

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

    public function ajukanPeminjamanBarang()
    {
        // Cek sesi pengguna
        if ($this->checkSessionPeminjam() !== true) {
            return $this->checkSessionPeminjam(); // Redirect jika sesi tidak valid
        }

        try {
            $rules = [
                'kepentingan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kepentingan harus diisi !'
                    ]
                ],
                'dokumen_jaminan' => [
                    'rules' => 'uploaded[dokumen_jaminan]|max_size[dokumen_jaminan,2048]|is_image[dokumen_jaminan]',
                    'errors' => [
                        'uploaded' => 'Dokumen wajib diunggah !',
                        'max_size' => 'Ukuran dokumen tidak boleh lebih dari 2MB !',
                        'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, dll) !',
                    ],
                ],
            ];

            // Jalankan validasi
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Ambil data dari form
            $kepentingan = $this->request->getPost('kepentingan');
            $id_user = session()->get('id_user');

            // Ambil id_peminjaman yang dipilih dari sessionStorage
            $selectedIds = json_decode($this->request->getPost('selected_peminjaman_ids') ?? '[]');

            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'Tidak ada barang yang dipilih untuk dipinjam!');
            }

            // Ambil data user
            $userData = $this->m_user->find($id_user);
            $namaLengkap = $userData['nama_lengkap'] ?? 'User';

            // Buat kode peminjaman yang sangat unik (16 digit)
            $kodePeminjaman = $this->generateUniqueCode($namaLengkap, $id_user);

            // Update semua peminjaman yang dipilih
            $totalBarang = 0;
            $barangDetails = [];

            foreach ($selectedIds as $id_peminjaman) {
                // Ambil data peminjaman
                $peminjaman = $this->m_peminjaman_barang->find($id_peminjaman);

                if ($peminjaman && $peminjaman['status'] === 'keranjang') {
                    // Update data peminjaman
                    $this->m_peminjaman_barang->update($id_peminjaman, [
                        'kepentingan' => $kepentingan,
                        'kode_peminjaman' => $kodePeminjaman,
                        'status' => 'Belum Diproses',
                        'tanggal_pengajuan' => date('Y-m-d H:i:s'),
                        'dokumen_jaminan' => uploadFile('dokumen_jaminan', 'dokumen/dokumen-jaminan-peminjaman/')
                    ]);

                    $totalBarang += $peminjaman['total_dipinjam'];

                    // Ambil detail barang untuk pesan WhatsApp
                    $barang = $this->m_barang->find($peminjaman['id_barang']);
                    if ($barang) {
                        $barangDetails[] = "- {$barang['nama_barang']} ({$peminjaman['total_dipinjam']} unit)";
                    }
                }
            }

            // Format nomor telepon
            $phone = $userData['no_telepon'] ?? '';
            $formatted_phone = preg_replace('/[^0-9]/', '', $phone);

            // Awali dengan 62 jika dimulai dengan 0
            if (substr($formatted_phone, 0, 1) === '0') {
                $formatted_phone = '62' . substr($formatted_phone, 1);
            }

            // Mengambil tanggal dengan format Indonesia
            $tanggal = date('Y-m-d H:i:s');
            $tanggal_saja = date('Y-m-d', strtotime($tanggal));
            $waktu_saja = date('H:i:s', strtotime($tanggal));

            // Siapkan data untuk pesan WhatsApp
            $data = [
                'nama_lengkap' => $namaLengkap,
                'kode_peminjaman' => $kodePeminjaman,
                'total_dipinjam' => $totalBarang,
                'tanggal_pengajuan' => formatTanggalIndo($tanggal_saja) . ' ' . $waktu_saja,
                'kepentingan' => $kepentingan
            ];

            // Siapkan pesan WhatsApp
            $message = "
*Yth. {$data['nama_lengkap']}*
            
Dokumentasi peminjaman barang dengan detail:
            
*Kode Peminjaman*: {$data['kode_peminjaman']}
*Tanggal Pengajuan*: {$data['tanggal_pengajuan']}
*Kepentingan*: {$data['kepentingan']}
            
*Daftar Barang Dipinjam*:
" . implode("\n", $barangDetails) . "
            
*Total Barang*: {$data['total_dipinjam']} unit
            
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
            session()->setFlashdata('pesan', 'Pengajuan berhasil dikirim! Kode peminjaman Anda: <strong style="color: black;">' . esc($kodePeminjaman) . '</strong>');

            return redirect()->back();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return redirect()->back()->withInput()
                ->with('errors', ['system' => 'Terjadi kesalahan sistem, Silakan coba lagi !']);
        }
    }

    private function generateUniqueCode($namaLengkap, $id_user)
    {
        // Ambil 2 huruf pertama dari nama (dikonversi ke uppercase)
        $namaPrefiks = substr(strtoupper(preg_replace('/[^A-Za-z]/', '', $namaLengkap)), 0, 2);
        if (empty($namaPrefiks)) {
            $namaPrefiks = 'XX'; // Default jika nama tidak memiliki huruf
        }

        // Ambil 4 digit dari timestamp (dalam detik)
        $timeDigit = substr(time(), -4);

        // Ambil 2 digit dari ID user
        $userDigit = str_pad(substr($id_user, -2), 2, '0', STR_PAD_LEFT);

        // Tambahkan 4 digit acak
        $randomDigit = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Tambahkan microtime untuk menambah keunikan (4 digit)
        $microtime = str_pad(substr(microtime(true) * 10000, -4), 4, '0', STR_PAD_LEFT);

        // Kode unik: 2 huruf nama + 4 digit waktu + 2 digit user ID + 4 digit acak + 4 digit microtime = 16 digit
        $kodeUnik = $namaPrefiks . $timeDigit . $userDigit . $randomDigit . $microtime;

        return $kodeUnik;
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class TransaksiController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang',
            'tb_user_peminjam' => $this->m_peminjaman_barang->getAllSorted(),
        ]);

        return view('admin/transaksi/index', $data);
    }

    public function cek_data($kode_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = [
            'title' => 'Admin | Halaman Cek Data Transaksi Barang',
            'detail_peminjaman' => $this->m_peminjaman_barang->getDetailByKodePeminjaman($kode_peminjaman),
            'kode_peminjaman' => $kode_peminjaman,
        ];

        return view('admin/transaksi/cek_data', $data);
    }

    // Dipinjamkan
    public function dipinjamkan($kode_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Dipinjamkan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_peminjaman' => $this->m_peminjaman_barang->getDetailByKodePeminjaman($kode_peminjaman),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dipinjamkan', $data);
    }

    public function proses_dipinjamkan($id_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();
        $barangDetails = [];

        //validasi input 
        $rules = [
            'catatan_peminjaman' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'keterangan' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
                ]
            ],
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Keluar Barang !'
                ]
            ],
            'tanggal_dipinjamkan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Dipinjamkan Barang !'
                ]
            ],
            'total_barang' => [
                'rules' => 'required|greater_than_equal_to[0]|check_total_dipinjam[tb_peminjaman,' . $id_peminjaman . ']',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Barang Yang Keluar !',
                    'greater_than_equal_to' => 'Jumlah Barang Yang Keluar Tidak Boleh Negatif !',
                    'check_total_dipinjam' => 'Jumlah Barang Yang Keluar Tidak Sesuai Dengan Jumlah Total Barang Yang Dipinjam !',
                ]
            ],
            'tanggal_perkiraan_dikembalikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Perkiraan Barang Dikembalikan !'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data user peminjam
        $userPeminjam = $this->m_peminjaman_barang->getDetailById($id_peminjaman);

        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Ambil semua barang yang terkait dengan kode peminjaman
            $kodePeminjaman = $userPeminjam['kode_peminjaman'];
            $semuaBarang = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Ambil detail barang untuk pesan WhatsApp
            foreach ($semuaBarang as $item) {
                $barang = $this->m_barang->find($item['id_barang']);
                if ($barang) {
                    $barangDetails[] = "- {$barang['nama_barang']} ({$item['total_dipinjam']} unit)";
                }
            }

            // Dapatkan detail peminjaman termasuk total_jenis_barang
            $detailPeminjaman = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Pastikan ada data yang diambil
            if (!empty($detailPeminjaman)) {
                $total_jenis_barang = $detailPeminjaman[0]['total_jenis_barang'] ?? 0;
                $kategori_list = $detailPeminjaman[0]['kategori_list'] ?? '-';
            } else {
                $total_jenis_barang = 0;
                $kategori_list = '-';
            }

            // Update status semua peminjaman dengan kode peminjaman yang sama
            $this->m_peminjaman_barang->where('kode_peminjaman', $kodePeminjaman)
                ->set([
                    'catatan_peminjaman' => $data['catatan_peminjaman'],
                    'tanggal_dipinjamkan' => $data['tanggal_dipinjamkan'],
                    'tanggal_perkiraan_dikembalikan' => $data['tanggal_perkiraan_dikembalikan'],
                    'status' => 'Dipinjamkan',
                ])
                ->update();

            // Loop untuk menyimpan semua barang ke tb_barang_keluar
            foreach ($semuaBarang as $item) {
                $dataBarangKeluar = [
                    'id_barang' => $item['id_barang'],
                    'id_peminjaman' => $item['id_peminjaman'],
                    'tanggal_keluar' => $data['tanggal_keluar'],
                    'total_barang' => $item['total_dipinjam'], // Gunakan total_dipinjam dari setiap item
                    'keterangan' => $this->getKeteranganKeluarDipinjam($item['nama_barang'], $data['tanggal_keluar'], $userPeminjam['nama_lengkap'], $item['total_dipinjam'], $data['keterangan'] ?? ''),
                ];

                if (!$this->m_barang_keluar->insert($dataBarangKeluar)) {
                    throw new \Exception('Gagal menyimpan data barang keluar untuk ID: ' . $item['id_barang']);
                }
            }

            // Commit transaksi jika semua berhasil
            $this->db->transCommit();

            $message = "✨ *INFORMASI PEMINJAMAN BARANG* ✨\n\n"
                . "Halo *{$userPeminjam['nama_lengkap']}*,\n"
                . "Berikut detail peminjaman Anda:\n\n"
                . "📝 *Detail Peminjam*\n"
                . "Nama: *{$userPeminjam['nama_lengkap']}*\n"
                . "Pekerjaan: *{$userPeminjam['pekerjaan']}*\n"
                . "No. Telepon: *{$userPeminjam['no_telepon']}*\n\n"
                . "📦 *Detail Peminjaman*\n"
                . "Kode Peminjaman: *{$userPeminjam['kode_peminjaman']}*\n"
                . "Status: *Dipinjamkan*\n"
                . "Daftar Barang Dipinjam: \n\n"
                . implode("\n", $barangDetails) . "\n\n"
                . "Total Jenis Barang: *{$total_jenis_barang} jenis*\n"
                . "Kategori Barang: *{$kategori_list}*\n"
                . "Tanggal Pengajuan: *" . formatTanggalIndo($userPeminjam['tanggal_pengajuan']) . "*\n"
                . "Tanggal Dipinjamkan: *" . formatTanggalIndo($data['tanggal_dipinjamkan']) . "*\n"
                . "Tanggal Perkiraan Kembali: *" . formatTanggalIndo($data['tanggal_perkiraan_dikembalikan']) . "*\n\n"
                . "📌 *Catatan Peminjaman*\n"
                . "{$data['catatan_peminjaman']}\n\n"
                . "Harap Menggunakan Kode Peminjaman Untuk Mengecek Status Peminjaman Anda, Terima kasih. 🙏";

            $phone = preg_replace('/[^0-9]/', '', $userPeminjam['no_telepon']);
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }
            $waUrl = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message);

            // Set flash data untuk WhatsApp link dan pesan sukses
            session()->setFlashdata('whatsapp_link', $waUrl);
            session()->setFlashdata('pesan', 'Transaksi Barang Berhasil Dipinjamkan !');

            return redirect()->to('/admin/transaksi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal meminjamkan barang: ' . $e->getMessage());
        }
    }

    private function getKeteranganKeluarDipinjam($barang, $tanggal, $nama_peminjam, $total_dipinjam, $keterangan)
    {
        if (empty(trim($keterangan))) {
            // Format tanggal ke format Indonesia
            $tanggal_formatted = date('d F Y', strtotime($tanggal));
            return "Barang {$barang} sebanyak {$total_dipinjam} unit telah dipinjamkan kepada {$nama_peminjam} pada tanggal {$tanggal_formatted}";
        }
        return $keterangan;
    }
    // End Dipinjamkan

    // DITOLAK
    public function ditolak($kode_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Ditolak',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_peminjaman' => $this->m_peminjaman_barang->getDetailByKodePeminjaman($kode_peminjaman),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/ditolak', $data);
    }

    public function proses_ditolak($id_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();
        $barangDetails = [];

        //validasi input 
        $rules = [
            'catatan_peminjaman' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data user peminjam
        $userPeminjam = $this->m_peminjaman_barang->getDetailById($id_peminjaman);

        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Ambil semua barang yang terkait dengan kode peminjaman
            $kodePeminjaman = $userPeminjam['kode_peminjaman'];
            $semuaBarang = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Ambil detail barang untuk pesan WhatsApp
            foreach ($semuaBarang as $item) {
                $barang = $this->m_barang->find($item['id_barang']);
                if ($barang) {
                    $barangDetails[] = "- {$barang['nama_barang']} ({$item['total_dipinjam']} unit)";
                }
            }

            if (empty($semuaBarang)) {
                throw new \Exception('Tidak ada barang yang ditemukan untuk kode peminjaman ini');
            }

            // Update status peminjaman
            $dataUpdatePeminjam = [
                'catatan_peminjaman' => $data['catatan_peminjaman'],
                'status' => 'Ditolak',
            ];

            // Update stok untuk semua barang
            foreach ($semuaBarang as $barang) {
                $idBarang = $barang['id_barang'];
                $totalDipinjam = $barang['total_dipinjam'];

                // Ambil data stok barang
                $stokBarang = $this->m_barang_baik->where('id_barang', $idBarang)->first();
                $jumlahDipinjam = $this->m_barang->where('id_barang', $idBarang)->first();

                if (!$stokBarang || !$jumlahDipinjam) {
                    throw new \Exception('Data barang dengan ID: ' . $idBarang . ' tidak ditemukan');
                }

                $jumlahTotalBaik = $stokBarang['jumlah_total_baik'];
                $jumlahBarangDipinjam = $jumlahDipinjam['jumlah_dipinjam'];

                // Update jumlah stok barang
                $this->m_barang_baik->update($idBarang, [
                    'jumlah_total_baik' => $jumlahTotalBaik + $totalDipinjam
                ]);

                $this->m_barang->update($idBarang, [
                    'jumlah_dipinjam' => $jumlahBarangDipinjam - $totalDipinjam
                ]);

                // Simpan data ke tb_barang_masuk untuk setiap barang
                $dataBarangMasuk = [
                    'id_barang' => $idBarang,
                    'tanggal_masuk' => date('Y-m-d'),
                    'keterangan_masuk' => $this->getKeteranganMasukDitolak(date('Y-m-d'), $totalDipinjam, $userPeminjam['nama_lengkap']),
                ];

                if (!$this->m_barang_masuk->insert($dataBarangMasuk)) {
                    throw new \Exception('Gagal menyimpan data barang masuk untuk ID: ' . $idBarang);
                }
            }

            // Update status semua peminjaman dengan kode peminjaman yang sama
            $this->m_peminjaman_barang->where('kode_peminjaman', $kodePeminjaman)
                ->set($dataUpdatePeminjam)
                ->update();

            // Dapatkan detail peminjaman termasuk total_jenis_barang
            $detailPeminjaman = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Pastikan ada data yang diambil
            if (!empty($detailPeminjaman)) {
                $total_jenis_barang = $detailPeminjaman[0]['total_jenis_barang'] ?? 0;
                $kategori_list = $detailPeminjaman[0]['kategori_list'] ?? '-';
            } else {
                $total_jenis_barang = 0;
                $kategori_list = '-';
            }

            // Commit transaksi jika semua berhasil
            $this->db->transCommit();

            $message = "✨ *INFORMASI PEMINJAMAN BARANG* ✨\n\n"
                . "Halo *{$userPeminjam['nama_lengkap']}*,\n"
                . "Berikut detail peminjaman Anda:\n\n"
                . "📝 *Detail Peminjam*\n"
                . "Nama: *{$userPeminjam['nama_lengkap']}*\n"
                . "Pekerjaan: *{$userPeminjam['pekerjaan']}*\n"
                . "No. Telepon: *{$userPeminjam['no_telepon']}*\n\n"
                . "📦 *Detail Peminjaman*\n"
                . "Kode Peminjaman: *{$kodePeminjaman}*\n"
                . "Status: *Ditolak*\n"
                . "Daftar Barang Dipinjam: \n\n"
                .  implode("\n", $barangDetails)
                . "\n\nTotal Jenis Barang: *{$total_jenis_barang} jenis*\n"
                . "Kategori Barang: *{$kategori_list}*\n"
                . "Tanggal Pengajuan: *" . formatTanggalIndo($userPeminjam['tanggal_pengajuan']) . "*\n\n"
                . "📌 *Catatan Penolakan*\n"
                . "{$data['catatan_peminjaman']}\n\n"
                . "Harap Menggunakan Kode Peminjaman Untuk Mengecek Status Peminjaman Anda, Terima kasih. 🙏";

            $phone = preg_replace('/[^0-9]/', '', $userPeminjam['no_telepon']);
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }
            $waUrl = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message);

            // Set flash data untuk WhatsApp link dan pesan sukses
            session()->setFlashdata('whatsapp_link', $waUrl);
            session()->setFlashdata('pesan', 'Transaksi Barang Berhasil Ditolak !');

            return redirect()->to('/admin/transaksi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal meminjamkan barang: ' . $e->getMessage());
        }
    }

    private function getKeteranganMasukDitolak($tanggal_masuk, $total_dipinjam, $nama_lengkap)
    {
        return sprintf(
            "Penambahan stok sebanyak %d unit dari transaksi peminjaman atas nama %s yang ditolak pada tanggal %s",
            $total_dipinjam,
            $nama_lengkap,
            formatTanggalIndo($tanggal_masuk)
        );
    }
    // END DITOLAK

    // DIKEMBALIKAN
    public function dikembalikan($kode_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Dikembalikan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_peminjaman' => $this->m_peminjaman_barang->getDetailByKodePeminjaman($kode_peminjaman),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dikembalikan', $data);
    }

    public function proses_dikembalikan($id_peminjaman)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();
        $barangDetails = [];

        // Validasi input untuk setiap barang
        $rules = [
            'id_barang.*' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Barang !',
                    'numeric' => 'Jumlah harus berupa angka !'
                ]
            ],
            'jumlah_baik.*' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Barang Kondisi Layak !',
                    'numeric' => 'Jumlah harus berupa angka !',
                    'greater_than_equal_to' => 'Jumlah tidak boleh negatif !'
                ]
            ],
            'jumlah_rusak.*' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Barang Kondisi Rusak !',
                    'numeric' => 'Jumlah harus berupa angka !',
                    'greater_than_equal_to' => 'Jumlah tidak boleh negatif !'
                ]
            ],
            'catatan_peminjaman' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'tanggal_dikembalikan' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Dikembalikan Barang !',
                    'valid_date' => 'Format tanggal tidak valid !'
                ]
            ],
            'bukti_pengembalian' => [
                'rules' => 'uploaded[bukti_pengembalian]|max_size[bukti_pengembalian,2048]|is_image[bukti_pengembalian]',
                'errors' => [
                    'uploaded' => 'Dokumen Wajib Diunggah !',
                    'max_size' => 'Ukuran Dokumen Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPG, JPEG, PNG, dll) !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data user peminjam
        $userPeminjam = $this->m_peminjaman_barang->getDetailById($id_peminjaman);

        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Ambil data peminjaman utama
        $peminjaman = $this->m_peminjaman_barang->find($id_peminjaman);
        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan!');
        }

        // Ambil detail peminjaman berdasarkan kode peminjaman
        $kodePeminjaman = $userPeminjam['kode_peminjaman'];
        $detailPeminjamans = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

        // Validasi total barang untuk setiap item
        $idBarangs = $this->request->getPost('id_barang');
        $jumlahBaiks = $this->request->getPost('jumlah_baik');
        $jumlahRusaks = $this->request->getPost('jumlah_rusak');

        // Variabel untuk menyimpan total barang yang dipinjam per barang
        $totalBarangDipinjamPerBarang = [];

        // Hitung total barang dipinjam per barang berdasarkan kode peminjaman
        foreach ($detailPeminjamans as $detailPeminjaman) {
            $idBarang = $detailPeminjaman['id_barang'];
            $totalBarangDipinjamPerBarang[$idBarang] = $detailPeminjaman['total_dipinjam'];
        }

        // Array untuk menyimpan validasi per barang
        $barangValidation = [];

        // Variabel untuk menyimpan total barang yang dikembalikan
        $totalDikembalikanBaik = 0;
        $totalDikembalikanRusak = 0;

        // Loop untuk memeriksa setiap barang
        foreach ($detailPeminjamans as $detailPeminjaman) {
            $indexBarang = array_search($detailPeminjaman['id_barang'], $idBarangs);

            if ($indexBarang === false) {
                $barangValidation[] = "Barang {$detailPeminjaman['nama_barang']} tidak ditemukan dalam proses pengembalian!";
                continue;
            }

            $jumlahBaik = (int)$jumlahBaiks[$indexBarang];
            $jumlahRusak = (int)$jumlahRusaks[$indexBarang];
            $totalBarangDipinjam = $totalBarangDipinjamPerBarang[$detailPeminjaman['id_barang']];

            // Validasi per barang
            if ($jumlahBaik + $jumlahRusak > $totalBarangDipinjam) {
                $barangValidation[] = "Jumlah barang yang dikembalikan untuk {$detailPeminjaman['nama_barang']} melebihi total yang dipinjam! (Dipinjam: {$totalBarangDipinjam}, Dikembalikan: " . ($jumlahBaik + $jumlahRusak) . ")";
            }

            // Tambahkan ke total
            $totalDikembalikanBaik += $jumlahBaik;
            $totalDikembalikanRusak += $jumlahRusak;
        }

        // Hitung total dipinjam dari detail peminjaman berdasarkan kode peminjaman
        $totalDipinjam = array_sum(array_column($detailPeminjamans, 'total_dipinjam'));

        // Validasi total barang
        if (($totalDikembalikanBaik + $totalDikembalikanRusak) !== $totalDipinjam) {
            $barangValidation[] = "Total barang yang dikembalikan harus sama dengan total yang dipinjam! (Dipinjam: {$totalDipinjam}, Dikembalikan: " . ($totalDikembalikanBaik + $totalDikembalikanRusak) . ")";
        }

        // Jika ada validasi yang gagal
        if (!empty($barangValidation)) {
            return redirect()->back()->withInput()
                ->with('error', implode("\n", $barangValidation));
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Ambil semua barang yang terkait dengan kode peminjaman
            $kodePeminjaman = $userPeminjam['kode_peminjaman'];
            $semuaBarang = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Ambil detail barang untuk pesan WhatsApp
            foreach ($semuaBarang as $item) {
                $barang = $this->m_barang->find($item['id_barang']);
                if ($barang) {
                    $barangDetails[] = "- {$barang['nama_barang']} ({$item['total_dipinjam']} unit)";
                }
            }

            // Dapatkan detail peminjaman termasuk total_jenis_barang
            $detailPeminjaman = $this->m_peminjaman_barang->getDetailByKodePeminjaman($kodePeminjaman);

            // Pastikan ada data yang diambil
            if (!empty($detailPeminjaman)) {
                $total_jenis_barang = $detailPeminjaman[0]['total_jenis_barang'] ?? 0;
                $kategori_list = $detailPeminjaman[0]['kategori_list'] ?? '-';
            } else {
                $total_jenis_barang = 0;
                $kategori_list = '-';
            }

            // Update status semua peminjaman dengan kode peminjaman yang sama
            $this->m_peminjaman_barang->where('kode_peminjaman', $kodePeminjaman)
                ->set([
                    'status' => 'Dikembalikan',
                    'tanggal_dikembalikan' => $data['tanggal_dikembalikan'],
                    'catatan_peminjaman' => $data['catatan_peminjaman'],
                    'bukti_pengembalian' => uploadFile('bukti_pengembalian', 'dokumen/dokumen-bukti-pengembalian/')
                ])
                ->update();

            // Proses update stok barang untuk setiap item
            foreach ($idBarangs as $index => $idBarang) {
                $jumlahBaik = $jumlahBaiks[$index];
                $jumlahRusak = $jumlahRusaks[$index];

                // Update stok barang baik
                $barangBaik = $this->m_barang_baik->where('id_barang', $idBarang)->first();
                $this->m_barang_baik->update($barangBaik['id_barang_baik'], [
                    'jumlah_total_baik' => $barangBaik['jumlah_total_baik'] + $jumlahBaik
                ]);

                // Update stok barang rusak
                $barangRusak = $this->m_barang_rusak->where('id_barang', $idBarang)->first();
                $this->m_barang_rusak->update($barangRusak['id_barang_rusak'], [
                    'jumlah_total_rusak' => $barangRusak['jumlah_total_rusak'] + $jumlahRusak,
                    'keterangan_rusak' => $this->getKeteranganRusak(
                        $barangRusak['jumlah_total_rusak'] + $jumlahRusak,
                        $barangRusak['keterangan_rusak'] ?? ''
                    ),
                ]);

                // Update jumlah dipinjam di tb_barang
                $barang = $this->m_barang->find($idBarang);
                $this->m_barang->update($idBarang, [
                    'jumlah_dipinjam' => $barang['jumlah_dipinjam'] - ($jumlahBaik + $jumlahRusak)
                ]);
            }

            foreach ($semuaBarang as $item) {
                // Simpan data ke tb_barang_masuk
                $dataBarangMasuk = [
                    'id_barang' => $item['id_barang'],
                    'tanggal_masuk' => $data['tanggal_dikembalikan'],
                    'keterangan_masuk' => $this->getKeteranganMasukDikembalikan($data['tanggal_dikembalikan'], $userPeminjam['total_dipinjam'], $userPeminjam['nama_lengkap']),
                ];

                if (!$this->m_barang_masuk->insert($dataBarangMasuk)) {
                    throw new \Exception('Gagal menyimpan data barang masuk');
                }
            }

            // Commit transaksi
            $this->db->transCommit();

            $message = "✨ *INFORMASI PEMINJAMAN BARANG* ✨\n\n"
                . "Halo *{$userPeminjam['nama_lengkap']}*,\n"
                . "Berikut detail peminjaman Anda:\n\n"
                . "📝 *Detail Peminjam*\n"
                . "Nama: *{$userPeminjam['nama_lengkap']}*\n"
                . "Pekerjaan: *{$userPeminjam['pekerjaan']}*\n"
                . "No. Telepon: *{$userPeminjam['no_telepon']}*\n\n"
                . "📦 *Detail Peminjaman*\n"
                . "Kode Peminjaman: *{$userPeminjam['kode_peminjaman']}*\n"
                . "Status: *Dikembalikan*\n"
                . "Daftar Barang Dipinjam: \n\n"
                . implode("\n", $barangDetails) . "\n\n"
                . "Total Jenis Barang: *{$total_jenis_barang} jenis*\n"
                . "Kategori Barang: *{$kategori_list}*\n"
                . "Total Dipinjam: *{$totalDipinjam} unit*\n"
                . "Kondisi Baik: *{$totalDikembalikanBaik} unit*\n"
                . "Kondisi Rusak: *{$totalDikembalikanRusak} unit*\n"
                . "Tanggal Pengajuan: *" . formatTanggalIndo($userPeminjam['tanggal_pengajuan']) . "*\n"
                . "Tanggal Dipinjamkan: *" . formatTanggalIndo($userPeminjam['tanggal_dipinjamkan']) . "*\n"
                . "Tanggal Perkiraan Kembali: *" . formatTanggalIndo($userPeminjam['tanggal_perkiraan_dikembalikan']) . "*\n"
                . "Tanggal Dikembalikan: *" . formatTanggalIndo($data['tanggal_dikembalikan']) . "*\n\n"
                . "📌 *Catatan Pengembalian*\n"
                . "{$data['catatan_peminjaman']}\n\n"
                . "Harap Menggunakan Kode Peminjaman Untuk Mengecek Status Peminjaman Anda, Terima kasih. 🙏";

            $phone = preg_replace('/[^0-9]/', '', $userPeminjam['no_telepon']);
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }
            $waUrl = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . urlencode($message);

            // Set flash data untuk WhatsApp link dan pesan sukses
            session()->setFlashdata('whatsapp_link', $waUrl);
            session()->setFlashdata('pesan', 'Transaksi Pengembalian Barang Berhasil Disimpan !');

            return redirect()->to('/admin/transaksi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal mengembalikan barang: ' . $e->getMessage());
        }
    }

    private function getKeteranganRusak($jumlah, $keterangan)
    {
        if ($jumlah == 0) {
            return 'Tidak ada kerusakan';
        } else if ($jumlah > 0) {
            return 'Barang dalam kondisi rusak dan perlu perbaikan';
        }
        return $keterangan;
    }

    private function getKeteranganMasukDikembalikan($tanggal_masuk, $total_dipinjam, $nama_lengkap)
    {
        return sprintf(
            "Penambahan stok sebanyak %d unit dari transaksi peminjaman atas nama %s yang dikembalikan pada tanggal %s",
            $total_dipinjam,
            $nama_lengkap,
            formatTanggalIndo($tanggal_masuk)
        );
    }
    // END DIKEMBALIKAN

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Mendapatkan kode_peminjaman dari input POST
        $kode_peminjaman = $this->request->getPost('kode_peminjaman');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Ambil semua id_peminjaman yang terkait dengan kode_peminjaman
            $peminjamans = $this->db->table('tb_peminjaman')
                ->select('id_peminjaman, dokumen_jaminan, bukti_pengembalian')
                ->where('kode_peminjaman', $kode_peminjaman)
                ->get()
                ->getResult();

            // Hapus file-file terkait
            foreach ($peminjamans as $peminjaman) {
                // Hapus dokumen jaminan
                if (!empty($peminjaman->dokumen_jaminan)) {
                    $fullFilePath = ROOTPATH . 'public/' . $peminjaman->dokumen_jaminan;
                    if (is_file($fullFilePath)) {
                        unlink($fullFilePath);
                    }
                }

                // Hapus bukti pengembalian
                if (!empty($peminjaman->bukti_pengembalian)) {
                    $fullFilePath = ROOTPATH . 'public/' . $peminjaman->bukti_pengembalian;
                    if (is_file($fullFilePath)) {
                        unlink($fullFilePath);
                    }
                }
            }

            // Hapus data di tabel transaksi
            $this->db->table('tb_transaksi')
                ->whereIn('id_peminjaman', array_column($peminjamans, 'id_peminjaman'))
                ->delete();

            // Hapus data di tabel peminjaman
            $this->db->table('tb_peminjaman')
                ->where('kode_peminjaman', $kode_peminjaman)
                ->delete();

            // Selesaikan transaksi
            $this->db->transComplete();

            // Periksa apakah transaksi berhasil
            if ($this->db->transStatus() === false) {
                // Transaksi gagal, rollback perubahan
                $this->db->transRollback();
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus file dan data'
                ]);
            }

            // Transaksi berhasil, commit perubahan
            $this->db->transCommit();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Semua file dan data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            // Transaksi gagal, rollback perubahan
            $this->db->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus file dan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function totalByStatus($status)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $total = $this->m_peminjaman_barang->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }

    public function totalUserByStatus($status)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        try {
            $total = $this->m_peminjaman_barang
                ->groupBy('kode_peminjaman')
                ->where('status', $status)
                ->countAllResults();

            return $this->response->setJSON([
                'success' => true,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}

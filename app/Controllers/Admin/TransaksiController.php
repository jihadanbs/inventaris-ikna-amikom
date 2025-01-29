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
            'tb_user_peminjam' => $this->m_user_peminjam->getAllSorted(),
        ]);

        return view('admin/transaksi/index', $data);
    }

    public function cek_data($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Transaksi Barang',
            'tb_user_peminjam' => $this->m_user_peminjam->getNamaLengkapBySlug($slug),
        ]);

        return view('admin/transaksi/cek_data', $data);
    }


    // Dipinjamkan
    public function dipinjamkan($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Dipinjamkan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user_peminjam' => $this->m_user_peminjam->getNamaLengkapBySlug($slug),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dipinjamkan', $data);
    }

    public function proses_dipinjamkan($id_user_peminjam)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();

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
                'rules' => 'required|greater_than_equal_to[0]|check_total_dipinjam[tb_user_peminjam,' . $id_user_peminjam . ']',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Barang Yang Keluar !',
                    'greater_than_equal_to' => 'Jumlah Barang Yang Keluar Tidak Boleh Negatif !',
                    'check_total_dipinjam' => 'Jumlah Barang Yang Keluar Tidak Sesuai Dengan Jumlah Barang Yang Dipinjam !',
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
        $userPeminjam = $this->m_user_peminjam->find($id_user_peminjam);
        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Update data di tb_user_peminjam
            $dataUpdatePeminjam = [
                'id_user_peminjam' => $id_user_peminjam,
                'id_barang' => $userPeminjam['id_barang'],
                'catatan_peminjaman' => $data['catatan_peminjaman'],
                'tanggal_dipinjamkan' => $data['tanggal_dipinjamkan'],
                'tanggal_perkiraan_dikembalikan' => $data['tanggal_perkiraan_dikembalikan'],
                'status' => 'Dipinjamkan',
            ];

            if (!$this->m_user_peminjam->update($id_user_peminjam, $dataUpdatePeminjam)) {
                throw new \Exception('Gagal mengupdate data peminjam');
            }

            // Simpan data ke tb_barang_keluar
            $dataBarangKeluar = [
                'id_barang' => $userPeminjam['id_barang'],
                'id_user_peminjam' => $id_user_peminjam,
                'tanggal_keluar' => $data['tanggal_keluar'],
                'total_barang' => $data['total_barang'],
                'keterangan' => $this->getKeteranganKeluarDipinjam($data['tanggal_keluar'], $userPeminjam['nama_lengkap'], $data['total_barang'], $data['keterangan'] ?? ''),
            ];

            if (!$this->m_barang_keluar->insert($dataBarangKeluar)) {
                throw new \Exception('Gagal menyimpan data barang keluar');
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
                . "Total Dipinjam: *{$userPeminjam['total_dipinjam']} unit*\n"
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
            session()->setFlashdata('pesan', 'Transaksi Barang Berhasil Disimpan !');

            return redirect()->to('/admin/transaksi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal meminjamkan barang: ' . $e->getMessage());
        }
    }

    private function getKeteranganKeluarDipinjam($tanggal, $nama_peminjam, $total_dipinjam, $keterangan)
    {
        if (empty(trim($keterangan))) {
            // Format tanggal ke format Indonesia
            $tanggal_formatted = date('d F Y', strtotime($tanggal));
            return "Barang sebanyak {$total_dipinjam} unit telah dipinjamkan kepada {$nama_peminjam} pada tanggal {$tanggal_formatted}";
        }
        return $keterangan;
    }
    // End Dipinjamkan

    // DITOLAK
    public function ditolak($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Ditolak',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user_peminjam' => $this->m_user_peminjam->getNamaLengkapBySlug($slug),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/ditolak', $data);
    }

    public function proses_ditolak($id_user_peminjam)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();

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
        $userPeminjam = $this->m_user_peminjam->find($id_user_peminjam);
        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
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

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Update data di tb_user_peminjam
            $dataUpdatePeminjam = [
                'id_user_peminjam' => $id_user_peminjam,
                'id_barang' => $userPeminjam['id_barang'],
                'catatan_peminjaman' => $data['catatan_peminjaman'],
                'status' => 'Ditolak',
            ];

            // Update jumlah stok barang
            $this->m_barang_baik->update($idBarang, [
                'jumlah_total_baik' => $jumlahTotalBaik + $totalDipinjam
            ]);

            if (!$this->m_user_peminjam->update($id_user_peminjam, $dataUpdatePeminjam)) {
                throw new \Exception('Gagal mengupdate data peminjam');
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
                . "Status: *Ditolak*\n"
                . "Total Dipinjam: *{$userPeminjam['total_dipinjam']} unit*\n"
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
            session()->setFlashdata('pesan', 'Transaksi Barang Berhasil Disimpan !');

            return redirect()->to('/admin/transaksi');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Gagal meminjamkan barang: ' . $e->getMessage());
        }
    }
    // END DITOLAK

    // DIKEMBALIKAN
    public function dikembalikan($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Transaksi Barang Dikembalikan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user_peminjam' => $this->m_user_peminjam->getNamaLengkapBySlug($slug),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dikembalikan', $data);
    }

    public function proses_dikembalikan($id_user_peminjam)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();

        //validasi input 
        $rules = [
            'catatan_peminjaman' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
                ]
            ],
            'jumlah_total_baik' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Layak !',
                    'numeric' => 'Jumlah harus berupa angka !',
                    'greater_than_equal_to' => 'Jumlah tidak boleh negatif !'
                ]
            ],
            'jumlah_total_rusak' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Rusak !',
                    'numeric' => 'Jumlah harus berupa angka !',
                    'greater_than_equal_to' => 'Jumlah tidak boleh negatif !'
                ]
            ],
            'tanggal_dikembalikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Dikembalikan Barang !'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data user peminjam
        $userPeminjam = $this->m_user_peminjam->find($id_user_peminjam);
        if (!$userPeminjam) {
            return redirect()->back()->with('error', 'Data peminjam tidak ditemukan!');
        }

        // Ambil data stok barang
        $idBarang = $this->request->getPost('id_barang');
        $stokBarang = $this->m_barang_baik->where('id_barang', $idBarang)->first();
        $stokBarangRusak = $this->m_barang_rusak->where('id_barang', $idBarang)->first();

        if (!$stokBarang || !$stokBarangRusak) {
            return redirect()->back()->withInput()
                ->with('error', 'Data barang tidak ditemukan!');
        }

        // Validasi total barang yang dikembalikan
        $jumlahDikembalikanBaik = (int)$data['jumlah_total_baik'];
        $jumlahDikembalikanRusak = (int)$data['jumlah_total_rusak'];
        $totalDipinjam = (int)$this->request->getPost('total_dipinjam');

        if (($jumlahDikembalikanBaik + $jumlahDikembalikanRusak) !== $totalDipinjam) {
            return redirect()->back()->withInput()
                ->with('error', 'Total barang yang dikembalikan harus sama dengan total yang dipinjam!');
        }

        // Mulai transaksi database
        $this->db->transBegin();

        try {
            // Update stok barang baik
            $newStokBaik = $stokBarang['jumlah_total_baik'] + $jumlahDikembalikanBaik;
            if (!$this->m_barang_baik->update($idBarang, ['jumlah_total_baik' => $newStokBaik])) {
                throw new \Exception('Gagal mengupdate stok barang baik');
            }

            // Update stok barang rusak
            $newStokRusak = $stokBarangRusak['jumlah_total_rusak'] + $jumlahDikembalikanRusak;
            if (!$this->m_barang_rusak->update($idBarang, ['jumlah_total_rusak' => $newStokRusak])) {
                throw new \Exception('Gagal mengupdate stok barang rusak');
            }

            // Update data di tb_user_peminjam
            $dataUpdatePeminjam = [
                'id_user_peminjam' => $id_user_peminjam,
                'id_barang' => $userPeminjam['id_barang'],
                'catatan_peminjaman' => $data['catatan_peminjaman'],
                'tanggal_dikembalikan' => $data['tanggal_dikembalikan'],
                'jumlah_dikembalikan_baik' => $jumlahDikembalikanBaik,
                'jumlah_dikembalikan_rusak' => $jumlahDikembalikanRusak,
                'status' => 'Dikembalikan',
            ];

            if (!$this->m_user_peminjam->update($id_user_peminjam, $dataUpdatePeminjam)) {
                throw new \Exception('Gagal mengupdate data peminjam');
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
                . "Status: *Dikembalikan*\n"
                . "Total Dipinjam: *{$userPeminjam['total_dipinjam']} unit*\n"
                . "Kondisi Baik: *{$jumlahDikembalikanBaik} unit*\n"
                . "Kondisi Rusak: *{$jumlahDikembalikanRusak} unit*\n"
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
    // END DIKEMBALIKAN

    public function totalByStatus($status)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $total = $this->m_user_peminjam->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }

    public function totalUserByStatus($status)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        try {
            $total = $this->m_user_peminjam
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

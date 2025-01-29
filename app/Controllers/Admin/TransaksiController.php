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

    public function cek_data($nama_lengkap)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Transaksi Barang',
            'tb_user_peminjam' => $this->m_user_peminjam->getByNamaLengkap($nama_lengkap),
        ]);

        return view('admin/transaksi/cek_data', $data);
    }

    public function dipinjamkan($nama_lengkap)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Dipinjamkan Transaksi Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_user_peminjam' => $this->m_user_peminjam->getByNamaLengkap($nama_lengkap),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/transaksi/dipinjamkan', $data);
    }

    // Dipinjamkan
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
            session()->setFlashdata('pesan', 'Peminjaman Barang Berhasil Dikirimkan !');

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

    public function totalByStatus($status)
    {
        $total = $this->m_user_peminjam->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }
}

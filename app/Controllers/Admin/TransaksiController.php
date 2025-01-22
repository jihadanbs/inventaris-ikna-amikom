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

    public function proses_dipinjamkan()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $data = $this->request->getPost();

        // Konversi nilai jumlah ke integer untuk mencegah error tipe data
        $data['jumlah_total_baik'] = (int)($data['jumlah_total_baik'] ?? 0);
        $data['jumlah_total_rusak'] = (int)($data['jumlah_total_rusak'] ?? 0);
        $data['jumlah_total'] = (int)($data['jumlah_total'] ?? 0);

        // Validasi jumlah baik dan rusak tidak melebihi atau kurang dari jumlah total
        if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) > $data['jumlah_total']) {
            return redirect()->back()->withInput()->with('error', 'Jumlah barang layak dan rusak tidak boleh melebihi jumlah total barang yang dimasukkan!');
        } else if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) < $data['jumlah_total']) {
            return redirect()->back()->withInput()->with('error', 'Total jumlah dari barang layak dan rusak (' . $data['jumlah_total_baik'] + $data['jumlah_total_rusak'] . ') kurang dari jumlah total barang yang dimasukkan (' . $data['jumlah_total'] . ') !');
        }

        //validasi input 
        $rules = [
            'keterangan' => [
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => 'Kolom Catatan Tidak Boleh Kosong !',
                    'min_length' => 'Catatan tidak boleh kurang dari 5 karakter !',
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
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke tb_barang
        $dataBarang = [
            'keterangan' => $data['keterangan'],
            'tanggal_dipinjamkan' => $data['tanggal_dipinjamkan'],
        ];

        if ($this->m_barang->insert($dataBarang)) {
            $idBarang = $this->m_barang->getInsertID();

            $uploadFiles = uploadMultiple('path_file_foto_barang', 'dokumen/barang/');
            if (empty($uploadFiles)) {
                // Jika file tidak berhasil diunggah, tampilkan pesan error
                session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi !');
                return redirect()->back()->withInput();
            }

            // Simpan data file yang diunggah ke tb_file_foto_barang dan relasinya ke tb_galeri
            foreach ($uploadFiles as $filePath) {
                $this->db->table('tb_file_foto_barang')->insert([
                    'path_file_foto_barang' => $filePath,
                ]);

                // Dapatkan ID file foto yang baru saja disimpan
                $idFileFotoBarang = $this->db->insertID();

                // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
                $this->db->table('tb_galeri_barang')->insert([
                    'id_barang' => $idBarang,
                    'id_file_foto_barang' => $idFileFotoBarang,
                ]);
            }

            // Simpan data ke tb_barang_keluar
            $this->m_barang_baik->insert([
                'id_barang' => $idBarang,
                'jumlah_total_baik' => $data['jumlah_total_baik'],
                'keterangan_baik' => $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? ''),
            ]);

            // Simpan data ke tb_barang_rusak
            $this->m_barang_rusak->insert([
                'id_barang' => $idBarang,
                'jumlah_total_rusak' => $data['jumlah_total_rusak'],
                'keterangan_rusak' => $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? ''),
            ]);

            // Simpan data ke tb_barang_masuk
            $this->m_barang_masuk->insert([
                'id_barang' => $idBarang,
                'tanggal_masuk' => $data['tanggal_masuk'],
                'keterangan_masuk' => $this->getKeteranganMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? ''),
            ]);

            return redirect()->to('/admin/barang')->with('pesan', 'Barang berhasil ditambahkan !');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan barang !');
    }
}

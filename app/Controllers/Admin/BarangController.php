<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang',
            'tb_barang' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/barang/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/barang/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $data = $this->request->getPost();

        $jumlahBaik = $data['jumlah_total_baik'] ?? 0;
        $jumlahRusak = $data['jumlah_total_rusak'] ?? 0;

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
            'id_kategori_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori Barang !'
                ]
            ],
            'id_kondisi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kondisi Barang Saat Ini !'
                ]
            ],
            'nama_barang' => [
                'rules' => "required|is_unique_nama_barang[tb_barang,id_kategori_barang]|trim|min_length[2]|max_length[255]",
                'errors' => [
                    'required' => 'Kolom Nama Barang Tidak Boleh Kosong !',
                    'is_unique_nama_barang' => 'Nama Barang sudah terdaftar untuk nama kategori yang sama !',
                    'min_length' => 'Nama Barang tidak boleh kurang dari 2 karakter !',
                    'max_length' => 'Nama Barang tidak boleh melebihi 255 karakter !',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter !',
                    'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !',
                ]
            ],
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
                ]
            ],
            'keterangan_masuk' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
                ]
            ],
            'keterangan_baik' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
                ]
            ],
            'keterangan_rusak' => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
                ]
            ],
            'jumlah_total' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Total dari Barang Tersebut !',
                    'numeric' => 'Jumlah harus berupa angka !',
                    'greater_than_equal_to' => 'Jumlah tidak boleh negatif !'
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
            'path_file_foto_barang' => [
                'rules' => 'uploaded[path_file_foto_barang]|max_size[path_file_foto_barang,10240]|is_image[path_file_foto_barang]',
                'errors' => [
                    'uploaded' => 'Foto wajib diunggah !',
                    'max_size' => 'Ukuran foto tidak boleh lebih dari 10MB !',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, dll) !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke tb_barang
        $dataBarang = [
            'id_kategori_barang' => $data['id_kategori_barang'],
            'id_kondisi_barang' => $data['id_kondisi_barang'],
            'nama_barang' => $data['nama_barang'],
            'slug' => $this->generateUniqueBarangSlug($data['nama_barang']),
            'deskripsi' => $data['deskripsi'],
            'jumlah_total' => $data['jumlah_total'],
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

            // Simpan data ke tb_barang_baik
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
                'keterangan_masuk' => $this->getKeteranganMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? '', $jumlahBaik, $jumlahRusak),
            ]);

            return redirect()->to('/admin/barang')->with('pesan', 'Barang berhasil ditambahkan !');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan barang !');
    }

    private function getKeteranganBaik($jumlah, $keterangan)
    {
        if ($jumlah == 0) {
            return 'Ada kerusakan';
        } else if ($jumlah > 0 && empty(trim($keterangan))) {
            return 'Barang dalam kondisi baik dan layak digunakan';
        }
        return $keterangan;
    }

    private function getKeteranganRusak($jumlah, $keterangan)
    {
        if ($jumlah == 0) {
            return 'Tidak ada kerusakan';
        } else if ($jumlah > 0 && empty(trim($keterangan))) {
            return 'Barang dalam kondisi rusak dan perlu perbaikan';
        }
        return $keterangan;
    }

    private function getKeteranganMasuk($tanggal, $keterangan, $jumlahBaik, $jumlahRusak)
    {
        if (empty(trim($keterangan))) {
            // Format tanggal ke format Indonesia
            $tanggal_formatted = date('d F Y', strtotime($tanggal));

            $keteranganJumlah = [];
            if ($jumlahBaik > 0) {
                $keteranganJumlah[] = "$jumlahBaik barang dalam kondisi baik";
            }
            if ($jumlahRusak > 0) {
                $keteranganJumlah[] = "$jumlahRusak barang dalam kondisi rusak";
            }

            $detailJumlah = implode(' dan ', $keteranganJumlah);

            return "Penambahan " . $detailJumlah . " ke dalam inventaris pada tanggal " . $tanggal_formatted;
        }
        return $keterangan;
    }

    private function getKeteranganStokMasuk($tanggal, $keterangan, $jumlahBaik, $jumlahRusak)
    {
        if (empty(trim($keterangan))) {
            // Format tanggal ke format Indonesia
            $tanggal_formatted = date('d F Y', strtotime($tanggal));

            $keteranganJumlah = [];
            if ($jumlahBaik > 0) {
                $keteranganJumlah[] = "$jumlahBaik barang dalam kondisi baik";
            }
            if ($jumlahRusak > 0) {
                $keteranganJumlah[] = "$jumlahRusak barang dalam kondisi rusak";
            }

            $detailJumlah = implode(' dan ', $keteranganJumlah);

            return "Penambahan Stok " . $detailJumlah . " ke dalam inventaris pada tanggal " . $tanggal_formatted;
        }
        return $keterangan;
    }


    public function tambahStok($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Stok Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/barang/tambah_stok', $data);
    }

    public function saveStok($id_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $rules = [
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
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
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        // Pastikan nilai numerik
        $totalBarangBaik = (int)$data['jumlah_total_baik'];
        $totalBarangRusak = (int)$data['jumlah_total_rusak'];
        $totalBaru = $totalBarangBaik + $totalBarangRusak;

        if ($totalBaru <= 0) {
            return redirect()->back()->with('error', 'Total barang harus lebih dari 0');
        }

        $this->db->transStart();
        try {
            $barangLama = $this->m_barang->find($id_barang);

            if ($barangLama) {
                $stokTersedia = $barangLama['jumlah_total'] - $barangLama['jumlah_dipinjam'];

                // Mengambil data barang baik dan rusak saat ini
                $barangBaik = $this->m_barang_baik->where('id_barang', $id_barang)->first();
                $barangRusak = $this->m_barang_rusak->where('id_barang', $id_barang)->first();

                // Update jumlah total
                $jumlahBaik = ($barangBaik ? $barangBaik['jumlah_total_baik'] : 0) + $totalBarangBaik;
                $jumlahRusak = ($barangRusak ? $barangRusak['jumlah_total_rusak'] : 0) + $totalBarangRusak;

                if ($stokTersedia > 0) {
                    // Update item yang sudah ada
                    $updateData = [
                        'jumlah_total' => $barangLama['jumlah_total'] + $totalBaru,
                        'id_kondisi_barang' => $data['id_kondisi_barang'],
                        'tanggal_masuk' => $data['tanggal_masuk']
                    ];

                    $this->m_barang->update($id_barang, $updateData);
                    $newItemId = $id_barang;
                } else {
                    // Membuat item baru
                    $insertData = [
                        'nama_barang' => $barangLama['nama_barang'],
                        'id_kategori_barang' => $data['id_kategori_barang'],
                        'jumlah_total' => $totalBaru,
                        'jumlah_dipinjam' => 0,
                        'id_kondisi_barang' => $data['id_kondisi_barang'],
                        'tanggal_masuk' => $data['tanggal_masuk'],
                        'slug' => $barangLama['slug']
                    ];

                    $newItemId = $this->m_barang->insert($insertData);
                }

                // Update atau insert barang baik
                if ($barangBaik) {
                    $this->m_barang_baik->where('id_barang', $id_barang)->set([
                        'jumlah_total_baik' => $jumlahBaik,
                        'keterangan_baik' => $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? '')
                    ])->update();
                } else {
                    $this->m_barang_baik->insert([
                        'id_barang' => $id_barang,
                        'jumlah_total_baik' => $jumlahBaik,
                        'keterangan_baik' => $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? '')
                    ]);
                }


                // Update atau insert barang rusak
                if ($barangRusak) {
                    $this->m_barang_rusak->where('id_barang', $id_barang)->set([
                        'jumlah_total_rusak' => $jumlahRusak,
                        'keterangan_rusak' => $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? '')
                    ])->update();
                } else {
                    $this->m_barang_rusak->insert([
                        'id_barang' => $id_barang,
                        'jumlah_total_rusak' => $jumlahRusak,
                        'keterangan_rusak' => $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? '')
                    ]);
                }

                // Simpan data ke tb barang masuk
                $this->m_barang_masuk->insert([
                    'id_barang' => $id_barang,
                    'tanggal_masuk' => $data['tanggal_masuk'],
                    'keterangan_masuk' => $this->getKeteranganStokMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? '', $totalBarangBaik,  $totalBarangRusak),
                ]);

                // Rekam riwayat untuk barang dengan kondisi baik
                if ($totalBarangBaik > 0) {
                    $this->m_history_barang->insert([
                        'id_barang' => $newItemId,
                        'jumlah_masuk' => $totalBarangBaik,
                        'created_by' => session()->get('id_user')
                    ]);
                }

                // Rekam riwayat barang yang rusak
                if ($totalBarangRusak > 0) {
                    $this->m_history_barang->insert([
                        'id_barang' => $newItemId,
                        'jumlah_masuk' => $totalBarangRusak,
                        'created_by' => session()->get('id_user') // Ambil ID user dari session
                    ]);
                }
            } else {
                throw new \Exception('Data barang tidak ditemukan');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            return redirect()->to('/admin/barang')->with('pesan', 'Stok barang berhasil ditambahkan !');
        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Error in saveStok: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambah stok: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_barang = $this->request->getPost('id_barang');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file barang yang terkait dengan barang yang akan dihapus
            $dataFiles = $this->m_barang->getFilesById($id_barang);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada data yang ditemukan untuk nama barang.');
            }

            // Loop dan hapus setiap file yang terkait dari direktori
            foreach ($dataFiles as $fileData) {
                $filePath = $fileData['path_file_foto_barang'];
                $fullFilePath = ROOTPATH . 'public/' . $filePath;
                if (is_file($fullFilePath)) {
                    if (!unlink($fullFilePath)) {
                        throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                    }
                }
            }

            // Hapus entri dari tb_galeri_barang
            $this->m_barang->deleteFilesAndEntries($id_barang);

            // Hapus entri dari tb_barang
            $db->table('tb_barang')->where('id_barang', $id_barang)->delete();

            // Hapus entri dari tb_file_foto_barang yang tidak terkait dengan relasi lain
            $db->table('tb_file_foto_barang')
                ->whereNotIn('id_file_foto_barang', function ($builder) use ($id_barang) {
                    $builder->select('id_file_foto_barang')
                        ->from('tb_galeri_barang')
                        ->where('id_barang !=', $id_barang);
                })
                ->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_barang = $this->request->getPost('id_barang');

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Dapatkan ID file barang yang terkait dengan barang yang akan dihapus
            $dataFiles = $this->m_barang->getFilesById($id_barang);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada data yang ditemukan untuk nama barang.');
            }

            // Loop dan hapus setiap file yang terkait dari direktori
            foreach ($dataFiles as $fileData) {
                $filePath = $fileData['path_file_foto_barang'];
                $fullFilePath = ROOTPATH . 'public/' . $filePath;
                if (is_file($fullFilePath)) {
                    if (!unlink($fullFilePath)) {
                        throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                    }
                }
            }

            // Hapus entri dari tb_galeri_barang
            $this->m_barang->deleteFilesAndEntries($id_barang);

            // Hapus entri dari tb_barang
            $db->table('tb_barang')->where('id_barang', $id_barang)->delete();

            // Hapus entri dari tb_file_foto_barang yang tidak terkait dengan relasi lain
            $db->table('tb_file_foto_barang')
                ->whereNotIn('id_file_foto_barang', function ($builder) use ($id_barang) {
                    $builder->select('id_file_foto_barang')
                        ->from('tb_galeri_barang')
                        ->where('id_barang !=', $id_barang);
                })
                ->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function cek_data($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Barang',
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
            'dokumen' => $this->m_barang->getDokumenByBarangId($slug),
        ]);

        return view('admin/barang/cek_data', $data);
    }

    public function edit($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit Barang',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_barang' => $this->m_barang->getBarangBySlug($slug),
            'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
            'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
        ]);

        return view('admin/barang/edit', $data);
    }
    public function update($id_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = $this->request->getPost();
        $existingBarang = $this->m_barang->find($id_barang);

        if (!$existingBarang) {
            return redirect()->back()->with('error', 'Data barang tidak ditemukan !');
        }

        // // Konversi nilai jumlah ke integer untuk mencegah error tipe data
        // $data['jumlah_total_baik'] = (int)($data['jumlah_total_baik'] ?? 0);
        // $data['jumlah_total_rusak'] = (int)($data['jumlah_total_rusak'] ?? 0);
        // $data['jumlah_total'] = (int)($data['jumlah_total'] ?? 0);

        // // Konversi nilai existing ke integer untuk perbandingan yang akurat
        // $existingBarang['jumlah_total'] = (int)$existingBarang['jumlah_total'];

        // // Get existing related data
        // $existingBarangBaik = $this->m_barang_baik->where('id_barang', $id_barang)->first();
        // $existingBarangRusak = $this->m_barang_rusak->where('id_barang', $id_barang)->first();
        // $existingBarangMasuk = $this->m_barang_masuk->where('id_barang', $id_barang)->first();

        // // Konversi nilai existing related data ke integer
        // $existingBarangBaik['jumlah_total_baik'] = (int)$existingBarangBaik['jumlah_total_baik'];
        // $existingBarangRusak['jumlah_total_rusak'] = (int)$existingBarangRusak['jumlah_total_rusak'];

        $changes = [];

        // Bandingkan perubahan tabel utama dengan perbandingan ketat (===)
        if ($existingBarang['nama_barang'] !== trim($data['nama_barang'])) {
            $changes[] = 'Nama Barang';
        }
        if ((int)$existingBarang['id_kategori_barang'] !== (int)$data['id_kategori_barang']) {
            $changes[] = 'Kategori Barang';
        }
        if ((int)$existingBarang['id_kondisi_barang'] !== (int)$data['id_kondisi_barang']) {
            $changes[] = 'Kondisi Barang';
        }
        // if ($existingBarang['jumlah_total'] !== $data['jumlah_total']) {
        //     $changes[] = 'jumlah total';
        // }
        if ($existingBarang['deskripsi'] !== trim($data['deskripsi'])) {
            $changes[] = 'Deskripsi';
        }

        // // Cek perubahan jumlah_total_baik dan keterangan_baik
        // if ($existingBarangBaik['jumlah_total_baik'] !== $data['jumlah_total_baik']) {
        //     $changes[] = 'jumlah barang baik';
        // } else {
        //     // Bandingkan keterangan yang akan dihasilkan oleh getter
        //     $oldKetBaik = $this->getKeteranganBaik($existingBarangBaik['jumlah_total_baik'], $existingBarangBaik['keterangan_baik']);
        //     $newKetBaik = $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? '');
        //     if ($oldKetBaik !== $newKetBaik) {
        //         $changes[] = 'keterangan baik';
        //     }
        // }

        // // Cek perubahan jumlah_total_rusak dan keterangan_rusak
        // if ($existingBarangRusak['jumlah_total_rusak'] !== $data['jumlah_total_rusak']) {
        //     $changes[] = 'jumlah barang rusak';
        // } else {
        //     // Bandingkan keterangan yang akan dihasilkan oleh getter
        //     $oldKetRusak = $this->getKeteranganRusak($existingBarangRusak['jumlah_total_rusak'], $existingBarangRusak['keterangan_rusak']);
        //     $newKetRusak = $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? '');
        //     if ($oldKetRusak !== $newKetRusak) {
        //         $changes[] = 'keterangan rusak';
        //     }
        // }

        // // Cek perubahan tanggal_masuk dan keterangan_masuk
        // if ($existingBarangMasuk['tanggal_masuk'] !== $data['tanggal_masuk']) {
        //     $changes[] = 'tanggal masuk';
        // } else {
        //     // Bandingkan keterangan yang akan dihasilkan oleh getter
        //     $oldKetMasuk = $this->getKeteranganMasuk($existingBarangMasuk['tanggal_masuk'], $existingBarangMasuk['keterangan_masuk']);
        //     $newKetMasuk = $this->getKeteranganMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? '');
        //     if ($oldKetMasuk !== $newKetMasuk) {
        //         $changes[] = 'keterangan masuk';
        //     }
        // }

        // Periksa apakah file telah diunggah
        $filesUploaded = $this->request->getFileMultiple('path_file_foto_barang');
        if ($filesUploaded && is_array($filesUploaded)) {
            foreach ($filesUploaded as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $changes[] = 'Foto Barang';
                    break;
                }
            }
        }

        // Jika tidak ada perubahan yang terdeteksi, arahkan kembali dengan pesan
        if (empty($changes)) {
            return redirect()->to('/admin/barang')->with('warning', 'Tidak ada data barang yang diubah !');
        }

        // // Validasi jumlah baik dan rusak tidak melebihi atau kurang dari jumlah total
        // if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) > $data['jumlah_total']) {
        //     return redirect()->back()->withInput()->with('error', 'Jumlah barang layak dan rusak tidak boleh melebihi jumlah total barang yang dimasukkan !');
        // } else if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) < $data['jumlah_total']) {
        //     return redirect()->back()->withInput()->with('error', 'Total jumlah dari barang layak dan rusak (' . $data['jumlah_total_baik'] + $data['jumlah_total_rusak'] . ') kurang dari jumlah total barang yang dimasukkan (' . $data['jumlah_total'] . ') !');
        // }

        //validasi input 
        $rules = [
            'id_kategori_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori Barang !'
                ]
            ],
            'id_kondisi_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kondisi Barang Saat Ini !'
                ]
            ],
            'nama_barang' => [
                'rules' => "required|is_unique_nama_barang_lainnya[tb_barang,id_kategori_barang,id_barang]|trim|min_length[2]|max_length[100]",
                'errors' => [
                    'required' => 'Kolom Nama Barang Tidak Boleh Kosong !',
                    'is_unique_nama_barang_lainnya' => 'Nama Barang sudah terdaftar untuk nama kategori yang sama !',
                    'min_length' => 'Nama Barang tidak boleh kurang dari 2 karakter !',
                    'max_length' => 'Nama Barang tidak boleh melebihi 100 karakter !',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter !',
                    'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !',
                ]
            ],
            // 'tanggal_masuk' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
            //     ]
            // ],
            // 'keterangan_masuk' => [
            //     'rules' => 'max_length[255]',
            //     'errors' => [
            //         'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
            //     ]
            // ],
            // 'keterangan_baik' => [
            //     'rules' => 'max_length[255]',
            //     'errors' => [
            //         'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
            //     ]
            // ],
            // 'keterangan_rusak' => [
            //     'rules' => 'max_length[255]',
            //     'errors' => [
            //         'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
            //     ]
            // ],
            // 'jumlah_total' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Silahkan Masukkan Jumlah Total dari Barang Tersebut !'
            //     ]
            // ],
            // 'jumlah_total_baik' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Layak !'
            //     ]
            // ],
            // 'jumlah_total_rusak' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Rusak !'
            //     ]
            // ],
        ];

        // Cek file upload dengan cara yang lebih aman
        $filesUploaded = $this->request->getFileMultiple('path_file_foto_barang');
        if ($filesUploaded && is_array($filesUploaded)) {
            $hasValidFile = false;
            foreach ($filesUploaded as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $hasValidFile = true;
                    break;
                }
            }

            if ($hasValidFile) {
                $rules['path_file_foto_barang'] = [
                    'rules' => 'max_size[path_file_foto_barang,10240]|is_image[path_file_foto_barang]',
                    'errors' => [
                        'max_size' => 'Ukuran foto tidak boleh lebih dari 10MB !',
                        'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, dll) !',
                    ]
                ];
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data barang yang ada saat ini dari database
        $existingBarang = $this->m_barang->find($id_barang);
        if (!$existingBarang) {
            return redirect()->back()->with('error', 'Data barang tidak ditemukan !');
        }

        // Data untuk update tabel utama
        $dataToUpdate = [
            'id_barang' => $id_barang,
            'nama_barang' => $data['nama_barang'],
            'id_kategori_barang' => $data['id_kategori_barang'],
            'id_kondisi_barang' => $data['id_kondisi_barang'],
            // 'jumlah_total' => $data['jumlah_total'],
            'deskripsi' => $data['deskripsi'],
            'slug' => $this->generateUniqueBarangSlug($data['nama_barang']),
        ];

        // Start transaction
        $this->db->transStart();

        try {
            // Update tabel utama
            $this->m_barang->update($id_barang, $dataToUpdate);

            // Handle file upload
            $uploadedFiles = uploadMultiple('path_file_foto_barang', 'dokumen/barang/');
            if (!empty($uploadedFiles)) {
                // Hapus file lama
                $oldFileNames = explode(', ', $data['old_path_file_foto_barang']);
                foreach ($oldFileNames as $oldFileName) {
                    if (file_exists(ROOTPATH . 'public/' . $oldFileName)) {
                        unlink(ROOTPATH . 'public/' . $oldFileName);
                    }
                }

                // Hapus relasi lama
                $this->db->table('tb_galeri_barang')->where('id_barang', $id_barang)->delete();
                $this->db->table('tb_file_foto_barang')->whereIn('path_file_foto_barang', $oldFileNames)->delete();

                // Insert file baru
                foreach ($uploadedFiles as $fileName) {
                    // Insert ke tb_file_foto_barang
                    $this->db->table('tb_file_foto_barang')->insert([
                        'path_file_foto_barang' => $fileName,
                    ]);

                    // Ambil ID yang baru diinsert
                    $idFileFoto = $this->db->insertID();

                    // Insert ke tb_galeri_barang
                    $this->db->table('tb_galeri_barang')->insert([
                        'id_barang' => $id_barang,
                        'id_file_foto_barang' => $idFileFoto,
                    ]);
                }

                // Update path di tabel utama
                $dataToUpdate['path_file_foto_barang'] = implode(', ', $uploadedFiles);
            } else {
                // Jika tidak ada file baru yang diunggah, gunakan file lama
                $dataToUpdate['path_file_foto_barang'] = $data['old_path_file_foto_barang'];
            }

            // // Update tabel barang_baik
            // $this->m_barang_baik->where('id_barang', $id_barang)->set([
            //     'jumlah_total_baik' => $data['jumlah_total_baik'],
            //     'keterangan_baik' => $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? '')
            // ])->update();

            // // Update tabel barang_rusak
            // $this->m_barang_rusak->where('id_barang', $id_barang)->set([
            //     'jumlah_total_rusak' => $data['jumlah_total_rusak'],
            //     'keterangan_rusak' => $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? '')
            // ])->update();

            // // Update tabel barang_masuk
            // $this->m_barang_masuk->where('id_barang', $id_barang)->set([
            //     'tanggal_masuk' => $data['tanggal_masuk'],
            //     'keterangan_masuk' => $this->getKeteranganMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? '')
            // ])->update();

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal mengubah data barang !');
            }

            $changedFields = implode(', ', $changes);
            return redirect()->to('/admin/barang')->with('pesan', 'Data Barang Berhasil Diubah! Perubahan pada: <strong>' . $changedFields . '</strong>');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function totalData()
    {
        $totalData = $this->m_barang->getTotalBarang();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    private function generateUniqueBarangSlug($nama_barang)
    {
        // Buat slug dasar dari nama barang
        $baseSlug = url_title($nama_barang, '-', true);
        $slug = $baseSlug;
        $counter = 1;

        // Cek apakah slug sudah ada di database
        while ($this->m_barang->where('slug', $slug)->first()) {
            // Jika ada, tambahkan counter
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

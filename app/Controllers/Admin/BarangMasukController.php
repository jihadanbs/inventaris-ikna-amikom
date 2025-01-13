<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangMasukController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Masuk',
            'tb_barang_masuk' => $this->m_barang_masuk->getAllSorted(),
        ]);

        return view('admin/barang_masuk/index', $data);
    }
    // public function tambah()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     // Menyiapkan data untuk tampilan
    //     $data = array_merge([
    //         'title' => 'Admin | Halaman Tambah Barang',
    //         'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
    //         'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
    //         'tb_kondisi_barang' => $this->m_kondisi_barang->getAllData(),
    //     ]);

    //     return view('admin/barang/tambah', $data);
    // }

    // public function save()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     $data = $this->request->getPost();

    //     // Konversi nilai jumlah ke integer untuk mencegah error tipe data
    //     $data['jumlah_total_baik'] = (int)($data['jumlah_total_baik'] ?? 0);
    //     $data['jumlah_total_rusak'] = (int)($data['jumlah_total_rusak'] ?? 0);
    //     $data['jumlah_total'] = (int)($data['jumlah_total'] ?? 0);

    //     // Validasi jumlah baik dan rusak tidak melebihi atau kurang dari jumlah total
    //     if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) > $data['jumlah_total']) {
    //         return redirect()->back()->withInput()->with('error', 'Jumlah barang layak dan rusak tidak boleh melebihi jumlah total barang yang dimasukkan!');
    //     } else if (($data['jumlah_total_baik'] + $data['jumlah_total_rusak']) < $data['jumlah_total']) {
    //         return redirect()->back()->withInput()->with('error', 'Total jumlah dari barang layak dan rusak (' . $data['jumlah_total_baik'] + $data['jumlah_total_rusak'] . ') kurang dari jumlah total barang yang dimasukkan (' . $data['jumlah_total'] . ') !');
    //     }

    //     //validasi input 
    //     $rules = [
    //         'id_kategori_barang' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Nama Kategori Barang !'
    //             ]
    //         ],
    //         'id_kondisi_barang' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Kondisi Barang Saat Ini !'
    //             ]
    //         ],
    //         'nama_barang' => [
    //             'rules' => "required|is_unique_nama_barang[tb_barang,id_kategori_barang]|trim|min_length[2]|max_length[255]",
    //             'errors' => [
    //                 'required' => 'Kolom Nama Barang Tidak Boleh Kosong !',
    //                 'is_unique_nama_barang' => 'Nama Barang sudah terdaftar untuk nama kategori yang sama !',
    //                 'min_length' => 'Nama Barang tidak boleh kurang dari 2 karakter !',
    //                 'max_length' => 'Nama Barang tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'deskripsi' => [
    //             'rules' => 'required|trim|min_length[5]|max_length[255]',
    //             'errors' => [
    //                 'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
    //                 'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter !',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'tanggal_masuk' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
    //             ]
    //         ],
    //         'keterangan_masuk' => [
    //             'rules' => 'max_length[255]',
    //             'errors' => [
    //                 'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'keterangan_baik' => [
    //             'rules' => 'max_length[255]',
    //             'errors' => [
    //                 'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'keterangan_rusak' => [
    //             'rules' => 'max_length[255]',
    //             'errors' => [
    //                 'max_length' => 'Keterangan tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'jumlah_total' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Jumlah Total dari Barang Tersebut !'
    //             ]
    //         ],
    //         'jumlah_total_baik' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Layak !'
    //             ]
    //         ],
    //         'jumlah_total_rusak' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Jumlah Total Barang Kondisi Rusak !'
    //             ]
    //         ],
    //         'path_file_foto_barang' => [
    //             'rules' => 'uploaded[path_file_foto_barang]|max_size[path_file_foto_barang,10240]|is_image[path_file_foto_barang]',
    //             'errors' => [
    //                 'uploaded' => 'Foto wajib diunggah !',
    //                 'max_size' => 'Ukuran foto tidak boleh lebih dari 10MB !',
    //                 'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, dll) !',
    //             ],
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         // Kirim kembali ke form dengan error validasi
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     // Simpan data ke tb_barang
    //     $dataBarang = [
    //         'id_kategori_barang' => $data['id_kategori_barang'],
    //         'id_kondisi_barang' => $data['id_kondisi_barang'],
    //         'nama_barang' => $data['nama_barang'],
    //         'slug' => url_title($data['nama_barang'], '-', true),
    //         'deskripsi' => $data['deskripsi'],
    //         'jumlah_total' => $data['jumlah_total'],
    //     ];

    //     if ($this->m_barang->insert($dataBarang)) {
    //         $idBarang = $this->m_barang->getInsertID();

    //         $uploadFiles = uploadMultiple('path_file_foto_barang', 'dokumen/barang/');
    //         if (empty($uploadFiles)) {
    //             // Jika file tidak berhasil diunggah, tampilkan pesan error
    //             session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi !');
    //             return redirect()->back()->withInput();
    //         }

    //         // Simpan data file yang diunggah ke tb_file_foto_barang dan relasinya ke tb_galeri
    //         foreach ($uploadFiles as $filePath) {
    //             $this->db->table('tb_file_foto_barang')->insert([
    //                 'path_file_foto_barang' => $filePath,
    //             ]);

    //             // Dapatkan ID file foto yang baru saja disimpan
    //             $idFileFotoBarang = $this->db->insertID();

    //             // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
    //             $this->db->table('tb_galeri_barang')->insert([
    //                 'id_barang' => $idBarang,
    //                 'id_file_foto_barang' => $idFileFotoBarang,
    //             ]);
    //         }

    //         // Simpan data ke tb_barang_baik
    //         $this->m_barang_baik->insert([
    //             'id_barang' => $idBarang,
    //             'jumlah_total_baik' => $data['jumlah_total_baik'],
    //             'keterangan_baik' => $this->getKeteranganBaik($data['jumlah_total_baik'], $data['keterangan_baik'] ?? ''),
    //         ]);

    //         // Simpan data ke tb_barang_rusak
    //         $this->m_barang_rusak->insert([
    //             'id_barang' => $idBarang,
    //             'jumlah_total_rusak' => $data['jumlah_total_rusak'],
    //             'keterangan_rusak' => $this->getKeteranganRusak($data['jumlah_total_rusak'], $data['keterangan_rusak'] ?? ''),
    //         ]);

    //         // Simpan data ke tb_barang_masuk
    //         $this->m_barang_masuk->insert([
    //             'id_barang' => $idBarang,
    //             'tanggal_masuk' => $data['tanggal_masuk'],
    //             'keterangan_masuk' => $this->getKeteranganMasuk($data['tanggal_masuk'], $data['keterangan_masuk'] ?? ''),
    //         ]);

    //         return redirect()->to('/admin/barang')->with('pesan', 'Barang berhasil ditambahkan !');
    //     }

    //     return redirect()->back()->with('error', 'Gagal menambahkan barang !');
    // }

    // private function getKeteranganBaik($jumlah, $keterangan)
    // {
    //     if ($jumlah == 0) {
    //         return 'Ada kerusakan';
    //     } else if ($jumlah > 0 && empty(trim($keterangan))) {
    //         return 'Barang dalam kondisi baik dan layak digunakan';
    //     }
    //     return $keterangan;
    // }

    // private function getKeteranganRusak($jumlah, $keterangan)
    // {
    //     if ($jumlah == 0) {
    //         return 'Tidak ada kerusakan';
    //     } else if ($jumlah > 0 && empty(trim($keterangan))) {
    //         return 'Barang dalam kondisi rusak dan perlu perbaikan';
    //     }
    //     return $keterangan;
    // }

    // private function getKeteranganMasuk($tanggal, $keterangan)
    // {
    //     if (empty(trim($keterangan))) {
    //         // Format tanggal ke format Indonesia
    //         $tanggal_formatted = date('d F Y', strtotime($tanggal));
    //         return "Barang telah masuk ke dalam inventaris pada tanggal " . $tanggal_formatted;
    //     }
    //     return $keterangan;
    // }

    // public function delete()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     $id_barang = $this->request->getPost('id_barang');

    //     $db = \Config\Database::connect();
    //     $db->transStart();

    //     try {
    //         // Dapatkan ID file barang yang terkait dengan barang yang akan dihapus
    //         $dataFiles = $this->m_barang->getFilesById($id_barang);

    //         if (empty($dataFiles)) {
    //             throw new \Exception('Tidak ada data yang ditemukan untuk nama barang.');
    //         }

    //         // Loop dan hapus setiap file yang terkait dari direktori
    //         foreach ($dataFiles as $fileData) {
    //             $filePath = $fileData['path_file_foto_barang'];
    //             $fullFilePath = ROOTPATH . 'public/' . $filePath;
    //             if (is_file($fullFilePath)) {
    //                 if (!unlink($fullFilePath)) {
    //                     throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
    //                 }
    //             }
    //         }

    //         // Hapus entri dari tb_galeri_barang
    //         $this->m_barang->deleteFilesAndEntries($id_barang);

    //         // Hapus entri dari tb_barang
    //         $db->table('tb_barang')->where('id_barang', $id_barang)->delete();

    //         // Hapus entri dari tb_file_foto_barang yang tidak terkait dengan relasi lain
    //         $db->table('tb_file_foto_barang')
    //             ->whereNotIn('id_file_foto_barang', function ($builder) use ($id_barang) {
    //                 $builder->select('id_file_foto_barang')
    //                     ->from('tb_galeri_barang')
    //                     ->where('id_barang !=', $id_barang);
    //             })
    //             ->delete();

    //         $db->transComplete();

    //         if ($db->transStatus() === false) {
    //             $db->transRollback();
    //             return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
    //         }

    //         $db->transCommit();
    //         return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
    //     } catch (\Exception $e) {
    //         $db->transRollback();
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
    //     }
    // }

    // public function delete2()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     $id_barang = $this->request->getPost('id_barang');

    //     $db = \Config\Database::connect();
    //     $db->transStart();

    //     try {
    //         // Dapatkan ID file barang yang terkait dengan barang yang akan dihapus
    //         $dataFiles = $this->m_barang->getFilesById($id_barang);

    //         if (empty($dataFiles)) {
    //             throw new \Exception('Tidak ada data yang ditemukan untuk nama barang.');
    //         }

    //         // Loop dan hapus setiap file yang terkait dari direktori
    //         foreach ($dataFiles as $fileData) {
    //             $filePath = $fileData['path_file_foto_barang'];
    //             $fullFilePath = ROOTPATH . 'public/' . $filePath;
    //             if (is_file($fullFilePath)) {
    //                 if (!unlink($fullFilePath)) {
    //                     throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
    //                 }
    //             }
    //         }

    //         // Hapus entri dari tb_galeri_barang
    //         $this->m_barang->deleteFilesAndEntries($id_barang);

    //         // Hapus entri dari tb_barang
    //         $db->table('tb_barang')->where('id_barang', $id_barang)->delete();

    //         // Hapus entri dari tb_file_foto_barang yang tidak terkait dengan relasi lain
    //         $db->table('tb_file_foto_barang')
    //             ->whereNotIn('id_file_foto_barang', function ($builder) use ($id_barang) {
    //                 $builder->select('id_file_foto_barang')
    //                     ->from('tb_galeri_barang')
    //                     ->where('id_barang !=', $id_barang);
    //             })
    //             ->delete();

    //         $db->transComplete();

    //         if ($db->transStatus() === false) {
    //             $db->transRollback();
    //             return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
    //         }

    //         $db->transCommit();
    //         return $this->response->setJSON(['status' => 'success', 'message' => 'File dan data berhasil dihapus']);
    //     } catch (\Exception $e) {
    //         $db->transRollback();
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
    //     }
    // }


    // public function cek_data($slug)
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     // Menyiapkan data untuk tampilan
    //     $data = array_merge([
    //         'title' => 'Admin | Halaman Cek Data Barang',
    //         'tb_barang' => $this->m_barang->getBarangBySlug($slug),
    //         'dokumen' => $this->m_barang->getDokumenByBarangId($slug),
    //     ]);

    //     return view('admin/barang/cek_data', $data);
    // }

    // public function edit($slug)
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     // Menyiapkan data untuk tampilan
    //     $data = array_merge([
    //         'title' => 'Admin | Halaman Edit Barang',
    //         'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
    //         'tb_barang' => $this->m_barang->getBarangBySlug($slug),
    //         'tb_kategori_barang' => $this->m_kategori_barang->getAllData(),
    //     ]);

    //     return view('admin/barang/edit', $data);
    // }
    // public function update($id_barang)
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     // Validasi input
    //     if (!$this->validate([
    //         'id_kategori_barang' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Nama Kategori Barang !'
    //             ]
    //         ],
    //         'nama_barang' => [
    //             'rules' => "required|is_unique_nama_barang_lainnya[tb_barang,id_kategori_barang,id_barang]|trim|min_length[5]|max_length[100]",
    //             'errors' => [
    //                 'required' => 'Kolom Nama Barang Tidak Boleh Kosong !',
    //                 'is_unique_nama_barang_lainnya' => 'Nama Barang sudah terdaftar untuk nama kategori yang sama !',
    //                 'min_length' => 'Nama Barang tidak boleh kurang dari 5 karakter !',
    //                 'max_length' => 'Nama Barang tidak boleh melebihi 100 karakter !',
    //             ]
    //         ],
    //         'deskripsi' => [
    //             'rules' => 'required|trim|min_length[5]|max_length[255]',
    //             'errors' => [
    //                 'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
    //                 'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter !',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !',
    //             ]
    //         ],
    //         'tanggal_masuk' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
    //             ]
    //         ],
    //         'tanggal_keluar' => [
    //             'rules' => 'required|notEqualTo[tanggal_masuk]',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Tanggal Keluar Barang !',
    //                 'notEqualTo' => 'Tanggal Keluar tidak boleh sama dengan Tanggal Masuk !'
    //             ]
    //         ],
    //         'jumlah_total' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Masukkan Jumlah Total dari Barang Tersebut !'
    //             ]
    //         ],
    //     ])) {
    //         // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
    //         session()->setFlashdata('validation', \Config\Services::validation());
    //         return redirect()->back()->withInput();
    //     }

    //     // Ambil data barang yang ada saat ini dari database
    //     $existingBarang = $this->m_barang->find($id_barang);

    //     // Persiapkan data untuk update
    //     $dataToUpdate = [
    //         'id_barang' => $id_barang,
    //         'nama_barang' => $this->request->getVar('nama_barang'),
    //         'id_kategori_barang' => $this->request->getVar('id_kategori_barang'),
    //         'jumlah_total' => $this->request->getVar('jumlah_total'),
    //         'deskripsi' => $this->request->getVar('deskripsi'),
    //         'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
    //         'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
    //         'slug' => url_title($this->request->getVar('nama_barang'), '-', true)
    //     ];

    //     // Panggil helper uploadMultiple untuk multiple files
    //     $uploadedFiles = uploadMultiple('path_file_foto_barang', 'dokumen/barang/');

    //     // Cek apakah ada perubahan pada file foto
    //     $oldFileNames = explode(', ', $this->request->getVar('old_path_file_foto_barang'));
    //     $isFileChanged = !empty($uploadedFiles);

    //     // Cek apakah ada perubahan data
    //     $isDataChanged = false;
    //     foreach ($dataToUpdate as $key => $value) {
    //         if ($key !== 'id_barang' && $key !== 'slug') {
    //             if ($existingBarang[$key] != $value) {
    //                 $isDataChanged = true;
    //                 break;
    //             }
    //         }
    //     }

    //     // Jika tidak ada perubahan pada data dan file
    //     if (!$isDataChanged && !$isFileChanged) {
    //         // Set flash message untuk data tidak ada yang diubah
    //         session()->setFlashdata('warning', 'Data Barang Tidak Ada Yang Diubah !');
    //         return redirect()->to('/admin/barang');
    //     }

    //     // Proses file upload (sama seperti kode sebelumnya)
    //     if (!empty($uploadedFiles)) {
    //         // Hapus file lama jika ada file baru yang diunggah
    //         foreach ($oldFileNames as $oldFileName) {
    //             if (file_exists(ROOTPATH . 'public/' . $oldFileName)) {
    //                 unlink(ROOTPATH . 'public/' . $oldFileName);
    //             }
    //         }

    //         // Hapus relasi lama dari tb_galeri_barang dan tb_file_foto_barang
    //         $this->db->table('tb_galeri_barang')->where('id_barang', $id_barang)->delete();
    //         $this->db->table('tb_file_foto_barang')->whereIn('path_file_foto_barang', $oldFileNames)->delete();

    //         // Simpan file baru
    //         foreach ($uploadedFiles as $fileName) {
    //             $this->db->table('tb_file_foto_barang')->insert([
    //                 'path_file_foto_barang' => $fileName,
    //             ]);

    //             // Dapatkan ID file foto yang baru saja disimpan
    //             $idFileFoto = $this->db->insertID();

    //             // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
    //             $this->db->table('tb_galeri_barang')->insert([
    //                 'id_barang' => $id_barang,
    //                 'id_file_foto_barang' => $idFileFoto,
    //             ]);
    //         }

    //         // Update path file foto di data barang
    //         $dataToUpdate['path_file_foto_barang'] = implode(', ', $uploadedFiles);
    //     } else {
    //         // Jika tidak ada file baru yang diunggah, gunakan file lama
    //         $dataToUpdate['path_file_foto_barang'] = $this->request->getVar('old_path_file_foto_barang');
    //     }

    //     // Simpan data ke dalam database
    //     $this->m_barang->save($dataToUpdate);

    //     // Set flash message untuk sukses
    //     session()->setFlashdata('pesan', 'Data Barang Berhasil Diubah !');

    //     return redirect()->to('/admin/barang');
    // }
}

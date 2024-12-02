<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class BarangRusakController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Barang Rusak',
            'tb_barang_rusak' => $this->m_barang_rusak->getAllSorted(),
        ]);

        return view('admin/barang_rusak/index', $data);
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
            'tb_barang' => $this->m_barang->getAllSorted(),
        ]);

        return view('admin/barang_rusak/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari request
        $id_barang = $this->request->getVar('id_barang');
        $keterangan_rusak = $this->request->getVar('keterangan_rusak');
        $jumlah_total_rusak = $this->request->getVar('jumlah_total_rusak');

        // Validasi input
        if (!$this->validate([
            'id_barang' => [
                'rules' => 'required|is_unique_id_barang_rusak[tb_barang_rusak,id_barang]',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Barang !',
                    'is_unique_id_barang_rusak' => 'Nama Barang ini sudah terdaftar sebagai barang rusak !'
                ]
            ],
            'keterangan_rusak' => [
                'rules' => 'required|trim|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Keterangan Rusak Tidak Boleh Kosong !',
                    'min_length' => 'Keterangan Rusak tidak boleh kurang dari 5 karakter !',
                    'max_length' => 'Keterangan Rusak tidak boleh melebihi 255 karakter !',
                ]
            ],
            'jumlah_total_rusak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan Jumlah Total Kerusakan dari Barang Tersebut !',
                    // 'if_kurang_nol' => 'Jumlah Total Kerusakan tidak boleh kurang dari 0 !'
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Simpan data ke tb_barang_rusak
        $this->m_barang_rusak->save([
            'id_barang' => $id_barang,
            'keterangan_rusak' => $keterangan_rusak,
            'jumlah_total_rusak' => $jumlah_total_rusak,
        ]);

        // Perbarui jumlah barang baik
        $this->m_barang_baik->updateJumlahBarangBaik($id_barang);

        session()->setFlashdata('pesan', 'Data Barang Rusak Berhasil Ditambahkan !');

        return redirect()->to('/admin/barang_rusak');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_barang_rusak = $this->request->getPost('id_barang_rusak');

        if ($this->m_barang_rusak->delete($id_barang_rusak)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_barang_rusak = $this->request->getPost('id_barang_rusak');

        if ($this->m_barang_rusak->delete($id_barang_rusak)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
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
        ]);

        return view('admin/barang/edit', $data);
    }
    public function update($id_barang)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate([
            'id_kategori_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori Barang !'
                ]
            ],
            'nama_barang' => [
                'rules' => "required|is_unique_nama_barang_lainnya[tb_barang,id_kategori_barang,id_barang]|trim|min_length[5]|max_length[100]",
                'errors' => [
                    'required' => 'Kolom Nama Barang Tidak Boleh Kosong !',
                    'is_unique_nama_barang_lainnya' => 'Nama Barang sudah terdaftar untuk nama kategori yang sama !',
                    'min_length' => 'Nama Barang tidak boleh kurang dari 5 karakter !',
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
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Masuk Barang !'
                ]
            ],
            'tanggal_keluar' => [
                'rules' => 'required|notEqualTo[tanggal_masuk]',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal Keluar Barang !',
                    'notEqualTo' => 'Tanggal Keluar tidak boleh sama dengan Tanggal Masuk !'
                ]
            ],
            'jumlah_total' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Jumlah Total dari Barang Tersebut !'
                ]
            ],
        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data barang yang ada saat ini dari database
        $existingBarang = $this->m_barang->find($id_barang);

        // Persiapkan data untuk update
        $dataToUpdate = [
            'id_barang' => $id_barang,
            'nama_barang' => $this->request->getVar('nama_barang'),
            'id_kategori_barang' => $this->request->getVar('id_kategori_barang'),
            'jumlah_total' => $this->request->getVar('jumlah_total'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'slug' => url_title($this->request->getVar('nama_barang'), '-', true)
        ];

        // Panggil helper uploadMultiple untuk multiple files
        $uploadedFiles = uploadMultiple('path_file_foto_barang', 'dokumen/barang/');

        // Cek apakah ada perubahan pada file foto
        $oldFileNames = explode(', ', $this->request->getVar('old_path_file_foto_barang'));
        $isFileChanged = !empty($uploadedFiles);

        // Cek apakah ada perubahan data
        $isDataChanged = false;
        foreach ($dataToUpdate as $key => $value) {
            if ($key !== 'id_barang' && $key !== 'slug') {
                if ($existingBarang[$key] != $value) {
                    $isDataChanged = true;
                    break;
                }
            }
        }

        // Jika tidak ada perubahan pada data dan file
        if (!$isDataChanged && !$isFileChanged) {
            // Set flash message untuk data tidak ada yang diubah
            session()->setFlashdata('warning', 'Data Barang Tidak Ada Yang Diubah !');
            return redirect()->to('/admin/barang');
        }

        // Proses file upload (sama seperti kode sebelumnya)
        if (!empty($uploadedFiles)) {
            // Hapus file lama jika ada file baru yang diunggah
            foreach ($oldFileNames as $oldFileName) {
                if (file_exists(ROOTPATH . 'public/' . $oldFileName)) {
                    unlink(ROOTPATH . 'public/' . $oldFileName);
                }
            }

            // Hapus relasi lama dari tb_galeri_barang dan tb_file_foto_barang
            $this->db->table('tb_galeri_barang')->where('id_barang', $id_barang)->delete();
            $this->db->table('tb_file_foto_barang')->whereIn('path_file_foto_barang', $oldFileNames)->delete();

            // Simpan file baru
            foreach ($uploadedFiles as $fileName) {
                $this->db->table('tb_file_foto_barang')->insert([
                    'path_file_foto_barang' => $fileName,
                ]);

                // Dapatkan ID file foto yang baru saja disimpan
                $idFileFoto = $this->db->insertID();

                // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
                $this->db->table('tb_galeri_barang')->insert([
                    'id_barang' => $id_barang,
                    'id_file_foto_barang' => $idFileFoto,
                ]);
            }

            // Update path file foto di data barang
            $dataToUpdate['path_file_foto_barang'] = implode(', ', $uploadedFiles);
        } else {
            // Jika tidak ada file baru yang diunggah, gunakan file lama
            $dataToUpdate['path_file_foto_barang'] = $this->request->getVar('old_path_file_foto_barang');
        }

        // Simpan data ke dalam database
        $this->m_barang->save($dataToUpdate);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Barang Berhasil Diubah !');

        return redirect()->to('/admin/barang');
    }
}

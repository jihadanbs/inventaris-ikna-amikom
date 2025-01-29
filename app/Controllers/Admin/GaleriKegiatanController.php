<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class GaleriKegiatanController extends BaseController
{
    // Menampilkan daftar kegiatan
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $data = [
            'title' => 'Admin | Halaman Galeri',
            'kegiatan' => $this->galeriKegiatanModel->orderBy('id_kegiatan', 'DESC')->findAll(),
        ];

        return view('admin/galeri_kegiatan/index', $data);
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Foto',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ]);

        return view('admin/galeri_kegiatan/tambah', $data);
    }

    // Menyimpan data kegiatan baru
    public function store()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Validasi input
        $rules = [
            'judul_kegiatan' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Judul Kegiatan Harus Diisi !',
                    'max_length' => 'Judul Kegiatan Maksimal 255 Karakter !',
                ],
            ],
            'foto_kegiatan' => [
                'rules' => 'uploaded[foto_kegiatan]|max_size[foto_kegiatan,2048]|is_image[foto_kegiatan]',
                'errors' => [
                    'uploaded' => 'Foto Kegiatan Wajib Diunggah !',
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
            'tanggal_foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Kegiatan Harus Diisi !',
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Kegiatan Harus Diisi !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $this->galeriKegiatanModel->save([
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'foto_kegiatan'  => uploadFile('foto_kegiatan', 'dokumen/kegiatan/'),
            'tanggal_foto'   => $this->request->getPost('tanggal_foto'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/galeri-kegiatan')->with('pesan', 'Data kegiatan berhasil ditambahkan !');
    }

    public function cek_data($judul_kegiatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mengambil data kegiatan berdasarkan judul_kegiatan
        $tb_kegiatan = $this->galeriKegiatanModel->where('judul_kegiatan', $judul_kegiatan)->first();

        // Mengecek apakah kegiatan ditemukan
        if (!$tb_kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan dengan Judul Kegiatan ' . $judul_kegiatan . ' tidak ditemukan');
        }

        // Menyiapkan data untuk tampilan
        $data = [
            'title' => 'Admin | Halaman Cek Data Kegiatan',
            'tb_kegiatan' => [$tb_kegiatan],
        ];

        return view('admin/galeri_kegiatan/cek_data', $data);
    }

    // Menampilkan form edit kegiatan
    public function edit($judul_kegiatan)
    {
        // Mengambil data kegiatan berdasarkan judul_kegiatan
        $kegiatan = $this->galeriKegiatanModel->where('judul_kegiatan', $judul_kegiatan)->first();

        // Mengecek apakah kegiatan ditemukan
        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan dengan Judul Kegiatan ' . $judul_kegiatan . ' tidak ditemukan');
        }

        $data = [
            'title' => 'Admin | Halaman Cek Data',
            'kegiatan' => $kegiatan,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/galeri_kegiatan/edit', $data);
    }

    public function update($id)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Cari data kegiatan
        $kegiatan = $this->galeriKegiatanModel->find($id);
        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan');
        }

        // Validasi input
        $rules = [
            'judul_kegiatan' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Judul Kegiatan Harus Diisi !',
                    'max_length' => 'Judul Kegiatan Maksimal 255 Karakter !',
                ],
            ],
            'tanggal_foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Kegiatan Harus Diisi !',
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Kegiatan Harus Diisi !',
                ],
            ],
        ];

        // Tambah validasi foto jika ada foto yang diupload
        $foto = $this->request->getFile('foto_kegiatan');
        if ($foto->isValid()) {
            $rules['foto_kegiatan'] = [
                'rules' => 'max_size[foto_kegiatan,2048]|is_image[foto_kegiatan]|mime_in[foto_kegiatan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar !',
                    'mime_in' => 'File Harus Berupa Gambar (JPG, JPEG, atau PNG) !'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data di database dengan path relatif
        $data = [
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'tanggal_foto'   => $this->request->getPost('tanggal_foto'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ];

        // Proses upload foto baru jika ada
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama
            if ($kegiatan['foto_kegiatan'] && file_exists($kegiatan['foto_kegiatan'])) {
                unlink($kegiatan['foto_kegiatan']);
            }

            // Upload foto baru
            $newName = $foto->getRandomName();
            $foto->move('file_upload/dokumen/kegiatan', $newName);
            $data['foto_kegiatan'] = 'file_upload/dokumen/kegiatan/' . $newName;
        }

        // Update data
        try {
            $this->galeriKegiatanModel->update($id, $data);
            return redirect()->to('/admin/galeri-kegiatan')
                ->with('pesan', 'Data Kegiatan berhasil diperbarui !');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Cek permintaan AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }

        // Ambil ID dari data POST
        $id = $this->request->getPost('id_kegiatan');

        try {
            // Cari data kegiatan berdasarkan ID
            $kegiatan = $this->galeriKegiatanModel->find($id);

            if (!$kegiatan) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data kegiatan tidak ditemukan'
                ]);
            }

            // Cek apakah foto_kegiatan ada dalam array dan tidak kosong
            if (isset($kegiatan['foto_kegiatan']) && !empty($kegiatan['foto_kegiatan'])) {
                // Path lengkap file foto
                $filePath = ROOTPATH . 'public/' . $kegiatan['foto_kegiatan'];

                // Hapus file jika ada dan path valid
                if (file_exists(realpath($filePath))) {
                    if (!unlink(realpath($filePath))) {
                        log_message('error', 'Gagal menghapus file: ' . $filePath);
                    }
                }
            }

            // Hapus data dari database
            if ($this->galeriKegiatanModel->delete($id)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data kegiatan berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data kegiatan'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}

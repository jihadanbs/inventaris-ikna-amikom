<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FotoPengurusController extends BaseController
{
    // Menampilkan daftar kegiatan
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $data = [
            'title' => 'Admin | Halaman Foto Pengurus',
            'pengurus' => $this->fotoPengurusModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('admin/foto_pengurus/index', $data);
    }

    // Menampilkan form tambah kegiatan
    public function create()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Mengambil data untuk ditampilkan di view
        $data = [
            'title' => 'Admin | Halaman Foto Pengurus',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ];

        return view('admin/foto_pengurus/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Aturan validasi input
        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama pengurus wajib diisi !',
                    'min_length' => 'Nama Pengurus Minimal 3 Karakter !',
                    'max_length' => 'Nama Pengurus Maksimal 255 Karakter !',
                ],
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,5048]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'Foto Wajib Diunggah !',
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar (JPEG, PNG, dll) !',
                ],
            ],
            'posisi' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Posisi Wajib Diisi !',
                    'min_length' => 'Posisi Minimal 3 Karakter !',
                    'max_length' => 'Posisi Maksimal 255 Karakter !',
                ],
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Divisi Wajib Dipilih !',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $this->fotoPengurusModel->save([
            'nama' => $this->request->getPost('nama'),
            'foto' => uploadFile('foto', 'dokumen/pengurus/'),
            'posisi' => $this->request->getPost('posisi'),
            'divisi' => $this->request->getPost('divisi'),
        ]);

        return redirect()->to('/admin/foto-pengurus')->with('pesan', 'Data pengurus berhasil ditambahkan !');

        return redirect()->back()->with('error', 'Gagal mengupload foto !')->withInput();
    }

    // Menampilkan form edit kegiatan
    public function edit($nama)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Mengambil data pengurus berdasarkan nama
        $pengurus = $this->fotoPengurusModel->where('nama', $nama)->first();

        // Mengecek apakah pengurus ditemukan
        if (!$pengurus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus dengan nama ' . $nama . ' tidak ditemukan');
        }

        // Mengirim data ke view
        $data = [
            'title' => 'Admin | Halaman Edit Data Pengurus',
            'pengurus' => $pengurus,
            'validation' => \Config\Services::validation(),
        ];

        return view('/admin/foto_pengurus/edit', $data);
    }

    public function update($id)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Cari data pengurus
        $pengurus = $this->fotoPengurusModel->find($id);
        if (!$pengurus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus tidak ditemukan');
        }

        // Aturan validasi
        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Nama Pengurus Wajib Diisi !',
                    'min_length' => 'Nama Pengurus Minimal 3 Karakter !',
                    'max_length' => 'Nama Pengurus Maksimal 255 Karakter !'
                ]
            ],
            'posisi' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Posisi Wajib Diisi !',
                    'min_length' => 'Posisi Minimal 3 Karakter !',
                    'max_length' => 'Posisi Maksimal 255 Karakter !'
                ]
            ],
            'divisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Divisi Wajib Dipilih !'
                ]
            ]
        ];

        // Tambah validasi foto jika ada foto yang diupload
        $foto = $this->request->getFile('foto');
        if ($foto->isValid()) {
            $rules['foto'] = [
                'rules' => 'max_size[foto,5048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Foto Tidak Boleh Lebih Dari 2MB !',
                    'is_image' => 'File Harus Berupa Gambar !',
                    'mime_in' => 'File Harus Berupa Gambar (JPG, JPEG, atau PNG) !'
                ]
            ];
        }

        // Jalankan validasi
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk update
        $data = [
            'nama' => $this->request->getPost('nama'),
            'posisi' => $this->request->getPost('posisi'),
            'divisi' => $this->request->getPost('divisi')
        ];

        // Proses upload foto baru jika ada
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama
            if ($pengurus['foto'] && file_exists($pengurus['foto'])) {
                unlink($pengurus['foto']);
            }

            // Upload foto baru
            $newName = $foto->getRandomName();
            $foto->move('file_upload/dokumen/pengurus', $newName);
            $data['foto'] = 'file_upload/dokumen/pengurus/' . $newName;
        }

        // Update data
        try {
            $this->fotoPengurusModel->update($id, $data);
            return redirect()->to('/admin/foto-pengurus')
                ->with('pesan', 'Data pengurus berhasil diperbarui');
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

        // Pastikan ini adalah permintaan AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }

        // Ambil ID dari data POST
        $id = $this->request->getPost('id');

        try {
            // Cari data pengurus berdasarkan ID
            $pengurus = $this->fotoPengurusModel->find($id);

            if (!$pengurus) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data pengurus tidak ditemukan'
                ]);
            }

            // Path lengkap file foto
            $filePath = ROOTPATH . 'public/' . $pengurus['foto'];

            // Hapus file jika ada
            if ($pengurus['foto'] && file_exists(realpath($filePath))) {
                if (!unlink(realpath($filePath))) {
                    log_message('error', 'Gagal menghapus file: ' . $filePath);
                }
            }

            // Hapus data dari database
            if ($this->fotoPengurusModel->delete($id)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data pengurus berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data pengurus'
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

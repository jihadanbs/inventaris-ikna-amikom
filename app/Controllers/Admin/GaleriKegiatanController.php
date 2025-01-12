<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriKegiatanModel;

class GaleriKegiatanController extends BaseController
{
    protected $galeriKegiatanModel;

    public function __construct()
    {
        $this->galeriKegiatanModel = new GaleriKegiatanModel();
    }

    // Menampilkan daftar kegiatan
    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $data = [
            'title' => 'Admin | Halaman Galeri',
            'kegiatan' => $this->galeriKegiatanModel->findAll(),
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
        $validation = \Config\Services::validation();

        // Validasi input
        if (!$this->validate([
            'judul_kegiatan' => 'required|max_length[255]',
            'foto_kegiatan'  => 'uploaded[foto_kegiatan]|max_size[foto_kegiatan,2048]|is_image[foto_kegiatan]',
            'tanggal_foto'   => 'required|valid_date',
            'deskripsi'      => 'permit_empty',
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data ke database
        $this->galeriKegiatanModel->save([
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'foto_kegiatan'  => uploadFile('foto_kegiatan', 'uploads/kegiatan'),
            'tanggal_foto'   => $this->request->getPost('tanggal_foto'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/admin/galeri-kegiatan')->with('success', 'Data kegiatan berhasil ditambahkan!');
    }

    public function cek_data($id_kegiatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mengambil data kegiatan berdasarkan ID
        $tb_kegiatan = $this->galeriKegiatanModel->find($id_kegiatan);

        if (!$tb_kegiatan) {
            // Jika data tidak ditemukan
            return redirect()->back()->with('error', 'Data kegiatan tidak ditemukan.');
        }

        // Menyiapkan data untuk tampilan
        $data = [
            'title' => 'Admin | Halaman Cek Data',
            'tb_kegiatan' => [$tb_kegiatan], // Bungkus dalam array untuk kompatibilitas dengan tampilan
        ];

        return view('admin/galeri_kegiatan/cek_data', $data);
    }


    // Menampilkan form edit kegiatan
    public function edit($id)
    {
        $kegiatan = $this->galeriKegiatanModel->find($id);

        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan');
        }

        $data = [
            'title' => 'Admin | Halaman Cek Data',
            'kegiatan' => $kegiatan,
            'validation' => \Config\Services::validation(), // Tambahkan ini
        ];

        return view('admin/galeri_kegiatan/edit', $data);
    }
    public function update($id)
    {
        $validation = \Config\Services::validation();

        // Validasi input
        if (!$this->validate([
            'judul_kegiatan' => 'required|max_length[255]',
            'foto_kegiatan'  => 'is_image[foto_kegiatan]|max_size[foto_kegiatan,2048]|permit_empty',
            'tanggal_foto'   => 'required|valid_date',
            'deskripsi'      => 'permit_empty',
        ])) {
            return redirect()->to("/admin/galeri-kegiatan/edit/$id")->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil file foto_kegiatan yang baru
        $file = $this->request->getFile('foto_kegiatan');
        if ($file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada file baru yang diunggah
            $oldFile = $this->request->getPost('old_foto_kegiatan');
            if (file_exists($oldFile) && $oldFile != 'file_upload/uploads/kegiatan/default.jpg') {
                unlink($oldFile); // Hapus file lama
            }

            // Proses file baru
            $fileName = $file->getRandomName();
            $file->move('file_upload/uploads/kegiatan', $fileName);
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $fileName = explode(', ', $this->request->getVar('old_foto_kegiatan'));
        }

        // Update data di database dengan path relatif
        $this->galeriKegiatanModel->update($id, [
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'foto_kegiatan'  => implode(', ', $fileName),
            'tanggal_foto'   => $this->request->getPost('tanggal_foto'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
        ]);

        // Redirect ke halaman galeri kegiatan dengan pesan sukses
        return redirect()->to('/admin/galeri-kegiatan')->with('success', 'Data kegiatan berhasil diperbarui!');
    }


    public function delete()
    {
        $id = $this->request->getPost('id_foto'); // Tangkap data ID dari POST
        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID tidak ditemukan.'
            ]);
        }

        if ($this->galeriKegiatanModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Kegiatan berhasil dihapus.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus kegiatan.'
            ]);
        }
    }


    //     public function kegiatan()
    // {
    //     // Ambil data dari database
    //     $galeriKegiatan = $this->galeriKegiatanModel->findAll();

    //     // Kirim data ke view
    //     $data = [
    //         'title' => 'Galeri Kegiatan',
    //         'galeriKegiatan' => $galeriKegiatan,
    //     ];

    //     return view('/index', $data);
    // }

}

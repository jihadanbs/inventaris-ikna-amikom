<?php

namespace App\Controllers\Admin;

use App\Models\FotoPengurusModel;
use App\Controllers\BaseController;

class FotoPengurusController extends BaseController
{
    protected $fotoPengurusModel;

    public function __construct()
    {
        $this->fotoPengurusModel = new FotoPengurusModel();
    }

    // Menampilkan daftar kegiatan
    public function index()
    {
         // Cek sesi pengguna
         if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }
        
        $data = [
            'title' => 'Admin | Halaman Foto Pengurus',
            'pengurus' => $this->fotoPengurusModel->findAll(),
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
    $validation = \Config\Services::validation();
    
    // Aturan validasi input
    $rules = [
        'judul_foto' => [
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'Judul foto wajib diisi.',
                'max_length' => 'Judul foto tidak boleh lebih dari 100 karakter.',
            ],
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi wajib diisi.',
            ],
        ],
        'file_foto' => [
            'rules' => 'uploaded[file_foto]|max_size[file_foto,2048]|is_image[file_foto]',
            'errors' => [
                'uploaded' => 'Foto wajib diunggah.',
                'max_size' => 'Ukuran foto tidak boleh lebih dari 2MB.',
                'is_image' => 'File harus berupa gambar (JPEG, PNG, dll).',
            ],
        ],
        'tanggal_foto' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal upload wajib diisi.',
            ],
        ],
    ];

    if (!$this->validate($rules)) {
        // Kirim kembali input dan pesan error validasi
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    // Proses file upload
    $file = $this->request->getFile('file_foto');
    if (!$file->isValid()) {
        return redirect()->back()->with('error', 'File upload gagal.')->withInput();
    }

    $fileName = $file->getRandomName();
    $file->move('uploads/pengurus', $fileName);

    // Simpan data ke database
    $this->fotoPengurusModel->save([
        'judul_foto'    => $this->request->getPost('judul_foto'),
        'deskripsi'     => $this->request->getPost('deskripsi'),
        'file_foto'     => 'uploads/pengurus/' . $fileName,
        'tanggal_foto'  => $this->request->getPost('tanggal_foto'),
    ]);

    return redirect()->to('/admin/foto-pengurus')->with('success', 'Data berhasil ditambahkan!');
}


    // Menampilkan form edit kegiatan
    public function edit($id)
    {
        // Mengambil data pengurus berdasarkan ID
        $pengurus = $this->fotoPengurusModel->find($id);

        // Mengecek apakah pengurus ditemukan
        if (!$pengurus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus tidak ditemukan');
        }

        // Mengirim data ke view
        $data = [
            'title' => 'Admin | Halaman Edit Data Pengurus',
            'pengurus' => $pengurus, // Pastikan ini hanya data satu pengurus
            'validation' => \Config\Services::validation(),
        ];

        return view('/admin/foto_pengurus/edit', $data);
    }

    public function update($id)
    {
        $pengurus = $this->fotoPengurusModel->find($id);
        if (!$pengurus) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus tidak ditemukan');
        }

        // Validation remains the same
        if (!$this->validate([
            'nama' => 'required|min_length[3]|max_length[255]',
            'foto' => 'permit_empty|is_image[foto]|max_size[foto,2048]',
            'posisi' => 'required|min_length[3]|max_length[255]',
            'divisi' => 'required',
        ])) {
            return redirect()->to('/admin/foto-pengurus/edit/' . $id)->withInput();
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'posisi' => $this->request->getPost('posisi'),
            'divisi' => $this->request->getPost('divisi'),
            'created_at' => $this->request->getPost('created_at'),
        ];

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // Delete old photo if exists
            if ($pengurus['foto'] && file_exists($pengurus['foto'])) {
                unlink($pengurus['foto']);
            }
            
            // Move new photo to public directory
            $newFileName = $fileFoto->getRandomName();
            $fileFoto->move('uploads/pengurus', $newFileName);
            
            // Update photo path in database
            $data['foto'] = 'uploads/pengurus/' . $newFileName;
        }

        // Update database
        $this->fotoPengurusModel->update($id, $data);

        return redirect()->to('/admin/foto-pengurus')->with('success', 'Data pengurus berhasil diperbarui');
    }

    public function delete()
    {
        // Check if this is an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
        }

        // Get the ID from POST data
        $id = $this->request->getPost('id');
        
        try {
            // Find the pengurus data first
            $pengurus = $this->fotoPengurusModel->find($id);
            
            if (!$pengurus) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data pengurus tidak ditemukan'
                ]);
            }

            // Delete the photo file if it exists
            if ($pengurus['foto'] && file_exists($pengurus['foto'])) {
                unlink($pengurus['foto']);
            }

            // Delete the database record
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

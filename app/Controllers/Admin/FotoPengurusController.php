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
    // Aturan validasi input
    $rules = [
        'nama' => [
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Nama pengurus wajib diisi.',
                'min_length' => 'Nama pengurus minimal 3 karakter.',
                'max_length' => 'Nama pengurus maksimal 255 karakter.',
            ],
        ],
        'foto' => [
            'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]',
            'errors' => [
                'uploaded' => 'Foto wajib diunggah.',
                'max_size' => 'Ukuran foto tidak boleh lebih dari 2MB.',
                'is_image' => 'File harus berupa gambar (JPEG, PNG, dll).',
            ],
        ],
        'posisi' => [
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Posisi wajib diisi.',
                'min_length' => 'Posisi minimal 3 karakter.',
                'max_length' => 'Posisi maksimal 255 karakter.',
            ],
        ],
        'divisi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Divisi wajib dipilih.',
            ],
        ],
    ];

    if (!$this->validate($rules)) {
        // Kirim kembali ke form dengan error validasi
        return redirect()->to('/admin/foto-pengurus/tambah')
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }


    // Proses upload foto
    $foto = $this->request->getFile('foto');
    if ($foto->isValid() && !$foto->hasMoved()) {
        $newName = $foto->getRandomName();
        $foto->move('uploads/pengurus', $newName);
        
        // Simpan data ke database
        $this->fotoPengurusModel->save([
            'nama' => $this->request->getPost('nama'),
            'foto' => 'uploads/pengurus/' . $newName,
            'posisi' => $this->request->getPost('posisi'),
            'divisi' => $this->request->getPost('divisi'),
        ]);

        return redirect()->to('/admin/foto-pengurus')->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    return redirect()->back()->with('error', 'Gagal mengupload foto')->withInput();
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
                'required' => 'Nama pengurus wajib diisi',
                'min_length' => 'Nama pengurus minimal 3 karakter',
                'max_length' => 'Nama pengurus maksimal 255 karakter'
            ]
        ],
        'posisi' => [
            'rules' => 'required|min_length[3]|max_length[255]',
            'errors' => [
                'required' => 'Posisi wajib diisi',
                'min_length' => 'Posisi minimal 3 karakter',
                'max_length' => 'Posisi maksimal 255 karakter'
            ]
        ],
        'divisi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Divisi wajib dipilih'
            ]
        ]
    ];

    // Tambah validasi foto jika ada foto yang diupload
    $foto = $this->request->getFile('foto');
    if ($foto->isValid()) {
        $rules['foto'] = [
            'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Ukuran foto tidak boleh lebih dari 2MB',
                'is_image' => 'File harus berupa gambar',
                'mime_in' => 'File harus berupa gambar (JPG, JPEG, atau PNG)'
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
        $foto->move('uploads/pengurus', $newName);
        $data['foto'] = 'uploads/pengurus/' . $newName;
    }

    // Update data
    try {
        $this->fotoPengurusModel->update($id, $data);
        return redirect()->to('/admin/foto-pengurus')
            ->with('success', 'Data pengurus berhasil diperbarui');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
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

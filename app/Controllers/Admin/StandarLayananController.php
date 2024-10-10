<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class InformasiPublikController extends BaseController
{

    // public function index()
    // {
    //     // Cek sesi pengguna
    //     if ($this->checkSession() !== true) {
    //         return $this->checkSession(); // Redirect jika sesi tidak valid
    //     }

    //     $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
    //     $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
    //     $tb_lembaga = $this->m_lembaga->getAllData();
    //     $tb_jenis = $this->m_jenis->getAllData();
    //     $tb_pengunjung = $this->m_pengunjung->getAllData();
    //     $tb_kategori_informasi_publik =  $this->m_kategori_informasi->getAllData();
    //     //WAJIB//
    //     $tb_pemohon = $this->m_pemohon->getAllSorted();
    //     $tb_user = $this->m_user->getAll();
    //     $unreadCount = $this->m_pemohon->countUnreadEntries();
    //     $unread = $this->m_pemohon->getUnreadEntries();
    //     $unreadCount_keberatan = $this->m_keberatan->countUnreadEntries();
    //     $unread_keberatan = $this->m_keberatan->getUnreadEntries();
    //     //END WAJIB//

    //     $data = [
    //         'title' => 'Admin | Halaman Informasi Publik',
    //         'tb_informasi_publik' => $tb_informasi_publik,
    //         'slug_info_publik' => $slug_info_publik,
    //         'tb_lembaga' => $tb_lembaga,
    //         'tb_pengunjung' => $tb_pengunjung,
    //         'tb_jenis' => $tb_jenis,
    //         'tb_kategori_informasi_publik' => $tb_kategori_informasi_publik,
    //         'tb_user' => $tb_user,
    //         'tb_pemohon' => $tb_pemohon,
    //         'unreadCount' => $unreadCount,
    //         'unread' => $unread

    //     ];

    //     return view('admin/informasi_publik/index', $data);
    // }
    // public function cek_judul()
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     // Ambil judul, id kategori, dan id lembaga yang dikirim melalui AJAX
    //     $judul = $this->request->getPost('judul');
    //     $id_kategori_informasi = $this->request->getPost('id_kategori_informasi');
    //     $id_lembaga = $this->request->getPost('id_lembaga');

    //     // Lakukan pemeriksaan apakah judul sudah ada dalam database untuk pasangan id_lembaga dan id_kategori_informasi yang sama
    //     $model = new InformasiPublikModel(); // Ganti dengan nama model yang sesuai
    //     $result = $model->where('judul', $judul)
    //         ->where('id_kategori_informasi', $id_kategori_informasi)
    //         ->where('id_lembaga', $id_lembaga)
    //         ->countAllResults();

    //     // Kembalikan hasil dalam format JSON
    //     $response = [
    //         'available' => $result === 0 // Jika hasil === 0, berarti judul belum ada dalam database
    //     ];

    //     // Kembalikan hasil dalam format JSON
    //     return $this->response->setJSON($response);
    // }


    // public function tambah()
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     $tb_lembaga = $this->m_lembaga->getAllData();
    //     $tb_jenis = $this->m_jenis->getAllData();
    //     $tb_kategori_informasi_publik =  $this->m_kategori_informasi->getAllData();
    //     $tb_user = $this->m_user->getAll();

    //     $data = [
    //         'title' => 'Admin | Halaman Tambah Informasi Publik',
    //         'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
    //         'tb_lembaga' => $tb_lembaga,
    //         'tb_jenis' => $tb_jenis,
    //         'tb_kategori_informasi_publik' => $tb_kategori_informasi_publik,
    //         'tb_user' => $tb_user,
    //     ];

    //     return view('admin/informasi_publik/tambah', $data);
    // }

    // public function save()
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     // Ambil data dari request
    //     $judul = $this->request->getVar('judul');
    //     $id_kategori_informasi = $this->request->getVar('id_kategori_informasi_publik');
    //     $id_lembaga = $this->request->getVar('id_lembaga');
    //     $id_jenis = $this->request->getVar('id_jenis');
    //     $deskripsi = $this->request->getVar('deskripsi');
    //     $tanggal_file = $this->request->getVar('tanggal_file');

    //     //validasi input 
    //     if (!$this->validate([
    //         'id_lembaga' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Nama Dinas'
    //             ]
    //         ],
    //         'id_jenis' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Nama Jenis Informasi'
    //             ]
    //         ],
    //         'id_kategori_informasi_publik' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Silahkan Pilih Kategori Informasi'
    //             ]
    //         ],
    //         'judul' => [
    //             'rules' => "required|is_unique_judul[tb_informasi_publik,id_lembaga,id_kategori_informasi]|trim|max_length[255]|min_length[5]",
    //             'errors' => [
    //                 'required' => 'Kolom Judul Tidak Boleh Kosong',
    //                 'is_unique_judul' => 'Judul sudah terdaftar untuk nama dinas dan kategori informasi yang sama.',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter.',
    //                 'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter.'
    //             ]
    //         ],
    //         'deskripsi' => [
    //             'rules' => 'required|trim|max_length[255]',
    //             'errors' => [
    //                 'required' => 'Kolom Deskripsi Tidak Boleh Kosong',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter.'
    //             ]
    //         ],
    //         // 'file_informasi_publik' => [
    //         //     'rules' => 'mime_in[file_informasi_publik,application/pdf]|max_size[file_informasi_publik,5024]',
    //         //     'errors' => [
    //         //         'mime_in' => 'File yang diunggah harus berupa PDF',
    //         //         'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB'
    //         //     ]
    //         // ],

    //     ])) {
    //         session()->setFlashdata('validation', \Config\Services::validation());
    //         return redirect()->to('/admin/informasi_publik/tambah/' . $this->request->getVar('slug'))->withInput();
    //     }

    //     $slug = url_title($this->request->getVar('judul'), '-', true);
    //     $uploadFilePDF = uploadFilePDF('file_informasi_publik', 'dokumen/informasi_publik/');
    //     $this->m_informasi_publik->save([
    //         'id_lembaga' => $id_lembaga,
    //         'id_jenis' => $id_jenis,
    //         'id_kategori_informasi_publik' => $id_kategori_informasi,
    //         'judul' => $judul,
    //         'slug' => $slug,
    //         'deskripsi' => $deskripsi,
    //         'tanggal_file' => $tanggal_file,
    //         'file_informasi_publik' => $uploadFilePDF
    //     ]);

    //     session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

    //     return redirect()->to('/admin/informasi_publik');
    // }

    // public function delete()
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     $id_informasi_publik = $this->request->getPost('id_informasi_publik');

    //     if ($this->m_informasi_publik->delete($id_informasi_publik)) {
    //         return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
    //     } else {
    //         return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
    //     }
    // }

    // public function edit($slug)
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     $tb_informasi_publik = $this->m_informasi_publik->getInformasiPublik($slug);
    //     $tb_lembaga = $this->m_lembaga->getAllData();
    //     $tb_kategori_informasi_publik =  $this->m_kategori_informasi->getAllData();
    //     $tb_user =  $this->m_user->getAll();

    //     $data = [
    //         'title' => 'Admin | Halaman Edit Informasi Publik',
    //         'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
    //         'tb_informasi_publik' => $tb_informasi_publik,
    //         'tb_lembaga' => $tb_lembaga,
    //         'slug' => $slug,
    //         'tb_kategori_informasi_publik' => $tb_kategori_informasi_publik,
    //         'tb_user' => $tb_user,
    //     ];

    //     return view('admin/informasi_publik/edit', $data);
    // }
    // public function update($id_informasi_publik)
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     // Validasi input
    //     if (!$this->validate([
    //         'judul' => [
    //             'rules' => "required|trim|max_length[255]|min_length[5]",
    //             'errors' => [
    //                 'required' => 'Kolom Judul Tidak Boleh Kosong',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter.',
    //                 'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter.'
    //             ]
    //         ],
    //         'deskripsi' => [
    //             'rules' => 'required|trim|max_length[255]',
    //             'errors' => [
    //                 'required' => 'Kolom Deskripsi Tidak Boleh Kosong',
    //                 'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter.'
    //             ]
    //         ],
    //         // 'file_informasi_publik' => [
    //         //     'rules' => 'mime_in[file_informasi_publik,application/pdf]|max_size[file_informasi_publik,5024]',
    //         //     'errors' => [
    //         //         'mime_in' => 'File yang diunggah harus berupa PDF',
    //         //         'max_size' => 'Ukuran file tidak boleh lebih dari 5024 KB'
    //         //     ]
    //         // ],

    //     ])) {
    //         // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
    //         session()->setFlashdata('validation', \Config\Services::validation());
    //         return redirect()->to('/admin/informasi_publik/edit/' . $this->request->getVar('slug'))->withInput();
    //     }

    //     // Panggil helper updateFilePDF
    //     $oldFileName = $this->request->getVar('old_file_informasi_publik'); // Nama file lama harus diambil dari input hidden
    //     $newFileName = $this->request->getFile('file_informasi_publik')->isValid() ?
    //         updateFilePDF('file_informasi_publik', 'dokumen/informasi_publik/', $oldFileName) :
    //         $oldFileName;

    //     // Simpan data ke dalam database
    //     $slug = url_title($this->request->getVar('judul'), '-', true);
    //     $this->m_informasi_publik->save([
    //         'id_informasi_publik' => $id_informasi_publik,
    //         'id_lembaga' => $this->request->getVar('id_lembaga'),
    //         'id_kategori_informasi_publik' => $this->request->getVar('id_kategori_informasi_publik'),
    //         'judul' => $this->request->getVar('judul'),
    //         'slug' => $slug,
    //         'tanggal_file' => $this->request->getVar('tanggal_file'),
    //         'deskripsi' => $this->request->getVar('deskripsi'),
    //         'file_informasi_publik' => $newFileName // Simpan nama file baru ke database
    //     ]);

    //     // Set flash message untuk sukses
    //     session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

    //     return redirect()->to('/admin/informasi_publik');
    // }

    // public function cek_data($id_informasi_publik)
    // {
    //     // Cek session
    //     if (!$this->session->has('islogin')) {
    //         return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
    //     }

    //     if (session()->get('id_jabatan') != 1) {
    //         return redirect()->to('authentication/login');
    //     }

    //     $tb_user =  $this->m_user->getAll();

    //     $data = [
    //         'title' => 'Admin | Halaman Cek Data',
    //         // Mendapatkan informasi publik berdasarkan id
    //         'tb_informasi_publik' => $this->m_informasi_publik->getAll($id_informasi_publik),
    //         // Mendapatkan informasi publik dan dokumen berdasarkan id
    //         'dokumen' => $this->m_informasi_publik->getDokumenById($id_informasi_publik),
    //         'tb_user' => $tb_user,

    //     ];

    //     // print_r($data['tb_informasi_publik']); // Cetak nilai tb_informasi_publik untuk debugging


    //     return view('admin/informasi_publik/cek_data', $data);
    // }
}

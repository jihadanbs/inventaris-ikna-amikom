<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\VidioValidation;

class VidioController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Video',
            'tb_vidio' => $this->m_vidio->getAllData(),
            'slug_vidio' =>  $this->m_vidio->getVidio(),
        ], $this->loadCommonData());

        return view('admin/vidio/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Vidio',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/vidio/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan VidioValidation
        if (!$this->validate(VidioValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil link video
        $linkVidio = $this->request->getVar('link_vidio');

        // Periksa apakah $linkVidio tidak kosong sebelum dilanjutkan
        if (!empty($linkVidio)) {
            // Periksa apakah URL YouTube menggunakan format standar atau singkat
            if (strpos($linkVidio, 'youtube.com') !== false) {
                $parsedUrl = parse_url($linkVidio);
                parse_str($parsedUrl['query'], $queryParams);

                // Cek apakah URL memiliki parameter 'v' (ID video) atau 'live'
                if (isset($queryParams['v'])) {
                    $videoId = $queryParams['v'];
                } else if (isset($queryParams['live']) && $queryParams['live'] == 1) {
                    // Jika video live menggunakan parameter live=1
                    $videoId = 'live'; // Bisa sesuaikan cara penyimpanan video live
                } else if (strpos($parsedUrl['path'], '/live') !== false) {
                    // Tangani format /live/{videoId}
                    $pathSegments = explode('/', $parsedUrl['path']);
                    $videoId = end($pathSegments); // Ambil segmen terakhir sebagai videoId
                } else {
                    // Tangani URL yang tidak valid atau format yang salah
                    $videoId = null;
                }
            } else if (strpos($linkVidio, 'youtu.be') !== false) {
                // Jika format youtu.be
                $videoId = substr($linkVidio, strrpos($linkVidio, '/') + 1);
            } else {
                // URL tidak valid atau format lain yang tidak dikenali
                $videoId = null;
            }

            // Periksa apakah $videoId sudah di-set sebelum digunakan
            if (isset($videoId) && !is_null($videoId)) {
                // Menghasilkan nama random untuk digunakan sebagai nama file
                $namaLink = uniqid();

                $this->m_vidio->save([
                    'judul_vidio' => $this->request->getVar('judul_vidio'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'tanggal_vidio' => $this->request->getVar('tanggal_vidio'),
                    'slug' => url_title($this->request->getVar('judul_vidio'), '-', true),
                    'link_vidio' => $videoId
                ]);
            } else {
                // Menangani kasus di mana $videoId belum di-set
                // Ini bisa disebabkan oleh kesalahan parsing atau URL yang tidak valid
                return redirect()->back()->withInput()->with('error', 'URL YouTube tidak valid');
            }
        } else {
            // Menangani kasus di mana $linkVidio kosong
            return redirect()->back()->withInput()->with('error', 'URL YouTube diperlukan');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/vidio');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_vidio = $this->request->getPost('id_vidio');

        if ($this->m_vidio->delete($id_vidio)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus.']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data.']);
        }
    }

    public function edit($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Vidio',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_vidio' => $this->m_vidio->getVidio($slug),
        ], $this->loadCommonData());

        return view('admin/vidio/edit', $data);
    }
    public function update($id_vidio)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan VidioValidation
        if (!$this->validate(VidioValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil link video
        $linkVidio = $this->request->getVar('link_vidio');

        // Periksa apakah $linkVidio tidak kosong sebelum dilanjutkan
        if (!empty($linkVidio)) {
            // Periksa apakah URL YouTube menggunakan format standar atau singkat
            if (strpos($linkVidio, 'youtube.com') !== false) {
                $parsedUrl = parse_url($linkVidio);
                parse_str($parsedUrl['query'], $queryParams);

                // Cek apakah URL memiliki parameter 'v' (ID video) atau 'live'
                if (isset($queryParams['v'])) {
                    $videoId = $queryParams['v'];
                } else if (isset($queryParams['live']) && $queryParams['live'] == 1) {
                    // Jika video live menggunakan parameter live=1
                    $videoId = 'live'; // Bisa disesuaikan cara penyimpanan video live
                } else if (strpos($parsedUrl['path'], '/live') !== false) {
                    // Tangani format /live/{videoId}
                    $pathSegments = explode('/', $parsedUrl['path']);
                    $videoId = end($pathSegments); // Ambil segmen terakhir sebagai videoId
                } else {
                    // Tangani URL yang tidak valid atau format yang salah
                    $videoId = null;
                }
            } else if (strpos($linkVidio, 'youtu.be') !== false) {
                // Jika format youtu.be
                $videoId = substr($linkVidio, strrpos($linkVidio, '/') + 1);
            } else {
                // URL tidak valid atau format lain yang tidak dikenali
                $videoId = null;
            }

            // Periksa apakah $videoId sudah di-set sebelum digunakan
            if (isset($videoId) && !is_null($videoId)) {
                // Menghasilkan nama random untuk digunakan sebagai nama file
                $namaLink = uniqid();

                $this->m_vidio->save([
                    'id_vidio' => $id_vidio,
                    'judul_vidio' => $this->request->getVar('judul_vidio'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'tanggal_vidio' => $this->request->getVar('tanggal_vidio'),
                    'slug' => url_title($this->request->getVar('judul_vidio'), '-', true),
                    'link_vidio' => $videoId
                ]);
            } else {
                // Menangani kasus di mana $videoId belum di-set
                // Ini bisa disebabkan oleh kesalahan parsing atau URL yang tidak valid
                return redirect()->back()->withInput()->with('error', 'URL YouTube tidak valid');
            }
        } else {
            // Menangani kasus di mana $linkVidio kosong
            return redirect()->back()->withInput()->with('error', 'URL YouTube diperlukan');
        }

        session()->setFlashdata('pesan', 'Data Berhasil Di Ubah &#128077;');

        return redirect()->to('/admin/vidio');
    }

    public function cek_data($id_vidio)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Vidio',
            'tb_vidio' => $this->m_vidio->getAll($id_vidio),
            'id_vidio' => $this->m_vidio->getid($id_vidio),
        ], $this->loadCommonData());

        // print_r($data['tb_vidio']); // Cetak nilai tb_vidio untuk debugging

        return view('admin/vidio/cek_data', $data);
    }
}

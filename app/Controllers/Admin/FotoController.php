<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\FotoValidation;
use App\Upload\FotoUpload;
use App\Services\FotoServices;

class FotoController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Foto',
            'tb_foto' => $this->m_foto->getFotoWithFile(),
        ], $this->loadCommonData()); // Meload data umum admin

        // Tampilkan view dengan data yang telah disiapkan
        return view('admin/foto/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession();
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Foto',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_foto' => $this->m_foto->getFotoWithFile(),
        ], $this->loadCommonData());

        // Tampilkan view dengan data yang telah disiapkan
        return view('admin/foto/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan FotoValidation
        if (!$this->validate(FotoValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Simpan file menggunakan FotoUpload
        $uploadedFiles = FotoUpload::saveUploads('file_foto', 'dokumen/foto/');

        if ($uploadedFiles === false) {
            // Jika file tidak berhasil diunggah, tampilkan pesan error
            session()->setFlashdata('error', 'File gagal diunggah. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }

        // Simpan data foto
        $this->m_foto->save([
            'judul_foto' => $this->request->getVar('judul_foto'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal_foto' => $this->request->getVar('tanggal_foto'),
            'slug' => url_title($this->request->getVar('judul_foto'), '-', true),
        ]);

        // Dapatkan ID dari foto yang baru saja disimpan
        $idFoto = $this->m_foto->insertID();

        // Simpan data file yang diunggah ke tb_file_foto dan relasinya ke tb_galeri
        foreach ($uploadedFiles as $fileName) {
            $this->db->table('tb_file_foto')->insert(['file_foto' => $fileName]);

            // Dapatkan ID file foto yang baru saja disimpan
            $idFileFoto = $this->db->insertID();

            // Relasikan file foto dengan foto yang sudah disimpan sebelumnya
            $this->db->table('tb_galeri')->insert([
                'id_foto' => $idFoto,
                'id_file_foto' => $idFileFoto,
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/foto');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $idFoto = $this->request->getPost('id_foto');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Dapatkan file terkait dengan foto yang akan dihapus
            $dataFiles = $this->m_foto->getFilesById($idFoto);

            if (empty($dataFiles)) {
                return $this->jsonResponse('error', 'Tidak ada file yang ditemukan untuk id_foto.');
            }

            // Hapus file yang terkait menggunakan FotoServices
            FotoServices::deleteFiles($dataFiles);

            // Hapus data terkait dari database
            $this->deleteFotoAndFiles($idFoto);

            $this->db->transComplete(); // Selesaikan transaksi

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->jsonResponse('error', 'Gagal menghapus file dan data');
            }

            $this->db->transCommit();
            return $this->jsonResponse('success', 'File dan data berhasil dihapus');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->jsonResponse('error', 'Gagal menghapus file dan data', $e->getMessage());
        }
    }

    private function deleteFotoAndFiles($idFoto)
    {
        // Hapus entri dari tb_galeri
        $this->m_foto->deleteFilesAndEntries($idFoto);

        // Hapus entri dari tb_foto
        $this->db->table('tb_foto')->where('id_foto', $idFoto)->delete();

        // Hapus entri dari tb_file_foto yang tidak terkait dengan laporan lain
        $this->db->table('tb_file_foto')
            ->whereNotIn('id_file_foto', function ($builder) use ($idFoto) {
                $builder->select('id_file_foto')
                    ->from('tb_galeri')
                    ->where('id_foto !=', $idFoto);
            })
            ->delete();
    }

    private function jsonResponse($status, $message, $error = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($error) {
            $response['error'] = $error;
        }
        return $this->response->setJSON($response);
    }

    public function edit($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit Data Foto',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_foto' => $this->m_foto->getFotoWithSlug($slug),
            'slug' => $slug,
        ], $this->loadCommonData());

        return view('admin/foto/edit', $data);
    }

    public function update($id_foto)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate(FotoValidation::validationRules())) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Upload file baru jika ada
        $uploadedFiles = FotoUpload::handleFileUpload('file_foto', 'dokumen/foto/');

        if (!empty($uploadedFiles)) {
            // Hapus file lama
            $oldFileNames = explode(', ', $this->request->getVar('old_file_foto'));
            FotoServices::deleteOldFiles($oldFileNames);

            // Hapus relasi lama dari database
            $this->db->table('tb_galeri')->where('id_foto', $id_foto)->delete();
            $this->db->table('tb_file_foto')->whereIn('file_foto', $oldFileNames)->delete();

            // Simpan file baru dan relasi
            FotoUpload::saveNewFiles($uploadedFiles, $id_foto);
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $uploadedFiles = explode(', ', $this->request->getVar('old_file_foto'));
        }

        // Simpan data ke database
        $slug = url_title($this->request->getVar('judul_foto'), '-', true);
        $this->m_foto->save([
            'id_foto' => $id_foto,
            'judul_foto' => $this->request->getVar('judul_foto'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal_foto' => $this->request->getVar('tanggal_foto'),
            'slug' => $slug,
            'file_foto' => implode(', ', $uploadedFiles)
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/foto');
    }

    public function cek_data($id_foto)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data',
            'tb_foto' => $this->m_foto->getFotoWithFileId($id_foto),
            'dokumen' => $this->m_foto->getDokumenByFotoId($id_foto),
        ], $this->loadCommonData());

        // print_r($data['tb_foto']); // Cetak nilai tb_informasi_publik untuk debugging

        return view('admin/foto/cek_data', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\FaqValidation;

class FaqController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman FAQ',
            'tb_faq' => $this->m_faq->getAllSorted(),
            'tb_kategori_faq' => $this->m_kategori_faq->getAllData(),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/faq/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah FAQ',
            'tb_kategori_faq' => $this->m_kategori_faq->getAllData(),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
        ], $this->loadCommonData());

        return view('admin/faq/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan FotoValidation
        if (!$this->validate(FaqValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $this->m_faq->save([
            'id_kategori_faq' => $this->request->getVar('id_kategori_faq'),
            'pertanyaan' => $this->request->getVar('pertanyaan'),
            'jawaban' => $this->request->getVar('jawaban'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/faq');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil ID FAQ yang akan dihapus
        $idFaq = $this->getFaqIdFromRequest();

        // Hapus data dan kembalikan respons
        return $this->deleteFaq($idFaq);
    }

    // Ambil ID FAQ dari request
    private function getFaqIdFromRequest()
    {
        return $this->request->getPost('id_faq');
    }

    // Hapus FAQ berdasarkan ID dan kirim respons JSON
    private function deleteFaq($idFaq)
    {
        if ($this->m_faq->delete($idFaq)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data']);
        }
    }

    public function edit($id_faq)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit FAQ',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_faq' => $this->m_faq->getFaq($id_faq),
            'tb_kategori_faq' => $this->m_kategori_faq->getAllData(),
        ], $this->loadCommonData());

        return view('admin/faq/edit', $data);
    }
    public function update($id_faq)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan FotoValidation
        if (!$this->validate(FaqValidation::validationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Simpan data ke dalam database
        $this->m_faq->save([
            'id_faq' => $id_faq,
            'id_kategori_faq' => $this->request->getVar('id_kategori_faq'),
            'pertanyaan' => $this->request->getVar('pertanyaan'),
            'jawaban' => $this->request->getVar('jawaban'),
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/faq');
    }

    public function cek_data($id_faq)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data FAQ',
            'tb_faq' => $this->m_faq->getAll($id_faq),
            'id_faq' => $this->m_faq->getid($id_faq),
        ], $this->loadCommonData());

        // print_r($data['tb_faq']); // Cetak nilai tb_faq untuk debugging

        return view('admin/faq/cek_data', $data);
    }
}

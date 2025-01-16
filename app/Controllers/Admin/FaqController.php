<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
        ]);

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
        ]);

        return view('admin/faq/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Aturan validasi input
        $rules = [
            'id_kategori_faq' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori FAQ !'
                ]
            ],
            'pertanyaan' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Pertanyaan Tidak Boleh Kosong !',
                    'min_length' => 'Pertanyaan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'jawaban' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Jawaban Tidak Boleh Kosong !',
                    'min_length' => 'Jawaban tidak boleh kurang dari 5 karakter !'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->m_faq->save([
            'id_kategori_faq' => $this->request->getPost('id_kategori_faq'),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'slug' => url_title(strip_tags($this->request->getPost('pertanyaan')), '-', true),
            'jawaban' => $this->request->getPost('jawaban'),
        ]);

        return redirect()->to('admin/faq')->with('pesan', 'Data FAQ berhasil ditambahkan !');
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

    public function cek_data($slug)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $tb_faq = $this->m_faq->getSlug($slug);

        if (!$tb_faq) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('FAQ dengan ' . $slug . ' tidak ditemukan');
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data FAQ',
            'tb_faq' => $tb_faq,
        ]);

        // print_r($data['tb_faq']); // Cetak nilai tb_faq untuk debugging

        return view('admin/faq/cek_data', $data);
    }

    public function edit($id_faq)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $tb_faq = $this->m_faq->getFaq($id_faq);

        if (!$tb_faq) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('FAQ dengan ' . $id_faq . ' tidak ditemukan');
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Edit FAQ',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_faq' => $tb_faq,
            'tb_kategori_faq' => $this->m_kategori_faq->getAllData(),
        ]);

        return view('admin/faq/edit', $data);
    }
    public function update($id_faq)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $rules = [
            'id_kategori_faq' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Kategori FAQ !'
                ]
            ],
            'pertanyaan' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Pertanyaan Tidak Boleh Kosong !',
                    'min_length' => 'Pertanyaan tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'jawaban' => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Jawaban Tidak Boleh Kosong !',
                    'min_length' => 'Jawaban tidak boleh kurang dari 5 karakter !'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            // Kirim kembali ke form dengan error validasi
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_kategori_faq' => $this->request->getPost('id_kategori_faq'),
            'slug' => url_title(strip_tags($this->request->getPost('pertanyaan')), '-', true),
            'pertanyaan' => $this->request->getPost('pertanyaan'),
            'jawaban' => $this->request->getPost('jawaban'),
        ];

        if (empty($data)) {
            return $this->response->setJSON('Tidak ada data untuk diperbarui !', $data);
        }

        $this->m_faq->update($id_faq, $data);

        return redirect()->to('admin/faq')->with('pesan', 'Data FAQ berhasil diubah !');
    }
}

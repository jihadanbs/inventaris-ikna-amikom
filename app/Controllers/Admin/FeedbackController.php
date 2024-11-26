<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\FeedbackValidation;
use App\Gmail\FeedbackGmail;

class FeedbackController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Feedback Pengunjung',
            'tb_feedback' => $this->m_feedback->getAllData(),
        ]);

        return view('admin/feedback/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_feedback' => $this->m_feedback->getFeedback(),
        ]);

        return view('admin/feedback/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan FeedbackValidation
        if (!$this->validate(FeedbackValidation::saveValidationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getVar('nama'),
            'subjek' => $this->request->getVar('subjek'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        // Simpan data ke database
        $this->m_feedback->save($data);

        // Kirim email menggunakan FeedbackGmail
        if (FeedbackGmail::saveAndSendGmailRules($data)) {
            session()->setFlashdata('pesan', 'Feedback Berhasil Diajukan dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi.');
        }

        return redirect()->back();
    }

    public function cek_data($id_feedback)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_feedback' => $this->m_feedback->getFeedback($id_feedback),
        ]);

        return view('admin/feedback/cek_data', $data);
    }

    public function balas($id_feedback)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Balas Feedback Pengunjung',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_feedback' => $this->m_feedback->getFeedback($id_feedback),
        ]);

        return view('admin/feedback/balas', $data);
    }

    public function kirim($id_feedback)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil dan validasi data dari form
        $formData = $this->getFormData();
        if (!$this->validate(FeedbackValidation::balasValidationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data feedback dari database
        $tb_feedback = $this->m_feedback->getFeedback($id_feedback);
        if (!$tb_feedback) {
            session()->setFlashdata('gagal', 'Data pemohon tidak ditemukan.');
            return redirect()->to('/admin/feedback');
        }

        // Siapkan data untuk email dan simpan ke database
        $emailData = $this->prepareEmailData($tb_feedback, $formData);
        $this->saveFeedbackResponse($id_feedback, $formData['balasan']);

        // Kirim email
        if (FeedbackGmail::balasGmailRules($emailData)) {
            session()->setFlashdata('pesan', 'Anda telah melakukan pemberian tanggapan kepada ' . htmlspecialchars($tb_feedback->nama) . ' dan pengiriman email berhasil.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($tb_feedback->email) . '. Silakan coba lagi.');
        }

        return redirect()->to('/admin/feedback');
    }

    // Ambil data dari form yang ingin di balas
    private function getFormData()
    {
        return [
            'balasan' => $this->request->getVar('balasan')
        ];
    }

    // Siapkan data untuk email yang ingin di balas
    private function prepareEmailData($feedback, $formData)
    {
        return [
            'nama' => $feedback->nama,
            'email' => $feedback->email,
            'subjek' => $feedback->subjek,
            'pesan' => $feedback->pesan,
            'balasan' => $formData['balasan']
        ];
    }

    // Simpan tanggapan ke database yang ingin di balas
    private function saveFeedbackResponse($id_feedback, $balasan)
    {
        $data = [
            'id_feedback' => $id_feedback,
            'balasan' => $balasan,
            'status' => 'Sudah Ditanggapi'
        ];

        $this->m_feedback->save($data);
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_feedback = $this->request->getPost('id_feedback');

        if ($this->m_feedback->delete($id_feedback)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data']);
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_feedback = $this->request->getPost('id_feedback');

        if ($this->m_feedback->delete($id_feedback)) {
            return $this->response->setJSON(['success' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menghapus data']);
        }
    }

    // Frontend Function
    public function send()
    {
        // Ambil data dari form
        $data = [
            'nama' => $this->request->getVar('nama'),
            'subjek' => $this->request->getVar('subjek'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        // Simpan data ke database
        $this->m_feedback->save($data);

        // Kirim email menggunakan FeedbackGmail
        $emailSent = FeedbackGmail::saveAndSendGmailRules($data);

        if ($emailSent) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function send2()
    {
        // Ambil data dari form
        $data = [
            'nama' => $this->request->getVar('nama'),
            'subjek' => $this->request->getVar('subjek'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        // Simpan data ke database
        $this->m_feedback->save($data);

        // Kirim email menggunakan FeedbackGmail
        $emailSent = FeedbackGmail::saveAndSendGmailRules($data);

        if ($emailSent) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}

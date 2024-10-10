<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PengunjungController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Pengunjung',
            'tb_pengunjung' => $this->m_pengunjung->getAllData()
        ], $this->loadCommonData());

        return view('admin/pengunjung/index', $data);
    }
    public function downloadFile()
    {
        $email = $this->request->getPost('email');
        $id_informasi_publik = $this->request->getPost('id_informasi_publik'); // ID file dari form
        $id_laporan = $this->request->getPost('id_laporan');

        // Validasi email
        $validationRules = [
            'email' => 'required|valid_email'
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Email tidak valid.');
        }

        // Proses download file dan catat log
        $this->m_pengunjung->recordDownload($id_laporan, $id_informasi_publik, $email);

        // Lakukan logika unduhan file di sini

        // Redirect ke halaman sukses
        return redirect()->back();
    }

    public function success()
    {
        return view('download_success');
    }

    public function downloa1($id)
    {
        // Cari data pengunjung berdasarkan ID
        $pengunjung = $this->m_pengunjung->find($id);

        if (!$pengunjung) {
            // Jika data pengunjung tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->to('/'); // Ganti dengan halaman lain jika perlu
        }

        // Ambil informasi publik atau laporan berdasarkan jenis unduhan
        $file = null;
        if ($pengunjung->id_informasi_publik) {
            $file = $this->m_pengunjung->getInformasiPublik($pengunjung->id_informasi_publik);
        } elseif ($pengunjung->id_laporan) {
            $file = $this->m_pengunjung->getLaporan($pengunjung->id_laporan);
        }

        if (!$file) {
            // Jika file tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->to('/'); // Ganti dengan halaman lain jika perlu
        }

        // Buat array data untuk ditampilkan di template email
        $emailData = [
            'file' => $file
        ];

        // Buat tampilan email menggunakan template yang diinginkan
        $emailBody = view('Views/gmail/download_informasi_gmail.php', $emailData);

        // Proses pengiriman email
        $email = \Config\Services::email();

        // Konfigurasi email
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($pengunjung->email_pengunjung);
        $email->setSubject('File Unduhan');
        $email->setMessage($emailBody);

        // Lampirkan file
        $email->attach(FCPATH . 'uploads/' . $file->nama_file);

        // Kirim email
        if ($email->send()) {
            // Jika email berhasil dikirim, kembalikan response atau tampilkan pesan sukses
            return redirect()->back()->with('success', 'File telah berhasil dikirim melalui email.');
        } else {
            // Jika terjadi kesalahan saat mengirim email, tampilkan pesan error
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    // public function download()
    // {
    //     $email = $this->request->getJSON()->email;
    //     $fileId = $this->request->getJSON()->fileId;

    //     if (empty($email) || empty($fileId)) {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Alamat email atau ID file tidak valid']);
    //     }

    //     $berkas = new InformasiPublikModel();
    //     $data = $berkas->find($fileId);

    //     if (!$data) {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
    //     }

    //     if (!isset($data['file_informasi_publik'])) {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Berkas tidak ditemukan']);
    //     }

    //     $filePath = ROOTPATH . 'public/' . $data['file_informasi_publik'];
    //     if (!file_exists($filePath)) {
    //         return $this->response->setJSON(['success' => false, 'message' => 'File tidak ditemukan di server']);
    //     }

    //     // Buat tampilan email menggunakan template yang diinginkan
    //     $emailBody = view('Views/gmail/download_informasi_gmail', ['file' => $data['file_informasi_publik']]);

    //     // Proses pengiriman email
    //     $emailService = Services::email();

    //     // Konfigurasi email
    //     $emailService->setNewline("\r\n");
    //     $emailService->setMailType('html');
    //     $emailService->setTo($email);
    //     $emailService->setSubject('File Unduhan');
    //     $emailService->setMessage($emailBody);

    //     // Lampirkan file
    //     $emailService->attach($filePath);

    //     // Kirim email
    //     if ($emailService->send()) {
    //         return $this->response->setJSON(['success' => true, 'message' => 'File berhasil dikirim ke email']);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengirim email']);
    //     }
    // }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class InformasiPublikController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Informasi Publik',
            'tb_informasi_publik' => $this->m_informasi_publik->getAllSorted(),
            'slug_info_publik' => $this->m_informasi_publik->getInformasiPublik(),
            'tb_lembaga' => $this->m_lembaga->getAllData(),
            'tb_pengunjung' => $this->m_pengunjung->getAllData(),
            'tb_jenis' => $this->m_jenis->getAllData(),
            'tb_kategori_informasi_publik' => $this->m_kategori_informasi->getAllData(),
        ], $this->loadCommonData());

        return view('admin/informasi_publik/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Informasi Publik',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_lembaga' => $this->m_lembaga->getAllData(),
            'tb_jenis' => $this->m_jenis->getAllData(),
            'tb_kategori_informasi_publik' => $this->m_kategori_informasi->getAllData(),
        ], $this->loadCommonData());

        return view('admin/informasi_publik/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Ambil data dari request
        $judul = $this->request->getVar('judul');
        $id_kategori_informasi = $this->request->getVar('id_kategori_informasi_publik');
        $id_lembaga = $this->request->getVar('id_lembaga');
        $id_jenis = $this->request->getVar('id_jenis');
        $deskripsi = $this->request->getVar('deskripsi');
        $tanggal_file = $this->request->getVar('tanggal_file');

        //validasi input 
        if (!$this->validate([
            'id_lembaga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Dinas !'
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Nama Jenis Informasi !'
                ]
            ],
            'id_kategori_informasi_publik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih Kategori Informasi !'
                ]
            ],
            'judul' => [
                'rules' => "required|is_unique_judul[tb_informasi_publik,id_lembaga,id_kategori_informasi_publik,id_jenis]|trim|min_length[5]|max_length[90]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'is_unique_judul' => 'Judul sudah terdaftar untuk nama dinas, kategori informasi publik, dan jenis informasi yang sama !',
                    'min_length' => 'Judul tidak boleh kurang dari 5 karakter !',
                    'max_length' => 'Judul tidak boleh melebihi 90 karakter !',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'min_length' => 'Deskripsi tidak boleh kurang dari 5 karakter !',
                    'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !',
                ]
            ],
            'tanggal_file' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal File !'
                ]
            ],
        ])) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $uploadFilePDF = uploadFilePDF('file_informasi_publik', 'dokumen/informasi_publik/');
        $this->m_informasi_publik->save([
            'id_lembaga' => $id_lembaga,
            'id_jenis' => $id_jenis,
            'id_kategori_informasi_publik' => $id_kategori_informasi,
            'judul' => $judul,
            'slug' => $slug,
            'deskripsi' => $deskripsi,
            'tanggal_file' => $tanggal_file,
            'file_informasi_publik' => $uploadFilePDF
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan &#128077;');

        return redirect()->to('/admin/informasi_publik');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_informasi_publik = $this->request->getPost('id_informasi_publik');

        $this->db->transStart(); // Memulai transaksi

        try {
            $dataFiles = $this->m_informasi_publik->getFilesById($id_informasi_publik);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_informasi_publik.');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_informasi_publik->deleteById($id_informasi_publik);

            $this->db->transComplete(); // Mengakhiri transaksi

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $this->db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $id_informasi_publik = $this->request->getPost('id_informasi_publik');

        $this->db->transStart(); // Memulai transaksi

        try {
            $dataFiles = $this->m_informasi_publik->getFilesById($id_informasi_publik);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk id_informasi_publik.');
            }

            foreach ($dataFiles[0] as $fileColumn => $filePath) {
                if (!empty($filePath)) {
                    $fullFilePath = ROOTPATH . 'public/' . $filePath;
                    if (is_file($fullFilePath)) {
                        if (!unlink($fullFilePath)) {
                            throw new \Exception('Gagal menghapus file: ' . $fullFilePath);
                        }
                    }
                }
            }

            $this->m_informasi_publik->deleteById($id_informasi_publik);

            $this->db->transComplete(); // Mengakhiri transaksi

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data']);
            }

            $this->db->transCommit();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Semua file dan data berhasil dihapus']);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus file dan data', 'error' => $e->getMessage()]);
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
            'title' => 'Admin | Halaman Edit Informasi Publik',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_informasi_publik' => $this->m_informasi_publik->getInformasiPublik($slug),
            'tb_lembaga' => $this->m_lembaga->getAllData(),
            'tb_jenis' => $this->m_jenis->getAllData(),
            'tb_kategori_informasi_publik' => $this->m_kategori_informasi->getAllData(),
            'slug' => $slug,
        ], $this->loadCommonData());

        return view('admin/informasi_publik/edit', $data);
    }
    public function update($id_informasi_publik)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => "required|trim|max_length[90]|min_length[5]",
                'errors' => [
                    'required' => 'Kolom Judul Tidak Boleh Kosong !',
                    'max_length' => 'Judul tidak boleh melebihi 90 karakter !',
                    'min_length' => 'Judul tidak boleh kurang dari 5 karakter !'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim|max_length[255]',
                'errors' => [
                    'required' => 'Kolom Deskripsi Tidak Boleh Kosong !',
                    'max_length' => 'Deskripsi tidak boleh melebihi 255 karakter !'
                ]
            ],
            'tanggal_file' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Masukkan Tanggal File !'
                ]
            ],

        ])) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Panggil helper updateFilePDF
        $oldFileName = $this->request->getVar('old_file_informasi_publik'); // Nama file lama harus diambil dari input hidden
        $newFileName = $this->request->getFile('file_informasi_publik')->isValid() ?
            updateFilePDF('file_informasi_publik', 'dokumen/informasi_publik/', $oldFileName) :
            $oldFileName;

        // Simpan data ke dalam database
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->m_informasi_publik->save([
            'id_informasi_publik' => $id_informasi_publik,
            'id_lembaga' => $this->request->getVar('id_lembaga'),
            'id_kategori_informasi_publik' => $this->request->getVar('id_kategori_informasi_publik'),
            'id_jenis' => $this->request->getVar('id_jenis'),
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'tanggal_file' => $this->request->getVar('tanggal_file'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'file_informasi_publik' => $newFileName
        ]);

        // Set flash message untuk sukses
        session()->setFlashdata('pesan', 'Data Berhasil Diubah &#128077;');

        return redirect()->to('/admin/informasi_publik');
    }

    public function cek_data($id_informasi_publik)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data',
            'tb_informasi_publik' => $this->m_informasi_publik->getAll($id_informasi_publik),
            'dokumen' => $this->m_informasi_publik->getDokumenById($id_informasi_publik),
        ], $this->loadCommonData());

        // print_r($data['tb_informasi_publik']); // Cetak nilai tb_informasi_publik untuk debugging

        return view('admin/informasi_publik/cek_data', $data);
    }

    public function downloadFile($id_informasi_publik)
    {
        $data = $this->m_informasi_publik->find($id_informasi_publik);
        if (!$data) {
            return 'Data tidak ditemukan';
        }
        if (!isset($data['file_informasi_publik'])) {
            return 'Berkas tidak ditemukan';
        }
        $pathToFile = ROOTPATH . 'public/' . $data['file_informasi_publik'];
        return $this->response->download($pathToFile, null);
    }

    public function downloadFile_1($id_informasi_publik)
    {
        $data = $this->m_informasi_publik->find($id_informasi_publik);
        if (!$data) {
            return 'Data tidak ditemukan';
        }
        if (!isset($data['file_informasi_publik'])) {
            return 'Berkas tidak ditemukan';
        }
        // Assuming you have the email stored in your database
        $email_pengunjung = $data['email_pengunjung'];

        $pathToFile = ROOTPATH . 'public/' . $data['file_informasi_publik'];

        // Send the file to the email
        $emailData = [
            'file_informasi_publik' => $pathToFile // This should be the path to the file on your server
        ];
        $emailBody = view('Views/gmail/download_informasi_gmail.php', $emailData);

        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email_pengunjung);
        $this->email->setSubject('File Download');
        $this->email->setMessage($emailBody);

        // Check if the email is sent successfully
        if ($this->email->send()) {
            // If the email is sent successfully, proceed to allow the user to download the file
            $pathToFile = ROOTPATH . 'public/' . $data['file_informasi_publik'];
            return $this->response->download($pathToFile, null);
        } else {
            // If the email sending fails, print the email debugger output
            echo $this->email->printDebugger();
            return 'Gagal mengirim email. Silakan coba lagi.';
        }
    }

    public function kirim($id_informasi_publik)
    {
        // Ambil data dari request
        $email_pengunjung = $this->request->getVar('email_pengunjung');

        // Log data request
        log_message('debug', 'Request Data: ' . json_encode($this->request->getPost()));

        // Validasi input dasar
        $validationRules = [
            'email_pengunjung' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom Email Tidak Boleh Kosong',
                    'valid_email' => 'Email Tidak Valid'
                ]
            ],
        ];

        // Validasi input
        if (!$this->validate($validationRules)) {
            log_message('error', 'Validation Error: ' . json_encode($this->validator->getErrors()));
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Email tidak valid.']);
        }

        $data = $this->m_informasi_publik->find($id_informasi_publik);

        if (!$data) {
            return 'Data tidak ditemukan';
        }

        if (!isset($data['file_informasi_publik'])) {
            return 'Berkas tidak ditemukan';
        }

        $pathToFile = ROOTPATH . 'public/' . $data['file_informasi_publik'];

        // Dapatkan path file informasi publik
        $file_informasi_publik = $pathToFile;
        log_message('debug', 'File Path: ' . $file_informasi_publik);

        // Periksa apakah file ada dan valid
        if ($file_informasi_publik === null || !file_exists($file_informasi_publik)) {
            log_message('error', 'File tidak ditemukan atau tidak valid: ' . $file_informasi_publik);
            return $this->response->setStatusCode(404)->setJSON(['error' => 'File tidak ditemukan atau tidak valid.']);
        }

        // Simpan data ke database
        $dataSave = [
            'email_pengunjung' => $email_pengunjung,
            'id_informasi_publik' => $id_informasi_publik,
            'download_time' => date('Y-m-d H:i:s')
        ];

        // Buat template email dengan data
        $emailData = [
            'file_informasi_publik' => base_url($data['file_informasi_publik']) // URL ke file yang diunggah
        ];

        // Load view template email
        $emailBody = view('Views/gmail/download_informasi_gmail.php', $emailData);

        // Set email parameters
        $this->email->setNewline("\r\n");
        $this->email->setMailType('html');
        $this->email->setTo($email_pengunjung);
        $this->email->setSubject('File Download');
        $this->email->setMessage($emailBody);

        // Kirim email
        if ($this->email->send()) {
            $this->m_pemohon->save($dataSave); // Simpan data hanya jika email berhasil dikirim
            log_message('debug', 'Email berhasil dikirim ke: ' . $email_pengunjung);
            return $this->response->setJSON(['message' => 'Permohonan Berhasil Diajukan Dan Email Telah Dikirim.']);
        } else {
            $emailErrors = $this->email->printDebugger(['headers']);
            log_message('error', 'Gagal Mengirim Email: ' . $emailErrors);
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Gagal Mengirim Email. Silakan Coba Lagi.']);
        }
    }

    public function totalData()
    {
        $totalData = $this->m_informasi_publik->getTotalInformasiPublik();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }


    public function download_1()
    {
        $request = service('request');
        $email = $request->getPost('email');
        $fileId = $request->getPost('fileId');

        if (empty($email) || empty($fileId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Alamat email atau ID file tidak valid']);
        }

        $data = $this->m_informasi_publik->find($fileId);

        if (!$data) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan']);
        }

        if (!isset($data['file_informasi_publik'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Berkas tidak ditemukan']);
        }

        $filePath = ROOTPATH . 'public/' . $data['file_informasi_publik'];

        if (!file_exists($filePath)) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak ditemukan di server']);
        }

        $this->email->setTo($email);
        $this->email->setSubject('File Unduhan');
        $this->email->setMessage('Berikut adalah file yang Anda minta.');
        $this->email->attach($filePath);

        if ($this->email->send()) {

            return $this->response->setJSON(['success' => true, 'message' => 'File berhasil dikirim ke email']);
        } else {
            $error =  $this->email->printDebugger(['headers']);
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengirim email. Error: ' . $error]);
        }
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Validation\KeberatanValidation;
use App\Gmail\KeberatanGmail;
use App\Services\KeberatanServices;

class KeberatanController extends BaseController
{

    public function index()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Keberatan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' => $this->m_alasan->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/index', $data);
    }

    public function tambah()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Tambah Keberatan',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' => $this->m_alasan->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/tambah', $data);
    }

    public function save()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan KeberatanValidation
        if (!$this->validate(KeberatanValidation::saveValidationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Siapkan data untuk disimpan ke tb_keberatan
        $data = [
            'kode_keberatan' => $this->m_keberatan->generateKodeKeberatan(),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'ringkasan_kasus' => $this->request->getVar('ringkasan_kasus'),
            'file_keberatan' => uploadFilePDF('file_keberatan', 'permohonan_keberatan/file_keberatan/'),
        ];

        // Simpan data ke tb_keberatan
        $this->m_keberatan->save($data);

        // Ambil data dari request
        $id_alasan = (array) $this->request->getVar('id_alasan'); // Paksa menjadi array, walau hanya 1 nilai

        // Siapkan data untuk disimpan
        $insertData = array_map(function ($alasan) {
            return [
                'id_keberatan' => $this->m_keberatan->getInsertID(),
                'id_alasan' => $alasan,
            ];
        }, $id_alasan);

        // Insert data ke tb_form_keberatan secara batch
        $this->db->table('tb_form_keberatan')->insertBatch($insertData);

        // Kirim email menggunakan KeberatanGmail
        if (KeberatanGmail::saveDanKirimGmailRules($data)) {
            session()->setFlashdata('pesan', 'Keberatan Berhasil Diajukan Dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi.');
        }

        return redirect()->to('/admin/keberatan');
    }

    public function cek_data($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $this->m_keberatan->updateStatusBaca($id_keberatan);
        $keberatanData = $this->m_keberatan->getKeberatanById($id_keberatan);

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Cek Data',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'keberatan' => !empty($keberatanData) ? $keberatanData[0] : null,
            'dokumen' => $this->m_keberatan->getDokumenById($id_keberatan),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' =>  $this->m_alasan->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/cek_data', $data);
    }

    public function diproses($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $keberatanData = $this->m_keberatan->getKeberatanById($id_keberatan);

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Proses Data',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'dokumen' => $this->m_keberatan->getDokumenById($id_keberatan),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' => $this->m_alasan->getAllData(),
            'keberatan' => !empty($keberatanData) ? $keberatanData[0] : null,
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/diproses', $data);
    }

    public function proses($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan KeberatanValidation
        if (!$this->validate(KeberatanValidation::allValidationRules())) {
            // Jika terjadi kesalahan validasi, kembalikan dengan pesan validasi
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil nama pemohon dari database
        $pengaju_keberatan = $this->m_keberatan->getKeberatanEmail($id_keberatan);

        $data = [
            'id_keberatan' => $id_keberatan,
            'status' => 'Diproses',
            'tanggapan' => $this->request->getVar('tanggapan'),
        ];

        // Kirim email dengan status "Diproses"
        if (KeberatanGmail::tanggapanGmailRules($pengaju_keberatan, $data['tanggapan'], 'Diproses')) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Pemrosesan Keberatan</strong> ' . htmlspecialchars($pengaju_keberatan['nama']) . ' dan pengiriman email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . '. Silakan Coba Lagi, Mungkin Alamat Email Pengguna Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_keberatan->save($data);

        return redirect()->to('/admin/keberatan');
    }


    public function ditolak($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $keberatanData = $this->m_keberatan->getKeberatanById($id_keberatan);

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Penolakan Data',
            'keberatan' => !empty($keberatanData) ? $keberatanData[0] : null,
            'dokumen' => $this->m_keberatan->getDokumenById($id_keberatan),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' => $this->m_alasan->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/ditolak', $data);
    }

    public function reject($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan KeberatanValidation
        if (!$this->validate(KeberatanValidation::allValidationRules())) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil data pengaju dari database
        $pengaju_keberatan = $this->m_keberatan->getKeberatanEmail($id_keberatan);

        // Data untuk penyimpanan
        $data = [
            'id_keberatan' => $id_keberatan,
            'status' => 'Ditolak',
            'tanggapan' => $this->request->getVar('tanggapan'),
        ];

        // Kirim email dengan status "Ditolak"
        if (KeberatanGmail::tanggapanGmailRules($pengaju_keberatan, $data['tanggapan'], 'Ditolak')) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Penolakan Keberatan</strong> ' . htmlspecialchars($pengaju_keberatan['nama']) . ' dan pengiriman email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . '. Silakan Coba Lagi, Mungkin Alamat Email Pengguna Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_keberatan->save($data);

        return redirect()->to('/admin/keberatan');
    }

    public function diberikan($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        $keberatanData = $this->m_keberatan->getKeberatanById($id_keberatan);

        // Menyiapkan data untuk tampilan
        $data = array_merge([
            'title' => 'Admin | Halaman Pemberian Keberatan',
            'keberatan' => !empty($keberatanData) ? $keberatanData[0] : null,
            'dokumen' => $this->m_keberatan->getDokumenById($id_keberatan),
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_keberatan' => $this->m_keberatan->getKeberatan(),
            'tb_alasan' => $this->m_alasan->getAllData(),
        ], $this->loadCommonData()); // Meload data umum admin

        return view('admin/keberatan/diberikan', $data);
    }

    public function berikan($id_keberatan)
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Validasi input menggunakan KeberatanValidation
        if (!$this->validate(KeberatanValidation::allValidationRules())) {
            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->back()->withInput();
        }

        // Ambil nama pemohon dari database
        $pengaju_keberatan = $this->m_keberatan->getKeberatanEmail($id_keberatan);

        $data = [
            'id_keberatan' => $id_keberatan,
            'status' => 'Diberikan',
            'tanggapan' => $this->request->getVar('tanggapan'),
            'file_diberikan' => uploadFilePDF('file_diberikan', 'permohonan_keberatan/file_diberikan/'),
        ];

        // Pastikan file_diberikan tidak null sebelum membuat URL
        $file_url = $data['file_diberikan'] ? base_url($data['file_diberikan']) : null;

        // Panggil fungsi untuk mengirim email
        if (KeberatanGmail::tanggapanGmailRules($pengaju_keberatan, $data['tanggapan'], 'Diberikan', $file_url)) {
            session()->setFlashdata('pesan', 'Anda telah melakukan <strong>Pemberian Keberatan</strong> ' . htmlspecialchars($pengaju_keberatan['nama']) . ' dan pengiriman email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . ' &#128077;');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email ke alamat ' . htmlspecialchars($pengaju_keberatan['email']) . ' Silakan Coba Lagi, Mungkin Alamat Email Pengguna Tidak Aktif');
        }

        // Simpan data ke database
        $this->m_keberatan->save($data);

        return redirect()->to('/admin/keberatan');
    }

    public function delete()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mendapatkan id_keberatan dari input POST
        $id_keberatan = $this->request->getPost('id_keberatan');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Ambil data terkait dari database berdasarkan id_keberatan
            $dataFiles = $this->m_keberatan->getFilesByKeberatanId($id_keberatan);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk diberikan ke id_keberatan.');
            }

            // Hapus file yang terkait menggunakan KeberatanServices
            KeberatanServices::deleteFiles($dataFiles);

            // Hapus data di database
            $this->m_keberatan->deleteByKeberatanId($id_keberatan);

            // Selesaikan transaksi
            $this->db->transComplete();

            // Periksa apakah transaksi berhasil
            if ($this->db->transStatus() === false) {
                // Transaksi gagal, rollback perubahan
                $this->db->transRollback();
                return $this->jsonResponse('error', 'Gagal menghapus file dan data');
            }

            // Transaksi berhasil, commit perubahan
            $this->db->transCommit();
            return $this->jsonResponse('success', 'Semua file dan data berhasil dihapus');
        } catch (\Exception $e) {
            // Transaksi gagal, rollback perubahan
            $this->db->transRollback();
            return $this->jsonResponse('error', 'Gagal menghapus file dan data', $e->getMessage());
        }
    }

    public function delete2()
    {
        // Cek sesi pengguna
        if ($this->checkSession() !== true) {
            return $this->checkSession(); // Redirect jika sesi tidak valid
        }

        // Mendapatkan id_keberatan dari input POST
        $id_keberatan = $this->request->getPost('id_keberatan');

        // Mulai transaksi
        $this->db->transStart();

        try {
            // Ambil data terkait dari database berdasarkan id_keberatan
            $dataFiles = $this->m_keberatan->getFilesByKeberatanId($id_keberatan);

            if (empty($dataFiles)) {
                throw new \Exception('Tidak ada file yang ditemukan untuk diberikan ke id_keberatan.');
            }

            // Hapus file yang terkait menggunakan KeberatanServices
            KeberatanServices::deleteFiles($dataFiles);

            // Hapus data di database
            $this->m_keberatan->deleteByKeberatanId($id_keberatan);

            // Selesaikan transaksi
            $this->db->transComplete();

            // Periksa apakah transaksi berhasil
            if ($this->db->transStatus() === false) {
                // Transaksi gagal, rollback perubahan
                $this->db->transRollback();
                return $this->jsonResponse('error', 'Gagal menghapus file dan data');
            }

            // Transaksi berhasil, commit perubahan
            $this->db->transCommit();
            return $this->jsonResponse('success', 'Semua file dan data berhasil dihapus');
        } catch (\Exception $e) {
            // Transaksi gagal, rollback perubahan
            $this->db->transRollback();
            return $this->jsonResponse('error', 'Gagal menghapus file dan data', $e->getMessage());
        }
    }

    private function jsonResponse($status, $message, $error = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($error) {
            $response['error'] = $error;
        }
        return $this->response->setJSON($response);
    }

    // Function Total Data From Database FE dan BE
    public function kirim()
    {
        // Siapkan data untuk disimpan ke tb_keberatan
        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'no_telepon' => $this->request->getVar('no_telepon'),
            'ringkasan_kasus' => $this->request->getVar('ringkasan_kasus'),
            'file_keberatan' => uploadFilePDF('file_keberatan', 'permohonan_keberatan/file_keberatan/'),
            'kode_keberatan' => $this->m_keberatan->generateKodeKeberatan(),
        ];

        // Simpan data ke tb_keberatan
        $this->m_keberatan->save($data);

        // Ambil data dari request
        $id_alasan = (array) $this->request->getVar('id_alasan'); // Paksa menjadi array, walau hanya 1 nilai

        // Siapkan data untuk disimpan
        $insertData = array_map(function ($alasan) {
            return [
                'id_keberatan' => $this->m_keberatan->getInsertID(),
                'id_alasan' => $alasan,
            ];
        }, $id_alasan);

        // Insert data ke tb_form_keberatan secara batch
        $this->db->table('tb_form_keberatan')->insertBatch($insertData);

        // Kirim email menggunakan KeberatanGmail
        if (KeberatanGmail::saveDanKirimGmailRules($data)) {
            session()->setFlashdata('pesan', 'Keberatan Berhasil Diajukan Dan Email Telah Dikirim.');
        } else {
            session()->setFlashdata('gagal', 'Gagal Mengirim Email. Silakan Coba Lagi.');
        }

        return redirect()->to('/formkeberatan');
    }

    public function getKeberatanData()
    {
        // Ambil data dari tabel tb_keberatan
        $tb_keberatan = $this->m_keberatan->getKeberatan();

        // Kembalikan data dalam format JSON
        return $this->response->setJSON($tb_keberatan);
    }

    public function totalData()
    {
        $totalData = $this->m_keberatan->getTotalKeberatan();
        // Keluarkan total data sebagai JSON response
        return $this->response->setJSON(['total' => $totalData]);
    }

    public function totalByStatus($status)
    {
        $total = $this->m_keberatan->getTotalByStatus($status);
        return $this->response->setJSON(['total' => $total]);
    }
}

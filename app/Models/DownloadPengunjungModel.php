<?php

namespace App\Models;

use CodeIgniter\Model;

class DownloadPengunjungModel extends Model
{
    protected $table = 'tb_download_pengunjung';
    protected $primaryKey = 'id_download_pengunjung';
    protected $retunType = 'object';
    protected $allowedFields = ['email_pengunjung', 'tanggal_download'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_download_pengunjung', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_download_pengunjung, $email_pengunjung, $tanggal_download)
    {
        // Data yang akan diupdate
        $data = [
            'email_pengunjung' => $email_pengunjung,
            'tanggal_download' => $tanggal_download
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data lembaga ke database berdasarkan ID
        $this->update($id_download_pengunjung, $data);
    }
}

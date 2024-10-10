<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisInformasiModel extends Model
{
    protected $table = 'tb_jenis';
    protected $primaryKey = 'id_jenis';
    protected $retunType = 'object';
    protected $allowedFields = ['nama_jenis'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_jenis', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_jenis, $nama_jenis)
    {
        // Data yang akan diupdate
        $data = [
            'nama_jenis' => $nama_jenis
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data lembaga ke database berdasarkan ID
        $this->update($id_jenis, $data);
    }
}

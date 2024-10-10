<?php

namespace App\Models;

use CodeIgniter\Model;

class MemperolehInformasiModel extends Model
{
    protected $table = 'tb_memperoleh_informasi';
    protected $primaryKey = 'id_memperoleh_informasi';
    protected $retunType = 'object';
    protected $allowedFields = ['deskripsi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_memperoleh_informasi', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_memperoleh_informasi, $deskripsi)
    {
        // Data yang akan diupdate
        $data = [
            'deskripsi' => $deskripsi
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_memperoleh_informasi, $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class LembagaModel extends Model
{
    protected $table = 'tb_lembaga';
    protected $primaryKey = 'id_lembaga';
    protected $retunType = 'object';
    protected $allowedFields = ['nama_dinas'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_lembaga', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_lembaga, $nama_dinas)
    {
        // Data yang akan diupdate
        $data = [
            'nama_dinas' => $nama_dinas
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data lembaga ke database berdasarkan ID
        $this->update($id_lembaga, $data);
    }
}

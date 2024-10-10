<?php

namespace App\Models;

use CodeIgniter\Model;

class AlasanModel extends Model
{
    protected $table = 'tb_alasan';
    protected $primaryKey = 'id_alasan';
    protected $retunType = 'object';
    protected $allowedFields = ['deskripsi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_alasan', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_alasan, $deskripsi)
    {
        // Data yang akan diupdate
        $data = [
            'deskripsi' => $deskripsi
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_alasan, $data);
    }

    public function getAllDataByUser($id_user)
    {
        return $this->where('id_user', $id_user)->orderBy('id_desa', 'DESC')->findAll();
    }
}

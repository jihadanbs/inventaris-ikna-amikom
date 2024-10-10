<?php

namespace App\Models;

use CodeIgniter\Model;

class MendapatSalinanInformasiModel extends Model
{
    protected $table = 'tb_mendapat_salinan_informasi';
    protected $primaryKey = 'id_mendapat_salinan_informasi';
    protected $retunType = 'object';
    protected $allowedFields = ['deskripsi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_mendapat_salinan_informasi', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_mendapat_salinan_informasi, $deskripsi)
    {
        // Data yang akan diupdate
        $data = [
            'deskripsi' => $deskripsi
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_mendapat_salinan_informasi, $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriFaqModel extends Model
{
    protected $table = 'tb_kategori_faq';
    protected $primaryKey = 'id_kategori_faq';
    protected $allowedFields = ['nama_kategori'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_kategori_faq', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_kategori_faq, $nama_kategori)
    {
        // Data yang akan diupdate
        $data = [
            'kategori' => $nama_kategori
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_kategori_faq, $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriBarangModel extends Model
{
    protected $table = 'tb_kategori_barang';
    protected $primaryKey = 'id_kategori_barang';
    protected $allowedFields = ['nama_kategori'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_kategori_barang', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_kategori_barang, $nama_kategori)
    {
        // Data yang akan diupdate
        $data = [
            'kategori' => $nama_kategori
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_kategori_barang, $data);
    }
}

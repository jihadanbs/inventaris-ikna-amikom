<?php

namespace App\Models;

use CodeIgniter\Model;

class KondisiBarangModel extends Model
{
    protected $table = 'tb_kondisi_barang';
    protected $primaryKey = 'id_kondisi_barang';
    protected $allowedFields = ['nama_kondisi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_kondisi_barang', 'DESC')->findAll();
    }

    public function simpan_perubahan($id_kondisi_barang, $nama_kondisi)
    {
        // Data yang akan diupdate
        $data = [
            'kategori' => $nama_kondisi
            // Tambahkan kolom lain yang perlu diupdate jika ada
        ];

        // Lakukan update data alasan ke database berdasarkan ID
        $this->update($id_kondisi_barang, $data);
    }
}

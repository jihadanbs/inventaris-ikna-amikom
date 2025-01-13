<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriKegiatanModel extends Model
{
    protected $table            = 'tb_kegiatan';  // Menyesuaikan nama tabel dengan migrasi
    protected $primaryKey       = 'id_kegiatan'; // Menyesuaikan primary key dengan migrasi
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Menentukan tipe data yang dikembalikan (array)
    protected $useSoftDeletes   = false; // Soft delete tidak digunakan
    protected $protectFields    = true; // Proteksi terhadap field yang bisa diubah

    // Kolom yang diperbolehkan untuk diinsert atau update
    protected $allowedFields    = ['judul_kegiatan', 'foto_kegiatan', 'tanggal_foto', 'deskripsi'];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Dates
    protected $useTimestamps    = true; // Menandakan bahwa tabel menggunakan timestamps
    protected $dateFormat       = 'datetime'; // Format tanggal
    protected $createdField     = 'created_at'; // Nama field untuk created_at
    protected $updatedField     = 'updated_at'; // Nama field untuk updated_at
    protected $deletedField     = 'deleted_at'; // Nama field untuk deleted_at (jika soft delete digunakan)


    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'tb_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'tanggal_masuk', 'keterangan_masuk'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

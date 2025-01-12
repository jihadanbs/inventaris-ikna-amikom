<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'tb_barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'id_peminjaman', 'total_barang', 'keterangan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

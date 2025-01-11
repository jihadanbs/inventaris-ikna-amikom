<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangBaruModel extends Model
{
    protected $table = 'tb_barang_baru';
    protected $primaryKey = 'id_barang_baru';
    protected $allowedFields = [''];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

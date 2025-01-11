<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangBekasModel extends Model
{
    protected $table = 'tb_barang_bekas';
    protected $primaryKey = 'id_barang_bekas';
    protected $allowedFields = [''];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

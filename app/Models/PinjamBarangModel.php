<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamBarangModel extends Model
{
    protected $table = 'tb_setting_pinjam_barang';
    protected $primaryKey = 'id_setting_pinjam_barang';
    protected $retunType = 'object';
    protected $allowedFields = ['id_barang', 'is_tampil', 'masa_pinjam'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

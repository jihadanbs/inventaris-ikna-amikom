<?php

namespace App\Models;

use CodeIgniter\Model;

class FileFotoBarangModel extends Model
{
    protected $table = 'tb_file_foto_barang';
    protected $primaryKey = 'id_file_foto_barang';
    protected $allowedFields = ['id_file_foto_barang', 'path_file_foto_barang'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

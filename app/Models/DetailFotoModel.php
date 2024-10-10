<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailFotoModel extends Model
{
    protected $table = 'tb_detail_foto';
    protected $primaryKey = 'id_detail_foto';
    protected $allowedFields = ['id_foto', 'nama_file', 'tipe_file'];

    public function getFoto()
    {
        return $this->findAll(); // Anda dapat mengubah ini sesuai dengan kebutuhan Anda
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table = 'tb_jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $retunType = 'object';
    protected $allowedFields = ['nama_jabatan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAll()
    {
        return $this->orderBy('id_jabatan', 'DESC')->findAll();
    }
}

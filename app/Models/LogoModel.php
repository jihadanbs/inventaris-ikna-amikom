<?php

namespace App\Models;

use CodeIgniter\Model;

class LogoModel extends Model
{
    protected $table = 'tb_logo';
    protected $primaryKey = 'id_logo';
    protected $retunType = 'object';
    protected $allowedFields = ['gambar_logo'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_logo', 'DESC')->findAll();
    }

    public function getLogo($id_logo = null)
    {
        if ($id_logo === null) {
            // Jika $id_logo tidak ditentukan, kembalikan semua data
            return $this->findAll();
        } else {
            // Jika $id_logo ditentukan, cari data berdasarkan id_logo
            return $this->find($id_logo);
        }
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class VidioModel extends Model
{
    protected $table = 'tb_vidio';
    protected $primaryKey = 'id_vidio';
    protected $retunType = 'object';
    protected $allowedFields = ['file_vidio', 'judul_vidio', 'slug', 'link_vidio', 'tanggal_vidio', 'deskripsi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_vidio', 'DESC')->findAll();
    }

    public function getVidio($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getAll($id_vidio = null)
    {
        $builder = $this->db->table('tb_vidio');

        if ($id_vidio !== null) {
            $builder->where('id_vidio', $id_vidio);
        }

        return $builder->get()->getRow();
    }

    public function getid($id_vidio)
    {
        $builder = $this->db->table('tb_vidio');
        return $builder->where('id_vidio', $id_vidio)->get()->getResult();
    }
}

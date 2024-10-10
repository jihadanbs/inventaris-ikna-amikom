<?php

namespace App\Models;

use CodeIgniter\Model;

class SopModel extends Model
{
    protected $table = 'tb_sop';
    protected $primaryKey = 'id_sop';
    protected $retunType = 'object';
    protected $allowedFields = ['judul_sop', 'slug', 'tanggal_file', 'file_sop', 'link_sop'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getSop($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }


    public function getAll($id_sop = null)
    {
        $builder = $this->db->table('tb_sop');

        if ($id_sop !== null) {
            $builder->where('id_sop', $id_sop);
        }

        return $builder->get()->getRow();
    }

    public function getAllData()
    {
        return $this->orderBy('id_sop', 'DESC')->findAll();
    }

    public function getDokumenById($id_sop)
    {
        $builder = $this->db->table('tb_sop');
        return $builder->where('id_sop', $id_sop)->get()->getResult();
    }

    public function getFilesById($id_sop)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('file_sop')->where('id_sop', $id_sop)->findAll();
    }
    public function deleteById($id_sop)
    {
        // Menghapus entri di tabel berdasarkan id_pemohon
        return $this->where('id_sop', $id_sop)->delete();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'tb_wilayah';
    protected $primaryKey = 'id_wilayah';
    protected $returnType = 'object';
    protected $allowedFields = ['slug', 'judul_laporan', 'nama_wilayah', 'link_wilayah', 'gambar_wilayah'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getWilayah($id_wilayah = false)
    {
        if ($id_wilayah == false) {
            return $this->findAll();
        }

        return $this->where(['id_wilayah' => $id_wilayah])->first();
    }

    public function getAll($id_wilayah = null)
    {
        $builder = $this->db->table($this->table);

        if ($id_wilayah !== null) {
            $builder->where($this->primaryKey, $id_wilayah);
            return $builder->get()->getRow();
        } else {
            return $builder->get()->getResult();
        }
    }

    public function getid($id_wilayah)
    {
        $builder = $this->db->table('tb_wilayah');
        return $builder->where('id_wilayah', $id_wilayah)->get()->getResult();
    }

    public function getAllData()
    {
        return $this->orderBy('id_wilayah', 'DESC')->findAll();
    }

    public function findByID($id_wilayah)
    {
        return $this->where($this->primaryKey, $id_wilayah)
            ->first();
    }

    public function getDokumenById($id_wilayah)
    {
        $builder = $this->db->table('tb_wilayah');
        return $builder->where('id_wilayah', $id_wilayah)->get()->getResult();
    }

    public function getFilesById($id_wilayah)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('gambar_wilayah')->where('id_wilayah', $id_wilayah)->findAll();
    }
    public function deleteById($id_wilayah)
    {
        // Menghapus entri di tabel berdasarkan id_wilayah
        return $this->where('id_wilayah', $id_wilayah)->delete();
    }
}

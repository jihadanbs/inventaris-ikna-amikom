<?php

namespace App\Models;

use CodeIgniter\Model;

class WebOptionModel extends Model
{
    protected $table = 'tb_web_option';
    protected $primaryKey = 'id_web_option';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'value', 'path_file'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_web_option', 'DESC')->findAll();
    }

    public function getWeb($id_web_option = false)
    {
        if ($id_web_option == false) {
            return $this->findAll();
        }

        return $this->where(['id_web_option' => $id_web_option])->first();
    }


    public function getAll($id_web_option = null)
    {
        $builder = $this->db->table('tb_web_option');

        if ($id_web_option !== null) {
            $builder->where('id_web_option', $id_web_option);
        }

        return $builder->get()->getRow();
    }

    public function getDokumenById($id_web_option)
    {
        $builder = $this->db->table('tb_web_option');
        $result = $builder->where('id_web_option', $id_web_option)->get()->getResult();
        return $result;
    }

    public function ambil_data($id_web_option)
    {
        return $this->find($id_web_option);
    }

    public function getFilesById($id_web_option)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('path_file')->where('id_web_option', $id_web_option)->findAll();
    }
    public function deleteById($id_web_option)
    {
        // Menghapus entri di tabel berdasarkan id_pemohon
        return $this->where('id_web_option', $id_web_option)->delete();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'tb_laporan';
    protected $primaryKey = 'id_laporan';
    protected $retunType = 'object';
    protected $allowedFields = ['judul_laporan', 'slug', 'tanggal_file', 'file_laporan', 'link_laporan', 'id_pengunjung'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getLaporan($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }


    public function getAll($id_laporan = null)
    {
        $builder = $this->db->table('tb_laporan');

        if ($id_laporan !== null) {
            $builder->where('id_laporan', $id_laporan);
        }

        return $builder->get()->getRow();
    }

    public function getAllData()
    {
        return $this->orderBy('id_laporan', 'DESC')->findAll();
    }

    public function getDokumenById($id_laporan)
    {
        $builder = $this->db->table('tb_laporan');
        return $builder->where('id_laporan', $id_laporan)->get()->getResult();
    }

    public function getFilesById($id_laporan)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('file_laporan')->where('id_laporan', $id_laporan)->findAll();
    }
    public function deleteById($id_laporan)
    {
        // Menghapus entri di tabel berdasarkan id_pemohon
        return $this->where('id_laporan', $id_laporan)->delete();
    }
}

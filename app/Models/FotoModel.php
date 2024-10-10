<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'tb_foto';
    protected $primaryKey = 'id_foto';
    protected $retunType = 'object';
    protected $allowedFields = ['id_file_foto', 'judul_foto', 'slug', 'tanggal_foto', 'deskripsi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getFoto($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getAllData()
    {
        return $this->orderBy('id_foto', 'DESC')->findAll();
    }

    public function getDokumenByFotoId($id_foto)
    {
        return $this->db->table('tb_galeri')
            ->select('*')
            ->where('id_foto', $id_foto)
            ->get()
            ->getResultArray();
    }


    public function ambil_data($id_foto)
    {
        return $this->find($id_foto);
    }

    public function getFotoWithFile()
    {
        return $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->groupBy('tb_foto.id_foto')
            ->orderBy('tb_foto.id_foto', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getFotoWithFileId($id_foto)
    {
        return $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->where('tb_foto.id_foto', $id_foto) // Menambahkan kondisi untuk ID foto
            ->groupBy('tb_foto.id_foto')
            ->get()
            ->getResultArray();
    }

    public function getFotoWithSlug($slug = false)
    {
        $builder = $this->db->table('tb_foto')
            ->select('tb_foto.*, GROUP_CONCAT(tb_file_foto.file_foto SEPARATOR ", ") as file_foto')
            ->join('tb_galeri', 'tb_foto.id_foto = tb_galeri.id_foto')
            ->join('tb_file_foto', 'tb_galeri.id_file_foto = tb_file_foto.id_file_foto')
            ->groupBy('tb_foto.id_foto')
            ->orderBy('tb_foto.id_foto', 'DESC');

        if ($slug !== false) {
            $builder->where('tb_foto.slug', $slug);
            return $builder->get()->getRowArray(); // Return a single row
        }

        return $builder->get()->getResultArray(); // Return all rows
    }

    public function getFilesById($id_foto)
    {
        return $this->db->table('tb_file_foto')
            ->select('file_foto')
            ->join('tb_galeri', 'tb_file_foto.id_file_foto = tb_galeri.id_file_foto')
            ->where('tb_galeri.id_foto', $id_foto)
            ->get()
            ->getResultArray();
    }

    public function deleteFilesAndEntries($id_foto)
    {
        // Hapus entri dari tb_galeri
        $this->db->table('tb_galeri')->where('id_foto', $id_foto)->delete();

        // Hapus entri dari tb_file_foto yang terkait dengan tb_galeri yang dihapus
        $this->db->table('tb_file_foto')
            ->whereIn('id_file_foto', function ($builder) use ($id_foto) {
                $builder->select('id_file_foto')
                    ->from('tb_galeri')
                    ->where('id_foto', $id_foto);
            })
            ->delete();
    }
}

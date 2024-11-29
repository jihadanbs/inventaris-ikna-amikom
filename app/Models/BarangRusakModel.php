<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangRusakModel extends Model
{
    protected $table = 'tb_barang_rusak';
    protected $primaryKey = 'id_barang_rusak';
    protected $allowedFields = ['id_barang', 'jumlah_total_rusak', 'keterangan_rusak'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;


    // index
    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang_rusak');
        $builder->select('
            tb_barang_rusak.*, 
            tb_barang.nama_barang, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_barang.id_kategori_barang = tb_kategori_barang.id_kategori_barang', 'left');
        $builder->orderBy('tb_barang_rusak.id_barang_rusak', 'DESC');
        $builder->groupBy('tb_barang_rusak.id_barang_rusak, tb_barang.nama_barang, tb_barang.jumlah_total, tb_kategori_barang.nama_kategori');
        $query = $builder->get();
        $results = $query->getResultArray();

        // Ambil data tambahan berdasarkan id_barang_rusak
        foreach ($results as &$result) { // Gunakan reference untuk memodifikasi elemen array
            $id_barang_rusak = $result['id_barang_rusak'];
            $additional_data = $this->getDokumenById($id_barang_rusak);
            $result['additional_data'] = $additional_data;
        }

        return $results;
    }


    // delete
    public function getFilesById($id_barang)
    {
        return $this->db->table('tb_file_foto_barang')
            ->select('path_file_foto_barang')
            ->join('tb_galeri_barang', 'tb_file_foto_barang.id_file_foto_barang = tb_galeri_barang.id_file_foto_barang')
            ->where('tb_galeri_barang.id_barang', $id_barang)
            ->get()
            ->getResultArray();
    }

    public function deleteFilesAndEntries($id_barang)
    {
        // Hapus entri dari tb_galeri_barang
        $this->db->table('tb_galeri_barang')->where('id_barang', $id_barang)->delete();

        // Hapus entri dari tb_file_foto_barang yang terkait dengan tb_galeri_barang yang dihapus
        $this->db->table('tb_file_foto_barang')
            ->whereIn('id_file_foto_barang', function ($builder) use ($id_barang) {
                $builder->select('id_file_foto_barang')
                    ->from('tb_galeri_barang')
                    ->where('id_barang', $id_barang);
            })
            ->delete();
    }

    // cek data
    public function getDokumenById($id_barang_rusak)
    {
        $builder = $this->db->table('tb_barang_rusak');
        $result = $builder->where('id_barang_rusak', $id_barang_rusak)->get()->getResultArray();
        return $result;
    }

    public function getBarangBySlug($slug)
    {
        return $this->db->table('tb_barang')
            ->select('tb_barang.*, GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang, tb_kategori_barang.nama_kategori')
            ->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left')
            ->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left')
            ->where('tb_barang.slug', $slug)
            ->groupBy('tb_barang.slug')
            ->get()
            ->getRowArray();
    }
}

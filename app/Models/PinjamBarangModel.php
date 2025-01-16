<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamBarangModel extends Model
{
    protected $table = 'tb_setting_pinjam_barang';
    protected $primaryKey = 'id_setting_pinjam_barang';
    protected $retunType = 'object';
    protected $allowedFields = ['id_barang', 'slug', 'is_tampil', 'masa_pinjam', 'lokasi'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_setting_pinjam_barang');
        $builder->select('
            tb_setting_pinjam_barang.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_barang.nama_barang, 
            tb_barang.slug, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_baik.jumlah_total_baik, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_setting_pinjam_barang.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->groupBy('tb_setting_pinjam_barang.id_setting_pinjam_barang, tb_kategori_barang.nama_kategori');
        $builder->orderBy('tb_setting_pinjam_barang.id_setting_pinjam_barang', 'DESC');
        $query = $builder->get();
        $results = $query->getResultArray();

        return $results;
    }

    public function getTampil($perPage = 12, $offset = 0)
    {
        $builder = $this->db->table('tb_setting_pinjam_barang');
        $builder->select('
            tb_setting_pinjam_barang.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_barang.nama_barang, 
            tb_barang.slug, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_baik.jumlah_total_baik, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_setting_pinjam_barang.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        // Filter berdasarkan is_tampil = 1
        $builder->where('tb_setting_pinjam_barang.is_tampil', 1);

        $builder->groupBy('tb_setting_pinjam_barang.id_setting_pinjam_barang, tb_kategori_barang.nama_kategori');
        $builder->orderBy('tb_setting_pinjam_barang.id_setting_pinjam_barang', 'DESC');

        // Tambahkan limit dan offset untuk pagination
        $builder->limit($perPage, $offset);

        $query = $builder->get();
        return $query->getResultArray();
    }

    // Tambahkan method untuk menghitung total rows
    public function countAllTampil()
    {
        $builder = $this->db->table('tb_setting_pinjam_barang');
        $builder->select('tb_setting_pinjam_barang.id_setting_pinjam_barang');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_setting_pinjam_barang.id_barang', 'left');
        $builder->where('tb_setting_pinjam_barang.is_tampil', 1);
        $builder->groupBy('tb_setting_pinjam_barang.id_setting_pinjam_barang');

        return $builder->countAllResults(false);
    }


    public function getBarangBySlug($slug)
    {
        $builder = $this->db->table('tb_setting_pinjam_barang');
        $builder->select('
            tb_setting_pinjam_barang.*,
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_setting_pinjam_barang.id_setting_pinjam_barang, 
            tb_barang.nama_barang, 
            tb_barang.slug, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_baik.jumlah_total_baik, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_setting_pinjam_barang.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->where('tb_setting_pinjam_barang.slug', $slug);
        $query = $builder->get();
        $results = $query->getRowArray();

        return $results;
    }

    public function checkDuplicateBarangSetting($id_barang, $id_setting_pinjam_barang = null)
    {
        $builder = $this->db->table('tb_setting_pinjam_barang');
        $builder->where('id_barang', $id_barang);

        // If editing existing record, exclude current record from check
        if ($id_setting_pinjam_barang !== null) {
            $builder->where('id_setting_pinjam_barang !=', $id_setting_pinjam_barang);
        }

        $result = $builder->get()->getResult();

        // Return true if duplicate found, false if no duplicate
        return !empty($result);
    }
}

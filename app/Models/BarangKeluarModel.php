<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'tb_barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'total_barang', 'keterangan', 'tanggal_keluar'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang_keluar');
        $builder->select('
            tb_barang_keluar.*, 
            tb_barang.nama_barang, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_barang_keluar.id_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_barang.id_kategori_barang = tb_kategori_barang.id_kategori_barang', 'left');
        $builder->orderBy('tb_barang_keluar.id_barang_keluar', 'DESC');
        $builder->groupBy('tb_barang_keluar.id_barang_keluar, tb_barang.nama_barang, tb_barang.jumlah_total, tb_kategori_barang.nama_kategori');
        $query = $builder->get();
        $results = $query->getResultArray();

        return $results;
    }
}

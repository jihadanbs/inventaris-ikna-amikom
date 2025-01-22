<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'tb_barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'id_user_peminjam', 'total_barang', 'keterangan', 'tanggal_keluar'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang_masuk');
        $builder->select('
            tb_barang_masuk.*, 
            tb_barang.nama_barang, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_barang_masuk.id_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_barang.id_kategori_barang = tb_kategori_barang.id_kategori_barang', 'left');
        $builder->orderBy('tb_barang_masuk.id_barang_masuk', 'DESC');
        $builder->groupBy('tb_barang_masuk.id_barang_masuk, tb_barang.nama_barang, tb_barang.jumlah_total, tb_kategori_barang.nama_kategori');
        $query = $builder->get();
        $results = $query->getResultArray();

        return $results;
    }
}

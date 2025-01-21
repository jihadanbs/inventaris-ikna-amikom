<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPeminjamModel extends Model
{
    protected $table = 'tb_user_peminjam';
    protected $primaryKey = 'id_user_peminjam';
    protected $allowedFields = ['id_barang', 'total_dipinjam', 'nama_lengkap', 'pekerjaan', 'email', 'no_telepon', 'alamat', 'kepentingan', 'kode_peminjaman', 'status', 'keterangan', 'tanggal_pengajuan', 'tanggal_dipinjamkan', 'tanggal_diperkirakan_dikembalikan', 'tanggal_dikembalikan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_user_peminjam');
        $builder->select('
            tb_user_peminjam.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_barang.nama_barang, 
            tb_barang.slug, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_baik.jumlah_total_baik, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_user_peminjam.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->groupBy('tb_user_peminjam.id_user_peminjam, tb_kategori_barang.nama_kategori');
        $builder->orderBy('tb_user_peminjam.id_user_peminjam', 'DESC');
        $query = $builder->get();
        $results = $query->getResultArray();

        return $results;
    }
}

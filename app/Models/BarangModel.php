<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_kategori_barang', 'id_kondisi_barang', 'id_barang_masuk', 'nama_barang', 'deskripsi', 'jumlah_total', 'tanggal_keluar', 'slug', 'id_file_foto_barang', 'jumlah_dipinjam'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;


    // index
    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang');
        $builder->select('
            tb_barang.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');

        $builder->groupBy('tb_barang.id_barang, tb_kategori_barang.nama_kategori');
        // $builder->groupBy('tb_barang.id_barang, tb_kondisi_barang.nama_kondisi');
        $builder->orderBy('tb_barang.id_barang', 'DESC');
        $query = $builder->get();
        $results = $query->getResultArray();

        // Ambil data tambahan berdasarkan id_barang
        foreach ($results as &$result) {
            $id_barang = $result['id_barang'];
            $additional_data = $this->getDokumenByBarangId($id_barang);
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
    public function getDokumenByBarangId($id_barang)
    {
        return $this->db->table('tb_galeri_barang')
            ->select('*')
            ->where('id_barang', $id_barang)
            ->get()
            ->getResultArray();
    }

    public function getBarangBySlug($slug)
    {
        return $this->db->table('tb_barang')
            ->select('tb_barang.*, GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang, tb_kategori_barang.nama_kategori, 
            tb_kondisi_barang.nama_kondisi, 
            tb_barang_masuk.tanggal_masuk, 
            tb_barang_masuk.keterangan_masuk, 
            tb_barang_rusak.jumlah_total_rusak, 
            tb_barang_rusak.keterangan_rusak, 
            tb_barang_baik.jumlah_total_baik, 
            tb_barang_baik.keterangan_baik,
            tb_setting_pinjam_barang.masa_pinjam,
            tb_setting_pinjam_barang.lokasi')
            ->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left')
            ->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left')
            ->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left')
            ->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left')
            ->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left')
            ->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left')
            ->join('tb_setting_pinjam_barang', 'tb_barang.id_barang = tb_setting_pinjam_barang.id_barang', 'left')
            ->where('tb_barang.slug', $slug)
            ->groupBy('tb_barang.slug')
            ->get()
            ->getRowArray();
    }

    public function getTotalBarang()
    {
        $query = $this->db->query('SELECT SUM(jumlah_total) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}

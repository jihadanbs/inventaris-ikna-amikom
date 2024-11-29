<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_kategori_barang', 'nama_barang', 'deskripsi', 'jumlah_total', 'tanggal_masuk', 'tanggal_keluar', 'slug', 'id_file_foto_barang'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;


    // index
    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang');
        $builder->select('
            tb_barang.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_kategori_barang.nama_kategori
        ');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->groupBy('tb_barang.id_barang, tb_kategori_barang.nama_kategori');
        $builder->orderBy('tb_barang.id_barang', 'DESC');
        $query = $builder->get();
        $results = $query->getResultArray(); // Mengubah query menjadi array

        // Ambil data tambahan berdasarkan id_barang
        foreach ($results as &$result) { // Gunakan reference untuk memodifikasi elemen array
            $id_barang = $result['id_barang']; // Akses sebagai array
            $additional_data = $this->getDokumenByBarangId($id_barang);
            $result['additional_data'] = $additional_data; // Tambahkan ke array
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

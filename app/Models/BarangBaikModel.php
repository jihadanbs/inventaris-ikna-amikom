<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangBaikModel extends Model
{
    protected $table = 'tb_barang_baik';
    protected $primaryKey = 'id_barang_baik';
    protected $allowedFields = ['id_barang', 'jumlah_total_baik', 'keterangan_baik'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;


    // index
    public function getAllSorted()
    {
        $builder = $this->db->table('tb_barang_baik');
        $builder->select('
            tb_barang_baik.*, 
            tb_barang.nama_barang, 
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_barang.id_kategori_barang = tb_kategori_barang.id_kategori_barang', 'left');

        // Tambahkan filter untuk hanya menampilkan barang yang sudah diproses
        $builder->where('tb_barang_baik.id_barang IN (SELECT id_barang FROM tb_barang_rusak)');

        $builder->orderBy('tb_barang_baik.id_barang_baik', 'DESC');
        $builder->groupBy('tb_barang_baik.id_barang_baik, tb_barang.nama_barang, tb_barang.jumlah_total, tb_kategori_barang.nama_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updateJumlahBarangBaik($id_barang)
    {
        // Ambil data barang yang relevan saja berdasarkan id_barang yang baru saja disimpan
        $builder = $this->db->table('tb_barang');
        $builder->select('
            tb_barang.id_barang,
            tb_barang.nama_barang,
            tb_barang.jumlah_total,
            IFNULL(SUM(tb_barang_rusak.jumlah_total_rusak), 0) AS jumlah_total_rusak
        ');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->where('tb_barang.id_barang', $id_barang); // Filter berdasarkan id_barang
        $builder->groupBy('tb_barang.id_barang');
        $query = $builder->get();
        $result = $query->getRowArray();

        // Pastikan hasil ada dan jumlah_total_baik tidak negatif
        if ($result) {
            $jumlah_total_baik = $result['jumlah_total'] - $result['jumlah_total_rusak'];
            if ($jumlah_total_baik < 0) {
                $jumlah_total_baik = 0;
            }

            // Perbarui atau tambah data ke tb_barang_baik
            $this->db->table('tb_barang_baik')->replace([
                'id_barang' => $result['id_barang'],
                'jumlah_total_baik' => $jumlah_total_baik,
            ]);
        }
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
    public function getDokumenById($id_barang_baik)
    {
        $builder = $this->db->table('tb_barang_baik');
        $result = $builder->where('id_barang_baik', $id_barang_baik)->get()->getResultArray();
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

    public function getTotalBarangBaik()
    {
        $query = $this->db->query('SELECT SUM(jumlah_total_baik) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}

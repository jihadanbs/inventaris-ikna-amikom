<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPeminjamModel extends Model
{
    protected $table = 'tb_user_peminjam';
    protected $primaryKey = 'id_user_peminjam';
    protected $allowedFields = ['id_barang', 'total_dipinjam', 'nama_lengkap', 'pekerjaan', 'email', 'no_telepon', 'alamat', 'kepentingan', 'kode_peminjaman', 'status', 'keterangan', 'tanggal_pengajuan', 'tanggal_dipinjamkan', 'tanggal_perkiraan_dikembalikan', 'tanggal_dikembalikan', 'catatan_peminjaman'];
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

    public function getByNamaLengkap($nama_lengkap)
    {
        $builder = $this->db->table('tb_user_peminjam');
        $builder->select('
        tb_user_peminjam.*, 
        GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
        tb_barang.nama_barang, 
        tb_barang.slug, 
        tb_barang.jumlah_total,
        tb_kategori_barang.nama_kategori,
        tb_barang.id_kategori_barang, 
        tb_kondisi_barang.nama_kondisi, 
        tb_barang.id_kondisi_barang,
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

        // Menambahkan kondisi untuk mencari berdasarkan nama_lengkap
        $builder->where('tb_user_peminjam.nama_lengkap', $nama_lengkap);

        $builder->groupBy('tb_user_peminjam.id_user_peminjam, tb_kategori_barang.nama_kategori');
        $builder->orderBy('tb_user_peminjam.id_user_peminjam', 'DESC');

        // Mengambil satu data saja
        $query = $builder->get();
        $result = $query->getRowArray(); // Mendapatkan hanya satu baris data

        return $result;
    }


    public function getBarangBySlug($nama_lengkap)
    {
        return $this->db->table('tb_user_peminjam')
            ->select('tb_user_peminjam.*, GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang, tb_kategori_barang.nama_kategori, 
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
            ->where('tb_user_peminjam.nama_lengkap', $nama_lengkap)
            ->groupBy('tb_user_peminjam.nama_lengkap')
            ->get()
            ->getRowArray();
    }

    public function getByKodePeminjaman($kode_peminjaman)
    {
        $builder = $this->db->table('tb_user_peminjam');
        $builder->select('
            tb_user_peminjam.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_barang.nama_barang, 
            tb_kategori_barang.nama_kategori, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_user_peminjam.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');

        // Pastikan kode_peminjaman sesuai
        $builder->where('tb_user_peminjam.kode_peminjaman', $kode_peminjaman);

        $query = $builder->get();

        // Periksa apakah data ditemukan
        if ($query->getNumRows() > 0) {
            return $query->getRowArray(); // Kembalikan data jika ada
        } else {
            return null; // Data tidak ditemukan
        }
    }

    public function getTotalByStatus($status)
    {
        $query = $this->db->query('SELECT SUM(total_dipinjam) as total FROM ' . $this->table . ' WHERE status = ?', [$status]);
        $result = $query->getRow();

        return $result ? $result->total : 0;
    }
}

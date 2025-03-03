<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanBarangModel extends Model
{
    protected $table = 'tb_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = ['id_barang', 'total_dipinjam', 'slug', 'kepentingan', 'kode_peminjaman', 'status', 'tanggal_pengajuan', 'tanggal_dipinjamkan', 'tanggal_perkiraan_dikembalikan', 'tanggal_dikembalikan', 'catatan_peminjaman', 'dokumen_jaminan', 'bukti_pengembalian'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
            tb_peminjaman.id_peminjaman,
            tb_peminjaman.kode_peminjaman,
            tb_peminjaman.tanggal_pengajuan,
            tb_peminjaman.status,
            tb_peminjaman.slug,
            tb_user.nama_lengkap,
            COUNT(tb_peminjaman.id_barang) as total_jenis_barang,
            GROUP_CONCAT(DISTINCT tb_kategori_barang.nama_kategori SEPARATOR ", ") as kategori_list
        ');

        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');

        // Mengelompokkan berdasarkan kode_peminjaman
        $builder->groupBy('tb_peminjaman.kode_peminjaman');
        $builder->orderBy('tb_peminjaman.id_peminjaman', 'DESC');

        $query = $builder->get();
        $results = $query->getResultArray();

        return $results;
    }

    public function getDetailByKodePeminjaman($kode_peminjaman)
    {
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
            tb_peminjaman.*,
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_user.nama_lengkap,
            tb_barang.id_barang,
            tb_barang.nama_barang,
            tb_barang.slug as slug_barang,
            tb_barang.jumlah_total,
            tb_kategori_barang.nama_kategori,
            tb_kondisi_barang.nama_kondisi,
            tb_barang_baik.jumlah_total_baik,
            tb_barang_masuk.tanggal_masuk,
            tb_barang.id_kategori_barang, 
            tb_barang.id_kondisi_barang
        ');

        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->where('tb_peminjaman.kode_peminjaman', $kode_peminjaman);
        $builder->groupBy('tb_peminjaman.id_peminjaman');

        $query = $builder->get();
        $results = $query->getResultArray();

        // Memastikan kode_peminjaman selalu tersedia
        if (!empty($results)) {
            foreach ($results as &$item) {
                $item['kode_peminjaman'] = $kode_peminjaman;
            }
        }

        return $results;
    }

    public function getKodePeminjaman($kode_peminjaman)
    {
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
            tb_peminjaman.*, 
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_user.nama_lengkap, 
            tb_barang.nama_barang, 
            tb_kategori_barang.nama_kategori, 
            tb_barang_masuk.tanggal_masuk
        ');
        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');

        $builder->where('tb_peminjaman.kode_peminjaman', $kode_peminjaman);
        $builder->groupBy('tb_peminjaman.id_peminjaman');

        $query = $builder->get();

        // Mengembalikan array data, bukan hanya satu baris
        return $query->getResultArray();
    }
}

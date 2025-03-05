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

    public function getDetailPeminjamByKodePeminjaman($kode_peminjaman)
    {
        return $this->db->table('tb_peminjaman')
            ->where('kode_peminjaman', $kode_peminjaman)
            ->get()
            ->getRowArray();
    }

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
        // Pertama, dapatkan total jenis barang dan kategori dalam bentuk subquery
        $subquery = $this->db->table('tb_peminjaman')
            ->select('
                COUNT(DISTINCT tb_peminjaman.id_barang) as total_jenis_barang,
                GROUP_CONCAT(DISTINCT tb_kategori_barang.nama_kategori SEPARATOR ", ") as kategori_list,
                GROUP_CONCAT(DISTINCT tb_barang.nama_barang SEPARATOR ", ") as barang_list
            ')
            ->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left')
            ->where('tb_peminjaman.kode_peminjaman', $kode_peminjaman)
            ->get()
            ->getRowArray();

        // Kemudian, lakukan query utama
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
            tb_peminjaman.*,
            GROUP_CONCAT(tb_file_foto_barang.path_file_foto_barang SEPARATOR ", ") as path_file_foto_barang,
            tb_user.nama_lengkap,
            tb_user.no_telepon,
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

        // Join tabel yang diperlukan
        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->where('tb_peminjaman.kode_peminjaman', $kode_peminjaman);
        $builder->groupBy('tb_peminjaman.id_peminjaman');

        $query = $builder->get();
        $results = $query->getResultArray();

        // Menambahkan data total dan kategori dari subquery ke setiap hasil
        if (!empty($results) && !empty($subquery)) {
            foreach ($results as &$item) {
                $item['kode_peminjaman'] = $kode_peminjaman;
                $item['total_jenis_barang'] = $subquery['total_jenis_barang'];
                $item['kategori_list'] = $subquery['kategori_list'];
                $item['barang_list'] = $subquery['barang_list'];
            }
        }

        return $results;
    }

    public function getDetailByIdPeminjaman($id_peminjaman)
    {
        // Pertama, dapatkan total jenis barang dan kategori dalam bentuk subquery
        $subquery = $this->db->table('tb_peminjaman')
            ->select('
                COUNT(DISTINCT tb_peminjaman.id_barang) as total_jenis_barang,
                GROUP_CONCAT(DISTINCT tb_kategori_barang.nama_kategori SEPARATOR ", ") as kategori_list,
                GROUP_CONCAT(DISTINCT tb_barang.nama_barang SEPARATOR ", ") as barang_list
            ')
            ->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left')
            ->where('tb_peminjaman.id_peminjaman', $id_peminjaman)
            ->get()
            ->getRowArray();

        // Kemudian, lakukan query utama
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
            tb_barang.jumlah_dipinjam,
            tb_barang.id_kondisi_barang
        ');

        // Join tabel yang diperlukan
        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->join('tb_kondisi_barang', 'tb_kondisi_barang.id_kondisi_barang = tb_barang.id_kondisi_barang', 'left');
        $builder->join('tb_galeri_barang', 'tb_barang.id_barang = tb_galeri_barang.id_barang', 'left');
        $builder->join('tb_file_foto_barang', 'tb_galeri_barang.id_file_foto_barang = tb_file_foto_barang.id_file_foto_barang', 'left');
        $builder->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori_barang = tb_barang.id_kategori_barang', 'left');
        $builder->join('tb_barang_masuk', 'tb_barang_masuk.id_barang = tb_barang.id_barang', 'left');
        $builder->join('tb_barang_rusak', 'tb_barang.id_barang = tb_barang_rusak.id_barang', 'left');
        $builder->join('tb_barang_baik', 'tb_barang.id_barang = tb_barang_baik.id_barang', 'left');

        $builder->where('tb_peminjaman.id_peminjaman', $id_peminjaman);
        $builder->groupBy('tb_peminjaman.id_peminjaman');

        $query = $builder->get();
        $results = $query->getResultArray();

        // Menambahkan data total dan kategori dari subquery ke setiap hasil
        if (!empty($results) && !empty($subquery)) {
            foreach ($results as &$item) {
                $item['id_peminjaman'] = $id_peminjaman;
                $item['total_jenis_barang'] = $subquery['total_jenis_barang'];
                $item['kategori_list'] = $subquery['kategori_list'];
                $item['barang_list'] = $subquery['barang_list'];
            }
        }

        return $results;
    }

    public function getTotalDipinjam($id_peminjaman)
    {
        $peminjaman = $this->find($id_peminjaman);
        return $peminjaman['total_dipinjam'] ?? 0;
    }

    public function getDetailPeminjamanById($id_peminjaman)
    {
        return $this->db->table('tb_peminjaman')
            ->select('tb_barang.id_barang, tb_barang.nama_barang, tb_peminjaman.jumlah_dipinjam')
            ->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang')
            ->where('tb_peminjaman.id_peminjaman', $id_peminjaman)
            ->get()
            ->getResultArray();
    }

    public function getDetailById($id_peminjaman)
    {
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
        tb_peminjaman.*,
        tb_user.nama_lengkap,
        tb_user.pekerjaan,
        tb_user.no_telepon
    ');
        $builder->join('tb_transaksi', 'tb_transaksi.id_peminjaman = tb_peminjaman.id_peminjaman', 'left');
        $builder->join('tb_user', 'tb_user.id_user = tb_transaksi.id_user', 'left');
        $builder->where('tb_peminjaman.id_peminjaman', $id_peminjaman);

        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getBarangByKodePeminjaman($kode_peminjaman)
    {
        $builder = $this->db->table('tb_peminjaman');
        $builder->select('
        tb_peminjaman.id_peminjaman,
        tb_peminjaman.kode_peminjaman,
        tb_peminjaman.id_barang,
        tb_peminjaman.total_dipinjam,
        tb_peminjaman.tanggal_pengajuan,
        tb_peminjaman.tanggal_peminjaman,
        tb_peminjaman.tanggal_pengembalian,
        tb_barang.nama_barang
    ');
        $builder->join('tb_barang', 'tb_barang.id_barang = tb_peminjaman.id_barang', 'left');
        $builder->where('tb_peminjaman.kode_peminjaman', $kode_peminjaman);

        $query = $builder->get();
        return $query->getResultArray();
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

    public function getTotalByStatus($status)
    {
        $query = $this->db->query('SELECT SUM(total_dipinjam) as total FROM ' . $this->table . ' WHERE status = ?', [$status]);
        $result = $query->getRow();

        return $result ? $result->total : 0;
    }

    public function getFilesByKodePeminjaman($kode_peminjaman)
    {
        // Ambil hanya kolom yang dibutuhkan dan pastikan ada hasil
        $result = $this->select('dokumen_jaminan, bukti_pengembalian')
            ->where('kode_peminjaman', $kode_peminjaman)
            ->findAll();

        return $result ? $result : [];
    }

    public function deleteByKodePeminjaman($kode_peminjaman)
    {
        // Hapus entri di tabel peminjaman berdasarkan kode_peminjaman
        return $this->where('kode_peminjaman', $kode_peminjaman)->delete();
    }
}

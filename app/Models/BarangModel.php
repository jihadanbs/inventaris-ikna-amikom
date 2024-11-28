<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_barang';
    protected $retunType = 'object';
    protected $allowedFields = ['id_kategori_barang', 'nama_barang', 'deskripsi', 'jumlah_total', 'tanggal_masuk', 'tanggal_keluar', 'slug', 'id_file_foto_barang'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

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
        $results = $query->getResult();

        // Ambil data tambahan berdasarkan id_barang
        foreach ($results as $result) {
            $id_barang = $result->id_barang;
            $additional_data = $this->getDokumenById($id_barang);
            $result->additional_data = $additional_data;
        }

        return $results;
    }


    public function getDokumenById($id_barang)
    {
        $builder = $this->db->table('tb_barang');
        $result = $builder->where('id_barang', $id_barang)->get()->getResult();
        return $result;
    }

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

    public function getInformasiPublik($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getAll($id_informasi_publik = null)
    {
        $builder = $this->db->table('tb_informasi_publik');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_informasi_publik.id_lembaga')
            ->join('tb_kategori_informasi_publik', 'tb_kategori_informasi_publik.id_kategori_informasi_publik = tb_informasi_publik.id_kategori_informasi_publik')
            ->join('tb_jenis', 'tb_jenis.id_jenis = tb_informasi_publik.id_jenis');

        if ($id_informasi_publik !== null) {
            $builder->where('id_informasi_publik', $id_informasi_publik);
        }

        return $builder->get()->getRow();
    }

    public function getAllData()
    {
        return $this->orderBy('id_informasi_publik', 'DESC')->findAll();
    }

    public function ambil_data($id_lembaga)
    {
        return $this->find($id_lembaga);
    }

    public function countAllData()
    {
        return $this->countAll();
    }

    public function getNamaDinas()
    {
        $query = $this->db->table('tb_lembaga')->distinct()->select('nama_dinas')->get();
        $result = $query->getResultArray();

        $nama_dinas = [];
        foreach ($result as $row) {
            $nama_dinas[] = $row['nama_dinas'];
        }

        return $nama_dinas;
    }

    public function countByNamaKategori($nama_kategori)
    {
        $builder = $this->db->table('tb_informasi_publik');
        $builder->join('tb_kategori_informasi_publik', 'tb_kategori_informasi_publik.id_kategori_informasi_publik = tb_informasi_publik.id_kategori_informasi_publik');
        $builder->where('tb_kategori_informasi_publik.nama_kategori', $nama_kategori);
        return $builder->countAllResults();
    }

    public function countByJenis($nama_jenis)
    {
        $builder = $this->db->table('tb_informasi_publik');
        $builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_informasi_publik.id_jenis');
        $builder->where('tb_jenis.nama_jenis', $nama_jenis);
        return $builder->countAllResults();
    }

    public function getCategoryCounts()
    {
        $builder = $this->db->table('tb_informasi_publik');
        $builder->select('tb_kategori_informasi_publik.nama_kategori, COUNT(*) as total');
        $builder->join('tb_kategori_informasi_publik', 'tb_kategori_informasi_publik.id_kategori_informasi_publik = tb_informasi_publik.id_kategori_informasi_publik');
        $builder->groupBy('tb_kategori_informasi_publik.nama_kategori');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getJenisCounts()
    {
        $builder = $this->db->table('tb_informasi_publik');
        $builder->select('tb_jenis.nama_jenis, COUNT(*) as total');
        $builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_informasi_publik.id_jenis');
        $builder->groupBy('tb_jenis.nama_jenis');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getKategoriCounts()
    {
        $sql = "
            SELECT 
                tk.nama_kategori, 
                COUNT(tip.id_kategori_informasi_publik) AS total,
                CASE 
                    WHEN tk.nama_kategori = 'Informasi Berkala' THEN '/informasiberkala'
                    WHEN tk.nama_kategori = 'Informasi Serta-Merta' THEN '/informasisertamerta'
                    WHEN tk.nama_kategori = 'Informasi Setiap Saat' THEN '/informasisetiapsaat'
                    WHEN tk.nama_kategori = 'Informasi Dikecualikan' THEN '/informasidikecualikan'
                    ELSE '#'
                END AS link
            FROM tb_kategori_informasi_publik tk
            LEFT JOIN tb_informasi_publik tip ON tk.id_kategori_informasi_publik = tip.id_kategori_informasi_publik
            GROUP BY tk.nama_kategori
        ";

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function getTotalKategori()
    {
        $sql = "
        SELECT 
            COUNT(id_informasi_publik) AS total 
        FROM tb_informasi_publik
    ";

        $query = $this->db->query($sql);
        return $query->getRow()->total;
    }

    public function getTotalInformasiPublik()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }
}

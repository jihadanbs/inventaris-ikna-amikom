<?php

namespace App\Models;

use CodeIgniter\Model;

class PemohonModel extends Model
{
    protected $table = 'tb_pemohon';
    protected $primaryKey = 'id_pemohon';
    protected $returnType = 'object';
    protected $allowedFields = ['nik', 'kode_permohonan', 'nama_pemohon', 'pekerjaan', 'alamat', 'email', 'no_telepon', 'tanggal_pengajuan', 'file_ktp', 'file_pendirian_lembaga', 'akta_notaris_lembaga', 'surat_kesbangpol', 'surat_kuasa', 'status', 'rincian_informasi', 'tujuan', 'id_kategori', 'id_memperoleh_informasi', 'id_mendapat_salinan_informasi', 'id_cara_mendapat_salinan_informasi', 'id_lembaga', 'catatan', 'file_setuju_1', 'file_setuju_2', 'file_setuju_3', 'note', 'biaya', 'cara_pembayaran', 'status_baca', 'tanggal_ditolak', 'tanggal_diberikan', 'tanggal_diproses', 'rentan_waktu', 'keterangan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getByKodePermohonan($kode_permohonan)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->select('tb_pemohon.*, tb_lembaga.nama_dinas, tb_kategori.nama_kategori, tb_memperoleh_informasi.deskripsi, tb_mendapat_salinan_informasi.deskripsi, tb_cara_mendapat_salinan_informasi.deskripsi');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->where('tb_pemohon.kode_permohonan', $kode_permohonan);
        $builder->orderBy('tb_pemohon.id_pemohon', 'DESC');
        $query = $builder->get();
        $results = $query->getResult();

        // Ambil data tambahan berdasarkan id_pemohon
        foreach ($results as $result) {
            $id_pemohon = $result->id_pemohon;
            $additional_data = $this->getDokumenById($id_pemohon);
            $result->additional_data = $additional_data;
        }

        return $results;
    }

    public function getByKodeAndNIK($kode_permohonan)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_pemohon.*, tb_lembaga.nama_dinas, tb_kategori.nama_kategori, tb_memperoleh_informasi.deskripsi AS deskripsi_memperoleh, tb_mendapat_salinan_informasi.deskripsi AS deskripsi_mendapat, tb_cara_mendapat_salinan_informasi.deskripsi AS deskripsi_cara');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->where('tb_pemohon.kode_permohonan', $kode_permohonan);

        // Log query
        $query = $builder->get();
        log_message('debug', 'Query: ' . $builder->getCompiledSelect());
        log_message('debug', 'Query Result: ' . print_r($query->getResult(), true));

        return $query->getResult();
    }

    public function getPemohon($id_pemohon = false)
    {
        if ($id_pemohon == false) {
            return $this->findAll();
        }

        return $this->where(['id_pemohon' => $id_pemohon])->first();
    }
    public function getAllSorted_1($id_pemohon)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->select('tb_pemohon.*, tb_lembaga.nama_dinas, tb_kategori.nama_kategori, tb_memperoleh_informasi.deskripsi as deskripsi_memperoleh_informasi, tb_mendapat_salinan_informasi.deskripsi as deskripsi_mendapat_salinan_informasi, tb_cara_mendapat_salinan_informasi.deskripsi as deskripsi_cara_mendapat_salinan_informasi');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->where('tb_pemohon.id_pemohon', $id_pemohon);
        $query = $builder->get();

        return $query->getRow(); // Mengambil satu baris data
    }

    public function getAllSorted_2($kode_permohonan)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->select('tb_pemohon.*, tb_lembaga.nama_dinas, tb_kategori.nama_kategori, tb_memperoleh_informasi.deskripsi as deskripsi_memperoleh_informasi, tb_mendapat_salinan_informasi.deskripsi as deskripsi_mendapat_salinan_informasi, tb_cara_mendapat_salinan_informasi.deskripsi as deskripsi_cara_mendapat_salinan_informasi');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->where('tb_pemohon.kode_permohonan', $kode_permohonan);
        $query = $builder->get();

        return $query->getRow(); // Mengambil satu baris data
    }

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->select('tb_pemohon.*, tb_lembaga.nama_dinas, tb_kategori.nama_kategori, tb_memperoleh_informasi.deskripsi, tb_mendapat_salinan_informasi.deskripsi, tb_cara_mendapat_salinan_informasi.deskripsi');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->orderBy('tb_pemohon.id_pemohon', 'DESC');
        $query = $builder->get();
        $results = $query->getResult();

        // Ambil data tambahan berdasarkan id_pemohon
        foreach ($results as $result) {
            $id_pemohon = $result->id_pemohon;
            $additional_data = $this->getDokumenById($id_pemohon);
            $result->additional_data = $additional_data;
        }

        return $results;
    }

    public function getDokumenById($id_pemohon)
    {
        $builder = $this->db->table('tb_pemohon');
        $result = $builder->where('id_pemohon', $id_pemohon)->get()->getResult();
        return $result;
    }

    public function getAll($id_pemohon = null)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga')
            ->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori')
            ->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi')
            ->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi')
            ->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');

        if ($id_pemohon !== null) {
            $builder->where('id_pemohon', $id_pemohon);
        }

        return $builder->get()->getRow();
    }

    public function getAll_1($kode_permohonan = null)
    {
        // Lakukan query untuk mendapatkan data pemohon berdasarkan kode permohonan
        $builder = $this->db->table('tb_pemohon');
        $builder->join('tb_lembaga', 'tb_lembaga.id_lembaga = tb_pemohon.id_lembaga');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_pemohon.id_kategori');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');
        $builder->where('tb_pemohon.kode_permohonan', $kode_permohonan);
        $query = $builder->get();

        return $query->getRow(); // Mengambil satu baris data
    }

    public function getKategoriById($id)
    {
        return $this->db->table('tb_kategori')->where('id_kategori', $id)->get()->getRowArray();
    }

    public function getMemperolehById($id_pemohon = null)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->join('tb_memperoleh_informasi', 'tb_memperoleh_informasi.id_memperoleh_informasi = tb_pemohon.id_memperoleh_informasi');

        if ($id_pemohon !== null) {
            $builder->where('id_pemohon', $id_pemohon);
        }

        return $builder->get()->getRow();
    }
    public function getMendapatById($id_pemohon = null)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->join('tb_cara_mendapat_salinan_informasi', 'tb_cara_mendapat_salinan_informasi.id_cara_mendapat_salinan_informasi = tb_pemohon.id_cara_mendapat_salinan_informasi');

        if ($id_pemohon !== null) {
            $builder->where('id_pemohon', $id_pemohon);
        }

        return $builder->get()->getRow();
    }
    public function getCaraMendapatById($id_pemohon = null)
    {
        $builder = $this->db->table('tb_pemohon');
        $builder->join('tb_mendapat_salinan_informasi', 'tb_mendapat_salinan_informasi.id_mendapat_salinan_informasi = tb_pemohon.id_mendapat_salinan_informasi');

        if ($id_pemohon !== null) {
            $builder->where('id_pemohon', $id_pemohon);
        }

        return $builder->get()->getRow();
    }

    public function generateKodePermohonan()
    {
        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $numbers = mt_rand(100, 999);
        $moreLetters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);

        return "{$letters}-{$numbers}-{$moreLetters}";
    }

    public function getNamaKategori($id_kategori)
    {
        $builder = $this->db->table('tb_kategori');
        $builder->select('nama_kategori');
        $builder->where('id_kategori', $id_kategori);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            return $query->getRow()->nama_kategori;
        }

        return null;
    }

    public function getNamaDinas($id_lembaga)
    {
        $builder = $this->db->table('tb_lembaga');
        $builder->select('nama_dinas');
        $builder->where('id_lembaga', $id_lembaga);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            return $query->getRow()->nama_dinas;
        }

        return null;
    }

    public function countUnreadEntries()
    {
        return $this->db->table('tb_pemohon')
            ->where('status', 'Belum diproses')
            ->countAllResults();
    }

    public function getUnreadEntries()
    {
        return $this->db->table('tb_pemohon')
            ->where('status', 'Belum diproses')
            ->get()
            ->getResultObject();
    }

    public function updateStatusBaca($id_pemohon)
    {
        return $this->update($id_pemohon, ['status_baca' => false]);
    }

    // public function countUnreadEntries()
    // {
    //     return $this->db->table('tb_pemohon')
    //         ->where('status_baca', true)
    //         ->countAllResults();
    // }

    // public function getUnreadEntries()
    // {
    //     return $this->db->table('tb_pemohon')
    //         ->where('status_baca', true)
    //         ->get()
    //         ->getResultObject();
    // }

    public function getFilesByPemohonId($id_pemohon)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('file_ktp, file_pendirian_lembaga, akta_notaris_lembaga, surat_kesbangpol, surat_kuasa, file_setuju_1')->where('id_pemohon', $id_pemohon)->findAll();
    }
    public function deleteByPemohonId($id_pemohon)
    {
        // Menghapus entri di tabel berdasarkan id_pemohon
        return $this->where('id_pemohon', $id_pemohon)->delete();
    }

    public function getTotalPemohon()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }

    public function getTotalByStatus($status)
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE status = ?', [$status]);
        $result = $query->getRow();

        return $result ? $result->total : 0;
    }

    public function getKode($kode_permohonan)
    {
        $builder = $this->db->table('tb_pemohon');
        $result = $builder->where('kode_permohonan', $kode_permohonan)->get()->getResult();
        return $result;
    }
}

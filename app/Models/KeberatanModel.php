<?php

namespace App\Models;

use CodeIgniter\Model;

class KeberatanModel extends Model
{
    protected $table = 'tb_keberatan';
    protected $primaryKey = 'id_keberatan';
    protected $returnType = 'object';
    protected $allowedFields = ['id_alasan', 'email', 'ringkasan_kasus', 'nama', 'no_telepon', 'alamat', 'kode_keberatan', 'tanggapan', 'file_keberatan', 'file_diberikan', 'status', 'catatan', 'note', 'keterangan', 'status_baca_keberatan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    // public function getKeberatanByKode($kode_keberatan = null)
    // {
    //     $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
    //             FROM tb_keberatan
    //             JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
    //             JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan";

    //     if ($kode_keberatan !== null) {
    //         $sql .= " WHERE tb_keberatan.kode_keberatan = '$kode_keberatan'";
    //     }

    //     $sql .= " GROUP BY tb_keberatan.id_keberatan";

    //     $query = $this->db->query($sql);
    //     return $query->getResultArray();
    // }

    public function getKeberatanByKode($kode_keberatan = null)
    {
        $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
                FROM tb_keberatan
                JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
                JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan";

        if ($kode_keberatan !== null) {
            $sql .= " WHERE tb_keberatan.kode_keberatan = :kode_keberatan:";
        }

        $sql .= " GROUP BY tb_keberatan.id_keberatan";

        $query = $this->db->query($sql, ['kode_keberatan' => $kode_keberatan]);
        return $query->getResultArray();
    }



    function getAll()
    {
        $builder = $this->db->table('tb_keberatan');
        $builder->join('tb_alasan', 'tb_alasan.id_alasan = tb_keberatan.id_alasan')
            ->join('tb_pemohon', 'tb_pemohon.id_pemohon = tb_keberatan.id_pemohon');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKeberatanId($id_keberatan)
    {
        $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
            FROM tb_keberatan
            JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
            JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan
            GROUP BY tb_keberatan.id_keberatan
            WHERE BY tb_keberatan.id_keberatan" . $id_keberatan;

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function getKeberatan()
    {
        $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
            FROM tb_keberatan
            JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
            JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan
            GROUP BY tb_keberatan.id_keberatan
            ORDER BY tb_keberatan.id_keberatan DESC";

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function getKeberatanById($id_keberatan = null)
    {
        $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
            FROM tb_keberatan
            JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
            JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan";

        if ($id_keberatan !== null) {
            $sql .= " WHERE tb_keberatan.id_keberatan = :id_keberatan:";
        }

        $sql .= " GROUP BY tb_keberatan.id_keberatan";

        $query = $this->db->query($sql, ['id_keberatan' => $id_keberatan]);
        return $query->getResultArray();
    }

    public function getKeberatanEmail($id_keberatan = null)
    {
        $sql = "SELECT tb_keberatan.*, GROUP_CONCAT(tb_alasan.deskripsi SEPARATOR ', ') as deskripsi 
            FROM tb_keberatan
            JOIN tb_form_keberatan ON tb_keberatan.id_keberatan = tb_form_keberatan.id_keberatan
            JOIN tb_alasan ON tb_form_keberatan.id_alasan = tb_alasan.id_alasan";

        if ($id_keberatan !== null) {
            $sql .= " WHERE tb_keberatan.id_keberatan = :id_keberatan:";
        }

        $sql .= " GROUP BY tb_keberatan.id_keberatan";

        $query = $this->db->query($sql, ['id_keberatan' => $id_keberatan]);

        // Mengambil satu baris data jika id_keberatan diberikan
        return $id_keberatan !== null ? $query->getRowArray() : $query->getResultArray();
    }

    public function generateKodeKeberatan()
    {
        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $numbers = mt_rand(100, 999);
        $moreLetters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);

        return "{$letters}-{$numbers}-{$moreLetters}";
    }

    public function getDokumenById($id_keberatan)
    {
        $builder = $this->db->table('tb_keberatan');
        $result = $builder->where('id_keberatan', $id_keberatan)->get()->getResult();
        return $result;
    }

    public function getFilesByKeberatanId($id_keberatan)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('file_keberatan, file_diberikan')->where('id_keberatan', $id_keberatan)->findAll();
    }
    public function deleteByKeberatanId($id_keberatan)
    {
        // Menghapus entri di tabel berdasarkan id_keberatan
        return $this->where('id_keberatan', $id_keberatan)->delete();
    }


    public function countUnreadEntries()
    {
        return $this->db->table('tb_keberatan')
            ->where('status', 'Belum diproses')
            ->countAllResults();
    }

    public function getUnreadEntries()
    {
        return $this->db->table('tb_keberatan')
            ->where('status', 'Belum diproses')
            ->get()
            ->getResultObject();
    }

    public function updateStatusBaca($id_keberatan)
    {
        return $this->update($id_keberatan, ['status_baca_keberatan' => false]);
    }

    public function getTotalKeberatan()
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
}

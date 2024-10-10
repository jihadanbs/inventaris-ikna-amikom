<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table = 'tb_log_aktivitas';
    protected $primaryKey = 'id_log_aktivitas';
    protected $retunType = 'object';
    protected $allowedFields = ['isi_log', 'tanggal_log', 'id_user'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    // untuk memanggil data tabel yang saling berelasi dengan tb_log_aktivitas
    function getAll()
    {
        $builder = $this->db->table('tb_log_aktivitas');
        $builder->join('tb_user', 'tb_user.id_user = tb_log_aktivitas.id_user');
        $query = $builder->get();
        return $query->getResult();
    }
}

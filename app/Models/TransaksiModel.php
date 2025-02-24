<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $returnType = 'object';
    protected $allowedFields = ['id_user', 'id_peminjaman'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

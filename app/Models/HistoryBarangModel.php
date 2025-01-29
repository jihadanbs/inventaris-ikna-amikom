<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryBarangModel extends Model
{
    protected $table = 'tb_history_stock_barang';
    protected $primaryKey = 'id_history';
    protected $allowedFields = ['id_barang', 'jumlah_masuk', 'created_at', 'updated_at', 'created_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

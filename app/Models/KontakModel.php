<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakModel extends Model
{
    protected $table = 'tb_kontak';
    protected $primaryKey = 'id_kontak';
    protected $retunType = 'object';
    protected $allowedFields = ['nama', 'email', 'subjek', 'no_telepon', 'pesan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

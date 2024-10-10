<?php

namespace App\Models;

use CodeIgniter\Model;

class SearchModel extends Model
{
    protected $table = 'tb_search';
    protected $primaryKey = 'id_search';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'description'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function search($query)
    {
        return $this->like('name', $query)
            ->orLike('description', $query)
            ->findAll();
    }
}

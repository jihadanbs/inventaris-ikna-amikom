<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'tb_feedback';
    protected $primaryKey = 'id_feedback';
    protected $returnType = 'object';
    protected $allowedFields = ['nama', 'email', 'no_telepon', 'subjek', 'pesan', 'balasan', 'status'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getFeedback($id_feedback = false)
    {
        if ($id_feedback == false) {
            return $this->findAll();
        }

        return $this->where(['id_feedback' => $id_feedback])->first();
    }

    public function getAllData()
    {
        return $this->orderBy('id_feedback', 'DESC')->findAll();
    }

    public function getId($id_feedback)
    {
        return $this->db->table('tb_feedback')->where('id_feedback', $id_feedback)->get()->getRowArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'tb_visitor';
    protected $primaryKey = 'id_visitor';
    protected $returnType = 'object';
    protected $allowedFields = ['ip', 'date', 'hits', 'online', 'time',];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getVisitorStats()
    {
        $today = date('Y-m-d');
        return $this->where('visit_date', $today)->first();
    }

    public function getVisitorByIpAndDate($ip, $date)
    {
        return $this->where('ip', $ip)
            ->where('date', $date)
            ->first();
    }

    public function insertVisitor($data)
    {
        return $this->insert($data);
    }

    public function updateVisitor($ip, $date, $data)
    {
        return $this->where('ip', $ip)
            ->where('date', $date)
            ->set($data)
            ->update();
    }

    public function getTodayVisitors($date)
    {
        return $this->select('ip')
            ->where('date', $date)
            ->groupBy('ip')
            ->countAllResults();
    }

    // public function getTotalHits()
    // {
    //     return $this->selectSum('hits')
    //         ->first();
    // }

    public function getTotalVisitors()
    {
        return $this->countAllResults();
    }

    public function getOnlineVisitors($bataswaktu)
    {
        return $this->where('online >', $bataswaktu)
            ->countAllResults();
    }
}

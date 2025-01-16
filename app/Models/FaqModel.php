<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'tb_faq';
    protected $primaryKey = 'id_faq';
    protected $retunType = 'object';
    protected $allowedFields = ['id_kategori_faq', 'slug', 'pertanyaan', 'jawaban'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllSorted()
    {
        $builder = $this->db->table('tb_faq');
        $builder->select('tb_faq.*, tb_kategori_faq.nama_kategori');
        $builder->join('tb_kategori_faq', 'tb_kategori_faq.id_kategori_faq = tb_faq.id_kategori_faq');
        $builder->orderBy('tb_faq.id_faq', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getFaq($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getSlug($slug)
    {
        $builder = $this->db->table('tb_faq');
        $query = $builder->join('tb_kategori_faq', 'tb_kategori_faq.id_kategori_faq = tb_faq.id_kategori_faq')->where('tb_faq.slug', $slug)->get();

        return $query->getRowArray();
    }


    public function ambil_data($id_faq)
    {
        return $this->find($id_faq);
    }

    public function getid($id_faq)
    {
        $builder = $this->db->table('tb_faq');
        return $builder->where('id_faq', $id_faq)->get()->getResult();
    }

    public function getAllFaq()
    {
        $builder = $this->db->table('tb_faq');
        $builder->select('tb_faq.*, tb_kategori_faq.nama_kategori');
        $builder->join('tb_kategori_faq', 'tb_kategori_faq.id_kategori_faq = tb_faq.id_kategori_faq');
        return $builder->get()->getResult();
    }
}

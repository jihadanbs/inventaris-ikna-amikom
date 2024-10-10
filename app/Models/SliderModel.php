<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'tb_slider_beranda';
    protected $primaryKey = 'id_slider_beranda';
    protected $retunType = 'object';
    protected $allowedFields = ['gambar_slider'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_slider_beranda', 'DESC')->findAll();
    }

    public function getLogo($id_slider_beranda = null)
    {
        if ($id_slider_beranda === null) {
            return $this->findAll();
        } else {
            return $this->find($id_slider_beranda);
        }
    }

    public function getSlider($id_slider_beranda = false)
    {
        if ($id_slider_beranda == false) {
            return $this->findAll();
        }

        return $this->where(['id_slider_beranda' => $id_slider_beranda])->first();
    }

    public function getFilesById($id_slider_beranda)
    {
        // Ambil hanya kolom yang dibutuhkan
        return $this->select('gambar_slider')->where('id_slider_beranda', $id_slider_beranda)->findAll();
    }
    public function deleteById($id_slider_beranda)
    {
        // Menghapus entri di tabel berdasarkan id_slider_beranda
        return $this->where('id_slider_beranda', $id_slider_beranda)->delete();
    }
}

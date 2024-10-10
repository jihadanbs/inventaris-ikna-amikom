<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunjungModel extends Model
{
    protected $table = 'tb_pengunjung';
    protected $primaryKey = 'id_pengunjung';
    protected $returnType = 'object';
    protected $allowedFields = ['email_pengunjung', 'id_informasi_publik', 'id_laporan', 'download_time', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->findAll();
    }
    public function getAllData_1()
    {
        return $this->orderBy('id_pengunjung', 'DESC')->findAll();
    }

    public function recordDownload($id_informasi_publik, $email, $id_laporan)
    {
        $this->insert([
            'id_laporan' => $id_laporan,
            'id_informasi_publik' => $id_informasi_publik,
            'email' => $email,
            'download_time' => date('Y-m-d H:i:s')
        ]);
    }

    // Definisi relasi ke tb_informasi_publik
    public function informasiPublik()
    {
        return $this->belongsTo(InformasiPublikModel::class, 'id_informasi_publik', 'id_informasi_publik');
    }

    // Definisi relasi ke tb_laporan
    public function laporan()
    {
        return $this->belongsTo(LaporanModel::class, 'id_laporan', 'id_laporan');
    }

    // Metode untuk mengambil informasi publik berdasarkan id
    public function getInformasiPublik($id)
    {
        return $this->informasiPublik()->find($id);
    }

    // Metode untuk mengambil laporan berdasarkan id
    public function getLaporan($id)
    {
        return $this->laporan()->find($id);
    }
}

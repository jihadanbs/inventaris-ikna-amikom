<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPeminjamModel extends Model
{
    protected $table = 'tb_user_peminjam';
    protected $primaryKey = 'id_user_peminjam';
    protected $allowedFields = ['id_barang', 'nama_lengkap', 'pekerjaan', 'email', 'no_telepon', 'alamat', 'kepentingan', 'kode_peminjaman', 'status', 'keterangan', 'tanggal_pengajuan', 'tanggal_dipinjamkan', 'tanggal_diperkirakan_dikembalikan', 'tanggal_dikembalikan'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    public function getAllData()
    {
        return $this->orderBy('id_user_peminjam', 'DESC')->findAll();
    }
}

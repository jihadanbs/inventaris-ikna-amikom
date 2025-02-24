<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanBarangModel extends Model
{
    protected $table = 'tb_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = ['id_barang', 'total_dipinjam', 'slug', 'kepentingan', 'kode_peminjaman', 'status', 'tanggal_pengajuan', 'tanggal_dipinjamkan', 'tanggal_perkiraan_dikembalikan', 'tanggal_dikembalikan', 'catatan_peminjaman', 'dokumen_jaminan', 'bukti_pengembalian'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Jabatan extends Seeder
{
    public function run()
    {
        //menambahkan data dalam tabel jabatan
        $data = [
            [
                'nama_jabatan' => 'Admin'
            ],
            [
                'nama_jabatan' => 'Peminjam'
            ],
        ];

        $this->db->table('tb_jabatan')->insertBatch($data);
    }
}

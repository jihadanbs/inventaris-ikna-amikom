<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        //menambahkan data dalam tabel user
        $data = [
            [
                'nama_lengkap' => 'Florensius Alanroa Cikita',
                'username' => 'alan',
                'id_jabatan' => '1',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'status' => 'aktif',
                'email' => 'alanflorensius390@gmail.com',
                'no_telepon' => '088215178312',
                'file_profil' => ''
            ],
            [
                'nama_lengkap' => 'Temennya Alan',
                'username' => 'admin',
                'id_jabatan' => '1',
                'status' => 'aktif',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'email' => 'gantisendiri@gmail.com',
                'no_telepon' => '0812345678891',
                'file_profil' => ''
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}

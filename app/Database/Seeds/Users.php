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
                'nama_lengkap' => 'Jihadan Beckhianosyuhada',
                'username' => 'jihadan',
                'id_jabatan' => '1',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'status' => 'aktif',
                'email' => 'jihadanbs11@gmail.com',
                'no_telepon' => '088215178312',
                'file_profil' => 'gambar.jpg'
            ],
            [
                'nama_lengkap' => 'Muhammad Arrayan',
                'username' => 'arrayan',
                'id_jabatan' => '1',
                'status' => 'aktif',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'email' => 'mazoelian33@gmail.com',
                'no_telepon' => '088215178313',
                'file_profil' => 'gambar.jpg'
            ],
            [
                'nama_lengkap' => 'Halimah Mufita',
                'username' => 'mufita',
                'id_jabatan' => '1',
                'status' => 'aktif',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'email' => 'mufitacool@gmail.com',
                'no_telepon' => '088215178314',
                'file_profil' => 'gambar.jpg'
            ],
            [
                'nama_lengkap' => 'Cindy Loria',
                'username' => 'cindy',
                'id_jabatan' => '1',
                'status' => 'aktif',
                'password' => password_hash('1234567', PASSWORD_DEFAULT),
                'email' => 'cindyloria@gmail.com',
                'no_telepon' => '088215178315',
                'file_profil' => 'gambar.jpg'
            ],
        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}

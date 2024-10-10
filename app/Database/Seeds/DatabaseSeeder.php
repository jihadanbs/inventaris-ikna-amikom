<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil Seeder untuk tabel jabatan
        $this->call('Jabatan');

        // Panggil Seeder untuk tabel user
        $this->call('Users');
    }
}

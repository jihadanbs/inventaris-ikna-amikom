<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbJabatan extends Migration
{
    public function up()
    {
        // membuat database tb_jabatan (posisi untuk login nantinya)
        $this->forge->addField([
            'id_jabatan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_jabatan', TRUE);
        $this->forge->createTable('tb_jabatan', TRUE);
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_jabatan');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFileFoto extends Migration
{
    public function up()
    {
        // membuat database tb_file_foto
        $this->forge->addField([
            'id_file_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'file_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_file_foto', TRUE);
        $this->forge->createTable('tb_file_foto');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_file_foto');
    }
}

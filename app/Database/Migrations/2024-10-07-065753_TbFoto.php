<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFoto extends Migration
{
    public function up()
    {
        // membuat database tb_foto
        $this->forge->addField([
            'id_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'judul_foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tanggal_foto' => [
                'type' => 'DATE'
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_foto', TRUE);
        $this->forge->createTable('tb_foto');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_foto');
    }
}

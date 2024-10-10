<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbWebOption extends Migration
{
    public function up()
    {
        // membuat database tb_web_option
        $this->forge->addField([
            'id_web_option' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'value' => [
                'type' => 'TEXT'
            ],
            'path_file' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_web_option', TRUE);
        $this->forge->createTable('tb_web_option');
    }

    public function down()
    {
        // Menghapus tabel tb_web_option
        $this->forge->dropTable('tb_web_option');
    }
}

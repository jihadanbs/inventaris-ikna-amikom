<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSearch extends Migration
{
    public function up()
    {
        // Membuat tabel tb_search
        $this->forge->addField([
            'id_search' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_search', TRUE);
        // Membuat tabel tb_search';
        $this->forge->createTable('tb_search');
    }

    public function down()
    {
        // Menghapus tabel tb_search';
        $this->forge->dropTable('tb_search');
    }
}

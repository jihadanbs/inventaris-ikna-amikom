<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbVisitor extends Migration
{
    public function up()
    {
        // Membuat tabel tb_visitor
        $this->forge->addField([
            'id_visitor' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'online' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'time' => [
                'type' => 'DATETIME'
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_visitor', TRUE);
        // Membuat tabel tb_visitor
        $this->forge->createTable('tb_visitor');
    }

    public function down()
    {
        // Menghapus tabel tb_visitor
        $this->forge->dropTable('tb_visitor');
    }
}

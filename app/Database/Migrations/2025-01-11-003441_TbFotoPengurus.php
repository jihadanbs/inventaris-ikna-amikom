<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFotoPengurus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'posisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'divisi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_foto_pengurus');
    }

    public function down()
    {
        $this->forge->dropTable('tb_foto_pengurus');
    }
}

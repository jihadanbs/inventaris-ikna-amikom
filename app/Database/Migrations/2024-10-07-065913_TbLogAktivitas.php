<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbLogAktivitas extends Migration
{
    public function up()
    {
        // membuat database tb_log_aktivitas
        $this->forge->addField([
            'id_log_aktivitas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'isi_log' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tanggal_log' => [
                'type' => 'DATETIME',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_log_aktivitas', TRUE);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_log_aktivitas');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_log_aktivitas');
    }
}

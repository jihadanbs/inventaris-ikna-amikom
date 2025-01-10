<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGaleriKegiatan extends Migration
{
    public function up()
    {
          // membuat database tb_kegiatan
          $this->forge->addField([
            'id_kegiatan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'judul_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'foto_kegiatan' => [
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

        $this->forge->addKey('id_kegiatan', TRUE);
        $this->forge->createTable('tb_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kegiatan');
    }
}

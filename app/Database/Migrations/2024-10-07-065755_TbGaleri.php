<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGaleri extends Migration
{
    public function up()
    {
        // membuat database tb_galeri
        $this->forge->addField([
            'id_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_file_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addForeignKey('id_foto', 'tb_foto', 'id_foto', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_file_foto', 'tb_file_foto', 'id_file_foto', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_galeri');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_galeri');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFileFotoBarang extends Migration
{
    public function up()
    {
        // membuat database tb_file_foto_barang
        $this->forge->addField([
            'id_file_foto_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'path_file_foto_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_file_foto_barang', TRUE);
        $this->forge->createTable('tb_file_foto_barang');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_file_foto_barang');
    }
}

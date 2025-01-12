<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKondisiBarang extends Migration
{
    public function up()
    {
        // membuat database tb_kondisi_barang
        $this->forge->addField([
            'id_kondisi_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_kondisi' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_kondisi_barang', TRUE);
        $this->forge->createTable('tb_kondisi_barang');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_kondisi_barang');
    }
}

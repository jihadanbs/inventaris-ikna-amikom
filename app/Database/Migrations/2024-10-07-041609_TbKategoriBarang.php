<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKategoriBarang extends Migration
{
    public function up()
    {
        // membuat database tb_kategori_barang
        $this->forge->addField([
            'id_kategori_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_kategori_barang', TRUE);
        $this->forge->createTable('tb_kategori_barang');
    }

    public function down()
    {
        // untuk menghapus (drop) table
        $this->forge->dropTable('tb_kategori_barang');
    }
}

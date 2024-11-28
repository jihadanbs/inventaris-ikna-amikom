<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGaleriBarang extends Migration
{
    public function up()
    {
        // membuat database tb_galeri_barang
        $this->forge->addField([
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_file_foto_barang_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_file_foto_barang', 'tb_file_foto_barang', 'id_file_foto_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_galeri_barang');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_galeri_barang');
    }
}

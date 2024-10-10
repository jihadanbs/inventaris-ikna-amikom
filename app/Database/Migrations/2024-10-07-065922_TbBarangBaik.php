<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBarangBaik extends Migration
{
    public function up()
    {
        // Membuat tabel tb_barang_baik
        $this->forge->addField([
            'id_barang_baik' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'jumlah_total_baik' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_barang_baik', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // end foreign key

        // Membuat tabel tb_barang_baik
        $this->forge->createTable('tb_barang_baik');
    }

    public function down()
    {
        // Menghapus tabel tb_barang_baik
        $this->forge->dropTable('tb_barang_baik');
    }
}

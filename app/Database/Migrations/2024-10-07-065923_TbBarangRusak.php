<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBarangRusak extends Migration
{
    public function up()
    {
        // Membuat tabel tb_barang_rusak
        $this->forge->addField([
            'id_barang_rusak' => [
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
            'jumlah_total_rusak' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'keterangan_rusak' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_barang_rusak', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // end foreign key

        // Membuat tabel tb_barang_rusak
        $this->forge->createTable('tb_barang_rusak');
    }

    public function down()
    {
        // Menghapus tabel tb_barang_rusak
        $this->forge->dropTable('tb_barang_rusak');
    }
}

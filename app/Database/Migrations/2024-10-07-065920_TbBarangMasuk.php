<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBarangMasuk extends Migration
{
    public function up()
    {
        // Membuat tabel tb_barang_masuk
        $this->forge->addField([
            'id_barang_masuk' => [
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
            'tanggal_masuk' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'keterangan_masuk' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_barang_masuk', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');

        // Membuat tabel tb_barang_masuk
        $this->forge->createTable('tb_barang_masuk');
    }

    public function down()
    {
        // Menghapus tabel tb_barang_masuk
        $this->forge->dropTable('tb_barang_masuk');
    }
}

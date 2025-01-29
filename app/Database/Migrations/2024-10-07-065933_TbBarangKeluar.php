<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBarangKeluar extends Migration
{
    public function up()
    {
        // Membuat tabel tb_barang_keluar
        $this->forge->addField([
            'id_barang_keluar' => [
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
            'id_user_peminjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'tanggal_keluar' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'total_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_barang_keluar', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user_peminjam', 'tb_user_peminjam', 'id_user_peminjam', 'CASCADE', 'CASCADE');

        // Membuat tabel tb_barang_keluar
        $this->forge->createTable('tb_barang_keluar');
    }

    public function down()
    {
        // Menghapus tabel tb_barang_keluar
        $this->forge->dropTable('tb_barang_keluar');
    }
}

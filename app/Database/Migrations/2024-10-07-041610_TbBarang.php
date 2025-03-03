<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbBarang extends Migration
{
    public function up()
    {
        // Membuat tabel tb_barang
        $this->forge->addField([
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_kategori_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'id_kondisi_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'nama_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'jumlah_total' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'jumlah_dipinjam' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_barang', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_kategori_barang', 'tb_kategori_barang', 'id_kategori_barang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kondisi_barang', 'tb_kondisi_barang', 'id_kondisi_barang', 'CASCADE', 'CASCADE');

        // Membuat tabel tb_barang
        $this->forge->createTable('tb_barang');
    }

    public function down()
    {
        // Menghapus tabel tb_barang
        $this->forge->dropTable('tb_barang');
    }
}

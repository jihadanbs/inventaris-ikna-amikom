<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSettingPinjamBarang extends Migration
{
    public function up()
    {
        // Membuat tabel tb_setting_pinjam_barang
        $this->forge->addField([
            'id_setting_pinjam_barang' => [
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
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'is_tampil' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '0 = Tidak ditampilkan, 1 = Ditampilkan'
            ],
            'masa_pinjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'comment' => 'Durasi peminjaman dalam hari'
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            // 'status' => [
            //     'type' => 'ENUM',
            //     'constraint' => ['tersedia', 'dipinjam'],
            //     'default' => 'tersedia'
            // ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_setting_pinjam_barang', TRUE);
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_setting_pinjam_barang');
    }

    public function down()
    {
        // Menghapus tabel tb_setting_pinjam_barang
        $this->forge->dropTable('tb_setting_pinjam_barang');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPeminjaman extends Migration
{
    public function up()
    {
        // Membuat tabel tb_setting_pinjam_barang
        $this->forge->addField([
            'id_peminjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_user_peminjam' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_peminjam', TRUE);
        $this->forge->addForeignKey('id_user_peminjam', 'tb_user_peminjam', 'id_user_peminjam', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_peminjaman');
    }

    public function down()
    {
        // Menghapus tabel tb_setting_pinjam_barang
        $this->forge->dropTable('tb_setting_pinjam_barang');
    }
}

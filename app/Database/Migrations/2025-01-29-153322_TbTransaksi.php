<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTransaksi extends Migration
{
    public function up()
    {
        // Membuat tabel tb_transaksi
        $this->forge->addField([
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'id_peminjaman' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_transaksi', TRUE);
        $this->forge->addForeignKey('id_user', 'tb_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_peminjaman', 'tb_peminjaman', 'id_peminjaman', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_transaksi');
    }

    public function down()
    {
        // Menghapus tabel tb_transaksi
        $this->forge->dropTable('tb_transaksi');
    }
}

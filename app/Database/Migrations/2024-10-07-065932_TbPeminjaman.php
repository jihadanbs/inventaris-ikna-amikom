<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPeminjaman extends Migration
{
    public function up()
    {
        // membuat database tb_peminjaman
        $this->forge->addField([
            'id_peminjaman' => [
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
            // 'id_barang' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => TRUE
            // ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_peminjaman', TRUE);
        // membuat foreign key
        $this->forge->addForeignKey('id_user_peminjam', 'tb_user_peminjam', 'id_user_peminjam', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // end foreign key
        $this->forge->createTable('tb_peminjaman');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_peminjaman');
    }
}

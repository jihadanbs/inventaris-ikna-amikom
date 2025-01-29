<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbHistoryStokBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_history' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            // 'id_kondisi_barang' => [
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => TRUE
            // ],
            // 'tanggal_masuk' => [
            //     'type' => 'DATE',
            // ],
            'jumlah_masuk' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            // 'kondisi_masuk' => [
            //     'type' => 'ENUM',
            //     'constraint' => ['baik', 'rusak'],
            // ],
            // 'keterangan' => [
            //     'type' => 'TEXT',
            //     'null' => true,
            // ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_history', true);
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_kondisi_barang', 'tb_kondisi_barang', 'id_kondisi_barang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'tb_user', 'id_user', 'SET NULL', 'CASCADE');
        $this->forge->createTable('tb_history_stock_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_history_stock_barang');
    }
}

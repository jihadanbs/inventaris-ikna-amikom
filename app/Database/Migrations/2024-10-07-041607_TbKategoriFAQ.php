<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKategoriFAQ extends Migration
{
    public function up()
    {
        // Membuat tabel tb_kategori_faq
        $this->forge->addField([
            'id_kategori_faq' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_kategori_faq', TRUE);
        // Membuat tabel tb_kategori_faq
        $this->forge->createTable('tb_kategori_faq');
    }

    public function down()
    {
        // Menghapus tabel tb_kategori_faq
        $this->forge->dropTable('tb_kategori_faq');
    }
}

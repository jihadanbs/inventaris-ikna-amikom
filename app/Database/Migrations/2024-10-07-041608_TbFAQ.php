<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbFAQ extends Migration
{
    public function up()
    {
        // Membuat tabel tb_faq
        $this->forge->addField([
            'id_faq' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_kategori_faq' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'pertanyaan' => [
                'type' => 'TEXT',
            ],
            'jawaban' => [
                'type' => 'TEXT',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_faq', TRUE);
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_kategori_faq', 'tb_kategori_faq', 'id_kategori_faq', 'CASCADE', 'CASCADE');
        // Membuat tabel tb_faq
        $this->forge->createTable('tb_faq');
    }

    public function down()
    {
        // Menghapus tabel tb_faq
        $this->forge->dropTable('tb_faq');
    }
}

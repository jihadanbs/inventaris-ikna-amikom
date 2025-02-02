<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class TbStatistik extends Migration
{
    public function up()
    {
        // Membuat tabel tb_statistik
        $this->forge->addField([
            'id_statistik' => [
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
            'id_barang_baik' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'id_barang_rusak' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'judul_statistik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'data_grafik' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id_statistik', TRUE);
        // Menambahkan foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang_baik', 'tb_barang_baik', 'id_barang_baik', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang_rusak', 'tb_barang_rusak', 'id_barang_rusak', 'CASCADE', 'CASCADE');
        // Membuat tabel tb_statistik
        $this->forge->createTable('tb_statistik');
    }
    public function down()
    {
        // Menghapus tabel tb_statistik
        $this->forge->dropTable('tb_statistik');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPeminjaman extends Migration
{
    public function up()
    {
        // membuat database tb_user_peminjam
        $this->forge->addField([
            'id_peminjaman' => [
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
            'total_dipinjam' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kepentingan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kode_peminjaman' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'enum' => ['Diproses', 'Ditolak', 'Dipinjamkan', 'Dikembalikan'],
            ],
            'catatan_peminjaman' => [
                'type' => 'TEXT'
            ],
            'tanggal_pengajuan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'tanggal_dipinjamkan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'tanggal_perkiraan_dikembalikan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'tanggal_dikembalikan' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'dokumen_jaminan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'bukti_pengembalian' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_peminjaman', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // end foreign key

        // membuat tabel tb_peminjaman
        $this->forge->createTable('tb_peminjaman');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_peminjaman');
    }
}

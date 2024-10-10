<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbUserPeminjam extends Migration
{
    public function up()
    {
        // membuat database tb_user_peminjam
        $this->forge->addField([
            'id_user_peminjam' => [
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
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'alamat' => [
                'type' => 'TEXT',
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
                'enum' => ['Belum diproses', 'ditolak', 'dipinjamkan', 'dikembalikan'],
            ],
            'keterangan' => [
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
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id_user_peminjam', TRUE);

        // membuat foreign key
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        // end foreign key

        // membuat tabel tb_user_peminjam
        $this->forge->createTable('tb_user_peminjam');
    }

    public function down()
    {
        // untuk menghapus (drop) tabel
        $this->forge->dropTable('tb_user_peminjam');
    }
}

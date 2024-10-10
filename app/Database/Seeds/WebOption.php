<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WebOption extends Seeder
{
    public function run()
    {
        //menambahkan data dalam tabel web option
        $data = [
            [
                'name' => 'Profil',
                'value' => 'PPID adalah Pejabat Pengelola Informasi dan Dokumentasi di lingkungan kabupaten pesawaran,
dengan kepala dinas komunikasi, Informatika, Statistik dan Persandian sebagai ketua PPID yang bertanggung jawab kepada
Bupati Pesawaran dan Sekretaris Daerah sebagai atasan langsung dan ketua PPID memiliki bawahan bidang pengelola
informasi, bidang pelayanan informasi, bidang dokumentasi dan arsip serta bidang pengaduan dan penyelesaian sengketa.

Ketua PPID dapat berkonsultasi dan berkoordinasi dengan tim pertimbangan pelayanan informasi dalam hal ini ditugaskan
inspektur Kabupaten Pesawaran.',
                'path_file' => 'profil.jpg'
            ],
            [
                'name' => 'Visi & Misi',
                'value' => '1. Untuk memberi pelayanan informasi  yang cepat, tepat dan sederhana sesuai dengan aturan yang berlaku
2. Penyelenggara menyediakan informasi menyimpan, mendokumentasikan  dan mengamankan informasi
3. Mengadakan Forum Group Discussion (FGD) dalam keterbukaan informasi kepada  masyarakat',
                'path_file' => 'visimisi.jpg'
            ],
            [
                'name' => 'Struktur Organisasi',
                'value' => 'Struktur Organisasi',
                'path_file' => 'strukturorganisasi.jpg'
            ],
            [
                'name' => 'Tugas PPID',
                'value' => 'Merencanakan, mengorganisasikan, melaksanakan, mengawasi dan mengevaluasi pelaksanaan
kegiatan pengelolaan dan pelayanan informasi publik di lingkungan Pemerintah Kabupaten Pesawaran',
                'path_file' => 'tugasppid.jpg'
            ],
            [
                'name' => 'Fungsi PPID',
                'value' => '1. Penghimpun informasi dari seluruh OPD di Lingkungan Pemerintah Kabupaten Pesawaran
2. Penataan dan penyimpanan informasi publk yang diperoleh dari seluruh di OPD di Lingkungan Pmerintah Kabupaten Pesawaran
3. Pelaksanaan konsultasi informasi publik yang termasuk dalam kategori dikecualikan dan informasi yang terbuka untuk publik. Pendampingan penyelesaian sengketa informasi',
                'path_file' => 'fungsi.jpg'
            ],
            [
                'name' => 'Dasar Hukum',
                'value' => '1. Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Infromasi Publik

2. Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik

3. Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-undang Nomor 14 Tahun 2008
tentang keterbukaan Infromasi Publik

4. Peraturan Menteri Dalam Negeri Nomor 3 Tahun 2017 tentang Pedoman Pengelolaan Pelayanan Informasi dan
Dokumentasi Kementerian Dalam Negeri dan Pemerintahan Daerah

5. Keputusan Bupati Pesawaran Nomor 239/IV.13/HK/2022 tentang Penunjukan Pejabat Pengelola Informasi dan
Dokumentasi di Lingkungan Pemerintah Kabupaten Pesawaran

6. Peraturan Komisi Informasi Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik',
                'path_file' => 'dasar.jpg'
            ],
            [
                'name' => 'Logo',
                'value' => 'Logo',
                'path_file' => 'logo.png',
            ],
            [
                'name' => 'Favicon',
                'value' => 'Favicon',
                'path_file' => 'favicon.png',
            ],
            [
                'name' => 'Email',
                'value' => 'ppidpesawarankab@gmail.com',
                'path_file' => 'email.png',
            ],
            [
                'name' => 'Alamat',
                'value' => 'https://maps.app.goo.gl/jpr3uQeGuKH3tYFGA',
                'path_file' => 'alamat.png',
            ],
            [
                'name' => 'WhatsApp 1',
                'value' => 'https://wa.me/083163636065',
                'path_file' => 'whatsapp.png',
            ],
            [
                'name' => 'WhatsApp 2',
                'value' => 'https://wa.me/085934584422',
                'path_file' => 'whatsapp.png',
            ],
            [
                'name' => 'Prosedur Permohonan Penyelesaian Sengketa Informasi',
                'value' => 'Prosedur Permohonan Penyelesaian Sengketa Informasi',
                'path_file' => 'Prosedur_Penyelesaian_Sengketa.jpg',
            ],
            [
                'name' => 'Prosedur Penanganan Sengketa Informasi',
                'value' => 'Prosedur Penanganan Sengketa Informasi',
                'path_file' => 'Prosedur_Penanganan_Sengketa.jpg',
            ],
            [
                'name' => 'Biaya Layanan',
                'value' => 'Sesuai dengan Peraturan Gubernur Nomor 175 Tahun 2016 tentang Layanan Informasi Publik dijelaskan bahwa:

1. Penyediaan dan pemberian pelayanan informasi publik kepada pemohon informasi tidak dipungut biaya (pasal 53 ayat 3).

2. Dalam hal pemohon bermaksud melakukan penggandaan atau perekaman informasi publik, maka pemohon informasi dapat melakukan penggandaan atau perekaman dengan menggunakan biaya sendiri di sekitar lokasi PPID bersama petugas layanan informasi PPID atau menyediakan CD/VCD/Flashdisk untuk perekaman data informasi publik (pasal 53 ayat 4).

3. Dalam hal pemohon ingin mendapatkan salinan informasi melalui pengiriman jasa pos dan jasa kurir dikenakan biaya pos dan biaya kurir
sesuai dengan ketentuan biaya pada kantor jasa pos dan kantor jasa kurir (pasal 53 ayat 5).
',
                'path_file' => 'Biaya_Layanan_Informasi.jpg',
            ],
            [
                'name' => 'Maklumat Informasi Publik',
                'value' => '1. Kami sanggup menyelenggarakan pelayanan secara prima.
2. Kami siap menerima kritik dan saran dari masyarakat demi menciptakan masyarakat yang maju.
3. Kami sanggup mewujudkan informasi yang akurat dan berimbang.',
                'path_file' => 'maklumat.jpg',
            ],
            [
                'name' => 'Prosedur Permohonan Informasi Publik',
                'value' => 'Prosedur Permohonan Informasi Publik',
                'path_file' => 'Prosedur_Permohonan_Informasi_Publik.jpg',
            ],
            [
                'name' => 'Prosedur Pengajuan Keberatan Informasi Publik',
                'value' => 'Prosedur Pengajuan Keberatan Informasi Publik',
                'path_file' => 'Prosedur_Pengajuan_Keberatan_Informasi_Publik.jpg',
            ],
        ];

        $this->db->table('tb_web_option')->insertBatch($data);
    }
}

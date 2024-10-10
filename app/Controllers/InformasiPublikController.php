<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriInformasiModel;
use App\Models\LembagaModel;
use App\Models\InformasiPublikModel;
use App\Models\JenisInformasiModel;
use App\Models\PengunjungModel;
use App\Models\WebOptionModel;
use App\Models\VisitorModel;
use Config\Validation;

class InformasiPublikController extends BaseController
{
    protected $session;
    protected $validation;
    protected $m_informasi_publik;
    protected $m_lembaga;
    protected $m_jenis;
    protected $m_pengunjung;
    protected $m_kategori_informasi;
    protected $m_web_option;

    public function __construct()
    {
        helper("upload_helper");
        $this->session = session();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->m_lembaga = new LembagaModel();
        $this->m_jenis = new JenisInformasiModel();
        $this->m_pengunjung = new PengunjungModel();
        $this->m_kategori_informasi = new KategoriInformasiModel();
        $this->m_web_option = new WebOptionModel();
    }

    public function informasipublik()
    {
        // WAJIB //
        $tb_web_option = $this->m_web_option->getAll();
        $logo = $this->m_web_option->getAll(7);
        $path_logo = $logo ? $logo->path_file : null;
        $favicon = $this->m_web_option->getAll(8);
        $path_favicon = $favicon ? $favicon->path_file : null;
        $emailData = $this->m_web_option->getAll(9);
        $email = $emailData ? strip_tags($emailData->value, '<a>') : null;
        $alamatData = $this->m_web_option->getAll(10);
        $alamat = $alamatData ? strip_tags($alamatData->value, '<a>') : null;
        $cp1Data = $this->m_web_option->getAll(11);
        $cp1 = $cp1Data ? (object)[
            'value' => strip_tags($cp1Data->value, '<a>'),
            'name' => strip_tags($cp1Data->name)
        ] : null;
        $cp2Data = $this->m_web_option->getAll(12);
        $cp2 = $cp2Data ? (object)[
            'value' => strip_tags($cp2Data->value, '<a>'),
            'name' => strip_tags($cp2Data->name)
        ] : null;
        $sengketa = $this->m_web_option->getAll(13);
        $path_sengketa = $sengketa ? $sengketa->path_file : null;
        $penanganan = $this->m_web_option->getAll(14);
        $path_penanganan = $penanganan ? $penanganan->path_file : null;
        $visitorModel = new VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $visitor = $visitorModel->getVisitorByIpAndDate($ip, $date);
        if ($visitor == null) {
            $visitorModel->insertVisitor([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert
            ]);
        } else {
            $visitorModel->updateVisitor($ip, $date, [
                'hits' => $visitor->hits + 1,
                'online' => $waktu
            ]);
        }
        $pengunjunghariini = $visitorModel->getTodayVisitors($date); // Hitung jumlah pengunjung hari ini
        $totalpengunjung = $visitorModel->getTotalVisitors(); // Hitung total pengunjung
        $bataswaktu = time() - 300;
        $pengunjungonline = $visitorModel->getOnlineVisitors($bataswaktu); // Hitung pengunjung online

        $categoryCounts = $this->m_informasi_publik->getCategoryCounts(); // Chart
        $jenisCounts = $this->m_informasi_publik->getJenisCounts();
        // END WAJIB //

        $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_jenis = $this->m_jenis->getAllData();
        $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
        $tb_pengunjung = $this->m_pengunjung->getAllData();
        $tb_kategori_informasi_publik =  $this->m_kategori_informasi->getAllData();

        $m_nama_dinas = new InformasiPublikModel();
        $nama_dinas = $m_nama_dinas->getNamaDinas();

        $m_tahun = new \App\Models\InformasiPublikModel();
        $tahun_informasi_publik = $m_tahun->getAllData();

        $m_total_data = new InformasiPublikModel();
        $total_data = $m_total_data->countAllData();

        $pengunjung = $this->m_pengunjung->getAllData();

        $kategoriCounts = $this->m_informasi_publik->getKategoriCounts();
        $totalKategori = $this->m_informasi_publik->getTotalKategori();

        $data = [
            'title' => 'Informasi Publik',
            'activePage' => 'user/informasipublik',
            // WAJIB //
            'tb_web_option' => $tb_web_option,
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'profil' => $this->m_web_option->getAll(1), // Ganti dengan ID sesuai kebutuhan
            'visimisi' => $this->m_web_option->getAll(2),
            'struktur' => $this->m_web_option->getAll(3),
            'tugas' => $this->m_web_option->getAll(4),
            'fungsi' => $this->m_web_option->getAll(5),
            'dasarhukum' => $this->m_web_option->getAll(6),
            'logo' => $path_logo, // 7
            'favicon' => $path_favicon,
            'email' => $email, // 9
            'alamat' => $alamat, // 10
            'cp1' => $cp1, // 11
            'cp2' => $cp2, // 12
            'categoryCounts' => $categoryCounts,
            'jenisCounts' => $jenisCounts,
            'sengketa' => $path_sengketa, // 13
            'penanganan' => $path_penanganan, // 14
            'biaya' => $this->m_web_option->getAll(15), // 15
            'maklumat' => $this->m_web_option->getAll(16), // 16
            // END WAJIB //

            'tb_informasi_publik' => $tb_informasi_publik,
            'tahun_informasi_publik' => $tahun_informasi_publik,
            'total_data' => $total_data,
            'slug_info_publik' => $slug_info_publik,
            'tb_lembaga' => $tb_lembaga,
            'tb_pengunjung' => $tb_pengunjung,
            'tb_jenis' => $tb_jenis,
            'nama_dinas' => $nama_dinas,
            'tb_kategori_informasi_publik' => $tb_kategori_informasi_publik,

            'pengunjung' => $pengunjung,

            'kategoriCounts' => $kategoriCounts,
            'totalKategori' => $totalKategori
        ];

        return view('user/informasipublik/informasipublik', $data);
    }

    public function informasiberkala()
    {
        // WAJIB //
        $tb_web_option = $this->m_web_option->getAll();
        $logo = $this->m_web_option->getAll(7);
        $path_logo = $logo ? $logo->path_file : null;
        $favicon = $this->m_web_option->getAll(8);
        $path_favicon = $favicon ? $favicon->path_file : null;
        $emailData = $this->m_web_option->getAll(9);
        $email = $emailData ? strip_tags($emailData->value, '<a>') : null;
        $alamatData = $this->m_web_option->getAll(10);
        $alamat = $alamatData ? strip_tags($alamatData->value, '<a>') : null;
        $cp1Data = $this->m_web_option->getAll(11);
        $cp1 = $cp1Data ? (object)[
            'value' => strip_tags($cp1Data->value, '<a>'),
            'name' => strip_tags($cp1Data->name)
        ] : null;
        $cp2Data = $this->m_web_option->getAll(12);
        $cp2 = $cp2Data ? (object)[
            'value' => strip_tags($cp2Data->value, '<a>'),
            'name' => strip_tags($cp2Data->name)
        ] : null;
        $sengketa = $this->m_web_option->getAll(13);
        $path_sengketa = $sengketa ? $sengketa->path_file : null;
        $penanganan = $this->m_web_option->getAll(14);
        $path_penanganan = $penanganan ? $penanganan->path_file : null;
        $visitorModel = new VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $visitor = $visitorModel->getVisitorByIpAndDate($ip, $date);
        if ($visitor == null) {
            $visitorModel->insertVisitor([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert
            ]);
        } else {
            $visitorModel->updateVisitor($ip, $date, [
                'hits' => $visitor->hits + 1,
                'online' => $waktu
            ]);
        }
        $pengunjunghariini = $visitorModel->getTodayVisitors($date); // Hitung jumlah pengunjung hari ini
        $totalpengunjung = $visitorModel->getTotalVisitors(); // Hitung total pengunjung
        $bataswaktu = time() - 300;
        $pengunjungonline = $visitorModel->getOnlineVisitors($bataswaktu); // Hitung pengunjung online

        $categoryCounts = $this->m_informasi_publik->getCategoryCounts(); // Chart
        $jenisCounts = $this->m_informasi_publik->getJenisCounts();
        // END WAJIB //

        $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_jenis = $this->m_jenis->getAllData();
        $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
        $tb_pengunjung = $this->m_pengunjung->getAllData();

        $m_nama_dinas = new InformasiPublikModel();
        $nama_dinas = $m_nama_dinas->getNamaDinas();

        $m_tahun = new \App\Models\InformasiPublikModel();
        $tahun_informasi_publik = $m_tahun->getAllData();

        $m_total_data = new InformasiPublikModel();
        $total_data = $m_total_data->countAllData();

        $kategoriCounts = $this->m_informasi_publik->getKategoriCounts();
        $totalKategori = $this->m_informasi_publik->getTotalKategori();

        $data = [
            'title' => 'Informasi Berkala',
            'activePage' => 'informasiberkala',
            // WAJIB //
            'tb_web_option' => $tb_web_option,
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'profil' => $this->m_web_option->getAll(1), // Ganti dengan ID sesuai kebutuhan
            'visimisi' => $this->m_web_option->getAll(2),
            'struktur' => $this->m_web_option->getAll(3),
            'tugas' => $this->m_web_option->getAll(4),
            'fungsi' => $this->m_web_option->getAll(5),
            'dasarhukum' => $this->m_web_option->getAll(6),
            'logo' => $path_logo, // 7
            'favicon' => $path_favicon,
            'email' => $email, // 9
            'alamat' => $alamat, // 10
            'cp1' => $cp1, // 11
            'cp2' => $cp2, // 12
            'categoryCounts' => $categoryCounts,
            'jenisCounts' => $jenisCounts,
            'sengketa' => $path_sengketa, // 13
            'penanganan' => $path_penanganan, // 14
            'biaya' => $this->m_web_option->getAll(15), // 15
            'maklumat' => $this->m_web_option->getAll(16), // 16
            // END WAJIB //

            'tb_informasi_publik' => $tb_informasi_publik,
            'tahun_informasi_publik' => $tahun_informasi_publik,
            'total_data' => $total_data,
            'slug_info_publik' => $slug_info_publik,
            'tb_lembaga' => $tb_lembaga,
            'tb_pengunjung' => $tb_pengunjung,
            'tb_jenis' => $tb_jenis,
            'nama_dinas' => $nama_dinas,

            'kategoriCounts' => $kategoriCounts,
            'totalKategori' => $totalKategori

        ];
        return view('user/informasipublik/informasiberkala', $data);
    }

    public function informasisertamerta()
    {
        // WAJIB //
        $tb_web_option = $this->m_web_option->getAll();
        $logo = $this->m_web_option->getAll(7);
        $path_logo = $logo ? $logo->path_file : null;
        $favicon = $this->m_web_option->getAll(8);
        $path_favicon = $favicon ? $favicon->path_file : null;
        $emailData = $this->m_web_option->getAll(9);
        $email = $emailData ? strip_tags($emailData->value, '<a>') : null;
        $alamatData = $this->m_web_option->getAll(10);
        $alamat = $alamatData ? strip_tags($alamatData->value, '<a>') : null;
        $cp1Data = $this->m_web_option->getAll(11);
        $cp1 = $cp1Data ? (object)[
            'value' => strip_tags($cp1Data->value, '<a>'),
            'name' => strip_tags($cp1Data->name)
        ] : null;
        $cp2Data = $this->m_web_option->getAll(12);
        $cp2 = $cp2Data ? (object)[
            'value' => strip_tags($cp2Data->value, '<a>'),
            'name' => strip_tags($cp2Data->name)
        ] : null;
        $sengketa = $this->m_web_option->getAll(13);
        $path_sengketa = $sengketa ? $sengketa->path_file : null;
        $penanganan = $this->m_web_option->getAll(14);
        $path_penanganan = $penanganan ? $penanganan->path_file : null;
        $visitorModel = new VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $visitor = $visitorModel->getVisitorByIpAndDate($ip, $date);
        if ($visitor == null) {
            $visitorModel->insertVisitor([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert
            ]);
        } else {
            $visitorModel->updateVisitor($ip, $date, [
                'hits' => $visitor->hits + 1,
                'online' => $waktu
            ]);
        }
        $pengunjunghariini = $visitorModel->getTodayVisitors($date); // Hitung jumlah pengunjung hari ini
        $totalpengunjung = $visitorModel->getTotalVisitors(); // Hitung total pengunjung
        $bataswaktu = time() - 300;
        $pengunjungonline = $visitorModel->getOnlineVisitors($bataswaktu); // Hitung pengunjung online

        $categoryCounts = $this->m_informasi_publik->getCategoryCounts(); // Chart
        $jenisCounts = $this->m_informasi_publik->getJenisCounts();
        // END WAJIB //

        $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_jenis = $this->m_jenis->getAllData();
        $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
        $tb_pengunjung = $this->m_pengunjung->getAllData();

        $m_nama_dinas = new InformasiPublikModel();
        $nama_dinas = $m_nama_dinas->getNamaDinas();

        $m_tahun = new \App\Models\InformasiPublikModel();
        $tahun_informasi_publik = $m_tahun->getAllData();

        $m_total_data = new InformasiPublikModel();
        $total_data = $m_total_data->countAllData();

        $kategoriCounts = $this->m_informasi_publik->getKategoriCounts();
        $totalKategori = $this->m_informasi_publik->getTotalKategori();

        $data = [
            'title' => 'Informasi Serta Merta',
            'activePage' => 'informasisertamerta',
            // WAJIB //
            'tb_web_option' => $tb_web_option,
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'profil' => $this->m_web_option->getAll(1), // Ganti dengan ID sesuai kebutuhan
            'visimisi' => $this->m_web_option->getAll(2),
            'struktur' => $this->m_web_option->getAll(3),
            'tugas' => $this->m_web_option->getAll(4),
            'fungsi' => $this->m_web_option->getAll(5),
            'dasarhukum' => $this->m_web_option->getAll(6),
            'logo' => $path_logo, // 7
            'favicon' => $path_favicon,
            'email' => $email, // 9
            'alamat' => $alamat, // 10
            'cp1' => $cp1, // 11
            'cp2' => $cp2, // 12
            'categoryCounts' => $categoryCounts,
            'jenisCounts' => $jenisCounts,
            'sengketa' => $path_sengketa, // 13
            'penanganan' => $path_penanganan, // 14
            'biaya' => $this->m_web_option->getAll(15), // 15
            'maklumat' => $this->m_web_option->getAll(16), // 16
            // END WAJIB //

            'tb_informasi_publik' => $tb_informasi_publik,
            'tahun_informasi_publik' => $tahun_informasi_publik,
            'total_data' => $total_data,
            'slug_info_publik' => $slug_info_publik,
            'tb_lembaga' => $tb_lembaga,
            'tb_pengunjung' => $tb_pengunjung,
            'tb_jenis' => $tb_jenis,
            'nama_dinas' => $nama_dinas,

            'kategoriCounts' => $kategoriCounts,
            'totalKategori' => $totalKategori

        ];
        return view('user/informasipublik/informasisertamerta', $data);
    }

    public function informasisetiapsaat()
    {
        // WAJIB //
        $tb_web_option = $this->m_web_option->getAll();
        $logo = $this->m_web_option->getAll(7);
        $path_logo = $logo ? $logo->path_file : null;
        $favicon = $this->m_web_option->getAll(8);
        $path_favicon = $favicon ? $favicon->path_file : null;
        $emailData = $this->m_web_option->getAll(9);
        $email = $emailData ? strip_tags($emailData->value, '<a>') : null;
        $alamatData = $this->m_web_option->getAll(10);
        $alamat = $alamatData ? strip_tags($alamatData->value, '<a>') : null;
        $cp1Data = $this->m_web_option->getAll(11);
        $cp1 = $cp1Data ? (object)[
            'value' => strip_tags($cp1Data->value, '<a>'),
            'name' => strip_tags($cp1Data->name)
        ] : null;
        $cp2Data = $this->m_web_option->getAll(12);
        $cp2 = $cp2Data ? (object)[
            'value' => strip_tags($cp2Data->value, '<a>'),
            'name' => strip_tags($cp2Data->name)
        ] : null;
        $sengketa = $this->m_web_option->getAll(13);
        $path_sengketa = $sengketa ? $sengketa->path_file : null;
        $penanganan = $this->m_web_option->getAll(14);
        $path_penanganan = $penanganan ? $penanganan->path_file : null;
        $visitorModel = new VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $visitor = $visitorModel->getVisitorByIpAndDate($ip, $date);
        if ($visitor == null) {
            $visitorModel->insertVisitor([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert
            ]);
        } else {
            $visitorModel->updateVisitor($ip, $date, [
                'hits' => $visitor->hits + 1,
                'online' => $waktu
            ]);
        }
        $pengunjunghariini = $visitorModel->getTodayVisitors($date); // Hitung jumlah pengunjung hari ini
        $totalpengunjung = $visitorModel->getTotalVisitors(); // Hitung total pengunjung
        $bataswaktu = time() - 300;
        $pengunjungonline = $visitorModel->getOnlineVisitors($bataswaktu); // Hitung pengunjung online

        $categoryCounts = $this->m_informasi_publik->getCategoryCounts(); // Chart
        $jenisCounts = $this->m_informasi_publik->getJenisCounts();
        // END WAJIB //

        $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_jenis = $this->m_jenis->getAllData();
        $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
        $tb_pengunjung = $this->m_pengunjung->getAllData();

        $m_nama_dinas = new InformasiPublikModel();
        $nama_dinas = $m_nama_dinas->getNamaDinas();

        $m_tahun = new \App\Models\InformasiPublikModel();
        $tahun_informasi_publik = $m_tahun->getAllData();

        $m_total_data = new InformasiPublikModel();
        $total_data = $m_total_data->countAllData();

        $kategoriCounts = $this->m_informasi_publik->getKategoriCounts();
        $totalKategori = $this->m_informasi_publik->getTotalKategori();

        $data = [
            'title' => 'Informasi Setiap Saat',
            'activePage' => 'informasisetiapsaat',
            // WAJIB //
            'tb_web_option' => $tb_web_option,
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'profil' => $this->m_web_option->getAll(1), // Ganti dengan ID sesuai kebutuhan
            'visimisi' => $this->m_web_option->getAll(2),
            'struktur' => $this->m_web_option->getAll(3),
            'tugas' => $this->m_web_option->getAll(4),
            'fungsi' => $this->m_web_option->getAll(5),
            'dasarhukum' => $this->m_web_option->getAll(6),
            'logo' => $path_logo, // 7
            'favicon' => $path_favicon,
            'email' => $email, // 9
            'alamat' => $alamat, // 10
            'cp1' => $cp1, // 11
            'cp2' => $cp2, // 12
            'categoryCounts' => $categoryCounts,
            'jenisCounts' => $jenisCounts,
            'sengketa' => $path_sengketa, // 13
            'penanganan' => $path_penanganan, // 14
            'biaya' => $this->m_web_option->getAll(15), // 15
            'maklumat' => $this->m_web_option->getAll(16), // 16
            // END WAJIB //

            'tb_informasi_publik' => $tb_informasi_publik,
            'tahun_informasi_publik' => $tahun_informasi_publik,
            'total_data' => $total_data,
            'slug_info_publik' => $slug_info_publik,
            'tb_lembaga' => $tb_lembaga,
            'tb_pengunjung' => $tb_pengunjung,
            'tb_jenis' => $tb_jenis,
            'nama_dinas' => $nama_dinas,

            'kategoriCounts' => $kategoriCounts,
            'totalKategori' => $totalKategori

        ];
        return view('user/informasipublik/informasisetiapsaat', $data);
    }

    public function informasidikecualikan()
    {
        // WAJIB //
        $tb_web_option = $this->m_web_option->getAll();
        $logo = $this->m_web_option->getAll(7);
        $path_logo = $logo ? $logo->path_file : null;
        $favicon = $this->m_web_option->getAll(8);
        $path_favicon = $favicon ? $favicon->path_file : null;
        $emailData = $this->m_web_option->getAll(9);
        $email = $emailData ? strip_tags($emailData->value, '<a>') : null;
        $alamatData = $this->m_web_option->getAll(10);
        $alamat = $alamatData ? strip_tags($alamatData->value, '<a>') : null;
        $cp1Data = $this->m_web_option->getAll(11);
        $cp1 = $cp1Data ? (object)[
            'value' => strip_tags($cp1Data->value, '<a>'),
            'name' => strip_tags($cp1Data->name)
        ] : null;
        $cp2Data = $this->m_web_option->getAll(12);
        $cp2 = $cp2Data ? (object)[
            'value' => strip_tags($cp2Data->value, '<a>'),
            'name' => strip_tags($cp2Data->name)
        ] : null;
        $sengketa = $this->m_web_option->getAll(13);
        $path_sengketa = $sengketa ? $sengketa->path_file : null;
        $penanganan = $this->m_web_option->getAll(14);
        $path_penanganan = $penanganan ? $penanganan->path_file : null;
        $visitorModel = new VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");
        $visitor = $visitorModel->getVisitorByIpAndDate($ip, $date);
        if ($visitor == null) {
            $visitorModel->insertVisitor([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert
            ]);
        } else {
            $visitorModel->updateVisitor($ip, $date, [
                'hits' => $visitor->hits + 1,
                'online' => $waktu
            ]);
        }
        $pengunjunghariini = $visitorModel->getTodayVisitors($date); // Hitung jumlah pengunjung hari ini
        $totalpengunjung = $visitorModel->getTotalVisitors(); // Hitung total pengunjung
        $bataswaktu = time() - 300;
        $pengunjungonline = $visitorModel->getOnlineVisitors($bataswaktu); // Hitung pengunjung online

        $categoryCounts = $this->m_informasi_publik->getCategoryCounts(); // Chart
        $jenisCounts = $this->m_informasi_publik->getJenisCounts();
        // END WAJIB //

        $tb_informasi_publik = $this->m_informasi_publik->getAllSorted();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_jenis = $this->m_jenis->getAllData();
        $slug_info_publik = $this->m_informasi_publik->getInformasiPublik();
        $tb_pengunjung = $this->m_pengunjung->getAllData();

        $m_nama_dinas = new InformasiPublikModel();
        $nama_dinas = $m_nama_dinas->getNamaDinas();

        $m_tahun = new \App\Models\InformasiPublikModel();
        $tahun_informasi_publik = $m_tahun->getAllData();

        $m_total_data = new InformasiPublikModel();
        $total_data = $m_total_data->countAllData();

        $kategoriCounts = $this->m_informasi_publik->getKategoriCounts();
        $totalKategori = $this->m_informasi_publik->getTotalKategori();

        $data = [
            'title' => 'Informasi Dikecualikan',
            'activePage' => 'informasidikecualikan',
            // WAJIB //
            'tb_web_option' => $tb_web_option,
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
            'profil' => $this->m_web_option->getAll(1), // Ganti dengan ID sesuai kebutuhan
            'visimisi' => $this->m_web_option->getAll(2),
            'struktur' => $this->m_web_option->getAll(3),
            'tugas' => $this->m_web_option->getAll(4),
            'fungsi' => $this->m_web_option->getAll(5),
            'dasarhukum' => $this->m_web_option->getAll(6),
            'logo' => $path_logo, // 7
            'favicon' => $path_favicon,
            'email' => $email, // 9
            'alamat' => $alamat, // 10
            'cp1' => $cp1, // 11
            'cp2' => $cp2, // 12
            'categoryCounts' => $categoryCounts,
            'jenisCounts' => $jenisCounts,
            'sengketa' => $path_sengketa, // 13
            'penanganan' => $path_penanganan, // 14
            'biaya' => $this->m_web_option->getAll(15), // 15
            'maklumat' => $this->m_web_option->getAll(16), // 16
            // END WAJIB //

            'tb_informasi_publik' => $tb_informasi_publik,
            'tahun_informasi_publik' => $tahun_informasi_publik,
            'total_data' => $total_data,
            'slug_info_publik' => $slug_info_publik,
            'tb_lembaga' => $tb_lembaga,
            'tb_pengunjung' => $tb_pengunjung,
            'tb_jenis' => $tb_jenis,
            'nama_dinas' => $nama_dinas,

            'kategoriCounts' => $kategoriCounts,
            'totalKategori' => $totalKategori
        ];
        return view('user/informasipublik/informasidikecualikan', $data);
    }

    public function download($id)
    {
        // Inisialisasi model
        $pengunjungModel = new PengunjungModel();

        // Cari data pengunjung berdasarkan ID
        $pengunjung = $pengunjungModel->find($id);

        if (!$pengunjung) {
            // Jika data pengunjung tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->to('/'); // Ganti dengan halaman lain jika perlu
        }

        // Ambil informasi publik atau laporan berdasarkan jenis unduhan
        $file = null;
        if ($pengunjung->id_informasi_publik) {
            $file = $pengunjungModel->getInformasiPublik($pengunjung->id_informasi_publik);
        } elseif ($pengunjung->id_laporan) {
            $file = $pengunjungModel->getLaporan($pengunjung->id_laporan);
        }

        if (!$file) {
            // Jika file tidak ditemukan, tampilkan pesan error atau redirect ke halaman lain
            return redirect()->to('/'); // Ganti dengan halaman lain jika perlu
        }

        // Buat array data untuk ditampilkan di template email
        $emailData = [
            'file' => $file
        ];

        // Buat tampilan email menggunakan template yang diinginkan
        $emailBody = view('Views/gmail/download_informasi_gmail.php', $emailData);

        // Proses pengiriman email
        $email = \Config\Services::email();

        // Konfigurasi email
        $email->setNewline("\r\n");
        $email->setMailType('html');
        $email->setTo($pengunjung->email_pengunjung);
        $email->setSubject('File Unduhan');
        $email->setMessage($emailBody);

        // Lampirkan file
        $email->attach(FCPATH . 'uploads/' . $file->nama_file);

        // Kirim email
        if ($email->send()) {
            // Jika email berhasil dikirim, kembalikan response atau tampilkan pesan sukses
            return redirect()->back()->with('success', 'File telah berhasil dikirim melalui email.');
        } else {
            // Jika terjadi kesalahan saat mengirim email, tampilkan pesan error
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }
}

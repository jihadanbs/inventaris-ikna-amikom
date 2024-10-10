<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebOptionModel;
use App\Models\CaraMendapatSalinanInformasiModel;
use App\Models\MendapatSalinanInformasiModel;
use App\Models\MemperolehInformasiModel;
use App\Models\KategoriModel;
use App\Models\LembagaModel;
use App\Models\PemohonModel;
use App\Models\AlasanModel;
use App\Models\KeberatanModel;
use App\Models\VisitorModel;
use App\Models\InformasiPublikModel;
use App\Models\SopModel;
use Config\Validation;

class StandarLayananController extends BaseController
{
    protected $validation;
    protected $m_web_option;
    protected $email;
    protected $m_mendapat;
    protected $m_cara;
    protected $m_memperoleh;
    protected $m_pemohon;
    protected $m_lembaga;
    protected $m_kategori;
    protected $m_alasan;
    protected $m_keberatan;
    protected $db;
    protected $m_sop;
    protected $m_informasi_publik;

    public function __construct()
    {

        $this->m_web_option = new WebOptionModel();
        $this->email = \Config\Services::email();
        $this->m_cara = new CaraMendapatSalinanInformasiModel();
        $this->m_mendapat = new MendapatSalinanInformasiModel();
        $this->m_memperoleh = new MemperolehInformasiModel();
        $this->m_pemohon = new PemohonModel();
        $this->m_lembaga = new LembagaModel();
        $this->m_kategori = new KategoriModel();
        $this->m_alasan = new AlasanModel();
        $this->m_keberatan = new KeberatanModel();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->m_sop = new SopModel();
    }

    public function getPemohon()
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

        $kode_permohonan = $this->request->getVar('kode_permohonan');
        $tb_pemohon = $this->m_pemohon->getAll_1($kode_permohonan);
        $data = [
            'title' => 'Pemohon',
            'activePage' => 'pemohon_table',
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
            'tb_pemohon' => $tb_pemohon
        ];
        // $model = new PemohonModel();
        // $data['tb_pemohon'] = $model->getAll_1($kode_permohonan);

        return view('user/standarlayanan/pemohon_table', $data);
    }

    public function getKeberatan()
    {
        $kode_keberatan = $this->request->getVar('keberatan');
        $keberatanModel = new KeberatanModel();
        $data['tb_keberatan'] = $keberatanModel->where('kode_keberatan', $kode_keberatan)->findAll();
        return view('user/standarlayanan/keberatan_table', $data);
    }

    public function getData()
    {
        $request = service('request');
        $option = $request->getPost('option');
        $output = '';

        if ($option == '1') {
            $kodePermohonan = $request->getPost('kode_permohonan');
            $model = new PemohonModel();
            $data = $model->where('kode_permohonan', $kodePermohonan)->findAll();
            if ($data) {
                foreach ($data as $row) {
                    $output .= '<p>Kode Permohonan: ' . $row->kode_permohonan . '</p>';
                    $output .= '<p>Nama Pemohon: ' . $row->nama_pemohon . '</p>';
                    // Tambahkan kolom lainnya sesuai kebutuhan
                }
            } else {
                $output .= '<p>Data tidak ditemukan</p>';
            }
        } else if ($option == '2') {
            $kodeKeberatan = $request->getPost('kode_keberatan');
            $model = new KeberatanModel();
            $data = $model->where('kode_keberatan', $kodeKeberatan)->findAll();
            if ($data) {
                foreach ($data as $row) {
                    $output .= '<p>Kode Keberatan: ' . $row->kode_keberatan . '</p>';
                    $output .= '<p>Nama: ' . $row->nama . '</p>';
                    // Tambahkan kolom lainnya sesuai kebutuhan
                }
            } else {
                $output .= '<p>Data tidak ditemukan</p>';
            }
        }

        return $this->response->setBody($output);
    }

    public function standarlayanan()
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

        $data = [
            'title' => 'Standar Layanan',
            'activePage' => 'standarlayanan',
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

        ];
        return view('user/standarlayanan/standarlayanan', $data);
    }

    public function formpermohonan()
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
        $permohonan = $this->m_web_option->getAll(17);
        $path_permohonan = $permohonan ? $permohonan->path_file : null;
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

        $tb_memperoleh = $this->m_memperoleh->getAllData();
        $tb_cara_mendapat_salinan_informasi = $this->m_cara->getAllData();
        $tb_mendapat = $this->m_mendapat->getAllData();
        $tb_lembaga = $this->m_lembaga->getAllData();
        $tb_pemohon = $this->m_pemohon->getAllSorted();
        $tb_kategori = $this->m_kategori->getAllData();
        $tb_pemohon = $this->m_pemohon->getAllSorted();

        $data = [
            'title' => 'Standar Layanan (Form Permohonan)',
            'activePage' => 'formpermohonan',
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
            'permohonan' => $path_permohonan, // 17
            // END WAJIB //

            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'tb_cara_mendapat_salinan_informasi' => $tb_cara_mendapat_salinan_informasi,
            'tb_mendapat' => $tb_mendapat,
            'tb_memperoleh' => $tb_memperoleh,
            'tb_pemohon' => $tb_pemohon,
            'tb_lembaga' => $tb_lembaga,
            'tb_kategori' => $tb_kategori,
        ];
        return view('user/standarlayanan/formpermohonan', $data);
    }

    public function formkeberatan()
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
        $keberatan = $this->m_web_option->getAll(18);
        $path_keberatan = $keberatan ? $keberatan->path_file : null;
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

        $tb_alasan = $this->m_alasan->getAllData();
        $tb_keberatan = $this->m_keberatan->getKeberatan();

        // Ambil data dari formulir
        $kode_permohonan = $this->request->getVar('kode_permohonan');
        $nik = $this->request->getVar('nik');

        // Panggil model untuk mendapatkan data
        $tb_pemohon = $this->m_pemohon->getByKodeAndNIK($kode_permohonan, $nik);

        $data = [
            'title' => 'Standar Layanan (Form Keberatan)',
            'activePage' => 'formkeberatan',
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
            'keberatan' => $path_keberatan, // 18
            // END WAJIB //

            'tb_keberatan' => $tb_keberatan,
            'tb_alasan' => $tb_alasan,
            'tb_pemohon' => $tb_pemohon,
        ];
        return view('user/standarlayanan/formkeberatan', $data);
    }

    public function cekstatus()
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

        // Ambil data dari formulir
        $kode_permohonan = $this->request->getVar('kode_permohonan');
        $tb_pemohon = $this->m_pemohon->getAll_1($kode_permohonan);

        $kode_keberatan = $this->request->getVar('keberatan');
        $tb_keberatan = $this->m_keberatan->findAll();

        $data = [
            'title' => 'Standar Layanan (Cek Status)',
            'activePage' => 'cekstatus',
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

            'tb_pemohon' => $tb_pemohon,
            'tb_keberatan' => $tb_keberatan
        ];
        return view('user/standarlayanan/cekstatus', $data);
    }

    public function sopppid()
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

        $tb_sop = $this->m_sop->getAllData();

        $data = [
            'title' => 'Standar Layanan (SOP PPID)',
            'activePage' => 'sopppid',
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

            'tb_sop' => $tb_sop
        ];
        return view('user/standarlayanan/sop', $data);
    }

    public function sengketa()
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
        $data = [
            'title' => 'Standar Layanan (Penyelesaian Sengketa)',
            'activePage' => 'sengketa',
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
        ];
        return view('user/standarlayanan/sengketa', $data);
    }

    public function penanganan()
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
        $data = [
            'title' => 'Standar Layanan (Penanganan Sengketa)',
            'activePage' => 'penanganan',
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
        ];
        return view('user/standarlayanan/penanganansengketa', $data);
    }

    public function biaya()
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
        $data = [
            'title' => 'Standar Layanan (Biaya Informasi)',
            'activePage' => 'biaya',
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
        ];
        return view('user/standarlayanan/biayalayanan', $data);
    }

    public function maklumat()
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
        $data = [
            'title' => 'Standar Layanan (Maklumat Informasi)',
            'activePage' => 'maklumat',
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
        ];
        return view('user/standarlayanan/maklumat', $data);
    }
}

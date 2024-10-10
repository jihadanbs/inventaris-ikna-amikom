<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebOptionModel;
use App\Models\VisitorModel;
use App\Models\InformasiPublikModel;
use App\Models\SliderModel;
use Config\Validation;

class ProfilController extends BaseController
{
    protected $validation;
    protected $m_web_option;
    protected $m_informasi_publik;
    protected $m_slider;

    public function __construct()
    {
        $this->m_web_option = new WebOptionModel();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->m_slider = new SliderModel();
    }

    public function profil()
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

        $tb_slider_beranda = $this->m_slider->getAllData();

        $data = [
            'title' => 'Profil',
            'activePage' => 'profil',
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

            'tb_slider_beranda' => $tb_slider_beranda,
        ];
        return view('user/profil', $data);
    }
}

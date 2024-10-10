<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitorModel;
use App\Models\WebOptionModel;
use CodeIgniter\Controller;

class VisitorController extends BaseController
{
    protected $validation;
    protected $m_web_option;

    public function __construct()
    {
        $this->m_web_option = new WebOptionModel();
    }

    public function index()
    {
        // Load model
        $visitorModel = new VisitorModel();

        // Ambil data pengunjung
        $visitorStats = $visitorModel->getVisitorStats();

        // Data default jika tidak ada data pengunjung
        if (!$visitorStats) {
            $visitorStats = [
                'visitors_today' => 0,
                'visitors_online' => 0
            ];
        }

        // Kirim data ke view
        $data = [
            'visitors_today' => $visitorStats['visitors_today'],
            'visitors_online' => $visitorStats['visitors_online']
        ];

        return view('layouts/footer', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\WebOptionModel;
use App\Models\PemohonModel;
use App\Models\InformasiPublikModel;
use App\Models\SliderModel;

class Home extends BaseController
{
    protected $validation;
    protected $m_web_option;
    protected $m_pemohon;
    protected $m_informasi_publik;
    protected $m_wilayah;
    protected $m_slider;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->m_web_option = new WebOptionModel();
        $this->m_pemohon = new PemohonModel();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->m_slider = new SliderModel();
    }

    public function index()
    {

        $data = [];


        return view('index', $data);
    }

    public function about()
    {


        $data = [];


        return view('about', $data);
    }

    public function service()
    {


        $data = [];


        return view('service', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\PemohonModel;
use App\Models\WebOptionModel;
use App\Models\FotoPengurusModel;
use App\Models\GaleriKegiatanModel;
use App\Models\InformasiPublikModel;

class Home extends BaseController
{
    protected $validation;
    protected $m_web_option;
    protected $m_pemohon;
    protected $m_informasi_publik;
    protected $m_wilayah;
    protected $m_slider;
    protected $db;
    protected $galeriKegiatanModel;

    protected $fotoPengurusModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->m_web_option = new WebOptionModel();
        $this->m_pemohon = new PemohonModel();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->galeriKegiatanModel = new GaleriKegiatanModel();
        $this->fotoPengurusModel = new FotoPengurusModel();
    }



    public function index($page = 1)
    {

        $perPage = 8; // Jumlah data per halaman
        $offset = ($page - 1) * $perPage;
        // Ambil data dari database
        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);


        // Kirim data ke view
        $data = [
            'title' => 'Galeri Kegiatan',
            'galeriKegiatan' => $galeriKegiatan,
            'pengurus' => $this->fotoPengurusModel->findAll(),
        ];


        return view('index', $data);
    }

    public function about()
    {


        $data = [];


        return view('about', $data);
    }

    public function service($page = 1)
    {
        $perPage = 8; // Jumlah data per halaman
        $offset = ($page - 1) * $perPage;

        // Ambil data dengan limit dan offset
        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);
        $totalData = $this->galeriKegiatanModel->countAll(); // Total data

        // Kirim data ke view
        $data = [
            'title' => 'Galeri Kegiatan',
            'galeriKegiatan' => $galeriKegiatan,
            'currentPage' => $page,
            'totalPages' => ceil($totalData / $perPage),
        ];

        return view('service', $data);
    }


    public function galeri($page = 1)
    {
        $perPage = 8; // Jumlah data per halaman
        $offset = ($page - 1) * $perPage;

        // Ambil data dengan limit dan offset
        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);
        $totalData = $this->galeriKegiatanModel->countAll();

        // Kirim data ke view
        $data = [
            'title' => 'Galeri Kegiatan',
            'galeriKegiatan' => $galeriKegiatan,
            'currentPage' => $page,
            'totalPages' => ceil($totalData / $perPage),
        ];

        return view('galeri', $data);
    }


    public function kontak()
    {


        $data = [];


        return view('kontak', $data);
    }
}

<?php

namespace App\Controllers;

class Home extends BaseController
{
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
    $faqModel = new \App\Models\FaqModel();
    $allFaqs = $faqModel->getAllSorted(); 
    $faqCount = count($allFaqs); 

    $data = [
        'faqs' => $allFaqs,
        'faqCount' => $faqCount 
    ];

    return view('kontak', $data);
}

    
    public function barang()
    {


        $data = [];


        return view('barang', $data);
    }
    public function barangdetail()
    {


        $data = [];


        return view('barang-detail', $data);
    }
}

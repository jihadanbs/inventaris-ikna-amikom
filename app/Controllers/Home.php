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
        $perPage = 8;
        $offset = ($page - 1) * $perPage;

        $galeriKegiatan = $this->galeriKegiatanModel->orderBy('tanggal_foto', 'DESC')->findAll($perPage, $offset);
        $totalData = $this->galeriKegiatanModel->countAll();

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
        $allFaqs = $this->m_faq->getAllSorted();
        $faqCount = count($allFaqs);

        $data = [
            'faqs' => $allFaqs,
            'faqCount' => $faqCount
        ];

        return view('kontak', $data);
    }

    public function barang()
    {
        $perPage = 12;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $perPage;

        $total = $this->m_pinjam_barang->countAllTampil();

        $pager = service('pager');
        $pager->setPath('barang');

        $data = [
            'tb_setting_pinjam_barang' => $this->m_pinjam_barang->getTampil($perPage, $offset),
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page
        ];

        $pager->makeLinks($page, $perPage, $total);

        return view('barang', $data);
    }

    public function barangdetail()
    {


        $data = [];


        return view('barang-detail', $data);
    }
}

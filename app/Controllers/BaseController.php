<?php

namespace App\Controllers;

// Baru
use App\Models\KategoriBarangModel;

// Models
use App\Models\UserModel;
use App\Models\AlasanModel;
use App\Models\PemohonModel;
use App\Models\KeberatanModel;
use App\Models\CaraMendapatSalinanInformasiModel;
use App\Models\FaqModel;
use App\Models\KategoriFaqModel;
use App\Models\FeedbackModel;
use App\Models\FotoModel;
use App\Models\FileFotoModel;
use App\Models\KategoriInformasiModel;
use App\Models\LembagaModel;
use App\Models\InformasiPublikModel;
use App\Models\JenisInformasiModel;
use App\Models\PengunjungModel;

use App\Models\LaporanModel;
use App\Models\LogoModel;
use App\Models\MemperolehInformasiModel;
use App\Models\MendapatSalinanInformasiModel;
use App\Models\VidioModel;
use App\Models\JabatanModel;
use App\Models\SliderModel;
use App\Models\SopModel;
use App\Models\WebOptionModel;
use App\Models\WilayahModel;

// Config
use Config\Services;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'number'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    /**
     * @return void
     */

    // Protected Properties
    protected $session;
    protected $validation;
    protected $email;
    protected $date;
    protected $db;

    // baru
    protected $m_kategori_barang;

    // Protected Inisialisasi Models
    protected $m_user;
    protected $m_alasan;
    protected $m_pemohon;
    protected $m_keberatan;
    protected $m_cara;
    protected $m_faq;
    protected $m_kategori_faq;
    protected $m_feedback;
    protected $m_foto;
    protected $m_file_foto;
    protected $m_kategori_informasi;
    protected $m_lembaga;
    protected $m_informasi_publik;
    protected $m_jenis;
    protected $m_pengunjung;

    protected $m_laporan;
    protected $m_logo;
    protected $m_memperoleh;
    protected $m_mendapat;
    protected $m_vidio;
    protected $m_jabatan;
    protected $m_slider;
    protected $m_sop;
    protected $m_web_option;
    protected $m_wilayah;

    // Protected Inisialisasi GmailSend
    protected $feedbackGmail;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Properties
        $this->session = session(); // inisialisasi properti session
        $this->validation = \Config\Services::validation(); // inisialisasi properti validation
        $this->email = \Config\Services::email(); // inisialisasi properti email
        $this->date = new \DateTime(); // inisialisasi properti date
        $this->db = \Config\Database::connect(); // inisialisasi properti db

        // Helper
        helper("upload_helper");

        // Baru
        $this->m_kategori_barang = new KategoriBarangModel();

        // Inisialisasi Models
        $this->m_user = new UserModel();
        $this->m_alasan = new AlasanModel();
        $this->m_pemohon = new PemohonModel();
        $this->m_keberatan = new KeberatanModel();
        $this->m_cara = new CaraMendapatSalinanInformasiModel();
        $this->m_faq = new FaqModel();
        $this->m_kategori_faq = new KategoriFaqModel();
        $this->m_feedback = new FeedbackModel();
        $this->m_foto = new FotoModel();
        $this->m_file_foto = new FileFotoModel();
        $this->m_kategori_informasi = new KategoriInformasiModel();
        $this->m_lembaga = new LembagaModel();
        $this->m_informasi_publik = new InformasiPublikModel();
        $this->m_jenis = new JenisInformasiModel();
        $this->m_pengunjung = new PengunjungModel();

        $this->m_laporan = new LaporanModel();
        $this->m_logo = new LogoModel();
        $this->m_memperoleh = new MemperolehInformasiModel();
        $this->m_mendapat = new MendapatSalinanInformasiModel();
        $this->m_vidio = new VidioModel();
        $this->m_jabatan = new JabatanModel();
        $this->m_slider = new SliderModel();
        $this->m_sop = new SopModel();
        $this->m_web_option = new WebOptionModel();
        $this->m_wilayah = new WilayahModel();
    }

    // cek sesi admin
    protected function checkSession()
    {
        if (!$this->session->has('islogin')) {
            return redirect()->to('authentication/login')->with('gagal', 'Anda belum login');
        }

        if (session()->get('id_jabatan') != 1) {
            return redirect()->to('authentication/login');
        }

        return true; // Jika sesi valid
    }

    // me-load data umum di admin
    protected function loadCommonData()
    {
        return [
            'tb_user' => $this->m_user->getAll(),
            'unreadCount' => $this->m_pemohon->countUnreadEntries(),
            'unread' => $this->m_pemohon->getUnreadEntries(),
            'unreadCount_keberatan' => $this->m_keberatan->countUnreadEntries(),
            'unread_keberatan' => $this->m_keberatan->getUnreadEntries(),
        ];
    }
}

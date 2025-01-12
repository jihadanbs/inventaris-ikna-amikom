<?php

namespace App\Controllers;

// Models
use App\Models\UserModel;
use App\Models\KondisiBarangModel;
use App\Models\KategoriBarangModel;
use App\Models\BarangModel;
use App\Models\BarangMasukModel;
use App\Models\BarangKeluarModel;
use App\Models\BarangBaruModel;
use App\Models\BarangBekasModel;
use App\Models\FileFotoBarangModel;
use App\Models\BarangRusakModel;
use App\Models\BarangBaikModel;
use App\Models\UserPeminjamModel;
use App\Models\FaqModel;
use App\Models\KategoriFaqModel;
use App\Models\FeedbackModel;
use App\Models\FotoModel;
use App\Models\FileFotoModel;
use App\Models\PengunjungModel;
use App\Models\LaporanModel;
use App\Models\VidioModel;
use App\Models\JabatanModel;
use App\Models\WebOptionModel;

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


    // Protected Inisialisasi Models
    protected $m_user;
    protected $m_kondisi_barang;
    protected $m_kategori_barang;
    protected $m_barang;
    protected $m_barang_masuk;
    protected $m_barang_keluar;
    protected $m_barang_baru;
    protected $m_barang_bekas;
    protected $m_file_foto_barang;
    protected $m_barang_rusak;
    protected $m_barang_baik;
    protected $m_user_peminjam;
    protected $m_cara;
    protected $m_faq;
    protected $m_kategori_faq;
    protected $m_feedback;
    protected $m_foto;
    protected $m_file_foto;
    protected $m_pengunjung;
    protected $m_laporan;
    protected $m_vidio;
    protected $m_jabatan;
    protected $m_sop;
    protected $m_web_option;

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
        helper("date_helper");

        // Inisialisasi Models
        $this->m_user = new UserModel();
        $this->m_kategori_barang = new KategoriBarangModel();
        $this->m_kondisi_barang = new KondisiBarangModel();
        $this->m_barang = new BarangModel();
        $this->m_barang_masuk = new BarangMasukModel();
        $this->m_barang_keluar = new BarangKeluarModel();
        $this->m_barang_baru = new BarangBaruModel();
        $this->m_barang_bekas = new BarangBekasModel();
        $this->m_file_foto_barang = new FileFotoBarangModel();
        $this->m_barang_rusak = new BarangRusakModel();
        $this->m_barang_baik = new BarangBaikModel();
        $this->m_faq = new FaqModel();
        $this->m_user_peminjam = new UserPeminjamModel();
        $this->m_kategori_faq = new KategoriFaqModel();
        $this->m_feedback = new FeedbackModel();
        $this->m_foto = new FotoModel();
        $this->m_file_foto = new FileFotoModel();
        $this->m_pengunjung = new PengunjungModel();
        $this->m_laporan = new LaporanModel();
        $this->m_vidio = new VidioModel();
        $this->m_jabatan = new JabatanModel();
        $this->m_web_option = new WebOptionModel();
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
    // protected function loadCommonData()
    // {
    //     return [
    //         'tb_user' => $this->m_user->getAll(),
    //         'unreadCount' => $this->m_pemohon->countUnreadEntries(),
    //         'unread' => $this->m_pemohon->getUnreadEntries(),
    //         'unreadCount_keberatan' => $this->m_keberatan->countUnreadEntries(),
    //         'unread_keberatan' => $this->m_keberatan->getUnreadEntries(),
    //     ];
    // }
}

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home/search', 'Home::search');
$routes->get('/statistik', 'Home::statistik');
$routes->get('/visitor', 'VisitorController::index', ['namespace' => 'App\Controllers']);
$routes->get('/pencarian', 'Home::pencarian');

$routes->get('/error404', 'Home::error');
$routes->get('/servererror', 'Home::servererror');

// USER //
$routes->get('profil', 'ProfilController::profil', ['namespace' => 'App\Controllers']);


/*=================================== STANDAR LAYANAN ====================================*/
$routes->get('/standarlayanan', 'StandarLayananController::standarlayanan', ['namespace' => 'App\Controllers']);
$routes->get('/formpermohonan', 'StandarLayananController::formpermohonan', ['namespace' => 'App\Controllers']);
$routes->get('/formkeberatan', 'StandarLayananController::formkeberatan', ['namespace' => 'App\Controllers']);
$routes->get('/cekstatus', 'StandarLayananController::cekstatus', ['namespace' => 'App\Controllers']);
$routes->get('/sopppid', 'StandarLayananController::sopppid', ['namespace' => 'App\Controllers']);
$routes->get('/sengketa', 'StandarLayananController::sengketa', ['namespace' => 'App\Controllers']);
$routes->get('/penanganan', 'StandarLayananController::penanganan', ['namespace' => 'App\Controllers']);
$routes->get('/biaya', 'StandarLayananController::biaya', ['namespace' => 'App\Controllers']);
$routes->get('/maklumat', 'StandarLayananController::maklumat', ['namespace' => 'App\Controllers']);
$routes->get('/StandarLayananController/getPemohon', 'StandarLayananController::getPemohon', ['namespace' => 'App\Controllers']);
$routes->get('/StandarLayananController/getKeberatan', 'StandarLayananController::getKeberatan', ['namespace' => 'App\Controllers']);
// $routes->post('/cekstatus/getData', 'StandarLayananController::getData', ['namespace' => 'App\Controllers']);
$routes->get('/getPemohon', 'StandarLayananController::getPemohon', ['namespace' => 'App\Controllers']);

/*=================================== INFORMASI PUBLIK ====================================*/
$routes->get('/informasipublik', 'InformasiPublikController::informasipublik', ['namespace' => 'App\Controllers']);
$routes->post('/informasipublik/download', 'InformasiPublikController::informasipublik/download', ['namespace' => 'App\Controllers']);
$routes->get('/informasiberkala', 'InformasiPublikController::informasiberkala', ['namespace' => 'App\Controllers']);
$routes->get('/informasisertamerta', 'InformasiPublikController::informasisertamerta', ['namespace' => 'App\Controllers']);
$routes->get('/informasisetiapsaat', 'InformasiPublikController::informasisetiapsaat', ['namespace' => 'App\Controllers']);
$routes->get('/informasidikecualikan', 'InformasiPublikController::informasidikecualikan', ['namespace' => 'App\Controllers']);

/*=================================== LAPORAN ====================================*/
$routes->get('/laporan', 'LaporanController::laporan', ['namespace' => 'App\Controllers']);
$routes->get('/pdf', 'PdfController::pdf', ['namespace' => 'App\Controllers']);

/*=================================== GALERI ====================================*/
$routes->get('/galeri', 'GaleriController::galeri', ['namespace' => 'App\Controllers']);
$routes->get('/foto', 'GaleriController::foto', ['namespace' => 'App\Controllers']);
$routes->get('/video', 'GaleriController::video', ['namespace' => 'App\Controllers']);

/*=================================== FAQ ====================================*/
$routes->get('/faq', 'FaqController::faq', ['namespace' => 'App\Controllers']);
// END USER //


//AUTHENTICATION
$routes->group('authentication', function ($routes) { //catatan : pastikan post / get 
    $routes->get('login', 'Authentication::login/$1');
    $routes->post('cekLogin', 'Authentication::cekLogin/$1');
    $routes->get('logout', 'Authentication::logout/$1');
    $routes->get('lupaPassword', 'Authentication::lupaPassword/$1');
    $routes->post('lupaPassword', 'Authentication::lupaPassword/$1');
    $routes->get('resetPassword', 'Authentication::resetPassword/$1');
    $routes->post('resetPassword', 'Authentication::resetPassword/$1');
});

//ROLE
$routes->get('dashboard', 'RoleController::index');
//ROLE ADMIN
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    /*=================================== DASHBOARD ====================================*/
    $routes->get('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);

    /*=================================== PROFILE ====================================*/
    $routes->get('profile', 'ProfileController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('profile', static function ($routes) {
        $routes->post('update/(:num)', 'ProfileController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('resetpassword', 'ProfileController::resetPassword', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('updateSandi/(:num)', 'ProfileController::updateSandi/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== LEMBAGA ====================================*/
    $routes->get('lembaga', 'LembagaController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('lembaga', static function ($routes) {
        $routes->post('save', 'LembagaController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('simpan_perubahan', 'LembagaController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->delete('delete', 'LembagaController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== JENIS INFORMASI ====================================*/
    $routes->get('jenis_informasi', 'JenisInformasiController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('jenis_informasi', static function ($routes) {
        $routes->post('save', 'JenisInformasiController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('simpan_perubahan', 'JenisInformasiController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'JenisInformasiController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== INFORMASI PUBLIK ====================================*/
    $routes->get('informasi_publik', 'InformasiPublikController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('informasi_publik', static function ($routes) {
        $routes->get('totalData', 'InformasiPublikController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('download/(:segment)', 'InformasiPublikController::download/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('tambah', 'InformasiPublikController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'InformasiPublikController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('kirim/(:segment)', 'InformasiPublikController::kirim/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'InformasiPublikController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'InformasiPublikController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'InformasiPublikController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'InformasiPublikController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete2', 'InformasiPublikController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'InformasiPublikController::delete', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('downloadFile/(:num)', 'InformasiPublikController::downloadFile/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== KATEGORI BARANG ====================================*/
    $routes->GET('kategori_barang', 'KategoriBarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('kategori_barang', static function ($routes) {
        $routes->POST('save', 'KategoriBarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('simpan_perubahan', 'KategoriBarangController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete/(:num)', 'KategoriBarangController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FOTO ====================================*/
    $routes->get('foto', 'FotoController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('foto', static function ($routes) {
        $routes->get('tambah', 'FotoController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'FotoController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'FotoController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('update/(:num)', 'FotoController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'FotoController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'FotoController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'FotoController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== KATEGORI FAQ ====================================*/
    $routes->GET('kategori_faq', 'KategoriFaqController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('kategori_faq', static function ($routes) {
        $routes->POST('save', 'KategoriFaqController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('simpan_perubahan', 'KategoriFaqController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'KategoriFaqController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FAQ ====================================*/
    $routes->GET('faq', 'FaqController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('faq', static function ($routes) {
        $routes->get('tambah', 'FaqController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'FaqController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'FaqController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'FaqController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'FaqController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'FaqController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'FaqController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== LAPORAN ====================================*/
    $routes->get('laporan', 'LaporanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('laporan', static function ($routes) {
        $routes->get('tambah', 'LaporanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'LaporanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'LaporanController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'LaporanController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'LaporanController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'LaporanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'LaporanController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('downloadFile/(:num)', 'LaporanController::downloadFile/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== WEB OPTION ====================================*/
    $routes->get('web_option', 'WebOptionController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('web_option', static function ($routes) {
        $routes->get('tambah', 'WebOptionController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'WebOptionController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'WebOptionController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'WebOptionController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'WebOptionController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'WebOptionController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'WebOptionController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FORM PERMOHONAN ====================================*/
    $routes->get('permohonan', 'PermohonanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('permohonan', static function ($routes) {
        $routes->post('kirim', 'PermohonanController::kirim', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('totalByStatus/(:any)', 'PermohonanController::totalByStatus/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('totalData', 'PermohonanController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('tambah', 'PermohonanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'PermohonanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'PermohonanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('diproses/(:segment)', 'PermohonanController::diproses/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('proses/(:num)', 'PermohonanController::proses/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('ditolak/(:segment)', 'PermohonanController::ditolak/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('reject/(:num)', 'PermohonanController::reject/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('diberikan/(:segment)', 'PermohonanController::diberikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('berikan/(:num)', 'PermohonanController::berikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete2', 'PermohonanController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'PermohonanController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FORM KEBERATAN ====================================*/
    $routes->get('keberatan', 'KeberatanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('keberatan', static function ($routes) {
        $routes->post('kirim', 'KeberatanController::kirim', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('totalByStatus/(:any)', 'KeberatanController::totalByStatus/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('totalData', 'KeberatanController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('tambah', 'KeberatanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'KeberatanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'KeberatanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('diproses/(:segment)', 'KeberatanController::diproses/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('proses/(:num)', 'KeberatanController::proses/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('ditolak/(:segment)', 'KeberatanController::ditolak/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('reject/(:num)', 'KeberatanController::reject/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('diberikan/(:segment)', 'KeberatanController::diberikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('berikan/(:num)', 'KeberatanController::berikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete2', 'KeberatanController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'KeberatanController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FEEDBACK ====================================*/
    $routes->get('feedback', 'FeedbackController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('feedback', static function ($routes) {
        $routes->post('send2', 'FeedbackController::send2', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('send', 'FeedbackController::send', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('tambah', 'FeedbackController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'FeedbackController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'FeedbackController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('balas/(:segment)', 'FeedbackController::balas/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('kirim/(:num)', 'FeedbackController::kirim/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete2', 'FeedbackController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'FeedbackController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== SOP ====================================*/
    $routes->get('sop', 'SopController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('sop', static function ($routes) {
        $routes->get('tambah', 'SopController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'SopController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'SopController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'SopController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('cek_judul', 'SopController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'SopController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'SopController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== WEBSITE WILAYAH ====================================*/
    $routes->get('website', 'WebsiteController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('website', static function ($routes) {
        $routes->get('tambah', 'WebsiteController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'WebsiteController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'WebsiteController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'WebsiteController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'WebsiteController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'WebsiteController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== SLIDER ====================================*/
    $routes->get('slider', 'SliderController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('slider', static function ($routes) {
        $routes->get('tambah', 'SliderController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('save', 'SliderController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('edit/(:segment)', 'SliderController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->put('update/(:num)', 'SliderController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->get('cek_data/(:segment)', 'SliderController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'SliderController::delete', ['namespace' => 'App\Controllers\Admin']);
    });
});

//ROLE STAFF
$routes->group('staff', ['namespace' => 'App\Controllers\Staff'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Staff']);
});

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['namespace' => 'App\Controllers']);
$routes->get('/about', 'Home::about', ['namespace' => 'App\Controllers']);
$routes->get('/service', 'Home::service', ['namespace' => 'App\Controllers']);

$routes->get('/error404', 'Home::error', ['namespace' => 'App\Controllers']);
$routes->get('/servererror', 'Home::servererror', ['namespace' => 'App\Controllers']);

// USER //
$routes->get('profil', 'ProfilController::profil', ['namespace' => 'App\Controllers']);

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
$routes->group('authentication', function ($routes) {
    $routes->get('login', 'Authentication::login', ['namespace' => 'App\Controllers']);
    $routes->post('cekLogin', 'Authentication::cekLogin', ['namespace' => 'App\Controllers']);
    $routes->get('logout', 'Authentication::logout', ['namespace' => 'App\Controllers']);
    $routes->get('lupaPassword', 'Authentication::lupaPassword', ['namespace' => 'App\Controllers']);
    $routes->post('lupaPassword', 'Authentication::lupaPassword', ['namespace' => 'App\Controllers']);
    $routes->get('resetPassword', 'Authentication::resetPassword', ['namespace' => 'App\Controllers']);
    $routes->post('resetPassword', 'Authentication::resetPassword', ['namespace' => 'App\Controllers']);
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

    /*=================================== JENIS INFORMASI ====================================*/
    $routes->get('jenis_informasi', 'JenisInformasiController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->group('jenis_informasi', static function ($routes) {
        $routes->post('save', 'JenisInformasiController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('simpan_perubahan', 'JenisInformasiController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->post('delete', 'JenisInformasiController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
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

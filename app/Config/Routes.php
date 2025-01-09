<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->GET('/', 'Home::index', ['namespace' => 'App\Controllers']);
$routes->GET('/about', 'Home::about', ['namespace' => 'App\Controllers']);
$routes->GET('/service', 'Home::service', ['namespace' => 'App\Controllers']);
$routes->GET('/kontak', 'Home::kontak', ['namespace' => 'App\Controllers']);

$routes->GET('/error404', 'Home::error', ['namespace' => 'App\Controllers']);
$routes->GET('/servererror', 'Home::servererror', ['namespace' => 'App\Controllers']);

// USER //
/*=================================== PROFIL ====================================*/
$routes->GET('profil', 'ProfilController::profil', ['namespace' => 'App\Controllers']);

/*=================================== LAPORAN ====================================*/
$routes->GET('/laporan', 'LaporanController::laporan', ['namespace' => 'App\Controllers']);
$routes->GET('/pdf', 'PdfController::pdf', ['namespace' => 'App\Controllers']);

/*=================================== GALERI ====================================*/
$routes->GET('/galeri', 'GaleriController::galeri', ['namespace' => 'App\Controllers']);
$routes->GET('/foto', 'GaleriController::foto', ['namespace' => 'App\Controllers']);
$routes->GET('/video', 'GaleriController::video', ['namespace' => 'App\Controllers']);

/*=================================== FAQ ====================================*/
$routes->GET('/faq', 'FaqController::faq', ['namespace' => 'App\Controllers']);
// END USER //


//AUTHENTICATION
$routes->GROUP('authentication', function ($routes) {
    $routes->GET('login', 'Authentication::login', ['namespace' => 'App\Controllers']);
    $routes->POST('cekLogin', 'Authentication::cekLogin', ['namespace' => 'App\Controllers']);
    $routes->GET('logout', 'Authentication::logout', ['namespace' => 'App\Controllers']);
    $routes->GET('lupaPassword', 'Authentication::lupaPassword', ['namespace' => 'App\Controllers']);
    $routes->POST('lupaPassword', 'Authentication::lupaPassword', ['namespace' => 'App\Controllers']);
    $routes->GET('resetPassword', 'Authentication::resetPassword', ['namespace' => 'App\Controllers']);
    $routes->POST('resetPassword', 'Authentication::resetPassword', ['namespace' => 'App\Controllers']);
});

//ROLE
$routes->GET('dashboard', 'RoleController::index');
//ROLE ADMIN
$routes->GROUP('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    /*=================================== DASHBOARD ====================================*/
    $routes->GET('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);

    /*=================================== PROFILE ====================================*/
    $routes->GET('profile', 'ProfileController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('profile', static function ($routes) {
        $routes->POST('update/(:num)', 'ProfileController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('resetpassword', 'ProfileController::resetPassword', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('updateSandi/(:num)', 'ProfileController::updateSandi/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== KATEGORI BARANG ====================================*/
    $routes->GET('kategori_barang', 'KategoriBarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('kategori_barang', static function ($routes) {
        $routes->POST('save', 'KategoriBarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('simpan_perubahan', 'KategoriBarangController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete/(:num)', 'KategoriBarangController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG ====================================*/
    $routes->GET('barang', 'BarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang', static function ($routes) {
        $routes->GET('tambah', 'BarangController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG BAIK ====================================*/
    $routes->GET('barang_baik', 'BarangBaikController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_baik', static function ($routes) {
        $routes->GET('tambah', 'BarangBaikController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangBaikController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangBaikController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangBaikController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangBaikController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangBaikController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangBaikController::delete', ['namespace' => 'App\Controllers\Admin']);
    });
    /*=================================== BARANG ====================================*/
    $routes->GET('user_peminjam', 'UserPeminjamController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('user_peminjam', static function ($routes) {
        $routes->GET('tambah', 'BarangController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangController::delete', ['namespace' => 'App\Controllers\Admin']);
    });
    /*=================================== BARANG RUSAK ====================================*/
    $routes->GET('barang_rusak', 'BarangRusakController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_rusak', static function ($routes) {
        $routes->GET('tambah', 'BarangRusakController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangRusakController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangRusakController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangRusakController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangRusakController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangRusakController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangRusakController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FOTO ====================================*/
    $routes->GET('foto', 'FotoController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('foto', static function ($routes) {
        $routes->GET('tambah', 'FotoController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'FotoController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'FotoController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('update/(:num)', 'FotoController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'FotoController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'FotoController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'FotoController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
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
        $routes->GET('tambah', 'FaqController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'FaqController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'FaqController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'FaqController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'FaqController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'FaqController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'FaqController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== LAPORAN ====================================*/
    $routes->GET('laporan', 'LaporanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('laporan', static function ($routes) {
        $routes->GET('tambah', 'LaporanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'LaporanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'LaporanController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'LaporanController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'LaporanController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'LaporanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'LaporanController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('downloadFile/(:num)', 'LaporanController::downloadFile/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== WEB OPTION ====================================*/
    $routes->GET('web_option', 'WebOptionController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('web_option', static function ($routes) {
        $routes->GET('tambah', 'WebOptionController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'WebOptionController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'WebOptionController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'WebOptionController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'WebOptionController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'WebOptionController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'WebOptionController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FEEDBACK ====================================*/
    $routes->GET('feedback', 'FeedbackController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('feedback', static function ($routes) {
        $routes->POST('send2', 'FeedbackController::send2', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('send', 'FeedbackController::send', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'FeedbackController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'FeedbackController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'FeedbackController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('balas/(:segment)', 'FeedbackController::balas/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('kirim/(:num)', 'FeedbackController::kirim/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete2', 'FeedbackController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'FeedbackController::delete', ['namespace' => 'App\Controllers\Admin']);
    });
});

//ROLE STAFF
$routes->GROUP('staff', ['namespace' => 'App\Controllers\Staff'], function ($routes) {
    $routes->GET('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Staff']);
});

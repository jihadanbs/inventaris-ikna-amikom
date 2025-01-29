<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->GET('/', 'Home::index', ['namespace' => 'App\Controllers']);
$routes->GET('/about', 'Home::about', ['namespace' => 'App\Controllers']);
$routes->GET('/service/(:num)', 'Home::service/$1', ['namespace' => 'App\Controllers']);
$routes->GET('/service', 'Home::service', ['namespace' => 'App\Controllers']);
$routes->GET('/galeri/(:num)', 'Home::galeri/$1', ['namespace' => 'App\Controllers']);
$routes->GET('/galeri', 'Home::galeri', ['namespace' => 'App\Controllers']);

$routes->GET('/kontak', 'Home::kontak', ['namespace' => 'App\Controllers']);
$routes->GET('/barang', 'Home::barang', ['namespace' => 'App\Controllers']);
$routes->GET('/barang-detail/(:segment)', 'Home::barangdetail/$1', ['namespace' => 'App\Controllers']);
$routes->POST('/ajukan', 'Home::ajukan', ['namespace' => 'App\Controllers']);
$routes->GET('/cek_barang', 'Home::cek_barang', ['namespace' => 'App\Controllers']);
$routes->GET('/cek_resi', 'Home::cek_resi', ['namespace' => 'App\Controllers']);
$routes->POST('/cek_resi', 'Home::cek_resi', ['namespace' => 'App\Controllers']);

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

    /*=================================== KONDISI BARANG ====================================*/
    $routes->GET('kondisi_barang', 'KondisiBarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('kondisi_barang', static function ($routes) {
        $routes->POST('save', 'KondisiBarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('simpan_perubahan', 'KondisiBarangController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete/(:num)', 'KondisiBarangController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG IKNA ====================================*/
    $routes->GET('barang', 'BarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang', static function ($routes) {
        $routes->POST('saveStok/(:num)', 'BarangController::saveStok/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah_stok/(:segment)', 'BarangController::tambahStok/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('totalData', 'BarangController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'BarangController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== TAMBAH STOCK BARANG IKNA ====================================*/
    $routes->GET('history_barang', 'HistoryBarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('history_barang', static function ($routes) {
        $routes->GET('tambah', 'HistoryBarangController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'HistoryBarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'HistoryBarangController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'HistoryBarangController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'HistoryBarangController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'HistoryBarangController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'HistoryBarangController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG MASUK ====================================*/
    $routes->GET('barang_masuk', 'BarangMasukController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_masuk', static function ($routes) {
        $routes->GET('tambah', 'BarangMasukController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangMasukController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangMasukController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangMasukController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangMasukController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangMasukController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangMasukController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG KELUAR ====================================*/
    $routes->GET('barang_keluar', 'BarangKeluarController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_keluar', static function ($routes) {
        $routes->GET('tambah', 'BarangKeluarController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangKeluarController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangKeluarController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangKeluarController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangKeluarController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangKeluarController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangKeluarController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG BARU ====================================*/
    $routes->GET('barang_baru', 'BarangBaruController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_baru', static function ($routes) {
        $routes->GET('tambah', 'BarangBaruController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangBaruController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangBaruController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangBaruController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangBaruController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangBaruController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangBaruController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG BEKAS ====================================*/
    $routes->GET('barang_bekas', 'BarangBekasController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_bekas', static function ($routes) {
        $routes->GET('tambah', 'BarangBekasController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BarangBekasController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BarangBekasController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangBekasController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BarangBekasController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'BarangBekasController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BarangBekasController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG KONDISI BAIK ====================================*/
    $routes->GET('barang_baik', 'BarangBaikController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_baik', static function ($routes) {
        $routes->GET('totalData', 'BarangBaikController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangBaikController::update/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BARANG KONDISI RUSAK ====================================*/
    $routes->GET('barang_rusak', 'BarangRusakController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('barang_rusak', static function ($routes) {
        $routes->GET('totalData', 'BarangRusakController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BarangRusakController::update/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== SETTING PINJAM BARANG ====================================*/
    $routes->GET('setting-pinjam-barang', 'PinjamBarangController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('setting-pinjam-barang', static function ($routes) {
        $routes->GET('tambah', 'PinjamBarangController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'PinjamBarangController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'PinjamBarangController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'PinjamBarangController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek-data/(:segment)', 'PinjamBarangController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('updateStatusTampil', 'PinjamBarangController::updateStatusTampil', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'PinjamBarangController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete/(:num)', 'PinjamBarangController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== USER PEMINJAM ====================================*/
    $routes->GET('user_peminjam', 'UserPeminjamController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('user_peminjam', static function ($routes) {
        $routes->GET('totalByStatus/(:any)', 'UserPeminjamController::totalByStatus/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'UserPeminjamController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'UserPeminjamController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'UserPeminjamController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'UserPeminjamController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'UserPeminjamController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'UserPeminjamController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'UserPeminjamController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== TRANSAKSI ====================================*/
    $routes->GET('transaksi', 'TransaksiController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('transaksi', static function ($routes) {
        $routes->GET('totalByStatus/(:any)', 'TransaksiController::totalByStatus/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('proses_dikembalikan/(:segment)', 'TransaksiController::proses_dikembalikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('dikembalikan/(:segment)', 'TransaksiController::dikembalikan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('proses_ditolak/(:segment)', 'TransaksiController::proses_ditolak/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('ditolak/(:segment)', 'TransaksiController::ditolak/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('proses_dipinjamkan/(:segment)', 'TransaksiController::proses_dipinjamkan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('dipinjamkan/(:segment)', 'TransaksiController::dipinjamkan/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'TransaksiController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'TransaksiController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'TransaksiController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'TransaksiController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'TransaksiController::delete', ['namespace' => 'App\Controllers\Admin']);
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

    /*=================================== FOTO PENGURUS =============================== */
    $routes->GET('foto-pengurus', 'FotoPengurusController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('foto-pengurus', static function ($routes) {
        $routes->GET('tambah', 'FotoPengurusController::create', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'FotoPengurusController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'FotoPengurusController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'FotoPengurusController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'FotoPengurusController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== GALERI KEGIATAN =============================== */
    $routes->GET('galeri-kegiatan', 'GaleriKegiatanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('galeri-kegiatan', static function ($routes) {
        $routes->GET('tambah', 'GaleriKegiatanController::create', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'GaleriKegiatanController::store', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'GaleriKegiatanController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'GaleriKegiatanController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'GaleriKegiatanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'GaleriKegiatanController::delete', ['namespace' => 'App\Controllers\Admin']);
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
});

//ROLE STAFF
$routes->GROUP('staff', ['namespace' => 'App\Controllers\Staff'], function ($routes) {
    $routes->GET('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Staff']);
});

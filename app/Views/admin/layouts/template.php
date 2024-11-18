<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/login/css/style.css') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/ikna.png') ?>">
    <!-- SweetAlert -->
    <link href="<?= base_url('assets/admin/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <!-- App Css-->
    <link href="<?= base_url('assets/admin/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

    <!-- SEO untuk Admin IKNAventory -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Admin IKNAventory</title>
    <meta name="keywords" content="Admin IKNA AMIKOM, Admin IKNAventory" />
    <meta http-equiv="Accept-CH" content="Sec-CH-UA-Platform-Version, Sec-CH-UA-Model" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('path/to/icon.ico'); ?>" />
    <link rel="amphtml" href="<?= base_url('amp/' . uri_string()); ?>">
    <link rel="canonical" href="<?= current_url(); ?>" />
    <meta property="og:site_name" content="Admin IKNAventory" />
    <meta property="og:title" content="Admin IKNAventory - Pengelolaan Inventaris IKNA AMIKOM Yogyakarta" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Admin IKNAventory adalah halaman untuk mengelola data inventaris IKNA AMIKOM Yogyakarta" />
    <meta property="og:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" />
    <meta itemprop="name" content="Admin IKNAventory - Pengelolaan Inventaris IKNA AMIKOM Yogyakarta" />
    <meta itemprop="url" content="<?= current_url(); ?>" />
    <meta itemprop="description" content="Admin IKNAventory adalah halaman untuk mengelola data inventaris IKNA AMIKOM Yogyakarta" />
    <meta itemprop="thumbnailUrl" content="<?= base_url('path/to/image.jpg'); ?>" />
    <link rel="image_src" href="<?= base_url('path/to/image.jpg'); ?>" />
    <meta itemprop="image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta name="twitter:title" content="Admin IKNAventory - Pengelolaan Inventaris IKNA AMIKOM Yogyakarta" />
    <meta name="twitter:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta name="twitter:url" content="<?= current_url(); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Admin IKNAventory adalah halaman untuk mengelola data inventaris IKNA AMIKOM Yogyakarta" />
    <meta name="description" content="Admin IKNAventory adalah halaman untuk mengelola data inventaris IKNA AMIKOM Yogyakarta" />
    <!-- End SEO untuk Admin IKNAventory -->

    <!-- Tag untuk mencegah indeks oleh mesin pencari -->
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">

    <!-- Keamanan dan Aksesibilitas Lanjutan -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; frame-src 'self' https://www.youtube.com;"> -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; 
    script-src 'self' 'unsafe-inline' 'unsafe-eval' cdn.ckeditor.com;
    style-src 'self' 'unsafe-inline' cdn.ckeditor.com;
    img-src 'self' data: cdn.ckeditor.com;
    frame-src 'self' https://www.youtube.com;
    connect-src https://pdf-converter.cke-cs.com;
    form-action 'self';"> -->
    <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=()">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta name="referrer" content="no-referrer">
    <!-- End SEO -->
</head>
<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>


<div class="label-page">
    <a href="<?= base_url('/sengketa') ?>" class="btn btn-warning">
        PENYELESAIAN SENGKETA
    </a>
</div>
<div class="label-page-2">
    <a href="<?= base_url('/penanganan') ?>" class="btn btn-warning">
        PENANGANAN SENGKETA
    </a>
</div>
<div class="label-page-3">
    <a href="<?= base_url('/sopppid') ?>" class="btn btn-warning">
        SOP
    </a>
</div>

<!-- hero Start -->
<section class="hero">
    <div class="hero_overlay"></div>
    <div id="particles-js">
        <img src="<?= base_url('assets/img/Peta Beranda.png') ?>" alt="" class="heroimg">
    </div>
    <div class="hero_content h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-100 align-items-center hero_content-width">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4" style="color: #f4d160; font-size: 40px;">PROFIL</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi dan Dokumentasi (PPID) <br><br> Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<!-- Carousel Img -->
<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade position-absolute imghero" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $active = 'active'; ?>
        <?php foreach ($tb_slider_beranda as $image) : ?>
            <div class="carousel-item <?= $active ?>">
                <img src="<?= base_url($image['gambar_slider']) ?>" class="d-block" style="border-radius: 20px; width: 500px; height: 300px;" alt="gambar Slider">
            </div>
            <?php $active = ''; // Hapus kelas 'active' setelah iterasi pertama 
            ?>
        <?php endforeach; ?>
    </div>
</div>
<!-- Carousel Img -->

<div class="container-fluid layanan pt-5 pb-5" data-aos="fade-up">
    <span class="badge" id="visimisi">
        <h5 class="mt-3 fw-bold">PROFIL PPID</h5>
    </span>
    <div class="container text-left fw-bold" style=" font-family: Poppins">
        <p class="mx-auto">
            <?= isset($profil->value)  ? $profil->value : '$Profile'; ?>
        </p>
    </div>
    <div class="container text-center position-relative" data-aos="fade-up">
        <span class="badge position-absolute start-50 translate-middle-x" style="top: -50px;">
            <h5 class="mt-3 fw-bold">VISI & MISI PPID</h5>
        </span>
        <span class="kotak d-flex justify-content-center align-items-center">
            <p style="text-align: left; padding-left:20px; margin-bottom: 30px"><br><br <?= isset($visimisi->value)  ? $visimisi->value : 'Data tidak ditemukan'; ?> <br></p>
        </span>
    </div>
</div>

<section class="struktur pt-5" id="struktur">
    <div class="container-fluid pt-3 pb-5" data-aos="fade-up">
        <span class="badge2">
            <h5 class="mt-3 fw-bold" style="padding-left: 14px; padding-top:12px;">STRUKTUR ORGANISASI PPID</h5>
        </span>
        <div class="container text-center">
            <p><br>
            <h3 style="color: black; text-shadow: 0px 1px 1px #8AC4D0;" class="fw-bold pb-5">STRUKTUR PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI<br>
                DI LINGKUNGAN PEMERINTAH KABUPATEN PESAWARAN</h3>
            </p>
            <?php if (isset($struktur->path_file) && !empty($struktur->path_file)) : ?>
                <img src="<?= base_url($struktur->path_file) ?>" alt="Struktur Organisasi" style="max-width: 100%; height: auto;">
            <?php else : ?>
                <p>$Gambar Struktur Organisasi</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="tugas pt-5 pb-3" id="tugasdanfungsi">
    <div class="container text-center position-relative" data-aos="fade-up">
        <span class="badge3 position-absolute translate-middle-x" style="top: -45px;" id="tugas">
            <h5 class="mt-3 fw-bold">TUGAS PPID</h5>
        </span>
        <span class="kotak2">
            <p><br><br>
                <?= isset($tugas->value)  ? $tugas->value : '$Tugas PPID'; ?><br><br>
            </p>
        </span>
    </div>
</section>

<section class="fungsi pb-5">
    <div class="container text-center position-relative" data-aos="fade-up">
        <span class="badge position-absolute start-50 translate-middle-x" style="top: -50px;">
            <h5 class="mt-3 fw-bold">FUNGSI PPID</h5>
        </span>
        <span class="kotak d-flex justify-content-center align-items-center">
            <p style="text-align: left; padding-left:20px; margin-bottom: 30px;"><br><br <?= isset($fungsi->value)  ? $fungsi->value : 'Data tidak ditemukan'; ?> <br>
            </p>
        </span>
    </div>
</section>

<section class=" dasarhukum" id="dasarhukum">
    <div class="container text-center position-relative" data-aos="fade-up" data-aos-delay="100">
        <span class="badge3 position-absolute start-50 translate-middle-x" style="top: -45px;">
            <h6 class="mt-3 fw-bold" style="padding-top:10px">DASAR HUKUM PPID</h6>
        </span>
        <span class="kotak2 d-flex justify-content-center align-items-center">
            <p class="mx-auto" style="text-align: left; padding-left:20px; margin-bottom: 30px"><br><br <?= isset($dasarhukum->value)  ? $dasarhukum->value : 'Data tidak ditemukan'; ?> </p>
        </span>
    </div>

</section>


<?= $this->endSection(''); ?>
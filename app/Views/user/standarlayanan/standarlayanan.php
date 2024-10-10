<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-120 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4 mt-5" style="color: #f4d160; font-size: 45px;">STANDAR LAYANAN</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<div class="container-fluid layanan pt-3 pb-5" id="layanan">
    <div class="container text-center">
        <div class="row pt-4">
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up">
                <a href="<?= base_url('/formpermohonan') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file fa-5x"></i>
                        <h5 class="my-5 mx-auto">Formulir Permohonan</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <a href="<?= base_url('/formkeberatan') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file-invoice fa-5x"></i>
                        <h5 class="my-5 mx-auto">Formulir Keberatan</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?= base_url('/cekstatus') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file-circle-check fa-5x"></i>
                        <h5 class="my-5 mx-auto">Cek Status Formulir</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <a href="<?= base_url('/sopppid') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file-lines fa-5x"></i>
                        <h5 class="my-5 mx-auto">SOP PPID</h5>
                    </span>
                </a>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up">
                <a href="<?= base_url('/sengketa') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-clipboard fa-5x"></i>
                        <h5 class="my-5 mx-auto">Prosedur Penyelesaian Sengketa</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <a href="<?= base_url('/penanganan') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-clipboard-list fa-5x"></i>
                        <h5 class="my-5 mx-auto">Prosedur Penanganan Sengketa</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?= base_url('/biaya') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file-invoice-dollar fa-5x"></i>
                        <h5 class="my-5 mx-auto">Biaya Layanan</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <a href="<?= base_url('/maklumat') ?>" class="text-decoration-none">
                    <span class="lingkaran">
                        <i class="fa-solid fa-file-pen fa-5x"></i>
                        <h5 class="my-5 mx-auto ps-3 pe-3">Maklumat Informasi Publik</h5>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>
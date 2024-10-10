<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- hero Start -->
<section class="hero">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-100 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4" style="color: #f4d160; font-size: 40px;">STATISTIK</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 25px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<div class="container mt-5 mb-5">
    <div class="card" style="border:0px;">
        <div class="card-header" style="background-color: white; border:0px;">
            <h4 class="card-title mb-3 fw-bold">Statistik Kategori Daftar Informasi Publik</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5 mb-5">
    <div class="card" style="border:0px;">
        <div class="card-header" style="background-color: white; border:0px;">
            <h4 class="card-title mb-3 fw-bold">Statistik Jenis Daftar Informasi Publik</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="chart">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>
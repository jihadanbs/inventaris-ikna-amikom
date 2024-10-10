<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<div class="container-fluid standarlayanan pb-3" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">Biaya Layanan</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4 class="fw-bold"> Biaya Layanan Informasi Publik </h4>
    </div>
</div>

<div class="container text-center position-relative">
    <span class="badge3 position-absolute start-50 translate-middle-x" style="top: -50px;">
        <h6 class="mt-3 fw-bold" style="font-size: 23px; padding-top:10px;">Biaya Layanan Informasi</h6>
    </span>
    <span class="kotak2 d-flex justify-content-center align-items-center">
        <p class="mx-auto" style="text-align: left; padding-left:20px; padding-right:20px;"><br><br>
            <?= isset($biaya->value)  ? $biaya->value : '$BiayaLayanan'; ?>
        </p>
    </span>
</div>


<?= $this->endSection(''); ?>
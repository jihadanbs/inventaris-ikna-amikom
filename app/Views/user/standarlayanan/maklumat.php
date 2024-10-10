<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<div class="container-fluid standarlayanan pb-3" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">Maklumat</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4 class="fw-bold"> Maklumat Informasi Publik </h4>
    </div>
</div>


<div class="container text-center position-relative">
    <span class="badge3 position-absolute translate-middle-x" style="top: -50px;">
        <h6 class="mt-3 fw-bold" style="font-size: 18px;">Dinas Komunikasi dan Informatika <br> Kabupaten Pesawaran</h6>
    </span>
    <span class="kotak2" style="display: flex; flex-direction: column;">
        <h4 class="fw-bold pt-5"> MAKLUMAT PELAYANAN </h4>
        <p><strong>
                <?= isset($maklumat->value)  ? $maklumat->value : '$MaklumatLayanan'; ?>
            </strong></p>
        <div class="d-flex justify-content-end">
            <div class="badge text-wrap" style="width: 350px; background-color:#f4d160; color:black;">
                Kepala Dinas<br>
                Komunikasi, Informatika, Statistik, dan Persandian<br>
                Kabupaten Pesawaran
                <br><br><br><br><br>
                JAYADI YASA, S.STP.,M.I.P<br>
                NIP. 19830113 200112 1 002
            </div>
        </div>
    </span>
</div>


<?= $this->endSection(''); ?>
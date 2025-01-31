<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<div class="container-fluid standarlayanan pb-5" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">Prosedur Penyelesaian Sengketa</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Prosedur Permohonan Penyelesaian Sengketa Informasi</h4>
        <div class="sop pt-3">
            <?php if (isset($sengketa) && !empty($sengketa)) : ?>
                <img src="<?= base_url($sengketa) ?>" alt="sengketa" />
            <?php else : ?>
                <p>Gambar Prosedur Permohonan Penyelesaian Sengketa Informasi</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(''); ?>
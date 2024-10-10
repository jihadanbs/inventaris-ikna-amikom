<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
    /* untuk menyembunyikan elemen dengan ID loadmodaldisabilitas di halaman ini */
    #loadmodaldisabilitas {
        display: none;
    }
</style>

<!-- hero Start -->
<section class="hero" style="height:100px;">
    <div class="hero_overlay2"></div>
</section>
<!-- hero end -->

<div class="container-fluid standarlayanan pb-5" style="padding-top: 20px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">SOP</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Standar Operasional Prosedur PPID Kab Pesawaran</h4>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table pt-3 pb-3 table-bordered dt-responsive w-100" style="border-color: #28527A;">
                        <thead class="table-bg">
                            <tr class="highlight text-center" style="color: white;">
                                <th>No</th>
                                <th>Nama SOP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tb_sop as $row) : ?>
                                <tr>
                                    <td data-field="id_sop" style="max-width: 5px" scope="row"><?= $i++; ?></td>
                                    <td data-field="judul_sop">
                                        <?php if ($row['file_sop']) : ?>
                                            <a href="<?= base_url("/pdf?pdf=" . urlencode(base_url($row['file_sop']))) ?>" style="color:#28527A; text-decoration:none;">
                                                <?= $row['judul_sop']; ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="javascript:void(0);" style="color:#F5004F; text-decoration:none;"><?= $row['judul_sop']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<?= $this->endSection(''); ?>
<?= $this->include('admin/layouts/script') ?>
<div class="col-md-12">

    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
        <?= $this->include('admin/layouts/navbar') ?>
        <?= $this->include('admin/layouts/sidebar') ?>
    </div>
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data FAQ</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data FAQ</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">FAQ IKNAventory</h3>
                    </div>

                    <div class="card-body">
                        <?= $this->include('alert/alert'); ?>
                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data FAQ</b></h4>
                            <?php if (!empty($tb_faq)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/ikna.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                    <th width="170px">Nama Kategori FAQ</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= $tb_faq['nama_kategori'] ?> </td>
                                </tr>
                                <tr>
                                    <th width="150px">Pertanyaan</th>
                                    <th class="text-center">:</th>
                                    <td><?= $tb_faq['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Jawaban</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= $tb_faq['jawaban'] ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= site_url('admin/faq'); ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= site_url('admin/faq/edit/' . $tb_faq['slug']); ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-edit"></i> Ubah Data
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>
<?= $this->include('admin/layouts/script2') ?>
</body>

</html>
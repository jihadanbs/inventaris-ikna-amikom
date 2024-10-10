<?= $this->include('admin/layouts/script') ?>
<style>
    .tabel-kanan {
        display: flex;
        margin-left: 20px;
    }
</style>
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vidio</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Publik</a></li>

                                    <li class="breadcrumb-item active">Formulir Cek Data</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">PPID Kab. Pesawaran</h3>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                <?= session()->getFlashdata('pesan') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('gagal')) : ?>
                            <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                <?= session()->getFlashdata('gagal') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Vidio</b></h4>
                            <?php if (!empty($tb_vidio)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= $tb_vidio->link_vidio; ?>" frameborder="0" allowfullscreen></iframe>
                                    </td>
                                </tr>
                                <div style="position: relative; left: 20px">
                                    <tr class="tabel-kanan">
                                        <th width="150px">Judul Vidio</th>
                                        <th width="30px" class="text-center">:</th>
                                        <td><?= $tb_vidio->judul_vidio ?? '' ?> </td>
                                    </tr>
                                    <tr class="tabel-kanan">
                                        <th width="150px">Deskripsi Vidio</th>
                                        <th width="30px" class="text-center">:</th>
                                        <td><?= $tb_vidio->deskripsi ?? '' ?></td>
                                    </tr>
                                    <tr class="tabel-kanan">
                                        <th width="150px">Tanggal Vidio</th>
                                        <th width="30px" class="text-center">:</th>
                                        <td><?= $tb_vidio->tanggal_vidio ?? '' ?></td>
                                    </tr>
                                </div>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <tbody>
                                <?php $no = 1;
                                foreach ($id_vidio as $key => $value) : ?>

                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/vidio" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/vidio/edit/<?= $value->slug ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
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
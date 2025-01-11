<?= $this->include('admin/layouts/script') ?>

<style>
    .tabel-kanan {
        display: flex;
        margin-left: 20px;
    }
    .gallery-image {
        max-width: 150px;
        max-height: 100px;
        margin-right: 10px;
        display: inline-block;
    }
</style>

<div class="col-md-12">
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Galeri Kegiatan</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Galeri Kegiatan</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Galeri Kegiatan</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <h4 class="text-center mb-3"><b>Formulir Cek Data Foto</b></h4>
                        <?php if (!empty($tb_kegiatan)) : ?>
    <?php foreach ($tb_kegiatan as $foto) : ?>
        <div class="row mb-3">
            <div class="col-md-4 text-center">
                <?php foreach (explode(', ', $foto['foto_kegiatan']) as $file) : ?>
                    <img src="<?= base_url($file); ?>" class="gallery-image" alt="Foto kegiatan">
                <?php endforeach; ?>
            </div>
            <div class="col-md-8">
                <p><strong>Judul Kegiatan:</strong> <?= $foto['judul_kegiatan'] ?? '' ?></p>
                <p><strong>Tanggal Upload:</strong> <?= $foto['tanggal_foto'] ?? '' ?></p>
                <p><strong>Deskripsi:</strong> <?= $foto['deskripsi'] ?? '' ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p class="text-center text-muted">Data tidak ditemukan.</p>
<?php endif; ?>



                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width=50px>NO</th>
                                    <th>Dokumen</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($tb_kegiatan as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td><?= $value['judul_kegiatan'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url($value['foto_kegiatan']); ?>" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Lihat File
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/galeri-kegiatan" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/galeri-kegiatan/edit/<?= $value['id_kegiatan'] ?>" class="btn btn-warning btn-md edit">
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

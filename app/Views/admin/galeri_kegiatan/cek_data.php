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
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/galeri-kegiatan') ?>">Galeri Kegiatan</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Galeri Kegiatan</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">IKNA AMIKOM YOGYAKARTA</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Kegiatan</b></h4>
                            <?php if (!empty($tb_kegiatan)) : ?>
                                <?php foreach ($tb_kegiatan as $foto) : ?>
                                    <tr>
                                        <td rowspan="1" width="250px" class="text-center">
                                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php foreach (explode(', ', $foto['foto_kegiatan']) as $file) : ?>
                                                        <img src="<?= base_url($file); ?>" class="gallery-image" alt="Foto kegiatan" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </td>

                                        <td style=" padding-left: 50px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="fw-bold text-black">Judul Kegiatan</label>
                                                </div>
                                                <div class="col-auto">:</div>
                                                <div class="col-md-8">
                                                    <p><?= esc($foto['judul_kegiatan'] ?? '', 'html'); ?></p>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="fw-bold text-black">Tanggal Kegiatan</label>
                                                </div>
                                                <div class="col-auto">:</div>
                                                <div class="col-md-8">
                                                    <p><?= formatTanggalIndo($foto['tanggal_foto'] ?? '', 'html'); ?></p>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="fw-bold text-black">Deskripsi</label>
                                                </div>
                                                <div class="col-auto">:</div>
                                                <div class="col-md-8">
                                                    <p><?= esc($foto['deskripsi'] ?? '', 'html'); ?></p>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-center text-muted">Data tidak ditemukan</p>
                            <?php endif; ?>
                        </table>

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
                                            <button type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?= $value['id_kegiatan']; ?>"
                                                class="btn btn-info btn-sm view">
                                                <i class="fas fa-eye"></i> View File
                                            </button>
                                        </td>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $value['id_kegiatan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $value['id_kegiatan']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?= $value['id_kegiatan']; ?>"><?= $value['judul_kegiatan']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <!-- Cek apakah file adalah gambar -->
                                                        <?php if (in_array(pathinfo($value['foto_kegiatan'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) : ?>
                                                            <img src="<?= base_url($value['foto_kegiatan']); ?>"
                                                                alt="Preview Foto"
                                                                class="img-fluid"
                                                                style="max-height: 500px;">
                                                        <?php else : ?>
                                                            <p>File ini bukan gambar. <a href="<?= base_url($value['foto_kegiatan']); ?>" target="_blank">Unduh file di sini</a>.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <a href="<?= base_url($value['foto_kegiatan']); ?>"
                                                            class="btn btn-primary"
                                                            download="<?= basename($value['foto_kegiatan']); ?>">Download File</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= site_url('admin/galeri-kegiatan'); ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= site_url('admin/galeri-kegiatan/edit/' . $value['judul_kegiatan']); ?>" class="btn btn-warning btn-md edit">
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
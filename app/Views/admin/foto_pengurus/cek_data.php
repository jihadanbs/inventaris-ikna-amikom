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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Foto</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Foto</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data Foto</li>
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

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Foto</b></h4>
                            <?php if (!empty($tb_foto)) : ?>
                                <?php foreach ($tb_foto as $key => $foto) : ?>
                                    <tr>
                                        <td rowspan="<?= count($tb_foto) ?>" width="250px" class="text-center">
                                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="text-align: center;">
                                                <div class="carousel-inner">
                                                    <?php foreach (explode(', ', $foto['file_foto']) as $index => $file) : ?>
                                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                            <img src="<?= base_url($file); ?>" class="d-block mx-auto file_foto" alt="..." style="max-width: 150px; max-height: 100px;">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="background-color: black; border-radius: 10px;">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="background-color: black; border-radius: 10px;">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold text-black">Judul Foto :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <p><?= $foto['judul_foto'] ?? '' ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold text-black">Tanggal Upload Foto :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <p><?= $foto['tanggal_foto'] ?? '' ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold text-black">Deskripsi :</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <p><?= $foto['deskripsi'] ?? '' ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
                                foreach ($tb_foto as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td><?= $value['judul_foto'] ?></td>
                                        <td class="text-center">
                                            <?php if ($value['file_foto']) : ?>
                                                <button type="button" class="btn btn-info btn-sm view" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['id_foto'] ?>">
                                                    <i class="fas fa-eye"></i> View File
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= $value['id_foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $value['id_foto'] ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div id="carouselExampleControls<?= $value['id_foto'] ?>" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <?php foreach (explode(', ', $value['file_foto']) as $index => $file) : ?>
                                                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                                <img src="<?= base_url($file); ?>" class="d-block w-100" alt="..." style="max-width: 800px; max-height: 600px; margin: 0 auto;">
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $value['id_foto'] ?>" data-bs-slide="prev" style="background-color: black; border-radius: 10px;">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $value['id_foto'] ?>" data-bs-slide="next" style="background-color: black; border-radius: 10px;">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/foto" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/foto/edit/<?= $value['slug'] ?>" class="btn btn-warning btn-md edit">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousels = document.querySelectorAll('.carousel');
        carousels.forEach(function(carousel) {
            new bootstrap.Carousel(carousel);
        });
    });
</script>


</body>



</html>
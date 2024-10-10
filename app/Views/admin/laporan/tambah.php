<?= $this->include('admin/layouts/script') ?>

<!-- saya nonaktifkan agar agar side bar tidak dapat di klik sembarangan -->
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Laporan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Laporan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">

                <div class="col-10">
                    <div class="card border border-secondary rounded p-4">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Formulir Tambah Data Laporan</h2>

                            <form action="/admin/laporan/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="judul_laporan" class="col-form-label">Judul Laporan :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('judul_laporan')) ? 'is-invalid' : ''; ?>" required name="judul_laporan" placeholder="Masukkan Judul Laporan" id="judul_laporan" cols="30" rows="5" style="background-color: white;"><?php echo old('judul_laporan'); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('judul_laporan'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_file" class="col-form-label">Tanggal File :</label>
                                    <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_file')) ? 'is-invalid' : ''; ?>" required name="tanggal_file" id="tanggal_file" cols="30" rows="10" style="background-color: white;"><?php echo old('tanggal_file'); ?></input>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_file'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_laporan" class="col-form-label">File :</label>
                                    <input type="file" accept="application/pdf" class="form-control custom-border" id="file_laporan" name="file_laporan" style="background-color: white;" <?= (old('file_laporan')) ? 'disabled' : 'required'; ?>>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/laporan" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Tambah</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('admin/layouts/footer') ?>
<!-- end main content-->

<?= $this->include('admin/layouts/script2') ?>
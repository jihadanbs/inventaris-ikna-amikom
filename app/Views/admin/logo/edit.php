<?= $this->include('admin/layouts/script') ?>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Logo</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Logo</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Logo</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Logo</h2>
                            <form action="/admin/logo/update/<?= $tb_logo['id_logo']; ?>" method="post" enctype="multipart/form-data" id="validationForm" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>
                                <input type="hidden" name="gambar_logo" value="<?= $tb_logo['gambar_logo']; ?>">

                                <div class="mb-3">
                                    <label for="gambar_logo" class="col-form-label">File :</label>
                                    <input type="file" accept="image/*" class="form-control" id="gambar_logo" name="gambar_logo" style="background-color: white;">
                                    <div class="invalid-feedback">
                                        Kolom File Tidak Boleh Kosong
                                    </div>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_logo['gambar_logo'])) : ?>
                                        <p>File exists: <?= $tb_logo['gambar_logo'] ?></p>
                                        <img src="<?= base_url($tb_logo['gambar_logo']); ?>" alt="Preview" class="gambar_logo" style="width: 100px; height: 100px;">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/logo" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary ">Ubah Data</button>
                                    </div>
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
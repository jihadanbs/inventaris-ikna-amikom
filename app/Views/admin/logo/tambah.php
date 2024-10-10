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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Logo</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Logo</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Logo</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Logo</h2>

                            <form action="/admin/logo/save" method="post" enctype="multipart/form-data" id="validationForm" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="gambar_logo" class="col-form-label">Gambar Logo :</label>
                                    <input type="file" accept="image/*" class="form-control custom-border" id="gambar_logo" name="gambar_logo" style="background-color: white;" <?= (old('gambar_logo')) ? 'disabled' : 'required'; ?>>
                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback" id="fileError">
                                        Kolom Upload Logo Tidak Boleh Kosong
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <a href="/admin/logo" class="btn btn-secondary btn-md ml-3">
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
<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Vidio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vidio</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Vidio</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Vidio</h2>

                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> -
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="/admin/vidio/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="judul_vidio" class="col-form-label">Judul Vidio :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('judul_vidio')) ? 'is-invalid' : ''; ?>" id="judul_vidio" required name="judul_vidio" placeholder="Masukkan Judul Vidio" style="background-color: white;" autofocus value="<?= old('judul_vidio'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('judul_vidio'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="link_vidio" class="col-form-label">Link Vidio :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('link_vidio')) ? 'is-invalid' : ''; ?>" id="link_vidio" required name="link_vidio" placeholder="Masukkan Link Vidio" style="background-color: white;" autofocus value="<?= old('link_vidio'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('link_vidio'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" required name="deskripsi" placeholder="Masukkan Deskripsi" id="deskripsi" cols="30" rows="10" style="background-color: white;"><?php echo old('deskripsi'); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_vidio" class="col-form-label">Tanggal Upload Vidio :</label>
                                    <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_vidio')) ? 'is-invalid' : ''; ?>" required name="tanggal_vidio" id="tanggal_vidio" value="<?= old('tanggal_vidio'); ?>" style="background-color: white;"></input>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_vidio'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/vidio" class="btn btn-secondary btn-md ml-3">
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
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Form Feedback Pengunjung</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Feedback Pengunjung</h2>

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

                            <form action="/admin/feedback/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" value="<?= old('nama'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="col-form-label">Email :</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" value="<?= old('email'); ?>">
                                            <small class="form-text text-muted">Pastikan Email Anda Aktif Untuk Mempermudah Proses Kami Memberi Tanggapan</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="subjek" class="col-form-label">Subjek :</label>
                                        <div class="col-sm-12">
                                            <input type="subjek" class="form-control <?= ($validation->hasError('subjek')) ? 'is-invalid' : ''; ?>" id="subjek" name="subjek" placeholder="Masukkan Subjek Kendala Anda" style="background-color: white;" value="<?= old('subjek'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('subjek'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon :</label>
                                        <div class="col-sm-12">
                                            <input type="no_telepon" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Aktif Anda" style="background-color: white;" value="<?= old('no_telepon'); ?>">
                                            <small class="form-text text-muted">Pastikan Nomor Telepon Anda Aktif (Bisa No HP / Whatsapp)</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telepon'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pesan" class="col-form-label">Isi Pesan :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('pesan')) ? 'is-invalid' : ''; ?>" required name="pesan" placeholder="Masukkan Isi Pesan Anda" id="pesan" cols="30" rows="5" style="background-color: white;"><?php echo old('pesan'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pesan'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/feedback" class="btn btn-secondary btn-md ml-3">
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
<?= $this->include('admin/layouts/script') ?>
<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Foto</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Foto</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Foto</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Foto</h2>
                            <form action="<?= site_url('admin/galeri-kegiatan/update/' . $kegiatan['id_kegiatan']); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="old_foto_kegiatan" value="<?= $kegiatan['foto_kegiatan']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="judul_kegiatan" class="col-form-label">Judul Kegiatan<span style="color: red;">*</span></label>
                                        <input type="text" style="background-color: #fff;" class="form-control <?= session('errors.judul_kegiatan') ? 'is-invalid' : ''; ?>" id="judul_kegiatan" name="judul_kegiatan" value="<?= old('judul_kegiatan', $kegiatan['judul_kegiatan']); ?>" placeholder="Masukkan Judul Kegiatan">
                                        <?php if (session('errors.judul_kegiatan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.judul_kegiatan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_foto" class="col-form-label">Tanggal Foto<span style="color: red;">*</span></label>
                                        <input type="date" style="background-color: #fff;" class="form-control <?= session('errors.tanggal_foto') ? 'is-invalid' : ''; ?>" id="tanggal_foto" name="tanggal_foto" value="<?= old('tanggal_foto', $kegiatan['tanggal_foto']); ?>">
                                        <?php if (session('errors.tanggal_foto')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tanggal_foto') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi<span style="color: red;">*</span></label>
                                    <textarea style="background-color: #fff;" class="form-control <?= session('errors.deskripsi') ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" rows="5"><?= old('deskripsi', $kegiatan['deskripsi']); ?></textarea>
                                    <?php if (session('errors.deskripsi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.deskripsi') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="foto_kegiatan" class="col-form-label">Foto Kegiatan<span style="color: red;">*</span></label>
                                    <?php if ($kegiatan['foto_kegiatan']): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url($kegiatan['foto_kegiatan']); ?>" alt="Foto Kegiatan" class="img-thumbnail img-preview" style="max-width: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" style="background-color: #fff;" class="form-control <?= session('errors.foto_kegiatan') ? 'is-invalid' : ''; ?>" id="foto_kegiatan" name="foto_kegiatan" accept="image/*" onchange="previewImg()">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
                                    <?php if (session('errors.foto_kegiatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.foto_kegiatan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <script>
                                    function previewImg() {
                                        const foto = document.querySelector('#foto_kegiatan');
                                        const imgPreview = document.querySelector('.img-preview');

                                        const fileFoto = new FileReader();
                                        fileFoto.readAsDataURL(foto.files[0]);

                                        fileFoto.onload = function(e) {
                                            imgPreview.src = e.target.result;
                                        }
                                    }
                                </script>

                                <div class="form-group mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= site_url('admin/galeri-kegiatan/cek_data/' . $kegiatan['judul_kegiatan']); ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Batal Ubah</a>
                                        <button type="submit" class="btn btn-warning btn-md edit"><i class="fas fa-save"></i> Simpan Perubahan Data</button>
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
<?= $this->include('admin/layouts/script2') ?>
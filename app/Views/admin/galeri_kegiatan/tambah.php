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
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Kegiatan</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin/galeri-kegiatan">Galeri Kegiatan</a></li>
                                <li class="breadcrumb-item active">Tambah Data</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card border border-secondary rounded p-4">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Formulir Tambah Data Kegiatan</h2>
                            <form action="/admin/galeri-kegiatan/save" method="post" enctype="multipart/form-data" novalidate>
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="judul_kegiatan" class="form-label">Judul Kegiatan:</label>
                                    <input type="text" name="judul_kegiatan" id="judul_kegiatan" 
                                           class="form-control <?= isset($errors['judul_kegiatan']) ? 'is-invalid' : '' ?>" 
                                           value="<?= old('judul_kegiatan') ?>" placeholder="Masukkan Judul Kegiatan">
                                    <?php if (isset($errors['judul_kegiatan'])): ?>
                                        <div class="invalid-feedback"><?= $errors['judul_kegiatan'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="foto_kegiatan" class="form-label">Foto Kegiatan:</label>
                                    <input type="file" name="foto_kegiatan" id="foto_kegiatan" 
                                           class="form-control <?= isset($errors['foto_kegiatan']) ? 'is-invalid' : '' ?>" 
                                           accept="image/*">
                                    <?php if (isset($errors['foto_kegiatan'])): ?>
                                        <div class="invalid-feedback"><?= $errors['foto_kegiatan'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_foto" class="form-label">Tanggal Kegiatan:</label>
                                    <input type="date" name="tanggal_foto" id="tanggal_foto" 
                                           class="form-control <?= isset($errors['tanggal_foto']) ? 'is-invalid' : '' ?>" 
                                           value="<?= old('tanggal_foto') ?>">
                                    <?php if (isset($errors['tanggal_foto'])): ?>
                                        <div class="invalid-feedback"><?= $errors['tanggal_foto'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi:</label>
                                    <textarea name="deskripsi" id="deskripsi" 
                                              class="form-control <?= isset($errors['deskripsi']) ? 'is-invalid' : '' ?>" 
                                              rows="5"><?= old('deskripsi') ?></textarea>
                                    <?php if (isset($errors['deskripsi'])): ?>
                                        <div class="invalid-feedback"><?= $errors['deskripsi'] ?></div>
                                    <?php endif ?>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/galeri-kegiatan" class="btn btn-secondary me-3">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- Menambahkan script untuk menangani multiple file uploads -->
<script>
    document.getElementById('file_foto').addEventListener('change', function(event) {
        var files = event.target.files;
        var fileError = document.getElementById('fileError');

        if (files.length === 0) {
            fileError.style.display = 'block';
            event.target.classList.add('is-invalid');
        } else {
            fileError.style.display = 'none';
            event.target.classList.remove('is-invalid');
        }
    });
</script>
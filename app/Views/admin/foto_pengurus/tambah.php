<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>


<!-- Sidebar dinonaktifkan untuk mencegah interaksi -->
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Pengurus</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pengurus</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Pengurus</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Pengurus</h2>
                            <form action="/admin/foto-pengurus/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                                        id="nama" name="nama" value="<?= old('nama') ?>">
                                    <?php if (session('errors.nama')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.nama') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <!-- Foto -->
                                <div class="mb-3">
                                    <label for="foto" class="col-form-label">Foto:</label>
                                    <input type="file" class="form-control <?= session('errors.foto') ? 'is-invalid' : '' ?>"
                                        id="foto" name="foto" accept="image/*" onchange="previewImg()">
                                    <?php if (session('errors.foto')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.foto') ?>
                                        </div>
                                    <?php endif ?>
                                    <!-- Image Preview -->
                                    <div class="mt-2">
                                        <img src="/img/default.jpg" class="img-thumbnail img-preview" width="200px">
                                    </div>
                                </div>

                                <!-- Posisi -->
                                <div class="mb-3">
                                    <label for="posisi" class="col-form-label">Posisi:</label>
                                    <input type="text" class="form-control <?= session('errors.posisi') ? 'is-invalid' : '' ?>"
                                        id="posisi" name="posisi" value="<?= old('posisi') ?>">
                                    <?php if (session('errors.posisi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.posisi') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <!-- Divisi -->
                                <div class="mb-3">
                                    <label for="divisi" class="col-form-label">Divisi:</label>
                                    <select class="form-control <?= session('errors.divisi') ? 'is-invalid' : '' ?>"
                                        id="divisi" name="divisi">
                                        <option value="">-- Pilih Divisi --</option>
                                        <option value="BPH" <?= (old('divisi') == 'BPH') ? 'selected' : ''; ?>>BPH</option>
                                        <option value="Kerohanian" <?= (old('divisi') == 'Kerohanian') ? 'selected' : ''; ?>>Kerohanian</option>
                                        <option value="Kerumahtanggaan" <?= (old('divisi') == 'Kerumahtanggaan') ? 'selected' : ''; ?>>Kerumahtanggaan</option>
                                        <option value="Humas" <?= (old('divisi') == 'Humas') ? 'selected' : ''; ?>>Humas</option>
                                        <option value="Talenta Olahraga" <?= (old('divisi') == 'Talenta Olahraga') ? 'selected' : ''; ?>>Talenta Olahraga</option>
                                        <option value="Talenta Musik" <?= (old('divisi') == 'Talenta Musik') ? 'selected' : ''; ?>>Talenta Musik</option>
                                        <option value="Talenta Pertunjukan" <?= (old('divisi') == 'Talenta Pertunjukan') ? 'selected' : ''; ?>>Talenta Pertunjukan</option>
                                        <option value="Usaha Dana" <?= (old('divisi') == 'Usaha Dana') ? 'selected' : ''; ?>>Usaha Dana</option>
                                        <option value="Litbang" <?= (old('divisi') == 'Litbang') ? 'selected' : ''; ?>>Litbang</option>
                                    </select>
                                    <?php if (session('errors.divisi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.divisi') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="modal-footer">
                                    <a href="/admin/foto-pengurus" class="btn btn-secondary btn-md ml-3">
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

<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->include('admin/layouts/footer') ?>
<?= $this->include('admin/layouts/script2') ?>
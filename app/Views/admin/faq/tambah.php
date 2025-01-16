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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data FAQ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data FAQ</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data FAQ</h2>

                            <form action="<?= site_url('admin/faq/save'); ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= $this->include('alert/alert'); ?>
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="id_kategori_faq" class="col-form-label">Nama Kategori FAQ</label><span style="color: red;">*</span>
                                    <select class="form-select custom-border <?= session('errors.id_kategori_faq') ? 'is-invalid' : ''; ?>" id=" id_kategori_faq" name="id_kategori_faq" aria-label="Default select example" style="background-color: white;" required>
                                        <option value="" selected disabled>~ Silahkan Pilih Nama Kategori FAQ ~</option>
                                        <!-- Populasi opsi dropdown dengan data dari controller -->
                                        <?php foreach ($tb_kategori_faq as $value) : ?>
                                            <option value="<?= $value['id_kategori_faq'] ?>" <?= old('id_kategori_faq') == $value['id_kategori_faq'] ? 'selected' : ''; ?>>
                                                <?= $value['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (session('errors.id_kategori_faq')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.id_kategori_faq') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="pertanyaan" class="col-form-label">Pertanyaan</label><span style="color: red;">*</span>
                                    <textarea id="pertanyaan" class="form-control <?= session('errors.pertanyaan') ? 'is-invalid' : ''; ?>" style="background-color: white" name="pertanyaan"><?php echo old('pertanyaan'); ?></textarea>

                                    <?php if (session('errors.pertanyaan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.pertanyaan') ?>
                                        </div>
                                    <?php endif ?>
                                    <!-- inisiasi CKEditor -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            if (typeof initEditor === 'function') {
                                                initEditor('#pertanyaan');
                                            } else {
                                                console.error('initEditor function is not available.');
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="mb-3">
                                    <label for="jawaban" class="col-form-label">Jawaban</label><span style="color: red;">*</span>
                                    <textarea class="form-control <?= session('errors.jawaban') ? 'is-invalid' : ''; ?>" name="jawaban" style="background-color: white" id="jawaban"><?php echo old('jawaban'); ?></textarea>

                                    <?php if (session('errors.jawaban')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.jawaban') ?>
                                        </div>
                                    <?php endif ?>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            if (typeof initEditor === 'function') {
                                                initEditor('#jawaban');
                                            } else {
                                                console.error('initEditor function is not available.');
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/faq" class="btn btn-secondary btn-md ml-3">
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
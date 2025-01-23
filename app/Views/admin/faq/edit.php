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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data FAQ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data FAQ</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data FAQ</h2>
                            <form action="<?= site_url('admin/faq/update/' . $tb_faq['id_faq']); ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= $this->include('alert/alert'); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <form action="<?= site_url('admin/faq/update/' . $tb_faq['id_faq']); ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                        <?= $this->include('alert/alert'); ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <?= csrf_field(); ?>

                                        <div class="mb-3">
                                            <label for="id_kategori_faq" class="col-form-label">Nama Kategori FAQ</label><span style="color: red;">*</span>
                                            <a href="<?= site_url('admin/kategori_faq'); ?>" class="btn rounded-pill">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <select class="form-select custom-border <?= ($validation->hasError('id_kategori_faq')) ? 'is-invalid' : ''; ?>" id="id_kategori_faq" name="id_kategori_faq" aria-label="Default select example" style="background-color: white;" required>
                                                <option value="" selected disabled>~ Silahkan Pilih Nama Kategori FAQ ~</option>
                                                <?php foreach ($tb_kategori_faq as $value) : ?>
                                                    <?php $selected = ($value['id_kategori_faq'] == old('id_kategori_faq', $tb_faq['id_kategori_faq'])) ? 'selected' : ''; ?>
                                                    <option value="<?= $value['id_kategori_faq'] ?>" <?= $selected ?>><?= $value['nama_kategori'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pertanyaan" class="col-form-label">Pertanyaan</label><span style="color: red;">*</span>
                                            <textarea class="form-control <?= session('errors.pertanyaan') ? 'is-invalid' : ''; ?>" name="pertanyaan" style="background-color: white" id="pertanyaan"><?= old('pertanyaan', $tb_faq['pertanyaan']); ?></textarea>
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
                                            <textarea class="form-control <?= session('errors.jawaban') ? 'is-invalid' : ''; ?>" name="jawaban" style="background-color: white" id="jawaban"><?= old('jawaban', $tb_faq['jawaban']); ?>
                                    </textarea>
                                            <?php if (session('errors.jawaban')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jawaban') ?>
                                                </div>
                                            <?php endif ?>
                                            <!-- inisiasi CKEditor -->
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

                                        <div class="form-group mb-4 mt-4">
                                            <div class="d-grid gap-2 d-md-flex justify-content-end">
                                                <a href="/admin/faq/cek_data/<?= $tb_faq['slug'] ?>" class="btn btn-secondary btn-md ml-3">
                                                    <i class="fas fa-arrow-left"></i> Kembali
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
</div>


<?= $this->include('admin/layouts/footer') ?>
<!-- end main content-->
<?= $this->include('admin/layouts/script2') ?>

<!-- autofocus input edit langsung kebelakang kata -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputJudul = document.getElementById('judul');

        // Fungsi untuk mengatur fokus ke posisi akhir input
        function setFocusToEnd(element) {
            element.focus();
            var val = element.value;
            element.value = ''; // kosongkan nilai input
            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
        }

        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
        setFocusToEnd(inputJudul);
    });
</script>
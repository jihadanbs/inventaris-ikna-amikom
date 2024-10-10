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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Laporan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Laporan</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Laporan</h2>
                            <form action="/admin/laporan/update/<?= $tb_laporan['id_laporan']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="judul_laporan" class="col-form-label">Judul Laporan</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('judul_laporan')) ? 'is-invalid' : ''; ?>" id="judul_laporan" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Judul Laporan" name="judul_laporan"><?= old('judul_laporan', $tb_laporan['judul_laporan']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('judul_laporan'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_file" class="col-form-label">Tanggal Ubah File :</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_file')) ? 'is-invalid' : ''; ?>" id="tanggal_file" style="background-color: white;" name="tanggal_file" value="<?= old('tanggal_file', $tb_laporan['tanggal_file']); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_file'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_laporan" class="col-form-label">File</label>
                                    <input type="file" accept="application/pdf" class="form-control" id="file_laporan" name="file_laporan" style="background-color: white;" <?= (old('file_laporan')) ? 'disabled' : 'required'; ?>>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_laporan['file_laporan'])) : ?>
                                        <p>File exists: <?= $tb_laporan['file_laporan'] ?></p>
                                        <input type="hidden" name="old_file_laporan" value="<?= $tb_laporan['file_laporan']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/laporan/cek_data/<?= $tb_laporan['id_laporan'] ?>" class="btn btn-secondary btn-md ml-3">
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


<?= $this->include('admin/layouts/footer') ?>
<!-- end main content-->

<?= $this->include('admin/layouts/script2') ?>

<!-- autofocus input edit langsung kebelakang kata -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputJudul = document.getElementById('judul_laporan');

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
<!-- end autofocus input edit langsung kebelakang kata -->
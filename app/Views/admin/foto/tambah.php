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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Foto</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Foto</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Foto</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Foto</h2>

                            <form action="/admin/foto/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="judul_foto" class="col-form-label">Judul Foto :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_foto')) ? 'is-invalid' : ''; ?>" id="judul_foto" name="judul_foto" placeholder="Masukkan Judul Foto" style="background-color: white;" autofocus value="<?= old('judul_foto'); ?>">
                                        <small class="form-text text-muted">Judul Singkat Saja Maksimal 2-3 Kalimat. Cth: Kegiatan Bupati Pesawaran</small>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_foto'); ?>
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
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="file_foto" class="col-form-label">Gambar Foto :</label>
                                        <input type="file" accept="image/*" class="form-control custom-border" id="file_foto" name="file_foto[]" style="background-color: white;" <?= (old('file_foto')) ? 'disabled' : 'required'; ?> multiple>
                                        <small class="form-text text-muted">
                                            <span style="color: blue;">NOTE : Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan CTRL Pada Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Dimau Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                        </small>

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_foto" class="col-form-label">Tanggal Upload Foto :</label>
                                        <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_foto')) ? 'is-invalid' : ''; ?>" required name="tanggal_foto" placeholder="Masukkan Tanggal Foto" value="<?= old('tanggal_foto'); ?>" id="tanggal_foto" cols="30" rows="10" style="background-color: white;"></input>

                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_foto'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/foto" class="btn btn-secondary btn-md ml-3">
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
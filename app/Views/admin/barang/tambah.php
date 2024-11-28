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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/barang') ?>">Data Barang</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Barang</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Barang</h2>

                            <form action="<?= esc(site_url('admin/barang/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_barang" class="col-form-label">Nama Barang :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang Yang Ingin Ditambahkan" style="background-color: white;" autofocus value="<?= old('nama_barang'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_barang'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_barang" class="col-form-label">Kategori Barang :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_barang')) ? 'is-invalid' : ''; ?>" id="id_kategori_barang" name="id_kategori_barang" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Kategori Barang ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kategori_barang as $value) : ?>
                                                <option value="<?= $value['id_kategori_barang'] ?>" <?= old('id_kategori_barang') == $value['id_kategori_barang'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="kategori_id" name="kategori_id">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_kategori_barang'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="tanggal_masuk" class="col-form-label">Tanggal Masuk :</label>
                                        <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" name="tanggal_masuk" placeholder="Tanggal Masuk" id="tanggal_masuk" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_masuk'); ?>"></input>
                                        <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_masuk'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_keluar" class="col-form-label">Tanggal Keluar :</label>
                                        <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_keluar')) ? 'is-invalid' : ''; ?>" name="tanggal_keluar" placeholder="Tanggal Keluar" id="tanggal_keluar" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_keluar'); ?>"></input>
                                        <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_keluar'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" required name="deskripsi" placeholder="Masukkan Deskripsi" id="deskripsi" cols="30" rows="5" style="background-color: white;"><?php echo old('deskripsi'); ?></textarea>
                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_total" class="col-form-label">Total :</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_total')) ? 'is-invalid' : ''; ?>" id="jumlah_total" name="jumlah_total" placeholder="Masukkan Jumlah Total Dari Barang" style="background-color: white;" autofocus value="<?= old('jumlah_total'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_total'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="path_file_foto_barang" class="col-form-label">Foto Barang :</label>
                                        <input type="file" accept="image/*" class="form-control custom-border" id="path_file_foto_barang" name="path_file_foto_barang[]" style="background-color: white;" <?= (old('path_file_foto_barang')) ? 'disabled' : 'required'; ?> multiple>
                                        <div class="invalid-feedback" id="file_foto_barang_error" style="display: none;">Kolom File Foto Barang Wajib Di Isi Pertama Kali !</div>
                                        <small class="form-text text-muted">
                                            <span style="color: blue;"><span style="color: red;">NOTE :</span> Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan<span style="color: red;"> CTRL </span> Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Diinginkan Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                        </small>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fungsi untuk menampilkan validasi foto setelah validasi PHP
                                        setTimeout(function() {
                                            var fileFoto = document.getElementById("path_file_foto_barang");
                                            var fileFotoError = document.getElementById("file_foto_barang_error");

                                            // Cek jika foto sudah dipilih dan sembunyikan pesan kesalahan foto
                                            if (fileFoto.files.length > 0) {
                                                fileFotoError.style.display = "none"; // Sembunyikan pesan kesalahan foto jika foto dipilih
                                            } else if (!fileFoto.classList.contains("is-invalid")) {
                                                fileFotoError.style.display = "block"; // Tampilkan pesan kesalahan foto jika foto belum dipilih
                                            }
                                        }, 100); // Delay sedikit untuk memastikan semua validasi PHP selesai

                                        // Cek ketika foto diinputkan
                                        document.getElementById("path_file_foto_barang").addEventListener("change", function() {
                                            var fileFoto = document.getElementById("path_file_foto_barang");
                                            var fileFotoError = document.getElementById("file_foto_barang_error");

                                            // Jika file foto dipilih, sembunyikan pesan kesalahan
                                            if (fileFoto.files.length > 0) {
                                                fileFotoError.style.display = "none";
                                            }
                                        });
                                    });

                                    // Validasi ketika form disubmit
                                    document.getElementById("validationForm").addEventListener("submit", function(event) {
                                        var valid = true;

                                        // Cek validasi path_file_foto_barang
                                        var fileFoto = document.getElementById("path_file_foto_barang");
                                        var fileFotoError = document.getElementById("file_foto_barang_error");

                                        if (!fileFoto.files.length) {
                                            valid = false;
                                            fileFotoError.style.display = "block"; // Tampilkan pesan kesalahan
                                        } else {
                                            fileFotoError.style.display = "none"; // Sembunyikan pesan kesalahan jika gambar dipilih
                                        }

                                        // Jika gambar gagal divalidasi, form tidak akan disubmit
                                        if (!valid) {
                                            event.preventDefault();
                                        }
                                    });
                                </script>

                                <div class="modal-footer">
                                    <a href="<?= site_url('admin/barang') ?>" class="btn btn-secondary btn-md ml-3">
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
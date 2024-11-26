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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barang</a></li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Barang</h2>

                            <form action="/admin/barang/save" method="post" enctype="multipart/form-data" novalidate>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_barang" class="col-form-label">Nama Barang :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang Informasi" style="background-color: white;" autofocus value="<?= old('nama_barang'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_barang'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_barang" class="col-form-label">Kategori Barang :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_barang')) ? 'is-invalid' : ''; ?>" id="id_kategori_barang" name="id_kategori_barang" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori Barang --</option>
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
                                        <input type="file" accept="image/*" class="form-control custom-border" id="path_file_foto_barang" name="path_file_foto_barang" style="background-color: white;">
                                        <small class="form-text text-muted">
                                            <span style="color: blue;">NOTE : Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan CTRL Pada Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Dimau Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                        </small>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/barang" class="btn btn-secondary btn-md ml-3">
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
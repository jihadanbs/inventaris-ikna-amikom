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
                            <h2 class="text-center mb-4">FORMULIR TAMBAH DATA BARANG</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/barang/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_barang" class="col-form-label">Nama Barang<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.nama_barang') ? 'is-invalid' : '' ?>" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang Yang Ingin Ditambahkan" style="background-color: white;" autofocus value="<?= old('nama_barang'); ?>">
                                            <?php if (session('errors.nama_barang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_barang') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_barang" class="col-form-label">Kategori Barang<span class="text-danger">*</span></label>
                                        <a href="<?= site_url('admin/kategori_barang'); ?>" class="btn rounded-pill">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <select class="form-select custom-border <?= session('errors.id_kategori_barang') ? 'is-invalid' : '' ?>" id="id_kategori_barang" name="id_kategori_barang" aria-label="Default select example" style="background-color: white;">
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Kategori Barang ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kategori_barang as $value) : ?>
                                                <option value="<?= $value['id_kategori_barang'] ?>" <?= old('id_kategori_barang') == $value['id_kategori_barang'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="kategori_id" name="kategori_id">
                                        <?php if (session('errors.id_kategori_barang')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_kategori_barang') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_total" class="col-form-label">Total Barang Yang Masuk<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.jumlah_total') ? 'is-invalid' : '' ?>" id="jumlah_total" name="jumlah_total" placeholder="Masukkan Jumlah Total Dari Barang" style="background-color: white;" autofocus value="<?= old('jumlah_total'); ?>">

                                            <?php if (session('errors.jumlah_total')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jumlah_total') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kondisi_barang" class="col-form-label">Kondisi Barang<span class="text-danger">*</span></label>
                                        <a href="<?= site_url('admin/kondisi_barang'); ?>" class="btn rounded-pill">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <select class="form-select custom-border <?= session('errors.id_kondisi_barang') ? 'is-invalid' : '' ?>" id="id_kondisi_barang" name="id_kondisi_barang" aria-label="Default select example" style="background-color: white;">
                                            <option value="" selected disabled>~ Silahkan Pilih Kondisi Barang ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kondisi_barang as $value) : ?>
                                                <option value="<?= $value['id_kondisi_barang'] ?>" <?= old('id_kondisi_barang') == $value['id_kondisi_barang'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_kondisi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="kategori_id" name="kategori_id">
                                        <?php if (session('errors.id_kondisi_barang')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_kondisi_barang') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="tanggal_masuk" class="col-form-label">Tanggal Masuk Barang<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control custom-border <?= session('errors.tanggal_masuk') ? 'is-invalid' : ''; ?>" name="tanggal_masuk" placeholder="Tanggal Masuk" id="tanggal_masuk" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_masuk'); ?>"></input>

                                        <?php if (session('errors.tanggal_masuk')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tanggal_masuk') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="keterangan_masuk" class="col-form-label">Keterangan Masuk<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.keterangan_masuk') ? 'is-invalid' : ''; ?>" id="keterangan_masuk" name="keterangan_masuk" placeholder="Masukkan Keterangan Masuk Barang" style="background-color: white;" autofocus value="<?= old('keterangan_masuk'); ?>">

                                            <?php if (session('errors.keterangan_masuk')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.keterangan_masuk') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">
                                                <span style="color: blue;"><span style="color: blue;">Note : Boleh dikosongi</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_total_baik" class="col-form-label">Total Barang (Baik/Layak) :</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.jumlah_total_baik') ? 'is-invalid' : ''; ?>" id="jumlah_total_baik" name="jumlah_total_baik" placeholder="Masukkan Jumlah Total Barang Kondisi Layak" style="background-color: white;" autofocus value="<?= old('jumlah_total_baik'); ?>">

                                            <?php if (session('errors.jumlah_total_baik')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jumlah_total_baik') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="keterangan_baik" class="col-form-label">Keterangan Baik<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.keterangan_baik') ? 'is-invalid' : ''; ?>" id="keterangan_baik" name="keterangan_baik" placeholder="Masukkan Keterangan Barang" style="background-color: white;" autofocus value="<?= old('keterangan_baik'); ?>">

                                            <?php if (session('errors.keterangan_baik')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.keterangan_baik') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">
                                                <span style="color: blue;"><span style="color: blue;">Note : Boleh dikosongi</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_total_rusak" class="col-form-label">Total Barang (Rusak/Tidak Layak)<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.jumlah_total_rusak') ? 'is-invalid' : ''; ?>" id="jumlah_total_rusak" name="jumlah_total_rusak" placeholder="Masukkan Jumlah Total Barang Kondisi Rusak" style="background-color: white;" autofocus value="<?= old('jumlah_total_rusak'); ?>">

                                            <?php if (session('errors.jumlah_total_rusak')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jumlah_total_rusak') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="keterangan_rusak" class="col-form-label">Keterangan Rusak<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.keterangan_rusak') ? 'is-invalid' : ''; ?>" id="keterangan_rusak" name="keterangan_rusak" placeholder="Masukkan Keterangan Barang" style="background-color: white;" autofocus value="<?= old('keterangan_rusak'); ?>">

                                            <?php if (session('errors.keterangan_rusak')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.keterangan_rusak') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">
                                                <span style="color: blue;"><span style="color: blue;">Note : Boleh dikosongi</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi Barang<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.deskripsi') ? 'is-invalid' : ''; ?>" required name="deskripsi" placeholder="Masukkan Deskripsi" id="deskripsi" cols="30" rows="5" style="background-color: white;"><?php echo old('deskripsi'); ?></textarea>

                                    <?php if (session('errors.deskripsi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.deskripsi') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="path_file_foto_barang" class="col-form-label">Foto Barang<span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" class="form-control custom-border <?= session('errors.path_file_foto_barang') ? 'is-invalid' : ''; ?>" id="path_file_foto_barang" name="path_file_foto_barang[]" style="background-color: white;" <?= (old('path_file_foto_barang')) ? 'disabled' : 'required'; ?> value="<?= old('path_file_foto_barang'); ?>" multiple>

                                    <?php if (session('errors.path_file_foto_barang')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.path_file_foto_barang') ?>
                                        </div>
                                    <?php endif ?>
                                    <small class="form-text text-muted">
                                        <span style="color: blue;"><span style="color: red;">NOTE :</span> Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan<span style="color: red;"> CTRL </span> Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Diinginkan Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                    </small>
                                </div>

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
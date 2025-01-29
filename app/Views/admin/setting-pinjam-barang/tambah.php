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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Setting Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/setting-pinjam-barang') ?>">Setting Barang</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Setting Barang</li>
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
                            <h2 class="text-center mb-4">FORMULIR TAMBAH SETTING BARANG</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/setting-pinjam-barang/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_barang" class="col-form-label">Nama Barang<span class="text-danger">*</span></label>
                                        <select class="form-select custom-border <?= session('errors.id_barang') ? 'is-invalid' : '' ?>" id="id_barang" name="id_barang" aria-label="Default select example" style="background-color: white;">
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Barang ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_barang as $value) : ?>
                                                <option value="<?= $value['id_barang'] ?>" <?= old('id_barang') == $value['id_barang'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_barang'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="barang_id" name="barang_id">
                                        <?php if (session('errors.id_barang')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_barang') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3 separator">
                                        <label for="masa_pinjam" class="col-form-label">Masa Pinjam Barang (Hari)<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.masa_pinjam') ? 'is-invalid' : '' ?>" id="masa_pinjam" name="masa_pinjam" placeholder="Masukkan Masa Pinjam Barang" style="background-color: white;" autofocus value="<?= old('masa_pinjam'); ?>">

                                            <?php if (session('errors.masa_pinjam')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.masa_pinjam') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="col-form-label">Lokasi Barang<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= session('errors.lokasi') ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi" placeholder="Masukkan Lokasi barang" style="background-color: white;" autofocus value="<?= old('lokasi'); ?>">

                                        <?php if (session('errors.lokasi')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.lokasi') ?>
                                            </div>
                                        <?php endif ?>

                                        <small class="form-text text-muted">
                                            <span>Kabupaten / Kota (Contoh : Kab. Sleman)</span>
                                        </small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="is_tampil">Tampilkan di Halaman Depan</label><span class="text-danger">*</span>
                                        <input type="checkbox" class="form-check-input <?= session('errors.is_tampil') ? 'is-invalid' : '' ?>" name="is_tampil" id="is_tampil" value="1" <?= old('is_tampil') ? 'checked' : '' ?>>
                                    </div>

                                    <?php if (session('errors.is_tampil')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.is_tampil') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= site_url('admin/setting-pinjam-barang') ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;"><i class="fas fa-plus"></i> Tambah Data</button>
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
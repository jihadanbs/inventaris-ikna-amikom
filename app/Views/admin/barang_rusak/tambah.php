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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Barang Rusak</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/barang_rusak') ?>">Data Barang Rusak</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Barang Rusak</li>
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
                            <h2 class="text-center mb-4">FORMULIR TAMBAH DATA BARANG RUSAK</h2>

                            <form action="<?= esc(site_url('admin/barang_rusak/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_barang" class="col-form-label">Nama Barang :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_barang')) ? 'is-invalid' : ''; ?>" id="id_barang" name="id_barang" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Barang ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_barang as $value) : ?>
                                                <option value="<?= $value['id_barang'] ?>" <?= old('id_barang') == $value['id_barang'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_barang'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" id="kategori_id" name="kategori_id">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_barang'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_total_rusak" class="col-form-label">Total Barang Rusak :</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_total_rusak')) ? 'is-invalid' : ''; ?>" id="jumlah_total_rusak" name="jumlah_total_rusak" placeholder="Masukkan Jumlah Total Rusak Dari Barang" style="background-color: white;" autofocus value="<?= old('jumlah_total_rusak'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jumlah_total_rusak'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan_rusak" class="col-form-label">Keterangan Rusak :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('keterangan_rusak')) ? 'is-invalid' : ''; ?>" required name="keterangan_rusak" placeholder="Masukkan Penjelasan Keterangan Rusak" id="keterangan_rusak" cols="30" rows="5" style="background-color: white;"><?php echo old('keterangan_rusak'); ?></textarea>
                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('keterangan_rusak'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= site_url('admin/barang_rusak') ?>" class="btn btn-secondary btn-md ml-3">
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
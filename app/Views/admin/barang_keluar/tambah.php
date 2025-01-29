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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Barang Keluar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Aktivitas Barang</a></li>
                                <li class="breadcrumb-item"><a href="<?= ('admin/barang_keluar'); ?>">Barang Keluar</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Barang Keluar</li>
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
                            <h2 class="text-center mb-4">FORMULIR TAMBAH BARANG KELUAR</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/barang_keluar/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
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

                                    <div class="col-md-6 mb-3">
                                        <label for="total_barang" class="col-form-label">Total Barang Yang Keluar<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.total_barang') ? 'is-invalid' : '' ?>" id="total_barang" name="total_barang" placeholder="Masukkan Jumlah Barang Yang Keluar" style="background-color: white;" autofocus value="<?= old('total_barang'); ?>">

                                            <?php if (session('errors.total_barang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.total_barang') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_keluar" class="col-form-label">Tanggal Keluar Barang<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-border <?= session('errors.tanggal_keluar') ? 'is-invalid' : ''; ?>" name="tanggal_keluar" placeholder="Tanggal Keluar" id="tanggal_keluar" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_keluar'); ?>"></input>

                                    <?php if (session('errors.tanggal_keluar')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.tanggal_keluar') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="col-form-label">Keterangan Keluar<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.keterangan') ? 'is-invalid' : ''; ?>" required name="keterangan" placeholder="Masukkan Keterangan" id="keterangan" cols="30" rows="5" style="background-color: white;"><?php echo old('keterangan'); ?></textarea>

                                    <?php if (session('errors.keterangan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.keterangan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= site_url('admin/barang_keluar') ?>" class="btn btn-secondary btn-md ml-3">
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
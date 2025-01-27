<?= $this->include('admin/layouts/script') ?>
<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }

    .alert-info {
        background-color: #f0f9ff;
        border: 1px solid #bee5eb;
        position: relative;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        background-color: #007bff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }

    .icon-box span {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .background-animation {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.1) 75%);
        z-index: 0;
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-info {
        animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Stok Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/barang') ?>">Data Barang</a></li>
                                <li class="breadcrumb-item"><a href="<?= esc(site_url('admin/barang/cek_data/' . urlencode($tb_barang['slug'])), 'attr') ?>">Formulir Cek Data Barang</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Stok Barang</li>
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
                            <h2 class="text-center mb-4">FORMULIR TAMBAH DATA STOK BARANG</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/barang/saveStok/' . urlencode($tb_barang['id_barang'])), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_barang" value="<?= esc($tb_barang['id_barang'], 'attr'); ?>">
                                <input type="hidden" name="id_kategori_barang" value="<?= esc($tb_barang['id_kategori_barang'], 'attr'); ?>">
                                <input type="hidden" name="id_kondisi_barang" value="<?= esc($tb_barang['id_kondisi_barang'], 'attr'); ?>">
                                <input type="hidden" name="slug" value="<?= esc($tb_barang['slug'], 'attr'); ?>">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-info shadow-lg rounded-3 position-relative overflow-hidden animate-info">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box me-3 d-flex align-items-center justify-content-center">
                                                    <span class="text-white fw-bold">INFO</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1"><strong><span class="text-danger">*</span>INFORMASI STOK <?= strtoupper(esc($tb_barang['nama_barang'])) ?> SAAT INI<span class="text-danger">*</span></strong></h5>
                                                    <p class="mb-0">
                                                        <strong>Total Barang :</strong> <span class="text-primary"><?= esc($tb_barang['jumlah_total']) ?> Barang <span style="color: black;">(HASIL DARI STOK TERSEDIA DITAMBAH DIPINJAM)</span></span><br>
                                                        <strong>Dipinjam :</strong> <span class="text-danger"><?= esc($tb_barang['jumlah_dipinjam']) ?> Barang</span><br>
                                                        <strong>Tersedia :</strong> <span class="text-success"><?= esc($tb_barang['jumlah_total'] - $tb_barang['jumlah_dipinjam']) ?> Barang </strong> <span style="color: black;">(GABUNGAN KONDISI BAIK DAN RUSAK)</span></span><br>
                                                        <strong>Kondisi Baik/Layak :</strong> <span class="text-success"><?= esc($tb_barang['jumlah_total_baik']) ?> Barang</span><br>
                                                        <strong>Kondisi Rusak :</strong> <span class="text-danger"><?= esc($tb_barang['jumlah_total_rusak']) ?> Barang</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="background-animation"></div>
                                        </div>
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
                                            <input type="text" class="form-control <?= session('errors.keterangan_masuk') ? 'is-invalid' : ''; ?>" id="keterangan_masuk" name="keterangan_masuk" placeholder="Masukkan Keterangan Masuk Barang" style="background-color: white;" value="<?= old('keterangan_masuk'); ?>">

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

                                <div class="modal-footer">
                                    <a href="<?= esc(site_url('admin/barang/cek_data/' . urlencode($tb_barang['slug'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
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
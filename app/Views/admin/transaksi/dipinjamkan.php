<?= $this->include('admin/layouts/script') ?>
<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Peminjaman Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/transaksi') ?>">Data Transaksi</a></li>
                                <li class="breadcrumb-item"><a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($tb_peminjaman[0]['nama_lengkap'])), 'attr') ?>">Formulir Cek Data Transaksi</a></li>
                                <li class="breadcrumb-item active">Formulir Peminjaman Barang</li>
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
                            <h2 class="text-center mb-4">FORMULIR PEMINJAMAN BARANG</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/transaksi/proses_dipinjamkan/' . urlencode($tb_peminjaman[0]['id_peminjaman'])), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_barang" value="<?= esc($tb_peminjaman[0]['id_barang'], 'attr'); ?>">
                                <input type="hidden" name="slug" value="<?= esc($tb_peminjaman[0]['slug'], 'attr'); ?>">
                                <input type="hidden" name="nama_lengkap" value="<?= esc($tb_peminjaman[0]['nama_lengkap'], 'attr'); ?>">
                                <input type="hidden" name="total_dipinjam" value="<?= esc($tb_peminjaman[0]['total_dipinjam'], 'attr'); ?>">
                                <input type="hidden" name="id_peminjaman" value="<?= esc($tb_peminjaman[0]['id_peminjaman'], 'attr'); ?>">
                                <input type="hidden" name="kategori_list" value="<?= esc($tb_peminjaman[0]['kategori_list'] ?? '', 'attr'); ?>">
                                <input type="hidden" name="total_jenis_barang" value="<?= esc($tb_peminjaman[0]['total_jenis_barang'] ?? 0, 'attr'); ?>">

                                <label class="col-form-label" style="font-size: 25px;">A. Data Peminjam</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_lengkap" class="col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : ''; ?>" id="nama_lengkap" style="background-color: white;" placeholder="Masukkan Nama Barang" name="nama_lengkap" value="<?= esc(old('nama_lengkap', $tb_peminjaman[0]['nama_lengkap']), 'attr'); ?>" autocomplete="off" readonly>

                                            <?php if (session('errors.nama_lengkap')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_lengkap') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama_barang" class="col-form-label">Nama Barang<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.nama_barang') ? 'is-invalid' : ''; ?>" id="nama_barang" style="background-color: white;" placeholder="Masukkan Nama Barang" name="nama_barang" value="<?= esc(old('nama_barang', $tb_peminjaman[0]['barang_list']), 'attr'); ?>" autocomplete="off" readonly>

                                            <?php if (session('errors.nama_barang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_barang') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="total_jenis_barang" class="col-form-label">Total Jenis Barang</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="total_jenis_barang" style="background-color: white;" value="<?= esc($tb_peminjaman[0]['total_jenis_barang'] ?? 0, 'attr'); ?> Jenis Barang" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kategori_list" class="col-form-label">Daftar Kategori</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="kategori_list" style="background-color: white;" value="<?= esc($tb_peminjaman[0]['kategori_list'] ?? '-', 'attr'); ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_kondisi_barang" class="col-form-label">Kondisi Barang<span class="text-danger">*</span></label>
                                    <select class="form-select custom-border <?= ($validation->hasError('id_kondisi_barang')) ? 'is-invalid' : ''; ?>" id="id_kondisi_barang" name="id_kondisi_barang" aria-label="Default select example" style="background-color: white;" required disabled>
                                        <option value="" selected disabled>~ Silahkan Pilih Nama Kondisi Barang ~</option>
                                        <?php foreach ($tb_kondisi_barang as $value) : ?>
                                            <?php $selected = ($value['id_kondisi_barang'] == old('id_kondisi_barang', $tb_peminjaman[0]['id_kondisi_barang'])) ? 'selected' : ''; ?>
                                            <option value="<?= $value['id_kondisi_barang'] ?>" <?= $selected ?>><?= $value['nama_kondisi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kepentingan" class="col-form-label">Kepentingan<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.kepentingan') ? 'is-invalid' : ''; ?>" id="kepentingan" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan kepentingan" name="kepentingan" autocomplete="off" disabled><?= esc(old('kepentingan', $tb_peminjaman[0]['kepentingan']), 'attr'); ?></textarea>

                                    <?php if (session('errors.kepentingan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kepentingan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <label class="col-form-label" style="font-size: 25px;">B. Input Barang Keluar</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="total_barang" class="col-form-label">Total Barang (Keluar)<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control <?= session('errors.total_barang') ? 'is-invalid' : ''; ?>"
                                                id="total_barang"
                                                name="total_barang"
                                                placeholder="Masukkan Jumlah Total Barang Yang Keluar"
                                                style="background-color: white;"
                                                value="<?= array_sum(array_column($tb_peminjaman, 'total_dipinjam')) ?>"
                                                readonly>

                                            <?php if (session('errors.total_barang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.total_barang') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">
                                                <span>Note : Sudah terisi otomatis</span>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_keluar" id="tanggal_keluar" class="col-form-label">Tanggal Keluar Barang<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control custom-border <?= session('errors.tanggal_keluar') ? 'is-invalid' : ''; ?>" name="tanggal_keluar" placeholder="Tanggal Masuk" id="tanggal_keluar" cols="30" rows="10" style="background-color: white;" autofocus value="<?= old('tanggal_keluar'); ?>"></input>

                                        <?php if (session('errors.tanggal_keluar')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tanggal_keluar') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan_keluar" class="col-form-label">Keterangan Keluar<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= session('errors.keterangan_keluar') ? 'is-invalid' : ''; ?>" id="keterangan_keluar" name="keterangan_keluar" placeholder="Masukkan Keterangan Barang Keluar" style="background-color: white;" value="<?= old('keterangan_keluar'); ?>">

                                        <?php if (session('errors.keterangan_keluar')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.keterangan_keluar') ?>
                                            </div>
                                        <?php endif ?>
                                        <small class="form-text text-muted">
                                            <span>Note : Boleh dikosongi</span>
                                        </small>
                                    </div>
                                </div>

                                <label class="col-form-label" style="font-size: 25px;">C. Input Peminjam</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="tanggal_dipinjamkan" class="col-form-label">Tanggal Dipinjamkan Barang<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control custom-border <?= session('errors.tanggal_dipinjamkan') ? 'is-invalid' : ''; ?>" name="tanggal_dipinjamkan" placeholder="Tanggal Masuk" id="tanggal_dipinjamkan" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_dipinjamkan'); ?>"></input>

                                        <?php if (session('errors.tanggal_dipinjamkan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tanggal_dipinjamkan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_perkiraan_dikembalikan" class="col-form-label">Tanggal Perkiraan Barang Dikembalikan<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control custom-border <?= session('errors.tanggal_perkiraan_dikembalikan') ? 'is-invalid' : ''; ?>" name="tanggal_perkiraan_dikembalikan" placeholder="Tanggal Perkiraan Dikembalikan" id="tanggal_perkiraan_dikembalikan" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_perkiraan_dikembalikan'); ?>"></input>

                                        <?php if (session('errors.tanggal_perkiraan_dikembalikan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.tanggal_perkiraan_dikembalikan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan_peminjaman" class="col-form-label">Catatan Untuk Peminjam<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.catatan_peminjaman') ? 'is-invalid' : ''; ?>" required name="catatan_peminjaman" placeholder="Masukkan Catatan Peminjaman" id="catatan_peminjaman" cols="30" rows="5" style="background-color: white;"><?php echo old('catatan_peminjaman'); ?></textarea>

                                    <?php if (session('errors.catatan_peminjaman')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.catatan_peminjaman') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($tb_peminjaman[0]['kode_peminjaman'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-times"></i> Batal Meminjamkan
                                        </a>
                                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan Data Peminjaman</button>
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
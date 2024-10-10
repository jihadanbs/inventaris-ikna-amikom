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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Publik</a></li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Informasi Publik</h2>

                            <form action="/admin/informasi_publik/save" method="post" enctype="multipart/form-data" novalidate>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_lembaga" class="col-form-label">Nama Dinas :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_lembaga')) ? 'is-invalid' : ''; ?>" id=" id_lembaga" name="id_lembaga" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Dinas --</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_lembaga as $value) : ?>
                                                <option value="<?= $value['id_lembaga'] ?>" <?= old('id_lembaga') == $value['id_lembaga'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_dinas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_lembaga'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_informasi_publik" class="col-form-label">Kategori Informasi :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_informasi_publik')) ? 'is-invalid' : ''; ?>" id="id_kategori_informasi_publik" name="id_kategori_informasi_publik" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori Informasi --</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kategori_informasi_publik as $value) : ?>
                                                <option value="<?= $value['id_kategori_informasi_publik'] ?>" <?= old('id_kategori_informasi_publik') == $value['id_kategori_informasi_publik'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="kategori_id" name="kategori_id">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_kategori_informasi_publik'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_jenis" class="col-form-label">Jenis Informasi :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_jenis')) ? 'is-invalid' : ''; ?>" id="id_jenis" name="id_jenis" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Jenis Informasi --</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_jenis as $value) : ?>
                                                <option value="<?= $value['id_jenis'] ?>" <?= old('id_jenis') == $value['id_jenis'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_jenis'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" id="jenis_id" name="jenis_id">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_jenis'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_file" class="col-form-label">Tanggal File :</label>
                                        <input type="date" class="form-control custom-border <?= ($validation->hasError('tanggal_file')) ? 'is-invalid' : ''; ?>" name="tanggal_file" placeholder="Masukkan Tanggal File" id="tanggal_file" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_file'); ?>"></input>
                                        <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_file'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="judul" class="col-form-label">Judul Informasi :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" placeholder="Masukkan Judul Informasi" style="background-color: white;" autofocus value="<?= old('judul'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul'); ?>
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

                                <div class="mb-3">
                                    <label for="file_informasi_publik" class="col-form-label">File :</label>
                                    <input type="file" accept="application/pdf" class="form-control custom-border" id="file_informasi_publik" name="file_informasi_publik" style="background-color: white;">

                                    <div class="invalid">
                                        <?= $validation->getError(); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/informasi_publik" class="btn btn-secondary btn-md ml-3">
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
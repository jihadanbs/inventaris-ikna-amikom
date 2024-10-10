<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

<?= $this->include('admin/layouts/navbar') ?>
<!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
<div style="pointer-events: none;">
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Publik</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Informasi Publik</h2>
                            <form action="/admin/informasi_publik/update/<?= $tb_informasi_publik['id_informasi_publik']; ?>" method="post" enctype="multipart/form-data" novalidate>
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="slug" value="<?= $tb_informasi_publik['slug']; ?>">
                                <input type="hidden" name="file_informasi_publik_lama" value="<?= $tb_informasi_publik['file_informasi_publik']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_lembaga" class="col-form-label">Nama Dinas</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_lembaga')) ? 'is-invalid' : ''; ?>" id="id_lembaga" name="id_lembaga" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Dinas --</option>
                                            <?php foreach ($tb_lembaga as $value) : ?>
                                                <?php $selected = ($value['id_lembaga'] == old('id_lembaga', $tb_informasi_publik['id_lembaga'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_lembaga'] ?>" <?= $selected ?>><?= $value['nama_dinas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_informasi_publik" class="col-form-label">Kategori</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_informasi_publik')) ? 'is-invalid' : ''; ?>" id="id_kategori_informasi_publik" name="id_kategori_informasi_publik" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori Informasi --</option>
                                            <?php foreach ($tb_kategori_informasi_publik as $value) : ?>
                                                <?php $selected = ($value['id_kategori_informasi_publik'] == old('id_kategori_informasi_publik', $tb_informasi_publik['id_kategori_informasi_publik'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_kategori_informasi_publik'] ?>" <?= $selected ?>><?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_jenis" class="col-form-label">Jenis Informasi</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_jenis')) ? 'is-invalid' : ''; ?>" id="id_jenis" name="id_jenis" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Jenis Informasi --</option>
                                            <?php foreach ($tb_jenis as $value) : ?>
                                                <?php $selected = ($value['id_jenis'] == old('id_jenis', $tb_informasi_publik['id_jenis'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_jenis'] ?>" <?= $selected ?>><?= $value['nama_jenis'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_file" class="col-form-label">Tanggal Ubah Upload Foto :</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_file')) ? 'is-invalid' : ''; ?>" id="tanggal_file" style="background-color: white;" name="tanggal_file" value="<?= old('tanggal_file', $tb_informasi_publik['tanggal_file']); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal_file'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="judul" class="col-form-label">Judul</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" style="background-color: white;" placeholder="Masukkan Judul" name="judul" value="<?= old('judul', $tb_informasi_publik['judul']); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" cols="30" rows="10" style="background-color: white;" placeholder="Masukkan Deskripsi" name="deskripsi"><?= old('deskripsi', $tb_informasi_publik['deskripsi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_informasi_publik" class="col-form-label">File</label>
                                    <input type="file" accept="application/pdf" class="form-control" id="file_informasi_publik" name="file_informasi_publik" style="background-color: white;" <?= (old('file_informasi_publik')) ? 'disabled' : 'required'; ?>>
                                    <div class="invalid-feedback">
                                        Kolom File Tidak Boleh Kosong
                                    </div>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_informasi_publik['file_informasi_publik'])) : ?>
                                        <p>File exists: <?= $tb_informasi_publik['file_informasi_publik'] ?></p>
                                        <input type="hidden" name="old_file_informasi_publik" value="<?= $tb_informasi_publik['file_informasi_publik']; ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/informasi_publik/cek_data/<?= $tb_informasi_publik['id_informasi_publik'] ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary ">Ubah Data</button>
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

<!-- autofocus input edit langsung kebelakang kata -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputJudul = document.getElementById('judul');

        // Fungsi untuk mengatur fokus ke posisi akhir input
        function setFocusToEnd(element) {
            element.focus();
            var val = element.value;
            element.value = ''; // kosongkan nilai input
            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
        }

        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
        setFocusToEnd(inputJudul);
    });
</script>
<!-- end autofocus input edit langsung kebelakang kata -->
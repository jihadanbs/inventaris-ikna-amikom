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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Foto</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Foto</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Foto</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Foto</h2>
                            <form action="/admin/foto/update/<?= $tb_foto['id_foto']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>
                                <input type="hidden" name="slug" value="<?= $tb_foto['slug']; ?>">
                                <input type="hidden" name="file_foto" value="<?= $tb_foto['file_foto']; ?>">

                                <di class="mb-3">
                                    <label for="judul_foto" class="col-form-label">Judul Foto :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_foto')) ? 'is-invalid' : ''; ?>" id="judul_foto" style="background-color: white;" placeholder="Masukkan Judul Foto" name="judul_foto" value="<?= old('judul_foto', $tb_foto['judul_foto']); ?>">
                                        <small class="form-text text-muted">Judul Singkat Saja Maksimal 2-3 Kalimat. Cth: Kegiatan Bupati Pesawaran</small>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_foto'); ?>
                                        </div>
                                    </div>
                                </di>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" cols="30" rows="10" style="background-color: white;" placeholder="Masukkan Deskripsi" name="deskripsi"><?= old('deskripsi', $tb_foto['deskripsi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="file_foto" class="col-form-label">File Foto :</label>
                                        <input type="file" accept="image/*" class="form-control custom-border" id="file_foto" name="file_foto[]" style="background-color: white;" <?= (old('file_foto')) ? 'disabled' : 'required'; ?> multiple>
                                        <small class="form-text text-muted">
                                            <span style="color: blue;">NOTE : Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan CTRL Pada Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Dimau Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                        </small>
                                        <?php if (!empty($tb_foto['file_foto'])) : ?>
                                            <input type="hidden" name="old_file_foto" value="<?= $tb_foto['file_foto']; ?>">
                                        <?php endif; ?>
                                    </div>

                                    <di class="col-md-6 mb-3">
                                        <label for="tanggal_foto" class="col-form-label">Tanggal Ubah Upload Foto :</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_foto')) ? 'is-invalid' : ''; ?>" id="tanggal_foto" style="background-color: white;" name="tanggal_foto" value="<?= old('tanggal_foto', $tb_foto['tanggal_foto']); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal_foto'); ?>
                                            </div>
                                        </div>
                                    </di>
                                </div>
                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/foto/cek_data/<?= $tb_foto['id_foto'] ?>" class="btn btn-secondary btn-md ml-3">
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
        var inputJudul = document.getElementById('judul_foto');

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
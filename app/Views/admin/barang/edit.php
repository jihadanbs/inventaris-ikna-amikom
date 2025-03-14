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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('/admin/barang') ?>">Data Barang</a></li>
                                <li class="breadcrumb-item"><a href="<?= esc(site_url('/admin/barang/cek_data/' . urlencode($tb_barang['slug'])), 'attr') ?>">Formulir Cek Data Barang</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Barang</li>
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
                            <h2 class="text-center mb-4">FORMULIR UBAH DATA BARANG</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('/admin/barang/update/' . urlencode($tb_barang['id_barang'])), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="slug" value="<?= esc($tb_barang['slug'], 'attr'); ?>">
                                <input type="hidden" name="id_barang" value="<?= esc($tb_barang['id_barang'], 'attr'); ?>">
                                <input type="hidden" name="path_file_foto_barang" value="<?= esc($tb_barang['path_file_foto_barang'], 'attr'); ?>">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-info shadow-lg rounded-3 position-relative overflow-hidden animate-info">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-box me-3 d-flex align-items-center justify-content-center">
                                                    <span class="text-white fw-bold">INFO</span>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1"><strong><span class="text-danger">*</span>INFORMASI STOCK <?= strtoupper(esc($tb_barang['nama_barang'])) ?> SAAT INI<span class="text-danger">*</span></strong></h5>
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

                                <div class="mb-3">
                                    <label for="nama_barang" class="col-form-label">Nama Barang<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= session('errors.nama_barang') ? 'is-invalid' : ''; ?>" id="nama_barang" style="background-color: white;" placeholder="Masukkan Nama Barang" name="nama_barang" value="<?= esc(old('nama_barang', $tb_barang['nama_barang']), 'attr'); ?>" autocomplete="off">

                                        <?php if (session('errors.nama_barang')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nama_barang') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <!-- autofocus input edit langsung kebelakang kata -->
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        var inputNamaBarang = document.getElementById('nama_barang');

                                        // Fungsi untuk mengatur fokus ke posisi akhir input
                                        function setFocusToEnd(element) {
                                            element.focus();
                                            var val = element.value;
                                            element.value = ''; // kosongkan nilai input
                                            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
                                        }

                                        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
                                        setFocusToEnd(inputNamaBarang);
                                    });
                                </script>
                                <!-- end autofocus input edit langsung kebelakang kata -->

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_kategori_barang" class="col-form-label">Kategori Barang<span class="text-danger">*</span></label>
                                        <a href="<?= site_url('/admin/kategori_barang'); ?>" class="btn rounded-pill">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_barang')) ? 'is-invalid' : ''; ?>" id="id_kategori_barang" name="id_kategori_barang" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Kategori Barang ~</option>
                                            <?php foreach ($tb_kategori_barang as $value) : ?>
                                                <?php $selected = ($value['id_kategori_barang'] == old('id_kategori_barang', $tb_barang['id_kategori_barang'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_kategori_barang'] ?>" <?= $selected ?>><?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kondisi_barang" class="col-form-label">Kondisi Barang<span class="text-danger">*</span></label>
                                        <a href="<?= site_url('/admin/kondisi_barang'); ?>" class="btn rounded-pill">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kondisi_barang')) ? 'is-invalid' : ''; ?>" id="id_kondisi_barang" name="id_kondisi_barang" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Kondisi Barang ~</option>
                                            <?php foreach ($tb_kondisi_barang as $value) : ?>
                                                <?php $selected = ($value['id_kondisi_barang'] == old('id_kondisi_barang', $tb_barang['id_kondisi_barang'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_kondisi_barang'] ?>" <?= $selected ?>><?= $value['nama_kondisi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi Barang<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.deskripsi') ? 'is-invalid' : ''; ?>" id="deskripsi" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Deskripsi" name="deskripsi" autocomplete="off"><?= esc(old('deskripsi', $tb_barang['deskripsi']), 'attr'); ?></textarea>

                                    <?php if (session('errors.deskripsi')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.deskripsi') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="path_file_foto_barang" class="col-form-label">Foto Barang<span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" class="form-control custom-border <?= session('errors.path_file_foto_barang') ? 'is-invalid' : ''; ?>" id="path_file_foto_barang" name="path_file_foto_barang[]" style="background-color: white;" <?= (old('path_file_foto_barang')) ? 'disabled' : 'required'; ?> multiple>

                                    <?php if (session('errors.path_file_foto_barang')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.path_file_foto_barang') ?>
                                        </div>
                                    <?php endif ?>
                                    <small class="form-text text-muted">
                                        <span style="color: blue;"><span style="color: red;">NOTE :</span> Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan<span style="color: red;"> CTRL </span> Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Diinginkan Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span><span style="color: red;"> Jika Tidak Ada Perubahan Foto Anda Tidak Perlu Menginputkan Lagi!! (KOSONGKAN SAJA).</span>
                                    </small>

                                    <?php if (!empty($tb_barang['path_file_foto_barang'])) : ?>
                                        <input type="hidden" name="old_path_file_foto_barang" value="<?= esc($tb_barang['path_file_foto_barang'], 'attr'); ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('/admin/barang/cek_data/' . urlencode($tb_barang['slug'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-times"></i> Batal Ubah
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-md edit"><i class="fas fa-save"></i> Simpan Perubahan Data</button>
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
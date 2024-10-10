<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }

    .separator-radio {
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Form Permohonan Informasi Publik</a></li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Pemohon Informasi Publik</h2>

                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                    <?= session()->getFlashdata('pesan') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('gagal')) : ?>
                                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                    <?= session()->getFlashdata('gagal') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="/admin/permohonan/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_kategori" class="col-form-label">Kategori Pengajuan :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori')) ? 'is-invalid' : ''; ?>" id="id_kategori" name="id_kategori" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori Pengajuan --</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kategori as $value) : ?>
                                                <option value="<?= $value['id_kategori'] ?>" <?= old('id_kategori') == $value['id_kategori'] ? 'selected' : ''; ?>>
                                                    <?= $value['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_kategori'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_lembaga" class="col-form-label">Nama SKPD :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_lembaga')) ? 'is-invalid' : ''; ?>" id=" id_lembaga" name="id_lembaga" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih SKPD Tujuan --</option>
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
                                </div>

                                <div class="mb-3">
                                    <label for="nik" class="col-form-label">NIK/No. Identitas Pribadi :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" placeholder="Masukkan NIK/No. Identitas Pribadi Anda" style="background-color: white;" autofocus value="<?= old('nik'); ?>" required>
                                        <small class="form-text text-muted">Cek Kembali NIK Anda (Wajib 16 Digit)</small>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nik'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_pemohon" class="col-form-label">Nama Lengkap :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_pemohon')) ? 'is-invalid' : ''; ?>" id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" value="<?= old('nama_pemohon'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_pemohon'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_pengajuan" class="col-form-label">Tanggal Pengajuan :</label>
                                        <input type="date" class="form-control  <?= ($validation->hasError('tanggal_pengajuan')) ? 'is-invalid' : ''; ?>" name="tanggal_pengajuan" id="tanggal_pengajuan" style="background-color: white;"><? old('tanggal_pengajuan'); ?></input>

                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_pengajuan'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" required name="alamat" placeholder="Masukkan Alamat Lengkap Anda" id="alamat" cols="30" rows="5" style="background-color: white;"><?php echo old('alamat'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="email" class="col-form-label">Email :</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" value="<?= old('email'); ?>">
                                            <small class="form-text text-muted">Pastikan Email Anda Aktif Untuk Mempermudah Proses Verifikasi</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon :</label>
                                        <div class="col-sm-12">
                                            <input type="no_telepon" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Aktif Anda" style="background-color: white;" value="<?= old('no_telepon'); ?>">
                                            <small class="form-text text-muted">Pastikan Nomor Telepon Anda Aktif (Bisa No HP / Whatsapp)</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telepon'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pekerjaan" class="col-form-label">Pekerjaan :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' : ''; ?>" id="pekerjaan" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" style="background-color: white;" value="<?= old('pekerjaan'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pekerjaan'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_ktp" class="col-form-label">Upload File Ktp :</label>
                                    <input type="file" accept="application/pdf" class="form-control <?= ($validation->hasError('file_ktp')) ? 'is-invalid' : ''; ?>" id="file_ktp" name="file_ktp" style="background-color: white;" <?= (old('file_ktp')) ? 'disabled' : 'required'; ?>>
                                    <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('file_ktp'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator" id="surat_kuasa_container">
                                        <label for="surat_kuasa" class="col-form-label">Upload Surat Kuasa :</label>
                                        <input type="file" accept="application/pdf" class="form-control custom-border" id="surat_kuasa" name="surat_kuasa" style="background-color: white;" <?= (old('surat_kuasa')) ? 'disabled' : 'required'; ?>>
                                        <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                        <div class="invalid-feedback" id="fileError">
                                            Kolom File Surat Kuasa Tidak Boleh Kosong
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="akta_notaris_lembaga_container">
                                        <label for="akta_notaris_lembaga" class="col-form-label">Upload Akta Notaris Lembaga / Organisasi :</label>
                                        <input type="file" accept="application/pdf" class="form-control custom-border" id="akta_notaris_lembaga" name="akta_notaris_lembaga" style="background-color: white;" <?= (old('akta_notaris_lembaga')) ? 'disabled' : 'required'; ?>>
                                        <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                        <div class="invalid-feedback" id="fileError">
                                            Kolom File Akta Notaris Lembaga / Organisasi Tidak Boleh Kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator" id="file_pendirian_lembaga_container">
                                        <label for="file_pendirian_lembaga" class="col-form-label">Upload Surat Pendirian Lembaga / Organisasi :</label>
                                        <input type="file" accept="application/pdf" class="form-control custom-border" id="file_pendirian_lembaga" name="file_pendirian_lembaga" style="background-color: white;" <?= (old('file_pendirian_lembaga')) ? 'disabled' : 'required'; ?>>
                                        <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                        <div class="invalid-feedback" id="fileError">
                                            Kolom File Pendirian Lembaga Tidak Boleh Kosong
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3" id="surat_kesbangpol_container">
                                        <label for="surat_kesbangpol" class="col-form-label">Upload Surat KESBANGPOL :</label>
                                        <input type="file" accept="application/pdf" class="form-control custom-border" id="surat_kesbangpol" name="surat_kesbangpol" style="background-color: white;" <?= (old('surat_kesbangpol')) ? 'disabled' : 'required'; ?>>
                                        <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                        <div class="invalid-feedback" id="fileError">
                                            Kolom File Surat Kesbangpol Tidak Boleh Kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="rincian_informasi" class="col-form-label">Rincian Informasi :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('rincian_informasi')) ? 'is-invalid' : ''; ?>" required name="rincian_informasi" placeholder="Masukkan Rincian Informasi" id="rincian_informasi" cols="30" rows="5" style="background-color: white;"><?php echo old('rincian_informasi'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('rincian_informasi'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tujuan" class="col-form-label">Tujuan Penggunaan Informasi :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>" required name="tujuan" placeholder="Masukkan Tujuan Penggunaan Informasi" id="tujuan" cols="30" rows="5" style="background-color: white;"><?php echo old('tujuan'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tujuan'); ?>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-4 mb-3 separator">
                                                <label for="id_memperoleh_informasi" class="col-form-label">Cara Memperoleh Informasi :</label>
                                                <div id="cara_mendapat_salinan_informasi">
                                                    <!-- Populasi radio buttons dengan data dari controller -->
                                                    <?php foreach ($tb_memperoleh as $value) : ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input <?= ($validation->hasError('id_memperoleh_informasi')) ? 'is-invalid' : ''; ?>" type="radio" name="id_memperoleh_informasi" id="cara_<?= $value['id_memperoleh_informasi'] ?>" value="<?= $value['id_memperoleh_informasi'] ?>" <?= old('id_memperoleh_informasi') == $value['id_memperoleh_informasi'] ? 'checked' : ''; ?> required>
                                                            <label class="form-check-label" for="cara_<?= $value['id_memperoleh_informasi'] ?>">
                                                                <?= $value['deskripsi'] ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('id_memperoleh_informasi'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3 separator">
                                                <label for="id_mendapat_salinan_informasi" class="col-form-label">Mendapat Salinan Informasi :</label>
                                                <div id="cara_mendapat_salinan_informasi">
                                                    <!-- Populasi radio buttons dengan data dari controller -->
                                                    <?php foreach ($tb_mendapat as $value) : ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input <?= ($validation->hasError('id_mendapat_salinan_informasi')) ? 'is-invalid' : ''; ?>" type="radio" name="id_mendapat_salinan_informasi" id="cara_<?= $value['id_mendapat_salinan_informasi'] ?>" value="<?= $value['id_mendapat_salinan_informasi'] ?>" <?= old('id_mendapat_salinan_informasi') == $value['id_mendapat_salinan_informasi'] ? 'checked' : ''; ?> required>
                                                            <label class="form-check-label" for="cara_<?= $value['id_mendapat_salinan_informasi'] ?>">
                                                                <?= $value['deskripsi'] ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('id_mendapat_salinan_informasi'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="id_cara_mendapat_salinan_informasi" class="col-form-label">Cara Mendapat Salinan Informasi :</label>
                                                <div id="cara_mendapat_salinan_informasi">
                                                    <!-- Populasi radio buttons dengan data dari controller -->
                                                    <?php foreach ($tb_cara_mendapat_salinan_informasi as $value) : ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input <?= ($validation->hasError('id_cara_mendapat_salinan_informasi')) ? 'is-invalid' : ''; ?>" type="radio" name="id_cara_mendapat_salinan_informasi" id="cara_<?= $value['id_cara_mendapat_salinan_informasi'] ?>" value="<?= $value['id_cara_mendapat_salinan_informasi'] ?>" <?= old('id_cara_mendapat_salinan_informasi') == $value['id_cara_mendapat_salinan_informasi'] ? 'checked' : ''; ?> required>
                                                            <label class="form-check-label" for="cara_<?= $value['id_cara_mendapat_salinan_informasi'] ?>">
                                                                <?= $value['deskripsi'] ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('id_cara_mendapat_salinan_informasi'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/permohonan" class="btn btn-secondary btn-md ml-3">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriPengajuan = document.getElementById('id_kategori');
        const suratKuasaContainer = document.getElementById('surat_kuasa_container');
        const aktaNotarisLembagaContainer = document.getElementById('akta_notaris_lembaga_container');
        const filePendirianLembagaContainer = document.getElementById('file_pendirian_lembaga_container');
        const suratKesbangpolContainer = document.getElementById('surat_kesbangpol_container');

        function toggleFields() {
            const selectedText = kategoriPengajuan.options[kategoriPengajuan.selectedIndex].text;

            if (selectedText === 'Perorangan') {
                suratKuasaContainer.style.display = 'none';
                aktaNotarisLembagaContainer.style.display = 'none';
                filePendirianLembagaContainer.style.display = 'none';
                suratKesbangpolContainer.style.display = 'none';
            } else if (selectedText === 'Kelompok Orang') {
                suratKuasaContainer.style.display = 'block';
                aktaNotarisLembagaContainer.style.display = 'none';
                filePendirianLembagaContainer.style.display = 'none';
                suratKesbangpolContainer.style.display = 'none';
            } else {
                suratKuasaContainer.style.display = 'block';
                aktaNotarisLembagaContainer.style.display = 'block';
                filePendirianLembagaContainer.style.display = 'block';
                suratKesbangpolContainer.style.display = 'block';
            }
        }

        kategoriPengajuan.addEventListener('change', toggleFields);

        // Initial check
        toggleFields();
    });
</script>
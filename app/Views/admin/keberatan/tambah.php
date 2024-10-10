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

    .form-check {
        margin-bottom: 10px;
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Pengajuan Keberatan Informasi Publik</h2>

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

                            <form action="/admin/keberatan/save" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" autofocus value="<?= old('nama'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon :</label>
                                        <div class="col-sm-12">
                                            <input type="no_telepon" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Aktif Anda" style="background-color: white;" value="<?= old('no_telepon'); ?>">
                                            <small class="form-text text-muted">Pastikan Nomor Telepon Anda Aktif (Bisa No HP / Whatsapp)</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telepon'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="col-form-label">Email :</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" value="<?= old('email'); ?>">
                                            <small class="form-text text-muted">Pastikan Email Anda Aktif Untuk Mempermudah Proses Verifikasi</small>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" required name="alamat" placeholder="Masukkan alamat lengkap Anda" id="alamat" cols="30" rows="5" style="background-color: white;"><?php echo old('alamat'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('alamat'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="ringkasan_kasus" class="col-form-label">Kasus Posisi (Ringkasan Mengenai Kasus) :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('ringkasan_kasus')) ? 'is-invalid' : ''; ?>" name="ringkasan_kasus" placeholder="Masukkan Ringkasan Kasus lengkap Anda" id="ringkasan_kasus" cols="30" rows="5" style="background-color: white;"><?php echo old('ringkasan_kasus'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('ringkasan_kasus'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_keberatan" class="col-form-label">Upload File Keberatan (Jika Ada) :</label>
                                    <input type="file" accept="application/pdf" class="form-control <?= ($validation->hasError('file_keberatan')) ? 'is-invalid' : ''; ?>" id="file_keberatan" name="file_keberatan" style="background-color: white;" <?= (old('file_keberatan')) ? 'disabled' : 'required'; ?>>
                                    <small class="form-text text-muted">Pastikan file yang diunggah berbentuk PDF</small>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Alasan Keberatan :</label>
                                    <small class="form-text text-muted"> (Dapat Memilih Banyak Alasan)</small>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php foreach ($tb_alasan as $index => $value) : ?>
                                                <?php if ($index > 0 && $index % 6 == 0) : ?>
                                        </div>
                                        <div class="row">
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input <?= ($validation->hasError('id_alasan')) ? 'is-invalid' : ''; ?>" type="checkbox" id="id_alasan_<?= $value['id_alasan'] ?>" name="id_alasan[]" value="<?= $value['id_alasan'] ?>" <?= in_array($value['id_alasan'], old('id_alasan', [])) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="id_alasan_<?= $value['id_alasan'] ?>">
                                                    <?= $value['deskripsi'] ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_alasan'); ?>
                                        </div>
                                        <p id="selected-count">Jumlah Alasan yang Dipilih: <span id="count">0</span></p>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/keberatan" class="btn btn-secondary btn-md ml-3">
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
        // Ambil elemen select
        var selectElement = document.getElementById('id_alasan');

        // Event listener untuk memantau perubahan pada elemen select
        selectElement.addEventListener('click', function(event) {
            // Jika opsi yang dipilih tidak memiliki atribut selected, tambahkan atribut selected
            if (!event.target.hasAttribute('selected')) {
                event.target.setAttribute('selected', '');
            } else {
                // Jika opsi yang dipilih memiliki atribut selected, hapus atribut selected
                event.target.removeAttribute('selected');
            }
        });
    });
</script>

<script>
    // Ambil semua checkbox dengan nama "id_alasan[]"
    const checkboxes = document.querySelectorAll('input[name="id_alasan[]"]');

    // Inisialisasi jumlah alasan yang dipilih
    let selectedCount = 0;

    // Event listener untuk setiap checkbox
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                selectedCount++; // Jika checkbox diceklis, tambahkan 1 ke jumlah alasan yang dipilih
            } else {
                selectedCount--; // Jika checkbox tidak diceklis, kurangi 1 dari jumlah alasan yang dipilih
            }
            document.getElementById('count').innerText = selectedCount; // Update tampilan jumlah alasan yang dipilih
        });
    });
</script>
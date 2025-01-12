<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

<!-- Sidebar dinonaktifkan untuk mencegah interaksi -->
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Edit Data Pengurus</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pengurus</a></li>
                                <li class="breadcrumb-item active">Formulir Edit Data Pengurus</li>
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
                            <h2 class="text-center mb-4">Formulir Edit Data Pengurus</h2>
                            <form action="/admin/foto-pengurus/update/<?= $pengurus['id']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>
                                <!-- <input type="hidden" name="_method" value="PUT"> -->

                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama', $pengurus['nama']); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                    </div>
                                </div>

                                <!-- Foto -->
                                <div class="mb-3">
                                    <label for="foto" class="col-form-label">Foto:</label>
                                    <!-- Tampilkan foto lama jika ada -->
                                    <?php if ($pengurus['foto']): ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url( $pengurus['foto']); ?>" alt="Foto Pengurus" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" accept="image/*">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto'); ?>
                                    </div>
                                </div>

                                <!-- Posisi -->
                                <div class="mb-3">
                                    <label for="posisi" class="col-form-label">Posisi:</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('posisi')) ? 'is-invalid' : ''; ?>" id="posisi" name="posisi" value="<?= old('posisi', $pengurus['posisi']); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('posisi'); ?>
                                    </div>
                                </div>

                                <!-- Divisi -->
                                <div class="mb-3">
                                    <label for="divisi" class="col-form-label">Divisi:</label>
                                    <select class="form-control <?= ($validation->hasError('divisi')) ? 'is-invalid' : ''; ?>" id="divisi" name="divisi">
                                        <option value="">-- Pilih Divisi --</option>
                                        <option value="BPH" <?= (old('divisi', $pengurus['divisi']) == 'BPH') ? 'selected' : ''; ?>>BPH</option>
                                        <option value="Kerohanian" <?= (old('divisi', $pengurus['divisi']) == 'Kerohanian') ? 'selected' : ''; ?>>Kerohanian</option>
                                        <option value="Kerumahtanggaan" <?= (old('divisi', $pengurus['divisi']) == 'Kerumahtanggaan') ? 'selected' : ''; ?>>Kerumahtanggaan</option>
                                        <option value="Humas" <?= (old('divisi', $pengurus['divisi']) == 'Humas') ? 'selected' : ''; ?>>Humas</option>
                                        <option value="Talenta Olahraga" <?= (old('divisi', $pengurus['divisi']) == 'Talenta Olahraga') ? 'selected' : ''; ?>>Talenta Olahraga</option>
                                        <option value="Talenta Musik" <?= (old('divisi', $pengurus['divisi']) == 'Talenta Musik') ? 'selected' : ''; ?>>Talenta Musik</option>
                                        <option value="Talenta Pertunjukan" <?= (old('divisi', $pengurus['divisi']) == 'Talenta Pertunjukan') ? 'selected' : ''; ?>>Talenta Pertunjukan</option>
                                        <option value="Usaha Dana" <?= (old('divisi', $pengurus['divisi']) == 'Usaha Dana') ? 'selected' : ''; ?>>Usaha Dana</option>
                                        <option value="Litbang" <?= (old('divisi', $pengurus['divisi']) == 'Litbang') ? 'selected' : ''; ?>>Litbang</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('divisi'); ?>
                                    </div>
                                </div>

                                <!-- Tanggal Pembuatan -->
                                <div class="mb-3">
                                    <label for="created_at" class="col-form-label">Tanggal Dibuat:</label>
                                    <input type="date" class="form-control <?= ($validation->hasError('created_at')) ? 'is-invalid' : ''; ?>" id="created_at" name="created_at" value="<?= old('created_at', $pengurus['created_at']); ?>" readonly>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('created_at'); ?>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="modal-footer">
                                    <a href="/admin/foto-pengurus" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Simpan Perubahan</button>
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
<?= $this->include('admin/layouts/script2') ?>

<?= $this->include('admin/layouts/script') ?>
<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

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
                            <form action="/admin/galeri-kegiatan/update/<?= $kegiatan['id_kegiatan']; ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="old_foto_kegiatan" value="<?= $kegiatan['foto_kegiatan']; ?>">

                                <div class="mb-3">
                                    <label for="judul_kegiatan" class="col-form-label">Judul Kegiatan:</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('judul_kegiatan')) ? 'is-invalid' : ''; ?>" 
                                           id="judul_kegiatan" 
                                           name="judul_kegiatan" 
                                           value="<?= old('judul_kegiatan', $kegiatan['judul_kegiatan']); ?>" 
                                           placeholder="Masukkan Judul Kegiatan">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('judul_kegiatan'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                    <textarea class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" 
                                              id="deskripsi" 
                                              name="deskripsi" 
                                              placeholder="Masukkan Deskripsi"
                                              rows="5"><?= old('deskripsi', $kegiatan['deskripsi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto_kegiatan" class="col-form-label">Foto Kegiatan:</label>
                                    <input type="file" class="form-control <?= ($validation->hasError('foto_kegiatan')) ? 'is-invalid' : ''; ?>" 
                                           id="foto_kegiatan" 
                                           name="foto_kegiatan" 
                                           accept="image/*">
                                    <small class="text-muted">File saat ini: <a href="/<?= $kegiatan['foto_kegiatan']; ?>" target="_blank">Lihat Foto</a></small>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto_kegiatan'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_foto" class="col-form-label">Tanggal Foto:</label>
                                    <input type="date" class="form-control <?= ($validation->hasError('tanggal_foto')) ? 'is-invalid' : ''; ?>" 
                                           id="tanggal_foto" 
                                           name="tanggal_foto" 
                                           value="<?= old('tanggal_foto', $kegiatan['tanggal_foto']); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_foto'); ?>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="/admin/galeri-kegiatan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
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

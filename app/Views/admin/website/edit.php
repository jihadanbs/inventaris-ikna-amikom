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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Website Wilayah</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Website Wilayah</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Website Wilayah</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Website Wilayah</h2>
                            <form action="/admin/website/update/<?= $tb_wilayah->id_wilayah; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_wilayah" class="col-form-label">Nama Wilayah / Website :</label>
                                        <input type="text" class="form-control custom-border <?= ($validation->hasError('nama_wilayah')) ? 'is-invalid' : ''; ?>" id="nama_wilayah" style="background-color: white;" placeholder="Masukkan Nama Wilayah" value="<?= old('nama_wilayah', $tb_wilayah->nama_wilayah); ?>" name="nama_wilayah"></input>
                                        <small class="form-text text-muted">Isikan Singkat saja (Maksimal 2-3 Kalimat). Cth : Kabupaten Pesawaran</small>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_wilayah'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="link_wilayah" class="col-form-label">Link Website :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">https://</span>
                                            </div>
                                            <input type="url" class="form-control custom-border <?= ($validation->hasError('link_wilayah')) ? 'is-invalid' : ''; ?>" required name="link_wilayah" id="link_wilayah" placeholder="Masukkan Link Website Wilayah" value="<?= old('link_wilayah', $tb_wilayah->link_wilayah); ?>" style="background-color: white;">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('link_wilayah'); ?>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Masukkan Link Lengkap. Cth : https://pesawarankab.go.id/</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar_wilayah" class="col-form-label">Gambar Wilayah / Website</label>
                                    <input type="file" accept="image/*" class="form-control" id="gambar_wilayah" name="gambar_wilayah" style="background-color: white;" <?= (old('gambar_wilayah')) ? 'disabled' : 'required'; ?>>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_wilayah->gambar_wilayah)) : ?>
                                        <p>File exists: <?= $tb_wilayah->gambar_wilayah ?></p>
                                        <input type="hidden" name="old_gambar_wilayah" value="<?= $tb_wilayah->gambar_wilayah; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/website/cek_data/<?= $tb_wilayah->id_wilayah ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Batal
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
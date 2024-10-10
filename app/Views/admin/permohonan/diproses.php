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
                        <h4 class="mb-sm-0 font-size-18">Formulir Pemrosesan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Form Pemrosesan Permohonan Informasi Publik</a></li>
                                <li class="breadcrumb-item active">Formulir Pemrosesan</li>
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
                            <h2 class="text-center mb-4">Formulir Pemrosesan Permohonan Informasi Publik</h2>

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

                            <form action="/admin/permohonan/proses/<?= $pemohon->id_pemohon ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nik" class="col-form-label">NIK :</label>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nik" style="background-color: #C7C8CC;" name="nik" value="<?= old('nik', $pemohon->nik); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pemohon" class="col-form-label">Nama Lengkap :</label>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama_pemohon" style="background-color: #C7C8CC;" name="nama_pemohon" value="<?= old('nama_pemohon', $pemohon->nama_pemohon); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email :</label>
                                    <div class="col-sm-12">
                                        <input disabled type="text" class="form-control" id="email" style="background-color: #C7C8CC;" name="email" value="<?= old('email', $pemohon->email); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_kategori" class="col-form-label">Kategori Pengajuan :</label>
                                        <select class="form-select custom-border" id="id_kategori" name="id_kategori" aria-label="Default select example" style="background-color: #C7C8CC;" disabled>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori --</option>
                                            <?php foreach ($tb_pemohon as $value) : ?>
                                                <?php $selected = ($value->id_kategori == old('id_kategori', $tb_pemohon[0]->id_kategori)) ? 'selected' : ''; ?>
                                                <option value="<?= htmlspecialchars($value->id_kategori) ?>" <?= $selected ?>><?= htmlspecialchars($value->nama_kategori) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_lembaga" class="col-form-label">SKPD Tujuan :</label>
                                        <select class="form-select custom-border" id="id_lembaga" name="id_lembaga" aria-label="Default select example" style="background-color: #C7C8CC;" disabled>
                                            <option value="" selected disabled>Silahkan Pilih Nama Lembaga --</option>
                                            <?php foreach ($tb_pemohon as $value) : ?>
                                                <?php $selected = ($value->id_lembaga == old('id_lembaga', $tb_pemohon[0]->id_lembaga)) ? 'selected' : ''; ?>
                                                <option value="<?= htmlspecialchars($value->id_lembaga) ?>" <?= $selected ?>><?= htmlspecialchars($value->nama_dinas) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="rincian_informasi" class="col-form-label">Rincian Informasi :</label>
                                    <textarea disabled class="form-control custom-border" id="rincian_informasi" cols="30" rows="5" style="background-color: #C7C8CC;" name="rincian_informasi"><?= old('rincian_informasi', $pemohon->rincian_informasi); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tujuan" class="col-form-label">Tujuan Penggunaan Informasi :</label>
                                    <textarea disabled class="form-control custom-border" id="tujuan" cols="30" rows="5" style="background-color: #C7C8CC;" name="tujuan"><?= old('tujuan', $pemohon->tujuan); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_diproses" class="col-form-label">Tanggal Pemrosesan :</label>
                                    <input type="date" class="form-control  <?= ($validation->hasError('tanggal_diproses')) ? 'is-invalid' : ''; ?>" name="tanggal_diproses" id="tanggal_diproses" style="background-color: white;"><? old('tanggal_diproses'); ?></input>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggal_diproses'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="col-form-label">Catatan Pemrosesan :</label>
                                    <textarea autofocus class="form-control custom-border <?= ($validation->hasError('catatan')) ? 'is-invalid' : ''; ?>" required name="catatan" placeholder="Masukkan Catatan Pemrosesan" id="catatan" cols="30" rows="5" style="background-color: white;"><?php echo old('catatan'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('catatan'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/permohonan/cek_data/<?= $pemohon->id_pemohon ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-md ml-3" style="margin-left: 10px;">
                                        <i class="fas fa-hourglass-half"></i> Proses
                                    </button>
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
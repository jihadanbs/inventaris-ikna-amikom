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
                        <h4 class="mb-sm-0 font-size-18">Formulir Keberatan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Form Penolakan Keberatan Informasi Publik</a></li>
                                <li class="breadcrumb-item active">Formulir Keberatan</li>
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
                            <h2 class="text-center mb-4">Formulir Penolakan Keberatan Informasi Publik</h2>

                            <form action="/admin/keberatan/reject/<?= $keberatan['id_keberatan'] ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama" style="background-color: #C7C8CC;" name="nama" value="<?= old('nama', $keberatan['nama']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="col-form-label">Email :</label>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="email" style="background-color: #C7C8CC;" name="email" value="<?= old('email', $keberatan['email']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="ringkasan_kasus" class="col-form-label">Ringkasan Kasus :</label>
                                    <textarea disabled class="form-control custom-border" id="ringkasan_kasus" cols="30" rows="5" style="background-color: #C7C8CC;" name="ringkasan_kasus"><?= old('ringkasan_kasus', $keberatan['ringkasan_kasus']); ?></textarea>
                                </div>

                                <tr>
                                    <th style="font-size: 1.0rem;">Alasan Yang Dipilih</th>
                                    <th class="text-center" style="font-size: 1.0rem;">:</th>
                                    <td>
                                        <?php if (empty($keberatan['deskripsi'])) : ?>
                                            <span class="badge bg-danger" style="font-size: 0.75em;">Tidak ada alasan yang di pilih</span>
                                        <?php else : ?>
                                            <?php
                                            $deskripsiList = explode(", ", $keberatan['deskripsi']);
                                            foreach ($deskripsiList as $deskripsi) :
                                            ?>
                                                <span class="badge bg-success" style="font-size: 0.75rem;"><?= $deskripsi ?></span>
                                            <?php endforeach; ?>
                                            <br><br>
                                            <span class="badge bg-primary" style="font-size: 0.75rem;">Jumlah alasan : <?= count($deskripsiList) ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <div class="mb-3">
                                    <label for="tanggapan" class="col-form-label">Tanggapan :</label>
                                    <textarea autofocus class="form-control custom-border <?= ($validation->hasError('tanggapan')) ? 'is-invalid' : ''; ?>" required name="tanggapan" placeholder="Masukkan tanggapan" id="tanggapan" cols="30" rows="5" style="background-color: white;"><?php echo old('tanggapan'); ?></textarea>
                                    <small class="form-text text-muted">Tanggapan Tidak Boleh Dikosongkan Pada Tahap Ini</small>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tanggapan'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="/admin/keberatan/cek_data/<?= $keberatan['id_keberatan'] ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-md ml-3" style="margin-left: 10px;">
                                        <i class="fas fa-times"></i> Tolak
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
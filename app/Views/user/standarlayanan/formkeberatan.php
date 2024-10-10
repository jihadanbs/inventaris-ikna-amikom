<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<div class="container-fluid standarlayanan pb-5" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">Form Keberatan</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Prosedur Pengajuan Keberatan Informasi Publik</h4>
        <div class="sop">
            <?php if (isset($keberatan) && !empty($keberatan)) : ?>
                <img src="<?= base_url($keberatan) ?>" alt="keberatan" />
            <?php else : ?>
                <p>Gambar Prosedur Pengajuan Keberatan Informasi Publik</p>
            <?php endif; ?>
        </div>

        <?php if (isset($keberatan) && !empty($keberatan)) : ?>
            <p><strong>Prosedur Pengajuan Keberatan Informasi Publik </strong><a href="<?= base_url($keberatan) ?>" download>disini</a></p>
        <?php else : ?>
            <p><strong>Prosedur Pengajuan Keberatan Informasi Publik </strong><a href="<?= base_url('assets/img/sop.png') ?>" download>disini</a></p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid standarlayanan2 p-5">
    <div class="container pt-5">
        <h4 style="font-weight: 700;">Alasan Pengajuan Keberatan<span style="color: red;">*</span></h4>
    </div>
    <form id="formKeberatan" action="/admin/keberatan/kirim" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row">
            <?php foreach ($tb_alasan as $index => $value) : ?>
                <?php if ($index > 0 && $index % 2 == 0) : ?>
        </div>
        <div class="row">
        <?php endif; ?>
        <div class="col-md-6 fw-bold">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="<?= $value['id_alasan'] ?>" id="id_alasan_<?= $value['id_alasan'] ?>" name="id_alasan[]">
                <label class="form-check-label" for="id_alasan_<?= $value['id_alasan'] ?>">
                    <?= $value['deskripsi'] ?></label>
            </div>
        </div>
    <?php endforeach; ?>
        </div>


        <div class="container pt-5">
            <h4 style="font-weight: 700;">Identitas Kuasa Pemohon (jika ada)</h4>
        </div>
        <div class="row">
            <div class="col-md-6 fw-bold">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="nama_keberatan form-control" name="nama" id="nama" placeholder="Masukkan Nama Lengkap Anda" style="border-width: 2px;">
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="alamat_keberatan form-control mt-2" name="alamat" id="alamat" rows="5" placeholder="Masukkan Alamat Anda" style="border-width: 2px;"></textarea>
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="no_telepon_keberatan form-control" name="no_telepon" id="no_telepon" placeholder="Masukkan Nomor Telepon Anda" style="border-width: 2px;">
                </div>
            </div>

            <div class="col-md-6 fw-bold">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="email_keberatan form-control" name="email" id="email" placeholder="Masukkan Nomor Telepon Anda" style="border-width: 2px;">
                    <label for="email" class="form-label" style="font-size: 12px;">Nb : Pastikan Email Anda Aktif Untuk Mempermudah Pengiriman Status</label>
                </div>
                <div class="mb-3">
                    <label for="ringkasan_kasus">Kasus Posisi (ringkasan mengenai kasus)<span style="color: red;">*</span></label>
                    <textarea class="ringkasan_kasus form-control mt-2" name="ringkasan_kasus" id="ringkasan_kasus" rows="5" style="border-width: 2px;" placeholder="Masukkan Ringkasan Kasus"></textarea>
                </div>
                <div class="mb-3">
                    <label for="file_keberatan" class="form-label">Upload Surat Keberatan (jika ada)</label>
                    <input class="upload form-control" type="file" accept="application/pdf" name="file_keberatan" id="file_keberatan" style="border-width: 2px;">
                    <label for="file_keberatan" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="d-flex justify-content-center">
                <button class="btn" style="background-color: #28527A; color:white; box-shadow: 0px 3px 4px 0px #8AC4D0; font-size:20px; border-radius:10px" id="formKeberatan" type="submit">Ajukan Keberatan</button>
            </div>
        </div>
    </form>

</div>

<?= $this->endSection(''); ?>
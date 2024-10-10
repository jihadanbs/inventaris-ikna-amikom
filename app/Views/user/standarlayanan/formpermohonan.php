<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<div class="container-fluid standarlayanan pb-5" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color: black;">Form Permohonan</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Prosedur Permohonan Informasi Publik</h4>
        <div class="sop">
            <?php if (isset($permohonan) && !empty($permohonan)) : ?>
                <img src="<?= base_url($permohonan) ?>" alt="permohonan" />
            <?php else : ?>
                <p>Gambar Prosedur Permohonan Informasi Publik</p>
            <?php endif; ?>
        </div>

        <?php if (isset($permohonan) && !empty($permohonan)) : ?>
            <p><strong>Prosedur Permohonan Informasi Publik </strong><a href="<?= base_url($permohonan) ?>" download>disini</a></p>
        <?php else : ?>
            <p><strong>Prosedur Permohonan Informasi Publik </strong><a href="<?= base_url('assets/img/prosedurpermohonan.png') ?>" download>disini</a></p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid standarlayanan2 pt-3 pb-5">
    <div class="container text-center">
        <h4 class="mb-5" style="font-weight: 700; font-size: 30px;">Form Permohonan Informasi Publik</h4>
    </div>
    <form id="formpermohonan" action="/admin/permohonan/kirim" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row">

            <div class=" col-md-6" style="padding-left: 20px; padding-right: 20px;">
                <div class="pl-6 mb-3" style="font-weight: 600;">
                    <label for="id_kategori" class="form-label">Kategori Permohonan<span style="color: red;">*</span></label>
                    <select class="kategori form-select" aria-label="Default select example" name="id_kategori" id="id_kategori">
                        <option value="" selected>Silahkan Pilih Nama Kategori Pengajuan</option>
                        <!-- Populasi opsi dropdown dengan data dari controller -->
                        <?php foreach ($tb_kategori as $value) : ?>
                            <option value="<?= $value['id_kategori'] ?>" <?= old('id_kategori') == $value['id_kategori'] ? 'selected' : ''; ?>>
                                <?= $value['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="id_lembaga" class="form-label">SKPD Tujuan<span style="color: red;">*</span></label>
                    <select class="skpd form-select" aria-label="Default select example" name="id_lembaga" id="id_lembaga">
                        <option value="" selected>Silahkan Pilih SKPD Tujuan</option>
                        <!-- Populasi opsi dropdown dengan data dari controller -->
                        <?php foreach ($tb_lembaga as $value) : ?>
                            <option value="<?= $value['id_lembaga'] ?>" <?= old('id_lembaga') == $value['id_lembaga'] ? 'selected' : ''; ?>>
                                <?= $value['nama_dinas'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="nik" class="form-label">NIK/No. Identitas Pribadi<span style="color: red;">*</span></label>
                    <input type="text" class="nik form-control" name="nik" id="nik" placeholder="Masukkan NIK/No. Identitas Pribadi">
                    <label for="nik" class="form-label" style="font-size: 12px;">Nb : Cek Kembali NIK Anda (Wajib 16 Digit)</label>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="nama_pemohon" class="form-label">Nama Lengkap<span style="color: red;">*</span></label>
                    <input type="text" class="nama form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Masukkan Nama Lengkap Anda">
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan<span style="color: red;">*</span></label>
                    <input type="date" class="tanggal form-control" name="tanggal_pengajuan" id="tanggal_pengajuan">
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="alamat">Alamat<span style="color: red;">*</span></label>
                    <textarea class="alamat form-control" name="alamat" id="alamat" rows="5" placeholder="Masukkan Alamat Anda"></textarea>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="email" class="form-label">Email<span style="color: red;">*</span></label>
                    <input type="email" class="email form-control" name="email" id="email" placeholder="Masukkan Alamat Email Anda">
                    <label for="email" class="form-label" style="font-size: 12px;">Nb : Pastikan Email Anda Aktif Untuk Mempermudah Pengiriman Status</label>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="no_telepon" class="form-label">Nomor Telepon<span style="color: red;">*</span></label>
                    <input type="text" class="telp form-control" name="no_telepon" id="no_telepon" placeholder="Masukkan Nomor Telepon Anda">
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="pekerjaan" class="form-label">Pekerjaan<span style="color: red;">*</span></label>
                    <input type="text" class="pekerjaan form-control" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan Anda">
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="file_ktp" class="form-label">Upload Foto KTP<span style="color: red;">*</span></label>
                    <input class="upload form-control" accept="application/pdf" type="file" name="file_ktp" id="file_ktp" style="border-width: 2px;">
                    <label for="file_ktp" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
                <div id="surat_kuasa_container" class="mb-3" style="font-weight: 600; display:none;">
                    <label for="surat_kuasa" class="form-label">Upload Surat Kuasa<span style="color: red;">*</span></label>
                    <input class="upload-kuasa form-control" type="file" accept="application/pdf" name="surat_kuasa" id="surat_kuasa" style="border-width: 2px;">
                    <label for="surat_kuasa" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
                <div id="akta_notaris_lembaga_container" class="mb-3" style="font-weight: 600; display:none;">
                    <label for="akta_notaris_lembaga" class="form-label">Upload Akta Notaris Lembaga / Organisasi<span style="color: red;">*</span></label>
                    <input class="upload-akta form-control" type="file" accept="application/pdf" name="akta_notaris_lembaga" id="akta_notaris_lembaga" style="border-width: 2px;">
                    <label for="akta_notaris_lembaga" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
            </div>
            <div class="col-md-6" style="padding-right: 20px; padding-left: 20px;">
                <div id="file_pendirian_lembaga_container" class="mb-3" style="font-weight: 600; display:none;">
                    <label for="file_pendirian_lembaga" class="form-label">Upload Surat Pendirian Lembaga / Organisasi<span style="color: red;">*</span></label>
                    <input class="upload-pendirian form-control" type="file" accept="application/pdf" name="file_pendirian_lembaga" id="file_pendirian_lembaga" style="border-width: 2px;">
                    <label for="file_pendirian_lembaga" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
                <div id="surat_kesbangpol_container" class="mb-3" style="font-weight: 600; display:none;">
                    <label for="surat_kesbangpol" class="form-label">Upload Surat KESBANGPOL<span style="color: red;">*</span></label>
                    <input class="upload-kesbangpol form-control" type="file" accept="application/pdf" name="surat_kesbangpol" id="surat_kesbangpol" style="border-width: 2px;">
                    <label for="surat_kesbangpol" class="form-label" style="font-size: 12px;">Max Upload 5 MB</label>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="rincian_informasi">Rincian Informasi<span style="color: red;">*</span></label>
                    <textarea class="rincian form-control" id="rincian_informasi" name="rincian_informasi" rows="5"></textarea>
                </div>
                <div class="mb-3" style="font-weight: 600;">
                    <label for="tujuan">Tujuan Penggunaan Informasi<span style="color: red;">*</span></label>
                    <textarea class="tujuan form-control" name="tujuan" id="tujuan" rows="5"></textarea>
                </div>

                <div class="mb-3" style="font-weight: 600;">
                    <label for="id_memperoleh_informasi" class="memperolehinformasi form-label" id="id_memperoleh_informasi">Cara Memperoleh Informasi<span style="color: red;">*</span></label>
                    <?php foreach ($tb_memperoleh as $value) : ?>
                        <div id="id_memperoleh_informasi" class="memperolehinformasi form-check">
                            <input class="memperolehinformasi form-check-input" type="radio" name="id_memperoleh_informasi" id="cara_<?= $value['id_memperoleh_informasi'] ?>" value="<?= $value['id_memperoleh_informasi'] ?>">
                            <label class="form-check-label" for="cara_<?= $value['id_memperoleh_informasi'] ?>">
                                <?= $value['deskripsi'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3" style="font-weight: 600;">
                    <label for="id_mendapat_salinan_informasi" id="salinan">Mendapatkan Salinan Informasi<span style="color: red;">*</span></label>
                    <!-- Populasi radio buttons dengan data dari controller -->
                    <?php foreach ($tb_mendapat as $value) : ?>
                        <div id="cara_mendapat_salinan_informasi" class="salinan form-check">
                            <input class="form-check-input" type="radio" name="id_mendapat_salinan_informasi" id="cara_<?= $value['id_mendapat_salinan_informasi'] ?>" value="<?= $value['id_mendapat_salinan_informasi'] ?>">
                            <label class="form-check-label" for="cara_<?= $value['id_mendapat_salinan_informasi'] ?>">
                                <?= $value['deskripsi'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3" style="font-weight: 600;">
                    <label for="id_cara_mendapat_salinan_informasi" class="form-label" id="mendapatsalinan">Cara Mendapatkan Salinan Informasi<span style="color: red;">*</span></label>
                    <!-- Populasi radio buttons dengan data dari controller -->
                    <?php foreach ($tb_cara_mendapat_salinan_informasi as $value) : ?>
                        <div id="cara_mendapat_salinan_informasi" class="mendapatsalinan form-check">
                            <input class="form-check-input" type="radio" name="id_cara_mendapat_salinan_informasi" id="cara_<?= $value['id_cara_mendapat_salinan_informasi'] ?>" value="<?= $value['id_cara_mendapat_salinan_informasi'] ?>">
                            <label class="form-check-label" for="cara_<?= $value['id_cara_mendapat_salinan_informasi'] ?>">
                                <?= $value['deskripsi'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="container mt-3">
                <div class="d-flex justify-content-center">
                    <button class="btn" style="background-color: #28527A; color:white; box-shadow: 0px 3px 4px 0px #8AC4D0; font-size:20px; border-radius:10px" id="alert3" type="submit">Ajukan Permohonan</button>
                </div>
            </div>
        </div>

    </form>

</div>

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

<?= $this->endSection(''); ?>
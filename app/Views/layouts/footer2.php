<div class="container-fluid pt-5 pb-3 kontak" id="kontak">
    <div class="container">
        <div class="row pb-3">
            <div class="col-md-3">
                <div class="text">
                    <h4 class=" fw-bold">Kontak Kami</h4>
                    <div class="iconn fw-bold"><img class="image-icon" src="<?= base_url('assets/img/Call.svg') ?>" />
                        Whatsapp
                    </div>
                    <!-- <p class="fw-normal">CP1. 083163636065<br>CP2. 083163636065</p> -->
                    <p class="fw-normal">
                        <?php if (isset($cp1) && isset($cp1->value)) : ?>
                            <a href="<?= esc($cp1->value) ?>" target="_blank" style="text-decoration: none; color:#28527A;">
                                <?= isset($cp1->name) ? esc($cp1->name) : 'Data tidak ditemukan'; ?>
                            </a>
                        <?php else : ?>
                            $Whatsapp1
                        <?php endif; ?>
                        <br>
                        <?php if (isset($cp2) && isset($cp2->value)) : ?>
                            <a href="<?= esc($cp2->value) ?>" target="_blank" style="text-decoration: none; color:#28527A;">
                                <?= isset($cp2->name) ? esc($cp2->name) : 'Data tidak ditemukan'; ?>
                            </a>
                        <?php else : ?>
                            $Whatsapp2
                        <?php endif; ?>
                    </p>

                </div>
                <div class="text">
                    <div class="iconn fw-bold"><img class="image-icon" src="<?= base_url('assets/img/Email.png') ?>" />
                        Alamat Email
                    </div>

                    <div class="email-section">
                        <p class="mx-auto fw-normal text-wrap text-break">
                            <?php if ($email !== 'Data tidak ditemukan') : ?>
                                <a href="mailto:<?= esc($email); ?>"><?= esc($email); ?></a>
                            <?php else : ?>
                                <?= esc($email); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="text">
                    <div class="iconn fw-bold"><img class="image-icon" src="<?= base_url('assets/img/Locationn.png') ?>" />
                        Alamat
                    </div>
                    <p class="mx-auto fw-normal">
                        <a href="<?= isset($alamat) ? esc($alamat) : '#'; ?>" target="_blank">
                            Komplek Perkantoran Pemerintah Daerah Kabupaten Pesawaran, Lampung
                        </a>
                    </p>
                </div>
                <div class="text">
                    <div class="iconn fw-bold"><img class="image-icon" src="<?= base_url('assets/img/jam.svg') ?>" />
                        Jam Operasional
                    </div>
                    <p class="fw-normal">Senin-Jumat : 08.00 s/d 16.00</p>
                </div>
            </div>
            <div class="col-md-3 fw-bold">
                <form action="/admin/feedback/send2" method="post" enctype="multipart/form-data" class="footer">
                    <?= csrf_field(); ?>
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama<span style="color: red;">*</span></label>
                        <input type="text" class="nama_feedback form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email<span style="color: red;">*</span></label>
                        <input type="text" class="email_feedback form-control" id="email" name="email" placeholder="Masukkan Email Anda">
                    </div>
                    <div class="mb-4">
                        <label for="no_telepon" class="form-label">Nomor Telepon<span style="color: red;">*</span></label>
                        <input type="text" class="no_telepon_feedback form-control" id="no_telepon" name="no_telepon" placeholder="No.Telpon yang bisa dihubungi">
                    </div>
                    <div class="mb-4">
                        <label for="subjek" class="form-label">Subjek<span style="color: red;">*</span></label>
                        <input type="text" class="subjek form-control" id="subjek" name="subjek" placeholder="Subjek Kendala yang Dialami">
                    </div>
            </div>
            <div class="col-md-3">
                <label for="pesan" class="form-label fw-bold">Isi Pesan</label>
                <textarea class="pesan form-control form-control-lg" id="pesan" name="pesan" rows="13" placeholder="Ketikkan pesan yang ingin disampaikan"></textarea>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button type="submit" class="btn btn-light" id="alertkontak2">Kirim</button>
                </div>
            </div>
            </form>

            <div class="col-md-3 text-center">
                <label for="lokasi" class="fw-bold text-center">Lokasi</label>
                <div id="map-container-google-3" class="z-depth-1-half map-container-3 mt-2" style="border-radius: 10px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12371.451138023298!2d105.071243!3d-5.401015!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d2f093d4a027%3A0x35fedef26ffe058a!2sDINAS%20KOMUNIKASI%20DAN%20INFORMATIKA%20kab.%20PEsawaran!5e1!3m2!1sid!2sid!4v1710400775444!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <br>
                <h5 class="text-center">Statistik Pengunjung</h5>
                <h1 class="text-center" style="color: #E90000; font-size: 40px; font-weight: 700;">
                    <span data-target="0"> <?= esc($totalpengunjung) ?></span>
                </h1>
                <div class="mb-2" style="color: rgba(4.25, 4.06, 4.06, 0.85); font-size: 15px; font-weight: 600; line-height: 20px; word-wrap: break-word">
                    Pengunjung hari ini: <span data-target="0"><?= esc($pengunjunghariini) ?></span> <br />
                    Pengunjung online: <span data-target="0"><?= esc($pengunjungonline) ?></span>
                </div>

                <a href="<?= base_url('/faq') ?>">
                    <img src="<?= base_url('assets/img/faq.gif') ?>" style="width: 70px; height:70px; border-radius:50%;">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container2 text-center pt-2 pb-2" style="color: white;">
    @2024 PPID Kabupaten Pesawaran
</div>

<?= $this->renderSection('content'); ?>
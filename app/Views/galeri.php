<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- Galeri section -->
    <section class="service_section layout_padding">
        <div class="row d-flex align-item-center">
            <?= $this->include('alert/frontalert'); ?>
        </div>
        <div class="container-fluid">
            <div class="heading_container">
                <h2>Kegiatan IKNAventory</h2>
                <p>Dokumentasi beberapa kegiatan yang pernah dilakukan oleh IKNAventory</p>
            </div>

            <div class="service_container row container-fluid">
                <?php if (!empty($galeriKegiatan)) : ?>
                    <?php foreach ($galeriKegiatan as $kegiatan) : ?>
                        <div class="box" data-toggle="modal" data-target="#modal<?= $kegiatan['id_kegiatan'] ?>">
                            <div class="img-box">
                                <img src="<?= base_url($kegiatan['foto_kegiatan']) ?>" alt="Foto <?= $kegiatan['judul_kegiatan'] ?>" class="img-fluid">
                            </div>
                            <div class="detail-box text-center">
                                <h5><?= $kegiatan['judul_kegiatan'] ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="no-data">
                        <img src="<?= base_url('assets/img/404.gif'); ?>" style="width: 250px;" alt="Data Tidak Ditemukan" class="no-data-img">
                        <p class="no-data-text">Data Tidak Ditemukan</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="btn-box d-flex justify-content-center">
                <?php if ($currentPage > 1) : ?>
                    <a href="<?= site_url('galeri/' . ($currentPage - 1)) ?>" class="btn btn-secondary">
                        Back
                    </a>
                <?php else : ?>
                    <a href="#" class="btn btn-secondary disabled">Back</a>
                <?php endif; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <a href="<?= site_url('galeri/' . ($currentPage + 1)) ?>" class="btn btn-primary">
                        Next
                    </a>
                <?php else : ?>
                    <a href="#" class="btn btn-primary disabled">Next</a>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <?php if (!empty($galeriKegiatan)) : ?>
        <?php foreach ($galeriKegiatan as $kegiatan) : ?>
            <div class="modal fade" id="modal<?= $kegiatan['id_kegiatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $kegiatan['id_kegiatan'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header text-white" style=background:#081c5c;>
                            <h5 class="modal-title" id="modalLabel<?= $kegiatan['id_kegiatan'] ?>">
                                <?= $kegiatan['judul_kegiatan'] ?>
                            </h5>
                            <button type="button" class="close" style="color: #FFF;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Image Section -->
                                <div class="col-md-6">
                                    <img src="<?= base_url($kegiatan['foto_kegiatan']) ?>" alt="Foto <?= $kegiatan['judul_kegiatan'] ?>" class="img-fluid rounded shadow-sm">
                                </div>
                                <!-- Details Section -->
                                <div class="col-md-6">
                                    <!-- <h6><b>Waktu Kegiatan :</b> <?= formatTanggalIndo($kegiatan['tanggal_foto']); ?></h6> -->
                                    <p class="text-muted mt-0"><b class="text-dark">Keterangan Kegiatan : </b><br><?= $kegiatan['deskripsi'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

    <!-- end galeri section -->
    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
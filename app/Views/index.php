<?= $this->include('layouts/template') ?>


<body>

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
        <!-- slider section -->
        <section class=" slider_section ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="detail_box">
                                        <h1>
                                            IKNAventory
                                        </h1>
                                        <div class="btn-box">
                                            <a href="#contactLink" class="btn-1">
                                                Kontak Kami
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="<?= base_url('assets/images/slider-img.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->
    <section class="about_section ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/about-img2.png') ?>" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Tentang IKNAventory
                            </h2>
                        </div>
                        <p>
                            UKM IKNA didirikan di Yogyakarta pada tanggal 14 November 1995 dan diresmikan tanggal 7
                            Desember 2011 oleh STMIK AMIKOM Yogyakarta (sekarang menjadi Universitas AMIKOM)
                        </p>
                        <a href="<?= site_url('/about') ?>">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->


    <!-- Kegiatan section -->
    <section class="service_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>Kegiatan IKNAventory</h2>
                <p>Dokumentasi beberapa kegiatan yang pernah dilakukan oleh IKNAventory</p>
            </div>

            <div class="service_container row container-fluid">
            <?php if (!empty($galeriKegiatan)) : ?>
                <?php foreach (array_slice($galeriKegiatan, 0, 4) as $kegiatan) : ?>
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
                <p class="text-center">Tidak ada data kegiatan yang ditemukan.</p>
            <?php endif; ?>
        </div>
            <div class="btn-box">
                <a href="<?= site_url('/service') ?>">
                    Lebih lanjut
                </a>
            </div>
        </div>
    </section>


   <!-- Modal untuk setiap kegiatan -->
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <h6><b>Waktu Kegiatan:</b> <?= $kegiatan['tanggal_foto'] ?></h6>
                        <p class="text-muted mt-2"><b class="text-dark">Keterangan kegiatan : </b><br><?= $kegiatan['deskripsi'] ?></p>
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

    <!-- end Kegiatan section -->

    <!--Start Nav tabs pengurus -->
    <section class="team_section layout_padding2-bottom mt-5">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Pengurus IKNAventory
                </h2>
                <p>
                    Berikut adalah daftar anggota-anggota pengurus IKNAventory
                </p>
            </div>
        </div>

        <nav>
            <div class="nav nav1 nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-bph" type="button"
                    role="tab" aria-controls="nav-bph" aria-selected="true">BPH</button>
                <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-Kerohanian"
                    type="button" role="tab" aria-controls="nav-Kerohanian" aria-selected="false">Kerohanian</button>
                <button class="nav-link" id="nav-Kerumahtanggaan-tab" data-toggle="tab"
                    data-target="#nav-Kerumahtanggaan" type="button" role="tab" aria-controls="nav-Kerumahtanggaan"
                    aria-selected="false">Kerumahtanggaan</button>
                <button class="nav-link" id="nav-other-tab1" data-toggle="tab" data-target="#nav-other1" type="button"
                    role="tab" aria-controls="nav-other1" aria-selected="false">Humas</button>
                <button class="nav-link" id="nav-other-tab2" data-toggle="tab" data-target="#nav-other2" type="button"
                    role="tab" aria-controls="nav-other2" aria-selected="false">Talenta Olahraga</button>
                <button class="nav-link" id="nav-other-tab2" data-toggle="tab" data-target="#nav-other2" type="button"
                    role="tab" aria-controls="nav-other2" aria-selected="false">Talenta Musik</button>
                <button class="nav-link" id="nav-other-tab2" data-toggle="tab" data-target="#nav-other2" type="button"
                    role="tab" aria-controls="nav-other2" aria-selected="false">Talenta Pertunjukan</button>
                <button class="nav-link" id="nav-other-tab3" data-toggle="tab" data-target="#nav-other3" type="button"
                    role="tab" aria-controls="nav-other3" aria-selected="false">Usaha dana</button>
                <button class="nav-link" id="nav-other-tab4" data-toggle="tab" data-target="#nav-other4" type="button"
                    role="tab" aria-controls="nav-other4" aria-selected="false">Litbang</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-bph" role="tabpanel" aria-labelledby="nav-bph-tab">
                <div class="team_container">
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/bph/f1.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Dandi
                            </h5>
                            <p>
                                Ketua Umum
                            </p>
                        </div>
                    </div>
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/bph/f3.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Ariel
                            </h5>
                            <p>
                                Wakil ketua
                            </p>

                        </div>
                    </div>
                    <div class="box b-2">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/bph/f2.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Anjani
                            </h5>
                            <p>
                                Sekretaris
                            </p>

                        </div>
                    </div>
                    <div class="box b-3">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/bph/f4.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Anggi
                            </h5>
                            <p>
                                Bendahara
                            </p>

                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="nav-Kerohanian" role="tabpanel" aria-labelledby="nav-Kerohanian-tab">
                <div class="team_container">
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerohanian/f1.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Dave
                            </h5>
                            <p>
                                Anggota 1
                            </p>
                        </div>
                    </div>
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerohanian/f2.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Fanya
                            </h5>
                            <p>
                                Anggota 2
                            </p>
                        </div>
                    </div>
                    <div class="box b-2">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerohanian/f3.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Deta
                            </h5>
                            <p>
                                Pengurus 3
                            </p>
                        </div>
                    </div>
                    <div class="box b-3">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerohanian/f4.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Dede
                            </h5>
                            <p>
                                Pengurus 4
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="nav-Kerumahtanggaan" role="tabpanel"
                aria-labelledby="nav-Kerumahtanggaan-tab">
                <div class="team_container">
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerumahtanggaan/f1.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Hera
                            </h5>
                            <p>
                                Anggota 1
                            </p>
                        </div>
                    </div>
                    <div class="box b-1">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerumahtanggaan/f2.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Kristin
                            </h5>
                            <p>
                                Anggota 2
                            </p>
                        </div>
                    </div>
                    <div class="box b-2">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerumahtanggaan/f3.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                Ikne
                            </h5>
                            <p>
                                Pengurus 3
                            </p>
                        </div>
                    </div>
                    <div class="box b-3">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/kerumahtanggaan/f4.JPG') ?>" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                indy
                            </h5>
                            <p>
                                Pengurus 4
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end team section -->


    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
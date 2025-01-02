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

                <!-- Card 1 -->
                <div class="box" data-toggle="modal" data-target="#modal1">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 1</h5>
                    </div>
                </div>


                <!-- Card 2 -->
                <div class="box" data-toggle="modal" data-target="#modal2">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 2</h5>
                    </div>
                </div>


                <!-- Card 3 -->
                <div class="box" data-toggle="modal" data-target="#modal3">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 3</h5>
                    </div>
                </div>
            </div>

            <div class="btn-box">
                <a href="<?= site_url('/service') ?>">
                    Lebih lanjut
                </a>
            </div>
        </div>
    </section>


    <!-- Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="Brand Promotion" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Kegiatan 1</h5>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus eligendi maxime aliquid minus
                        deleniti odit? Illo facere enim inventore quae?</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="Video Marketing" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Kegiatan 2</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis similique accusamus voluptas
                        fugiat nostrum tenetur non accusantium, nobis libero numquam!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="Site Analysis" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">kegiatan 3</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt dignissimos iure facere! Eius,
                        accusamus praesentium expedita dolore blanditiis fugit eveniet.</p>
                </div>
            </div>
        </div>
    </div>
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
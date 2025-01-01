<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->

    <section class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ">
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
                        <!-- <a href="">
                            Read More
                        </a -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>


</body>

</html>
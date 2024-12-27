<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>
                    Kegiatan IKNAventory
                </h2>
                <p>
                    Dokumentasi beberapa kegiatan yang perbah dilakukan oleh IKNAventory
                </p>
            </div>

            <div class="service_container">
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Brand Promotion
                        </h5>
                        <p>
                            Lorem ipsum dolor sit
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Brand Promotion
                        </h5>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Video Marketing

                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Site Analysis
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Social Media Marketing
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            SEO Optimization
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">
                    Back
                </a>

                <a href="">
                    Next
                </a>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
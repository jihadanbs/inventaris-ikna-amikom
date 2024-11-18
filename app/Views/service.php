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
                    Our Services
                </h2>
                <p>
                    consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>

            <div class="service_container">
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/s-1.png') ?>" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Brand Promotion
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/s-2.png') ?>" alt="">
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
                        <img src="<?= base_url('assets/images/s-3.png') ?>" alt="">
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
                        <img src="<?= base_url('assets/images/s-4.png') ?>" alt="">
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
                        <img src="<?= base_url('assets/images/s-5.png') ?>" alt="">
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
                    Read More
                </a>
            </div>
        </div>
    </section>
    <!-- end service section -->

    <div class="footer_bg">
        <?= $this->include('layouts/kontak') ?>
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
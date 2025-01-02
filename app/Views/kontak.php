<?= $this->include('layouts/template') ?>

<body class="sub_page">
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!--Star Kontak section -->
    <section class="kontak_section layout_padding">
        <div class="container-fluid text-center">
            <!-- Judul -->
            <h2 class="mb-4">Hubungi Kami Melalui</h2>

            <!-- Row untuk Card -->
            <div class="row justify-content-center">
                <!-- Card TikTok -->
                <div class="col-lg-8 col-md-6 mb-4">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor"
                                class="bi bi-tiktok" viewBox="0 0 16 16">
                                <path
                                    d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                            </svg>
                            <h5 class="card-title mt-3">TikTok</h5>
                        </div>
                    </div>
                </div>

                <!-- Card Instagram -->
                <div class="col-lg-8 col-md-6 mb-4">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <i class="bi bi-instagram" style="font-size: 3rem; color: #E1306C;"></i>
                            <h5 class="card-title mt-3">Instagram</h5>
                        </div>
                    </div>
                </div>

                <!-- Card Facebook -->
                <div class="col-lg-8 col-md-6 mb-4">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <i class="bi bi-facebook" style="font-size: 3rem; color: #3b5998;"></i>
                            <h5 class="card-title mt-3">Facebook</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end KONATK section -->

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
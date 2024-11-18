<!-- info section -->
<section class="info_section layout_padding2">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info_logo">
                    <h3>
                        IKNAventory
                    </h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor indidunt ut labore et
                        dolore magna
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_links">
                    <h4>
                        DAFTAR MENU
                    </h4>
                    <ul class=" ">
                        <li class="<?= uri_string() == '' ? 'active' : '' ?>">
                            <a class="" href="<?= site_url('/') ?>">Beranda</a>
                        </li>
                        <li class="<?= uri_string() == 'about' ? 'active' : '' ?>">
                            <a class="" href="<?= site_url('/about') ?>">Tentang Kami</a>
                        </li>
                        <li class="<?= uri_string() == 'service' ? 'active' : '' ?>">
                            <a class="" href="<?= site_url('/service') ?>">Layanan</a>
                        </li>
                        <li class="<?= uri_string() == 'contact' ? 'active' : '' ?>">
                            <a class="" href="#contactLink">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_contact">
                    <h4>
                        DETAIL KONTAK
                    </h4>
                    <a href="">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/telephone-white.png') ?>" width="12px" alt="">
                        </div>
                        <p>
                            +62 1234567890
                        </p>
                    </a>
                    <a href="">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/envelope-white.png') ?>" width="18px" alt="">
                        </div>
                        <p>
                            iknaamikom@gmail.com
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info_form ">
                    <h4>
                        NEWSLETTER
                    </h4>
                    <form action="">
                        <input type="email" placeholder="Masukkan email anda">
                        <button>
                            Subscribe
                        </button>
                    </form>
                    <div class="social_box">
                        <a href="https://linktr.ee/iknajogja" target="_blank">
                            <img src="<?= base_url('assets/images/3.png') ?>" alt="">
                        </a>
                        <a href="https://www.instagram.com/ikna_jogja/?hl=en" target="_blank">
                            <img src="<?= base_url('assets/images/instagram.png') ?>" alt="">
                        </a>
                        <a href="https://www.facebook.com/ikatankeluarganasraniamikom?mibextid=ZbWKwL" target="_blank">
                            <img src="<?= base_url('assets/images/info-fb.png') ?>" alt="">
                        </a>
                        <a href="https://www.youtube.com/@ikatankeluarganasraniamiko8035" target="_blank">
                            <img src="<?= base_url('assets/images/info-youtube.png') ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end info_section -->
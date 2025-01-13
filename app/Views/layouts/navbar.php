<!-- header section strats -->
<header class="header_section" style="margin-bottom: 50px;">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container fixed-top">
            <a class="navbar-brand" href="index.html">
                <span>
                    IKNAventory
                </span>
            </a>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item <?= uri_string() == '' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/') ?>">Beranda</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'about' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/about') ?>">Tentang Kami</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'galeri' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/galeri') ?>">Galeri</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'kontak' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/kontak') ?>">Kontak Kami</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'bsrsng' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/barang') ?>">Barang</a>
                        </li>
                    </ul>
                </div>
                <div class="quote_btn-container ">
                    <a href="<?= site_url('/authentication/login') ?>">Login</a>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->
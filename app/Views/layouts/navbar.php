<!-- header section strats -->
<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
                <span>
                    IKNAventory
                </span>
            </a>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
                    <ul class="navbar-nav">
                        <li class="nav-item <?= uri_string() == '' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/') ?>">Beranda</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'about' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/about') ?>">Tentang Kami</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'service' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/service') ?>">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contactLink">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="quote_btn-container ">
                    <a href="">
                        <img src="<?= base_url('assets/images/call.png') ?>" alt="">
                        <span>
                            Telepon : + 62 1234567890
                        </span>
                    </a>
                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- end header section -->
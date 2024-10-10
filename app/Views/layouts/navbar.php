<nav class="navbar navbar-expand-xl navbar-dark bg-light bg-transparent fixed-top">
    <div class="container">
        <div class="logo">
            <?php if (isset($logo) && !empty($logo)) : ?>
                <img class="image-removebg" src="<?= base_url($logo) ?>" alt="Logo" />
            <?php else : ?>
                <p>Logo PPID</p>
            <?php endif; ?>
        </div>
        <p class="PPID-kabupaten">
            <span class="text-wrapper">PPID<br /></span>
            <br>
            <span class="text-wrapper2">Kabupaten Pesawaran</span>
        </p>

        <button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-content-around mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo2" aria-controls="navbarTogglerDemo2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo2">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item me-3 ">
                    <a class="nav-link <?= $activePage == 'beranda' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown mx-auto">
                    <a class="nav-link dropdown-toggle <?= $activePage == 'profil' ? 'active' : '' ?>" href="<?= base_url('/profil') ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('/profil') ?>">Profil</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/profil') ?> #visimisi">Visi & Misi PPID</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/profil') ?> #struktur">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/profil') ?> #tugasdanfungsi">Tugas dan Fungsi PPID</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/profil') ?> #dasarhukum">Dasar Hukum PPID</a></li>
                    </ul>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $activePage == 'informasipublik' ? 'active' : '' ?>" href="<?= base_url('/informasipublik') ?>">Informasi Publik</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $activePage == 'standarlayanan' ? 'active' : '' ?>" href="<?= base_url('/standarlayanan') ?>">Standar Layanan</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $activePage == 'laporan' ? 'active' : '' ?>" href="<?= base_url('/laporan') ?>">Laporan</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link <?= $activePage == 'galeri' ? 'active' : '' ?>" href="<?= base_url('/galeri') ?>">Galeri</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<?= $this->renderSection('content'); ?>
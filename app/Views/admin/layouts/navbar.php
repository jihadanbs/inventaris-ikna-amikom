<style>
    @keyframes moveText {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }

        100% {
            transform: translateY(0);
        }
    }

    .moving-text {
        position: relative;
        top: 10px;
    }

    .navbar {
        background-color: #ffffff;
        /* Ubah sesuai kebutuhan */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Tambahkan shadow */
        padding: 10px;
    }

    .navbar-brand-box {
        margin-right: auto;
    }

    .navbar-brand-box .logo-lg {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .navbar-brand-box .logo-lg img {
        height: 24px;
    }

    .navbar-brand-box .logo-txt {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        /* Warna teks */
    }

    .navbar-brand-box .logo-txt:hover {
        color: #FF5733;
        /* Warna teks saat dihover */
        transition: color 0.3s ease;
    }

    .navbar-brand-box .logo-txt:active {
        transform: scale(0.95);
        /* Efek saat tombol ditekan */
    }

    .header-item {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .header-item:hover {
        color: #FF5733;
        /* Warna ikon saat dihover */
        transition: color 0.3s ease;
    }

    /* Efek saat tombol navbar dihover */
    .header-item:hover .fa-bars {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .form-group {
        margin-left: 10px;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .moving-text {
        animation: textAnimation 1s infinite alternate;
    }

    @keyframes textAnimation {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-5px);
        }
    }
</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/img/ikna.png') ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/img/ikna.png') ?>" alt="" height="24"> <span class="logo-txt">IKNA AMIKOM</span>
                        </span>
                    </a>

                    <a href="dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/img/ikna.png') ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/img/ikna.png') ?>" alt="" height="24"> <span class="logo-txt">IKNA AMIKOM</span>
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div class="form-group m-2">
                    <div class="input-group">
                        <?php
                        if (session()->has('islogin')) {
                            date_default_timezone_set('Asia/Jakarta'); // Sesuaikan zona waktu

                            $hour = date('G');

                            if ($hour >= 5 && $hour < 12) {
                                $ucapan = 'Selamat Pagi';
                            } elseif ($hour >= 12 && $hour < 15) {
                                $ucapan = 'Selamat Siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                $ucapan = 'Selamat Sore';
                            } else {
                                $ucapan = 'Selamat Malam';
                            }

                            // Ambil nama lengkap pengguna dari sesi
                            $nama_lengkap = session()->get('nama_lengkap');

                            if ($nama_lengkap) {
                                echo "<h4 class='font-size-18 text-center py-3 moving-text'>Haii, $ucapan " . htmlspecialchars($nama_lengkap) . " &#128522;</h4>"; // Emotikon senyum
                            } else {
                                echo "<h4 class='font-size-18 text-center py-3 moving-text'>Haii, $ucapan Pengguna &#128522;</h4>"; // Jika nama_lengkap tidak ada
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-sm-inline-block">
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= base_url(session('file_profil') ? session('file_profil') : 'assets/img/404.gif'); ?>" alt="<?= session()->has('nama_lengkap') ? session('nama_lengkap') : 'Profile Image'; ?>">

                    <?php if (session()->has('islogin')) : ?>
                        <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= session('username') ?></span>
                    <?php endif; ?>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="profile"><i class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Akun</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/authentication/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>

</header>

<?= $this->renderSection('content'); ?>
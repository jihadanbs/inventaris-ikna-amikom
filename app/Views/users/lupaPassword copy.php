<?= $this->include('admin/layouts/script') ?>
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body,
    input {
        font-family: "Poppins", sans-serif;
    }

    /* Namespace untuk mengisolasi gaya */
    .custom-container {
        position: relative;
        width: 100%;
        background-color: #fff;
        min-height: 100vh;
        overflow: hidden;
    }

    .custom-forms-container {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .custom-signin-signup {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        left: 75%;
        width: 50%;
        transition: 1s 0.7s ease-in-out;
        display: grid;
        grid-template-columns: 1fr;
        z-index: 5;
    }

    .custom-signin-signup form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0rem 5rem;
        transition: all 0.2s 0.7s;
        overflow: hidden;
        grid-column: 1 / 2;
        grid-row: 1 / 2;
    }

    .custom-signin-signup form.sign-in-form {
        z-index: 2;
    }

    .custom-title {
        font-size: 2.2rem;
        color: #F4D160;
        font-weight: 700;
    }

    .custom-title2 {
        font-size: 1.5rem;
        color: #28527A;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .custom-input-field {
        max-width: 380px;
        width: 100%;
        background-color: #28527A;
        margin: 10px 0;
        height: 55px;
        border-radius: 10px;
        display: grid;
        grid-template-columns: 85% 15%;
        position: relative;
    }

    .custom-input-field i {
        text-align: center;
        line-height: 55px;
        color: white;
        transition: 0.5s;
        font-size: 1.1rem;
        order: 2;
    }

    .custom-input-field input {
        background: #F1F3F6;
        border: 1px solid #28527A;
        border-radius: 10px;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        padding-left: 20px;
    }

    .custom-input-field input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .custom-btn {
        width: 90%;
        background-color: #28527A;
        border: none;
        outline: none;
        height: 49px;
        border-radius: 10px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
        margin: 10px 0;
        cursor: pointer;
        transition: 0.5s;
    }

    .custom-btn:hover {
        background-color: #F4D160;
    }

    .custom-panels-container {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .custom-container:before {
        content: "";
        position: absolute;
        height: 150%;
        width: 90%;
        top: -20%;
        right: 48%;
        transform: translateY(-5%);
        background-image: linear-gradient(-45deg, #28527A 0%, #28527A 100%);
        transition: 1.8s ease-in-out;
        border-radius: 50%;
        box-shadow: 7px 7px 10px 0px #8AC4D0;
        z-index: 6;
    }

    .custom-image {
        width: 100%;
        transition: transform 1.1s ease-in-out;
        transition-delay: 0.4s;
    }

    .custom-panel {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-around;
        text-align: center;
        z-index: 6;
        padding: 2rem;
    }

    .custom-left-panel {
        pointer-events: all;
        padding: 3rem 17% 2rem 12%;
        z-index: 6;
    }

    .custom-panel .content {
        color: #fff;
        transition: transform 0.9s ease-in-out;
        transition-delay: 0.6s;
    }

    .custom-panel h3 {
        font-weight: 600;
        line-height: 1;
        font-size: 1.5rem;
    }

    .custom-panel p {
        font-size: 0.95rem;
        padding: 0.7rem 0;
    }

    /* Animations and responsiveness */
    @media (max-width: 870px) {
        .custom-container {
            min-height: 800px;
            height: 100vh;
        }

        .custom-signin-signup {
            width: 100%;
            top: 95%;
            transform: translate(-50%, -100%);
            transition: 1s 0.8s ease-in-out;
        }

        .custom-signin-signup,
        .custom-container.sign-up-mode .custom-signin-signup {
            left: 50%;
        }

        .custom-panels-container {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 2fr 1fr;
        }

        .custom-panel {
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 2.5rem 8%;
            grid-column: 1 / 2;
        }

        .custom-left-panel {
            grid-row: 1 / 2;
        }

        .custom-image {
            width: 200px;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }

        .custom-panel .content {
            padding-right: 15%;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.8s;
        }

        .custom-panel h3 {
            font-size: 1.2rem;
        }

        .custom-panel p {
            font-size: 0.7rem;
            padding: 0.5rem 0;
        }

        .custom-btn.transparent {
            width: 110px;
            height: 35px;
            font-size: 0.7rem;
        }

        .custom-container:before {
            width: 1500px;
            height: 1500px;
            transform: translateX(-50%);
            left: 30%;
            bottom: 68%;
            right: initial;
            top: initial;
            transition: 2s ease-in-out;
        }

        .custom-container.sign-up-mode .custom-signin-signup {
            top: 5%;
            transform: translate(-50%, 0);
        }
    }

    @media (max-width: 570px) {
        .custom-signin-signup form {
            padding: 0 1.5rem;
        }

        .custom-image {
            display: none;
        }

        .custom-panel .content {
            padding: 0.5rem 1rem;
        }

        .custom-container {
            padding: 1.5rem;
        }

        .custom-container:before {
            bottom: 72%;
            left: 50%;
        }
    }

    .custom-form-group {
        width: 350px;
    }

    .custom-form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    @media (max-width: 320px) {
        .custom-form-group {
            width: 250px;
        }
    }
</style>

</head>

<body>
    <div class="custom-container">
        <div class="custom-forms-container">
            <?php $session = \Config\Services::session(); ?>
            <div class="custom-signin-signup">
                <form action="" method="POST" class="sign-in-form">
                    <?= csrf_field(); ?>
                    <div class="content-wrapper" style="display: flex; align-items:center;">
                        <div class="logo">
                            <img style="width: 50px; height:80px; padding-top:10px;" src="<?= base_url('assets/img/psw.png') ?>" alt="Logo" />
                        </div>
                        <p class="mb-0" style="padding-left: 15px; padding-bottom:20px;">
                            <span class="custom-title">PPID</span>
                            <br>
                            <span class="custom-title2">Kabupaten Pesawaran</span>
                        </p>
                    </div>

                    <?php if ($session->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                            <?= $session->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($session->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                            <?= $session->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($session->getFlashdata('warning')) : ?>
                        <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-outline align-middle me-3"></i><strong>Peringatan</strong> -
                            <?= $session->getFlashdata('warning') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>


                    <div class="custom-form-group">
                        <label for="nama" class="custom-form-label">Akun Pengguna</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nama" name="username" placeholder="Username/Email Terdaftar" value="<?php if ($session->getFlashdata('username')) echo $session->getFlashdata('username'); ?>">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['username'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['username'] ?>
                            </div>
                        <?php endif; ?>
                        <a href="<?php echo site_url("authentication/login"); ?>" style="color: black; text-align:right; display: block;">Kembali Kehalaman Login</a>
                    </div>

                    <input type="submit" value="Kirim" class="custom-btn solid" />
                </form>
            </div>

        </div>

        <div class="custom-panels-container">
            <div class="custom-panel custom-left-panel">
                <div class="content">
                    <img src="<?= base_url('assets/img/login-illustrator.png') ?>" class="custom-image" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/admin/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/feather-icons/feather.min.js') ?>"></script>
    <!-- pace js -->
    <script src="<?= base_url('assets/admin/libs/pace-js/pace.min.js') ?>"></script>
    <!-- Alert init js -->
    <script src="<?= base_url('assets/admin/js/pages/alert.init.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/app.js') ?>"></script>

</body>

</html>
<?= $this->include('admin/layouts/script') ?>
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

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 18px;
        transform: translateY(-50%);
        cursor: pointer;
        color: black;
        font-size: 1.1rem;
    }

    .custom-input-field i {
        text-align: center;
        line-height: 55px;
        color: white;
        transition: 0.5s;
        font-size: 1.1rem;
        order: 2;
    }

    .custom-form-group {
        width: 350px;
    }

    .custom-form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    /* Namespace untuk mengisolasi gaya */
    /* .custom-container {
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
    } */
</style>

<body>

    <body>
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />

                    <h1 class="opacity">LOGIN</h1>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                            <?= session()->getFlashdata('pesan') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                            <?= session()->getFlashdata('gagal') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> -
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_COOKIE['logout_message'])) : ?>
                        <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                            <?= $_COOKIE['logout_message']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php setcookie('logout_message', '', time() - 3600, "/"); // Hapus cookie setelah ditampilkan 
                        ?>
                    <?php endif; ?>
                    <?= form_open('authentication/cekLogin') ?>
                    <form action="#" method="POST" class="sign-in-form" autocomplete="off">
                        <div class="custom-form-group opacity">
                            <label for="nama" class="custom-form-label">Nama Pengguna</label>
                            <div class="custom-input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama" name="username" placeholder="Username/Email" value="<?= old('username') ?>" autocomplete="off">
                            </div>
                            <?php if (isset(session()->getFlashdata('validation')['username'])) : ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('validation')['username'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="custom-form-group opacity">
                            <label for="pw" class="custom-form-label">Kata Sandi</label>
                            <div class="custom-input-field">
                                <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility()"></i>
                                <input type="password" id="pw" name="password" placeholder="Masukkan kata sandi" value="<?= old('password') ?>" autocomplete="off">
                            </div>

                            <?php if (isset(session()->getFlashdata('validation')['password'])) : ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('validation')['password'] ?>
                                </div>
                            <?php endif; ?>
                        </div><br>
                        <button class="opacity">SUBMIT</button>
                    </form>
                    <?= form_close() ?>
                    <!-- PASSWORD TOGGLE -->
                    <script>
                        function togglePasswordVisibility() {
                            var passwordInput = document.getElementById("pw");
                            var passwordToggle = document.querySelector(".password-toggle");

                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                                passwordToggle.classList.remove("fa-lock");
                                passwordToggle.classList.add("fa-lock-open");
                            } else {
                                passwordInput.type = "password";
                                passwordToggle.classList.remove("fa-lock-open");
                                passwordToggle.classList.add("fa-lock");
                            }
                        }
                    </script>
                    <!-- END PASSWORD TOGGLE -->
                    <div class="register-forget opacity">
                        <!-- <a href="<?php echo site_url("authentication/lupaPassworD"); ?>" style="color: black; text-align:right; display: block;">Lupa kata sandi?</a> -->
                        <a href="#" style="color: black; text-align:right; display: block;">Lupa kata sandi?</a>
                    </div>
                </div>
                <div class="circle circle-two"></div>
            </div>
            <div class="theme-btn-container"></div>
        </section>
    </body>
    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/admin/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/login/js/script.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/pages/alert.init.js') ?>"></script>
    <script src="<?= base_url('assets/admin/js/app.js') ?>"></script>
</body>

</html>
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
</style>

<body>

    <body>
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />

                    <h1 class="opacity">RESET PASSWORD</h1>
                    <?= $this->include('alert/alert'); ?>
                    <?= form_open('authentication/resetPassword') ?>
                    <form action="<?= site_url('authentication/resetPassword?email=' . $email . '&token=' . $token) ?>" method="POST" class="sign-in-form" autocomplete="off">
                        <?= csrf_field(); ?>
                        <!-- Tambahkan input hidden untuk menyimpan email dan token -->
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="hidden" name="token" value="<?= $token ?>">

                        <div class="custom-form-group opacity">
                            <label for="pw" class="custom-form-label">Kata Sandi</label>
                            <div class="custom-input-field">
                                <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('pw', this)"></i>
                                <input type="password" id="pw" name="password" placeholder="Masukkan kata sandi" value="<?= old('password') ?>" autocomplete="off">
                            </div>
                            <?php if (isset(session()->getFlashdata('validation')['password'])) : ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('validation')['password'] ?>
                                </div>
                            <?php endif; ?>
                        </div><br>

                        <div class="custom-form-group opacity">
                            <label for="konfirmasi_password" class="custom-form-label">Konfirmasi Kata Sandi</label>
                            <div class="custom-input-field">
                                <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('konfirmasi_password', this)"></i>
                                <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan kata sandi" value="<?= old('konfirmasi_password') ?>" autocomplete="off">
                            </div>
                            <?php if (isset(session()->getFlashdata('validation')['konfirmasi_password'])) : ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('validation')['konfirmasi_password'] ?>
                                </div>
                            <?php endif; ?>
                        </div><br>

                        <button class="opacity">SUBMIT</button>
                    </form>
                    <?= form_close() ?>
                    <!-- PASSWORD TOGGLE -->
                    <script>
                        function togglePasswordVisibility(inputId, iconElement) {
                            var passwordInput = document.getElementById(inputId);

                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                                iconElement.classList.remove("fa-lock");
                                iconElement.classList.add("fa-lock-open");
                            } else {
                                passwordInput.type = "password";
                                iconElement.classList.remove("fa-lock-open");
                                iconElement.classList.add("fa-lock");
                            }
                        }
                    </script>
                    <!-- END PASSWORD TOGGLE -->
                    <div class="register-forget opacity">
                        <a href="<?php echo site_url("/authentication/lupaPassword"); ?>" style="color: black; text-align:right; display: block;">Lupa Kata Sandi?</a>
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
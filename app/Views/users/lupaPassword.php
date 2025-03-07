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

                    <h1 class="opacity">LUPA PASSWORD</h1>
                    <?= $this->include('alert/alert'); ?>
                    <?= form_open('authentication/lupaPassword') ?>
                    <form action="#" method="POST" class="sign-in-form" autocomplete="off">
                        <?= csrf_field(); ?>
                        <div class="custom-form-group opacity">
                            <label for="nama" class="custom-form-label">Akun Pengguna</label>
                            <div class="custom-input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" id="nama" name="username" placeholder="Username/Email" value="<?= old('username') ?>" autocomplete="off">
                            </div>
                            <?php if (isset(session()->getFlashdata('validation')['username'])) : ?>
                                <div class="text-danger">
                                    <?= session()->getFlashdata('validation')['username'] ?>
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
                        <a href="<?php echo site_url("authentication/login"); ?>" style="color: black; text-align:right; display: block;">Kembali Kehalaman Login</a>
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
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

    .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        .form-container {
            width: 850px;
            max-width: 2300px;
            overflow: hidden;
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


    .flexbox-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; 
    }

    .flexbox-1, .flexbox-2 {
        flex: 1 1 45%; 
        min-width: 300px; 
    }

    .custom-input-field textarea {
    width: 100%;
    min-height: 55px;
    max-height: 80px; 
    height: auto; 
    resize: vertical; 
}


    @media (max-width: 768px) {
    .container {
        width: 100%;
        padding: 10px;
    }

    .login-container {
        width: 100%;
        max-width: 450px; 
        margin: auto;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-container {
        width: 100%;
        max-width: 100%;
        padding: 15px;
        overflow: hidden;
    }

    .flexbox-container {
        flex-direction: column; 
    }

    .flexbox-1, .flexbox-2 {
        width: 100%;
        min-width: 100%;
    }

    .custom-form-group {
        width: 100%;
    }

    .custom-input-field input,
    .custom-input-field textarea {
        width: 100%;
    }

    .illustration {
        display: none; 
    }
}



</style>

<body>

    <body>
        <section class="container">
            <div class="login-container">
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                    
                    <h1 class="opacity">REGISTRASI AKUN</h1>
                    <?= $this->include('alert/alert'); ?>
                    <?= form_open('authentication/cekRegistrasi', ['class' => 'sign-in-form', 'autocomplete' => 'off']) ?>
                    <?= csrf_field(); ?>
                    <div class="flexbox-container" style="z-index: -1000;">
                        <div class="circle circle-one"></div>
                    <div class="flexbox-1">
                    <div class="custom-form-group opacity">
                        <label for="nama_lengkap" class="custom-form-label">Nama Lengkap</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="<?= old('nama_lengkap') ?>" autocomplete="off">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['nama_lengkap'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['nama_lengkap'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>

                    <div class="custom-form-group opacity">
                        <label for="username" class="custom-form-label">Username</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username" value="<?= old('username') ?>" autocomplete="off">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['username'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['username'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>

                    <div class="custom-form-group opacity">
                        <label for="email" class="custom-form-label">Email</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="email" name="email" placeholder="Masukkan Email Anda" value="<?= old('email') ?>" autocomplete="off">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['email'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['email'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>

                    <div class="custom-form-group opacity">
                        <label for="no_telepon" class="custom-form-label">No. Whastapp</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="no_telepon" name="no_telepon" placeholder="Masukkan No Whatsapp Anda" value="<?= old('no_telepon') ?>" autocomplete="off">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['no_telepon'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['no_telepon'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>

                    <div class="custom-form-group opacity">
                        <label for="pekerjaan" class="custom-form-label">Pekerjaan</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" value="<?= old('pekerjaan') ?>" autocomplete="off">
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['pekerjaan'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['pekerjaan'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>
                    </div>

                    <div class="flexbox-2">
                    <div class="custom-form-group opacity">
                        <label for="alamat" class="custom-form-label">Alamat</label>
                        <div class="custom-input-field">
                            <i class="fas fa-user"></i>
                            <textarea id="alamat" name="alamat" cols="30" rows="5" placeholder="Masukkan alamat Anda" value="<?= old('alamat') ?>" autocomplete="off"></textarea>
                        </div>
                        <?php if (isset(session()->getFlashdata('validation')['alamat'])) : ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('validation')['alamat'] ?>
                            </div>
                        <?php endif; ?>
                    </div><br>

                    <div class="custom-form-group opacity">
                        <label for="pw" class="custom-form-label">Kata Sandi</label>
                        <div class="custom-input-field">
                            <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('pw', this)"></i>
                            <input type="password" id="pw" name=" password" placeholder="Masukkan kata sandi" value="<?= old('password') ?>" autocomplete="off">
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


                    <button class="opacity">SUBMIT</button>
                    <?= form_close() ?>
                    <div class="register-forget opacity">
                        <a href="<?php echo site_url("authentication/login"); ?>" style="color: black; text-align:right; display: block;">Kembali Kehalaman Login</a>
                        <div class="circle circle-two"></div>
                    </div>
                    </div>
                    </div>
                </div>
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
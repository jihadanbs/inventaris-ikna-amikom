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
        
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
    }

    .form-container {
        width: 830px;
        max-width: 2300px;
        overflow: block;
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

    .flexbox-1,
    .flexbox-2 {
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

    .profile-photo-upload {
        position: relative;
        width: 100%;
        max-width: 350px;
        height: 55px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px dashed #6c757d;
        border-radius: 10px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        transition: all 0.3s ease;
        cursor: pointer;
        overflow: hidden;
    }

    .profile-photo-upload input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .profile-photo-upload .upload-icon {
        color: #6c757d;
        margin-right: 15px;
        transition: color 0.3s ease;
    }

    .profile-photo-upload .upload-text {
        color: #6c757d;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        flex-grow: 1;
        transition: color 0.3s ease;
    }

    .profile-photo-upload:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: #495057;
    }

    .profile-photo-upload:hover .upload-icon,
    .profile-photo-upload:hover .upload-text {
        color: #495057;
    }

    .profile-photo-upload.has-file .upload-text {
        color: #212529;
    }

    .profile-photo-upload .file-clear {
        position: absolute;
        right: 10px;
        color: #6c757d;
        cursor: pointer;
        display: none;
        transition: color 0.3s ease;
    }

    .profile-photo-upload.has-file .file-clear {
        display: block;
    }

    .profile-photo-upload .file-clear:hover {
        color: #dc3545;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile-photo-upload {
            max-width: 100%;
        }
    }

    /* Preview Styles */
    .profile-photo-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #6c757d;
        margin-bottom: 15px;
        display: none;
    }

    .profile-photo-preview.visible {
        display: block;
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
           
        }

        .form-container {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            overflow: block;
        }

        .flexbox-container {
            flex-direction: column;
        }

        .flexbox-1,
        .flexbox-2 {
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
            display: absolute;
            top: 0%;
        }
    }
</style>

<body>

    <body>
        <section class="container">
            <div class="login-container">
                <div class="form-container">
                    <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                    <div class="circle circle-one" style=" opacity: 0.5;"></div>

                    <h1 class="opacity">REGISTRASI AKUN</h1>
                    <?= $this->include('alert/alert'); ?>
                    <?= form_open('authentication/cekRegistrasi', ['class' => 'sign-in-form', 'autocomplete' => 'off']) ?>
                    <?= csrf_field(); ?>
                    <div class="flexbox-container">
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
                                    <i class="fas fa-id-badge"></i>
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
                                    <i class="fas fa-envelope"></i>
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
                                    <i class="fas fa-phone"></i>
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
                                    <i class="fas fa-briefcase"></i>
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
                                    <i class="fas fa-address-card"></i>
                                    <textarea id="alamat" name="alamat" cols="30" rows="5" placeholder="Masukkan alamat Anda" autocomplete="off"><?php echo old('alamat'); ?></textarea>
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
                            <div class="custom-form-group opacity">
                                <label for="file_profil" class="custom-form-label">Foto Profil</label>
                                <input type="file" id="file_profil" name="file_profil" accept="image/*" autocomplete="off">
                            </div><br>

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

    <script>
    <!-- JAVASCRIPT -->
    document.addEventListener('DOMContentLoaded', function() {
    const originalFileInput = document.getElementById('file_profil');
    

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.id = 'file_profil';
    fileInput.name = 'file_profil';
    fileInput.accept = 'image/*';
    fileInput.autocomplete = 'off';
    fileInput.style.display = 'none';
    

    originalFileInput.parentNode.replaceChild(fileInput, originalFileInput);

    const wrapper = document.createElement('div');
    wrapper.className = 'profile-photo-upload';
 
    const preview = document.createElement('img');
    preview.className = 'profile-photo-preview';
    fileInput.parentNode.insertBefore(preview, fileInput);
    
    wrapper.innerHTML = `
        <i class="fas fa-camera upload-icon"></i>
        <span class="upload-text">Pilih Foto Profil</span>
        <i class="fas fa-times file-clear"></i>
    `;
    
    fileInput.parentNode.insertBefore(wrapper, fileInput);
    wrapper.appendChild(fileInput);
    
  
    const uploadText = wrapper.querySelector('.upload-text');
    const fileClear = wrapper.querySelector('.file-clear');
    
  
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            // Update text
            uploadText.textContent = this.files[0].name;
            wrapper.classList.add('has-file');
            
         
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.classList.add('visible');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
  
    fileClear.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        uploadText.textContent = 'Pilih Foto Profil';
        wrapper.classList.remove('has-file');
        preview.src = '';
        preview.classList.remove('visible');
    });
    
   
    wrapper.addEventListener('click', function() {
        fileInput.click();
    });
});

     </script>
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
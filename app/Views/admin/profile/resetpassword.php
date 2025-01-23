<?= $this->include('admin/layouts/script') ?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
    .profile-card {
        text-align: center;
    }

    .profile-card img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .profile-card h5 {
        margin-top: 10px;
    }

    .card {
        max-width: 80%;
        margin-top: 10px;
        margin-left: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

    }

    .card-body {
        font-family: 'Roboto', sans-serif;
        padding: 20px;
    }

    .card-custom {
        max-width: 300px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-left: 30%;
        margin-top: 10px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .card-text {
        margin-bottom: 10px;
    }

    .btn-link {
        color: #007bff;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .edit-icon {
        position: relative;
        display: inline-block;
    }

    .informasi-pribadi-section {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .submit {
        border-top: 1px solid #dee2e6;
        padding-top: 15px;
        margin-top: 20px;
        text-align: center;
    }

    .btn-primary {
        background-color: #f66951;
        border: none;
        color: white;
        padding: 7px 20px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #f66951;
    }

    .card-custom {
        max-width: 300px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-left: 30%;
        margin-top: 10px;
    }

    .list-group-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
        text-decoration: none;
        color: #000;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item span {
        font-size: 16px;
        font-weight: 500;
        margin-left: 10px;
        color: #000;
    }

    .input-wrapper {
        position: relative;
    }

    .custom-form-group {
        margin-bottom: 1.5rem;
    }

    .custom-form-label {
        display: block;
        margin-bottom: 0.5rem;
    }

    .custom-input-field {
        max-width: 730px;
        width: 100%;
        background-color: #28527A;
        margin: 10px 0;
        height: 55px;
        border-radius: 10px;
        display: grid;
        grid-template-columns: 85% 15%;
        position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 20px;
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

    .custom-input-field input {
        background: #fff;
        border: 1px solid #28527A;
        border-radius: 10px;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        padding-left: 20px;
        width: 680px;
    }

    .custom-input-field input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .text-danger {
        color: #dc3545;
    }
</style>
</head>

<div style="pointer-events: none;">
    <?= $this->include('admin/layouts/navbar') ?>
</div>
<?= $this->include('admin/layouts/rightsidebar') ?>

<body>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 p-3">
                    <!-- Foto Profile Card -->
                    <div class="card card-custom mb-3">
                        <div class="card-body profile-card">
                            <div class="text-center mb-4">
                                <div class="edit-icon">
                                    <img src="<?= base_url(session('file_profil') ? session('file_profil') : 'assets/img/404.gif'); ?>" alt="Profile Image" class="rounded-circle" width="100" height="100">
                                </div>

                                <h4 style="margin-top: 20px;"><?= session()->has('nama_lengkap') ? session('nama_lengkap') : ''; ?></h4>
                                <p style="margin-top: 10px;">ADMIN<br><br>IKNA AMIKOM YOGYAKARTA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar Card -->
                    <div class="card card-custom">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fas fa-user"></i>
                                <a href="/admin/profile"><span>Profil</span></a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-lock"></i>
                                <a href="javascript:void(0)"><span>Ganti Kata Sandi</span></a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <a href="/authentication/logout"><span>Keluar</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8 ml-4">
                    <div class="mt-4 card">
                        <div class="card-body">
                            <div class="informasi-pribadi-section">
                                <a href=<?= site_url('/admin/profile') ?> class="btn btn-link">
                                    <i class="fas fa-arrow-left" style="font-size: 16px;"></i> Kembali
                                </a>
                                <h5 class="card-title">Ubah Kata Sandi</h5>

                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                        <?= session()->getFlashdata('pesan') ?>
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
                            </div>

                            <form action="<?= site_url('admin/profile/updateSandi/' . session('id_user')) ?>" method="post" enctype="multipart/form-data" id="validationForm" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>
                                <div class="custom-form-group">
                                    <label for="sandi_lama" class="custom-form-label">Kata Sandi<span class="text-danger">*</span></label>
                                    <div class="custom-input-field">
                                        <input type="password" class="form-control <?= isset($validation) && $validation->getError('sandi_lama') ? 'is-invalid' : ''; ?>" id="sandi_lama" name="sandi_lama" placeholder="Kata sandi Sekarang" value="<?= old('sandi_lama', session('sandi_lama')); ?>">
                                        <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('sandi_lama')"></i>
                                    </div>
                                    <div class="text-danger">
                                        <?= isset($validation) ? $validation->getError('sandi_lama') : ''; ?>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <label for="sandi_baru" class="custom-form-label">Kata Sandi Baru<span class="text-danger">*</span></label>
                                    <div class="custom-input-field">
                                        <input type="password" class="form-control <?= isset($validation) && $validation->getError('sandi_baru') ? 'is-invalid' : ''; ?>" id="sandi_baru" name="sandi_baru" placeholder="Kata sandi Baru" value="<?= old('sandi_baru', session('sandi_baru')); ?>">
                                        <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('sandi_baru')"></i>
                                    </div>
                                    <div class="text-danger">
                                        <?= isset($validation) ? $validation->getError('sandi_baru') : ''; ?>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <label for="konfirmasi_sandi_baru" class="custom-form-label">Ketik Ulang Kata Sandi Baru<span class="text-danger">*</span></label>
                                    <div class="custom-input-field">
                                        <input type="password" class="form-control <?= isset($validation) && $validation->getError('konfirmasi_sandi_baru') ? 'is-invalid' : ''; ?>" id="konfirmasi_sandi_baru" name="konfirmasi_sandi_baru" placeholder="Ketik ulang kata sandi baru" value="<?= old('konfirmasi_sandi_baru', session('konfirmasi_sandi_baru')); ?>">
                                        <i class="fas fa-lock password-toggle" onclick="togglePasswordVisibility('konfirmasi_sandi_baru')"></i>
                                    </div>
                                    <div class="text-danger">
                                        <?= isset($validation) ? $validation->getError('konfirmasi_sandi_baru') : ''; ?>
                                    </div>
                                </div>

                                <div class="submit">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Simpan Perubahan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/script2') ?>
    <script>
        // JavaScript untuk validasi form
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Fungsi untuk menampilkan/menyembunyikan kata sandi
        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling;
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("fa-lock");
                icon.classList.add("fa-lock-open");
            } else {
                field.type = "password";
                icon.classList.remove("fa-lock-open");
                icon.classList.add("fa-lock");
            }
        }
    </script>

</body>

</html>
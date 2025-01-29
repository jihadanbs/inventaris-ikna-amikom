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

    .pencil-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #ffffff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .fa-pencil-alt {
        color: #333333;
        font-size: 16px;
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

    .clear-input {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #888;
        cursor: pointer;
    }
</style>
</head>

<?= $this->include('admin/layouts/navbar') ?>
<?= $this->include('admin/layouts/rightsidebar') ?>

<body>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <?= $this->include('admin/profile/rightsidebar') ?>
                <div class="col-md-8 ml-4">
                    <div class="mt-4 card">
                        <div class="card-body">

                            <div class="informasi-pribadi-section">
                                <a href="dashboard" class="btn btn-link">
                                    <i class="fas fa-arrow-left" style="font-size: 16px;"></i> Dashboard
                                </a>
                                <h5 class="card-title">Informasi Pribadi</h5>

                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                        <?= session()->getFlashdata('pesan') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <form action="<?= site_url('admin/profile/update/' . session('id_user')) ?>" method="post" enctype="multipart/form-data" id="validationForm" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('nama_lengkap') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', session('nama_lengkap')); ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($validation) ? $validation->getError('nama_lengkap') : ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Username Anda" style="background-color: white;" id="username" name="username" value="<?= old('username', session('username')); ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($validation) ? $validation->getError('username') : ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" id="email" name="email" value="<?= old('email', session('email')); ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($validation) ? $validation->getError('email') : ''; ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_jabatan" class="col-form-label">Jabatan<span class="text-danger">*</span></label>
                                    <select class="form-select custom-border" id="id_jabatan" name="id_jabatan" aria-label="Default select example" style="background-color: #C7C8CC;" required disabled>
                                        <option value="" selected disabled>Silahkan Pilih Jabatan Anda --</option>
                                        <?php foreach ($tb_jabatan as $value) : ?>
                                            <?php
                                            // Check jika $tb_user memiliki kunci 'id_jabatan'
                                            $selected = '';
                                            if (session()->has('id_jabatan')) {
                                                // Jika ada, cek jika nilai id_jabatan sama dengan nilai saat ini dalam loop
                                                $selected = ($value['id_jabatan'] == old('id_jabatan', session('id_jabatan'))) ? 'selected' : '';
                                            }
                                            ?>
                                            <option value="<?= $value['id_jabatan'] ?>" <?= $selected ?>><?= $value['nama_jabatan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">Nomor Telepon<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('no_telepon') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Nomor Telpon / Whatsapp Anda" style="background-color: white;" id="no_telepon" name="no_telepon" value="<?= old('no_telepon', session('no_telepon')); ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($validation) ? $validation->getError('no_telepon') : ''; ?>
                                    </div>
                                </div>

                                <!-- Function mengambil Password Terakhir -->
                                <?php
                                // Ambil data dari sesi untuk password terakhir reset
                                $passwordLastReset = session('password_last_reset');

                                // Format tanggal terakhir reset password
                                $formattedLastReset = '';
                                if ($passwordLastReset) {
                                    $date = new DateTime($passwordLastReset);
                                    $formattedLastReset = $date->format('d') . ' ' . date('F', mktime(0, 0, 0, $date->format('m'), 10)) . ' ' . $date->format('Y,') . ' Jam ' . $date->format('H:i:s') . ' WIB';
                                }

                                // Menghitung tanggal kadaluarsa (30 hari setelah password terakhir reset)
                                $expiryDate = 'Belum melakukan update password &#129300;';
                                if ($passwordLastReset) {
                                    $expiryDateTime = (new DateTime($passwordLastReset))->modify('+30 days');
                                    $expiryDate = $expiryDateTime->format('d') . ' ' . date('F', mktime(0, 0, 0, $expiryDateTime->format('m'), 10)) . ' ' . $expiryDateTime->format('Y,') . ' Jam ' . $expiryDateTime->format('H:i:s') . ' WIB';
                                }
                                ?>

                                <div class="mb-3">
                                    <label for="password_last_reset" class="col-form-label">Terakhir Update Password<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input disabled type="text" placeholder="Belum melakukan update password &#129300;" class="form-control" id="password_last_reset" name="password_last_reset" style="background-color: #C7C8CC;" value="<?= $formattedLastReset; ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password_expiry" class="col-form-label">Password Berlaku Sampai<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input disabled type="text" class="form-control" id="password_expiry" name="password_expiry" style="background-color: #C7C8CC;" value="<?= $expiryDate; ?>">
                                    </div>
                                </div>
                                <!-- End Function -->

                                <!-- Function mengambil waktu Terakhir Login -->
                                <?php
                                // Ambil data dari sesi
                                $terakhirLogin = session('terakhir_login');

                                // Format tanggal jika ada data
                                $formattedDate = '';
                                if ($terakhirLogin) {
                                    $date = new DateTime($terakhirLogin);
                                    $formattedDate = $date->format('d') . ' ' . date('F', mktime(0, 0, 0, $date->format('m'), 10)) . ' ' . $date->format('Y,') . ' Jam ' . $date->format('H:i:s') . ' WIB';
                                }
                                ?>

                                <div class="mb-3">
                                    <label for="terakhir_login" class="col-form-label">Waktu Terakhir Login Sebelumnya<span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="terakhir_login" name="terakhir_login" style="background-color: #C7C8CC;" value="<?= $formattedDate; ?>" disabled>
                                    </div>
                                </div>
                                <!-- End Function -->

                                <div class="mb-3">
                                    <label for="file_profil" class="form-label">Foto Profile<span class="text-danger">*</span></label>
                                    <div class="mb-2">
                                        <?php if (session()->has('file_profil') && !empty(session('file_profil'))) : ?>
                                            <img src="<?= base_url(session('file_profil')); ?>" alt="Profile Photo" id="profilePhotoPreview" style="max-width: 150px;">
                                            <p class="fw-bold">File exists: <?= basename(session('file_profil')); ?></p>
                                            <input type="hidden" name="old_file_profil" value="<?= session('file_profil'); ?>">
                                        <?php else : ?>
                                            <img src="<?= base_url('assets/img/404.gif'); ?>" alt="Profile Photo" id="profilePhotoPreview" style="max-width: 150px;">
                                            <p class="fw-bold">Belum punya foto profile</p>
                                        <?php endif; ?>
                                    </div>
                                    <input type="file" accept="image/*" class="form-control <?= isset($validation) && $validation->hasError('file_profil') ? 'is-invalid' : ''; ?>" style="background-color: white;" id="file_profil" name="file_profil">
                                    <div class="invalid-feedback">
                                        <?= isset($validation) ? $validation->getError('file_profil') : ''; ?>
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
        document.getElementById('file_profil').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profilePhotoPreview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>


</body>

</html>
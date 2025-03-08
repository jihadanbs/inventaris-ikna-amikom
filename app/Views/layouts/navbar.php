<style>
    .navbar-user-dropdown {
        position: relative;
    }

    .navbar-user-dropdown .user-profile-container {
        padding: 0px 15px;
        cursor: pointer;
        padding: 0.25rem 1rem;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .navbar-user-dropdown .user-profile-container:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .navbar-user-dropdown .dropdown-toggle1 {
        padding: 0px 15p;
        color: inherit;
        text-decoration: none;
        background: none;
        border: none;
        width: 100%;
    }

    .navbar-user-dropdown .dropdown-toggle1:focus {
        outline: none !important;
        box-shadow: none !important;
    }


    .navbar-user-dropdown .dropdown-menu {
        right: 0;
        left: 0;
        top: 100%;
        border-radius: 4px;
    }

    .navbar-user-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1.25rem;
    }

    .navbar-user-dropdown .dropdown-item i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    #editProfilModal .modal-content {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    #editProfilModal .modal-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 20px 25px;
        border-bottom: none;
        position: relative;
    }

    #editProfilModal .modal-title {
        font-weight: 700;
        font-size: 1.3rem;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    #editProfilModal .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
        transition: all 0.2s;
    }

    #editProfilModal .close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    #editProfilModal .modal-body {
        padding: 25px;
    }

    #editProfilModal .form-group {
        margin-bottom: 20px;
    }

    #editProfilModal .form-group label {
        font-weight: 600;
        color: #444;
        margin-bottom: 7px;
        font-size: 0.9rem;
    }

    #editProfilModal .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    #editProfilModal .form-control:focus {
        box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.2);
        border-color: #2575fc;
        background-color: #fff;
    }

    #editProfilModal textarea.form-control {
        min-height: 100px;
    }

    #editProfilModal .profile-photo-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        margin-bottom: 15px;
        border: 1px dashed #ddd;
    }

    #editProfilModal .profile-photo {
        border-radius: 10px;
        max-height: 150px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    #editProfilModal .custom-file-upload {
        display: inline-block;
        cursor: pointer;
        background-color: #f1f3f5;
        color: #495057;
        padding: 8px 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 0.9rem;
        transition: all 0.3s;
        margin-top: 10px;
    }

    #editProfilModal .custom-file-upload:hover {
        background-color: #e9ecef;
    }

    #editProfilModal .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #editProfilModal .btn-primary {
        background-color: #2575fc;
        border-color: #2575fc;
    }

    #editProfilModal .btn-primary:hover {
        background-color: #1a68e5;
        border-color: #1a68e5;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(37, 117, 252, 0.3);
    }

    #editProfilModal .btn-danger {
        background-color: #f8f9fa;
        border-color: #ddd;
        color: #495057;
    }

    #editProfilModal .btn-danger:hover {
        background-color: #e9ecef;
        border-color: #ced4da;
        color: #212529;
    }

    #editProfilModal .modal-footer {
        border-top: none;
        padding: 15px 25px 25px;
    }

    /* Field dengan ikon */
    #editProfilModal .input-with-icon {
        position: relative;
    }

    #editProfilModal .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
    }

    #editProfilModal .input-with-icon .form-control {
        padding-left: 40px;
    }

    /* Helper text formatting */
    #editProfilModal .form-text {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 5px;
    }

    /* File input styling */
    #editProfilModal .file-input-wrapper {
        position: relative;
    }

    #editProfilModal input[type="file"] {
        opacity: 0;
        position: absolute;
        width: 0.1px;
        height: 0.1px;
    }

    .modal {
        z-index: 9999999;
    }
</style>
<header class="header_section" style="margin-bottom: 50px;">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container fixed-top">
            <a class="navbar-brand" href="index.html">
                <span>
                    IKNAventory
                </span>
            </a>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
            </button>

            <!-- NAVBAR -->
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item <?= uri_string() == '' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('/') ?>">Beranda</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'galeri' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('galeri') ?>">Galeri</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'kontak' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('kontak') ?>">Kontak Kami</a>
                        </li>
                        <li class="nav-item <?= (uri_string() == 'barang' || strpos(uri_string(), 'barang-detail') === 0) ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('barang') ?>">Barang</a>
                        </li>
                        <li class="nav-item <?= uri_string() == 'keranjang-barang' ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('keranjang-barang') ?>">Keranjang</a>
                        </li>
                        <li class="nav-item <?= (uri_string() == 'cek-barang' || uri_string() == 'cek-resi') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= site_url('cek-barang') ?>">Cek Barang</a>
                        </li>
                    </ul>
                </div>
                <div class=" d-flex align-items-center" style="margin-top: 0px; margin-bottom: 4px;">
                    <?php if (session()->has('islogin')) : ?>
                        <div class="quote_btn-container user-dropdown-full dropdown navbar-user-dropdown">
                            <button class=" btn dropdown-toggle1 nav-link d-flex align-items-center p-0" type="button" id="userDropdownFull" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="user-profile-container d-flex align-items-center">
                                    <?php if (!empty(session()->get('file_profil'))): ?>
                                        <img src="<?= base_url(session()->get('file_profil')) ?>" alt="Profile" class="rounded-circle mr-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-user-circle mr-2 text-muted" style="font-size: 30px;"></i>
                                    <?php endif; ?>
                                    <span class="username font-weight-bold"><?= session()->get('username') ?></span>

                                    <i class="fa fa-chevron-down ml-2 "></i>
                                </div>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdownFull">
                                <?php if (session()->get('id_jabatan') != 2) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="<?= site_url('/dashboard') ?>">
                                        <i class="fas fa-tachometer-alt mr-3 text-primary"></i>
                                        <span class="text-primary">Dashboard</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex align-items-center text-danger" href="<?= site_url('/authentication/logout') ?>">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        <span>Logout</span>
                                    </a>
                                <?php else: ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal" data-target="#editProfilModal">
                                        <i class="fas fa-user mr-3 text-success"></i>
                                        <span class="text-success">Profile</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item d-flex align-items-center text-danger" href="<?= site_url('/authentication/logout') ?>">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        <span>Logout</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?= site_url('/authentication/login') ?>" class="quote_btn-container mb-2">Login</a>
                    <?php endif; ?>
                </div>
                <!-- END NAVBAR -->
        </nav>
    </div>
</header>

<?php
$userId = session()->get('id_user');
$userModel = new \App\Models\UserModel();
$userData = $userId ? $userModel->find($userId) : null;

$pekerjaan = $userData['pekerjaan'] ?? session()->get('pekerjaan') ?? '';
$alamat = $userData['alamat'] ?? session()->get('alamat') ?? '';
$file_profil = $userData['file_profil'] ?? session()->get('file_profil') ?? '';
?>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" role="dialog" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProfilForm" action="<?= site_url('authentication/updateUser') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                            value="<?= session()->get('nama_lengkap') ?>"
                            required minlength="3" maxlength="255" pattern="[A-Za-z\s]+">
                    </div>
                    <div class="form-group">
                        <label for="username">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= session()->get('username') ?>"
                            required minlength="3" maxlength="10" pattern="[A-Za-z0-9_]+">
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= session()->get('email') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">Nomor Telepon<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="no_telepon" name="no_telepon"
                            value="<?= session()->get('no_telepon') ?>"
                            required pattern="[0-9]+" minlength="10" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                            value="<?= $pekerjaan ?>"
                            required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat"
                            required minlength="10" maxlength="500"><?= $alamat ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_profil">Foto Profil<span class="text-danger">*</span></label>
                        <div class="mb-2" style="cursor: pointer;" onclick="document.getElementById('file_profil').click()">
                            <?php if (!empty($file_profil)): ?>
                                <img src="<?= base_url($file_profil) ?>" alt="Current Profile" id="preview-image" class="img-thumbnail" style="max-height: 100px;">
                                <p class="text-muted small">Foto profil saat ini (klik untuk mengganti)</p>
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/404.gif') ?>" alt="Default Profile" id="preview-image" class="img-thumbnail" style="max-height: 100px;">
                                <p class="text-muted small">Belum ada foto profil (klik untuk menambahkan)</p>
                            <?php endif; ?>
                        </div>
                        <input type="file" class="form-control-file d-none" id="file_profil" name="file_profil" accept="image/*" data-max-size="2048" onchange="previewImage()">
                        <small class="form-text text-muted">Maksimal ukuran file 2MB. Format: JPG, JPEG, PNG, GIF</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end dari header section -->
<script>
    function previewImage() {
        var fileInput = document.getElementById('file_profil');
        var previewImg = document.getElementById('preview-image');

        // Debug
        console.log("File input changed");

        if (fileInput.files && fileInput.files[0]) {
            var file = fileInput.files[0];
            console.log("File selected:", file.name, "Size:", file.size, "Type:", file.type);

            var reader = new FileReader();

            reader.onload = function(e) {
                console.log("File loaded to preview");
                previewImg.src = e.target.result;

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Gambar berhasil diupload'
                });
            }

            reader.onerror = function(e) {
                console.error("Error reading file:", e);

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat membaca file'
                });
            }

            reader.readAsDataURL(file);
        } else {
            console.log("No file selected");
        }
    }

    $(document).ready(function() {
        // Validasi ukuran file sebelum submit
        $('#editProfilForm').on('submit', function(e) {
            var fileInput = $('#file_profil')[0];
            var maxSize = $(fileInput).data('max-size') * 2048;

            // Validasi ukuran file
            if (fileInput.files.length > 0) {
                if (fileInput.files[0].size > maxSize) {
                    alert('Ukuran file terlalu besar. Maks 2MB !');
                    e.preventDefault();
                    return false;
                }
            }
        });

        // Validasi real-time
        $('#editProfilForm input').on('invalid', function() {
            this.setCustomValidity(
                this.validity.valueMissing ? 'Kolom ini wajib diisi' :
                this.validity.patternMismatch ? 'Format input tidak valid' :
                this.validity.tooShort ? 'Input terlalu pendek' :
                this.validity.tooLong ? 'Input terlalu panjang' : ''
            );
        });

        $('#editProfilForm input').on('input', function() {
            this.setCustomValidity('');
        });

        <?php if (session()->getFlashdata('success')): ?>
            $('#editProfilModal').modal('hide');
        <?php endif; ?>
    });
</script>
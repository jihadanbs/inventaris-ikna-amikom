<?php
// Mendapatkan id_jabatan dari $tb_user
$id_jabatan = isset($tb_user[0]->id_jabatan) ? $tb_user[0]->id_jabatan : '';

// Mencari jabatan berdasarkan id_jabatan dari $tb_jabatan
$nama_jabatan = '';
foreach ($tb_jabatan as $jabatan) {
    if ($jabatan['id_jabatan'] == $id_jabatan) {
        $nama_jabatan = $jabatan['nama_jabatan'];
        break;
    }
}
?>

<div class="col-md-4 p-3">
    <!-- Foto Profile Card -->
    <div class="card card-custom mb-3">
        <div class="card-body profile-card">
            <div class="text-center mb-4">
                <div class="edit-icon">
                    <img src="<?= base_url(session('file_profil') ? session('file_profil') : 'assets/admin/images/user.png'); ?>" alt="Profile Image" class="rounded-circle" width="100" height="100">
                </div>

                <h4 style="margin-top: 20px;"><?= session()->has('nama_lengkap') ? session('nama_lengkap') : ''; ?></h4>
                <p style="margin-top: 10px;"><?= $nama_jabatan; ?><br>PPID Kab. Pesawaran</p>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Card -->
    <div class="card card-custom">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <i class="fas fa-user"></i>
                <a href="profile"><span>Profil</span></a>
            </li>
            <li class="list-group-item">
                <i class="fas fa-lock"></i>
                <a href="profile/resetpassword"><span>Ganti Kata Sandi</span></a>
            </li>
            <li class="list-group-item">
                <i class="fas fa-sign-out-alt"></i>
                <a href="/authentication/logout"><span>Keluar</span></a>
            </li>
        </ul>
    </div>
</div>
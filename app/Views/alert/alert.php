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

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
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

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('peringatan')) : ?>
    <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Warning</strong> -
        <?= session()->getFlashdata('peringatan') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-outline align-middle me-3"></i><strong>Peringatan</strong> -
        <?= session()->getFlashdata('warning') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
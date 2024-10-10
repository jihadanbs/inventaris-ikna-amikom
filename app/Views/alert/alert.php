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
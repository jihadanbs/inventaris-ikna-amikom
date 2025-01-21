<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all mr-2 align-middle"></i><strong>Sukses</strong> - 
        <?= session()->getFlashdata('pesan') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('gagal')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper mr-2 align-middle"></i><strong>Gagal</strong> - 
        <?= session()->getFlashdata('gagal') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper mr-2 align-middle"></i><strong>Gagal</strong> - 
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="mdi mdi-alert-outline mr-2 align-middle"></i><strong>Peringatan</strong> - 
        <?= session()->getFlashdata('warning') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

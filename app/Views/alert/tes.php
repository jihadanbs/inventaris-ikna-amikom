<style>
    /* Overlay untuk membuat latar belakang buram */
    .alert-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Warna hitam semi-transparan */
        z-index: 1050; /* Setara dengan modal di Bootstrap 4 */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Alert seperti modal */
    .alert-modal {
        position: relative;
        background: #fff; /* Warna latar belakang alert */
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 400px;
        max-width: 90%; /* Responsif */
        text-align: center;
        z-index: 1051;
    }

    /* Tombol close */
    .alert-modal .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #000;
        background: none;
        border: none;
        cursor: pointer;
    }
</style>


<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert-overlay">
        <div class="alert-modal">
            <button type="button" class="close" aria-label="Close" onclick="closeAlert(this)">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="mdi mdi-check-all mr-2 align-middle"></i>
            <strong>Sukses</strong> - 
            <?= session()->getFlashdata('pesan') ?>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('gagal')) : ?>
    <div class="alert-overlay">
        <div class="alert-modal">
            <button type="button" class="close" aria-label="Close" onclick="closeAlert(this)">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="mdi mdi-block-helper mr-2 align-middle"></i>
            <strong>Gagal</strong> - 
            <?= session()->getFlashdata('gagal') ?>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert-overlay">
        <div class="alert-modal">
            <button type="button" class="close" aria-label="Close" onclick="closeAlert(this)">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="mdi mdi-block-helper mr-2 align-middle"></i>
            <strong>Error</strong> - 
            <?= session()->getFlashdata('error') ?>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert-overlay">
        <div class="alert-modal">
            <button type="button" class="close" aria-label="Close" onclick="closeAlert(this)">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="mdi mdi-alert-outline mr-2 align-middle"></i>
            <strong>Peringatan</strong> - 
            <?= session()->getFlashdata('warning') ?>
        </div>
    </div>
<?php endif; ?>

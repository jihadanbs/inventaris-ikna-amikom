<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
    /* untuk menyembunyikan elemen dengan ID loadmodaldisabilitas di halaman ini */
    #loadmodaldisabilitas {
        display: none;
    }
</style>

<!-- hero Start -->
<section class="hero" style="height:130px; position: fixed; top: 0; width: 100%; z-index: 1000; background-color: #28527A;">
    <div class="hero_overlay2"></div>
    <div class="hero_content2 d-flex h-100 justify-content-between align-items-center">
        <a href="javascript:void(0);" onclick="history.back();">
            <i class="fa-solid fa-arrow-left" style="color: white; padding-left:50px; padding-top:90px;"><span class="ms-3">View PDF</span></i>
        </a>
        <!-- <i class="fa-solid fa-download" id="alertemail" style="color: white; padding-right:50px; padding-top:90px;"></i> -->
    </div>
</section>

<!-- hero end -->

<div class="container-fluid pb-3 pdf" id="pdf" style="background-color:#8AC4D0; padding-top: 150px;">
    <div class="container text-center position-relative">
        <div id="pdf-viewer" style="width: 100%; max-width: 800px; margin: auto;"></div>
    </div>
</div>

<script>
    // Disable right-click and keyboard shortcuts
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    });
    document.addEventListener("keydown", function(e) {
        if (e.ctrlKey || e.metaKey) {
            e.preventDefault();
        }
    });
</script>

<?= $this->endSection(''); ?>
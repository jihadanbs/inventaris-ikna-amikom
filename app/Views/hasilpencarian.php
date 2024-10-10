<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-100 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4" style="color: #f4d160; font-size: 40px;">PENELUSURAN DATA</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 25px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->


<div class="container pt-5 pb-5">
    <h4 class="fw-bold">Hasil Pencarian: "SOP"</h4>
    <img src="<?= base_url('assets/img/Rectangle 103.png') ?>" alt="" class="lineimg position-relative start-50 translate-middle-x mb-5" style="max-width: 100%; height: auto; bottom: -50px;">

    <div class="col-md-12 pt-5 pb-4">
        <!-- card -->
        <div class="card" style="height: 60px;border-radius:20px;">
            <!-- card body -->
            <div class="card-body d-flex justify-content-between align-items-center" style="height:60px; background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border-radius:20px;">
                <div class="fw-bold">
                    <a href="<?= base_url("/pdf?pdf=" . urlencode(base_url("assets/file/pemilihan.pdf"))) ?>" style="text-decoration:none; color: #28527A;">SOP Permohonan Informasi Publik </a>
                </div>
                <a href="#" class="alertemail">
                    <i class="fa-solid fa-download" style="color: #28527A;"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 pb-4">
        <!-- card -->
        <div class="card" style="height: 60px; border-radius:20px;">
            <!-- card body -->
            <div class="card-body d-flex justify-content-between align-items-center" style="height:60px; background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);border-radius:20px;">
                <div class="fw-bold">
                    <a href="<?= base_url("/pdf?pdf=" . urlencode(base_url("assets/file/pemilihan.pdf"))) ?>" style="text-decoration:none; color: #28527A;">SOP Permohonan Informasi Publik </a>
                </div>
                <a href="#" class="alertemail">
                    <i class="fa-solid fa-download" style="color: #28527A;"></i>
                </a>
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="visually-hidden">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <!-- Tambahkan lebih banyak halaman sesuai kebutuhan -->
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="visually-hidden">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <a href="javascript:void(0);" onclick="history.back();" style="text-decoration:none;">
        <div class="d-grid gap-2 col-3 mx-auto">
            <button class="btn" style="background-color: #28527A; color:white;" type="button">Kembali</button>
        </div>
    </a>
</div>


<?= $this->endSection(''); ?>
<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
    .card-item {
        display: none;
        padding-top: 30px;
    }

    .card-item.active {
        display: block;
    }

    .carousel-image {
        height: 200px;
        object-fit: cover;
    }

    /* new */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #28527A;
        border-radius: 50px;
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: #F4D160;
        /* Warna berubah saat hover */
    }

    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /*  */
</style>

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-120 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4 mt-5" style="color: #f4d160; font-size: 45px;">GALERI</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<section class="position-relative laptop-view">
    <div class="container p-5">
        <div class="row text-center">
            <div class="col-md-3 mb-1">
                <div class="siger-image2">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/galeri') ?>" class="text-decoration-none">
                    <div class="card custom-card">
                        <div class="card-body text-center fw-bold custom-card-body">
                            <h4>Foto</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-1">
                <div class="siger-image2">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/video') ?>" class="text-decoration-none">
                    <div class="card custom-card2">
                        <div class="card-body text-center fw-bold custom-card-body">
                            <h4>Video</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <img src="<?= base_url('assets/img/Rectangle 103.png') ?>" alt="" class="lineimg position-absolute start-50 translate-middle-x mb-3" style="max-width: 100%; height: auto; z-index: 2;">
</section>

<!-- Swiper Container -->
<div class="swiper-container mt-3" id="swiper-container">
    <div class="swiper-wrapper">
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image2">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/galeri') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #28527a; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold">
                        <h4>Foto</h4>
                    </div>
                </div>
            </a>
        </div>
        <!-- Add more slides here -->
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image2">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/video') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
                        <h4>Video</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <img src="<?= base_url('assets/img/Rectangle 103.png') ?>" alt="" class="lineimg position-relative start-50 translate-middle-x mb-3" style="max-width: 100%; height: auto; bottom: -50px;">
    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>
<!-- Swiper Container End-->

<!-- Card -->
<div class="container pb-5 pt-5">
    <div class="row row-cols-md-3 pb-5">
        <?php foreach ($tb_foto as $foto) : ?>
            <div class="col-md-4 card-item">
                <div class="card h-100">
                    <div id="carouselExampleControls_<?= $foto['id_foto'] ?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $files = explode(', ', $foto['file_foto']); // Mengubah string menjadi array
                            $isActive = true;
                            ?>
                            <?php foreach ($files as $file) : ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <a data-fancybox="gallery_<?= $foto['id_foto'] ?>" href="<?= base_url($file) ?>">
                                        <img src="<?= base_url($file) ?>" class="d-block w-100 carousel-image" alt="...">
                                    </a>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_<?= $foto['id_foto'] ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #28527A; border-radius: 50px;"></span>
                            <span class="visually-hidden" style="background-color:#f4d160;">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_<?= $foto['id_foto'] ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #28527A; border-radius: 50px;"></span>
                            <span class="visually-hidden" style="background-color:#f4d160;">Next</span>
                        </button>
                    </div>

                    <h5 class="card-title1 text-center fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($foto['judul_foto']) ?>">
                        <?= $foto['judul_foto'] ?>
                    </h5>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="d-flex justify-content-center mt-4">
    <div aria-label="Page navigation">
        <ul class="pagination" style="--bs-pagination-active-border-color: #f4d160; --bs-pagination-color: #28527A;"></ul>
    </div>
</div>
</div>
<!-- Card End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Tooltip Judul Lengkap -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<!-- End Tooltip Judul Lengkap -->
<script>
    $(document).ready(function() {
        const itemsPerPageDesktop = 6;
        const itemsPerPageMobile = 3;

        const cardItems = $('.card-item');
        const pagination = $('.pagination');
        let itemsPerPage = $(window).width() >= 768 ? itemsPerPageDesktop : itemsPerPageMobile;
        let currentPage = 1;

        function showPage(page) {
            currentPage = page;
            const totalItems = cardItems.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            cardItems.removeClass('active').each((index, card) => {
                if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
                    $(card).addClass('active');
                }
            });

            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            pagination.empty();
            for (let i = 1; i <= totalPages; i++) {
                const li = $('<li>').addClass('page-item').toggleClass('active', i === currentPage);
                const a = $('<a>').addClass('page-link').attr('href', '#').text(i);
                a.on('click', function(e) {
                    e.preventDefault();
                    showPage(i);
                });
                li.append(a);
                pagination.append(li);
            }
        }

        function updatePagination() {
            itemsPerPage = $(window).width() >= 768 ? itemsPerPageDesktop : itemsPerPageMobile;
            showPage(currentPage);
        }

        $(window).on('resize', updatePagination);

        showPage(1);
    });
</script>

<script>
    $(document).ready(function() {
        // Jalankan slideshow otomatis setiap 3 detik
        $('.carousel').carousel({
            interval: 3000
        });
    });
</script>

<?= $this->endSection(''); ?>
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
                    <div class="card custom-card2">
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
                    <div class="card custom-card">
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
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
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
                <div class="card text-light" style="background-color: #28527a; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold">
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

<div class="container p-5 pt-5 pb-5">
    <div class="row row-cols-1 row-cols-md-3 pb-5">

        <?php foreach ($tb_vidio as $vidio) : ?>
            <div class="col card-item">
                <div class="card h-100">
                    <iframe width="100%" height="180px" src="https://www.youtube.com/embed/<?= $vidio['link_vidio']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <h5 class="card-title1 text-center fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= esc($vidio['judul_vidio']); ?>">
                        <?= $vidio['judul_vidio']; ?>
                    </h5>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="d-flex justify-content-center mt-4">
        <div aria-label="Page navigation">
            <ul class="pagination" style="--bs-pagination-active-border-color: #f4d160; --bs-pagination-color: #28527A;"></ul>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Tooltip judul -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<!-- End Tooltip judul -->

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

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

<?= $this->endSection(''); ?>
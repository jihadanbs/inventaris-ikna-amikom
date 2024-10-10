<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>


<!-- label page -->
<div class="label-page">
    <a href="https://www.instagram.com/diskominfotiksan_pesawaran/" class="btn btn-warning" target="_blank">
        INSTAGRAM DISKOMINFO
    </a>
</div>
<div class="label-page-2">
    <a href="https://x.com/pesawarankab?t=J0aR2AtY-HwmMP4URoL5gA&s=09" class="btn btn-warning" target="_blank">
        TWITTER DISKOMINFO
    </a>
</div>
<!-- end label page -->

<!-- hero Start -->
<section class="hero">
    <div class="hero_overlay"></div>
    <div id="particles-js">
        <img src="<?= base_url('assets/img/Peta Beranda.png') ?>" alt="" class="heroimg">
    </div>
    <div class="hero_content h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-100 align-items-center hero_content-width">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4" style="color: #f4d160;">SELAMAT DATANG</h1>
                <p class="lead mb-4 fw-bold" style="color: white;">Website Portal PPID Kabupaten Pesawaran</p>
                <form class="d-flex mx-auto">
                    <input class="form-control" style="border-radius: 20px; height:34px; " type="search" placeholder="Cari.." aria-label="Search">
                </form>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<!-- Carousel Img -->
<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade position-absolute imghero" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $active = 'active'; ?>
        <?php foreach ($tb_slider_beranda as $image) : ?>
            <div class="carousel-item <?= $active ?>">
                <img src="<?= base_url($image['gambar_slider']) ?>" class="d-block" style="border-radius: 20px; width: 500px; height: 300px;" alt="gambar Slider">
            </div>
            <?php $active = ''; // Hapus kelas 'active' setelah iterasi pertama 
            ?>
        <?php endforeach; ?>
    </div>
</div>
<!-- Carousel Img -->

<div class="container-fluid layanan pt-3 pb-5" id="layanan">
    <span class="badge-akses mx-auto">
        <h5 class="mt-3 fw-bold">Akses Informasi Secara Cepat :</h5>
    </span>
    <div class="container text-center">
        <div class="row pt-4">
            <div class="col-md-3 mb-4 col-6" data-aos="fade-up">
                <a href="<?= base_url('/formpermohonan') ?>" class="text-decoration-none">
                    <span class="lingkaranberanda">
                        <i class="fa-solid fa-file fa-5x"></i>
                        <h5 class="mt-5 mx-3">Formulir Permohonan</h5>
                    </span>
                </a>
            </div>

            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="100">
                <a href="<?= base_url('/formkeberatan') ?>" class="text-decoration-none">
                    <span class="lingkaranberanda">
                        <i class="fa-solid fa-file-invoice fa-5x"></i>
                        <h5 class="mt-5 mx-3">Formulir Keberatan</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="200">
                <a href="<?= base_url('/cekstatus') ?>" class="text-decoration-none">
                    <span class="lingkaranberanda">
                        <i class="fa-solid fa-file-circle-check fa-5x"></i>
                        <h5 class="mt-5 mx-3">Cek Status Formulir</h5>
                    </span>
                </a>
            </div>
            <div class="col-md-3 mb-3 col-6" data-aos="fade-up" data-aos-delay="300">
                <a href="<?= base_url('/statistik') ?>" class="text-decoration-none">
                    <span class="lingkaranberanda">
                        <i class="fa-solid fa-chart-pie fa-5x"></i>
                        <h5 class="mt-5 mx-3">Statistik PPID Pesawaran</h5>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="statistik">
    <div class="container2 text-center pt-3 pb-3" style="color: white;">
        <h3 class="fw-bold">
            Jumlah Permohonan Informasi Berdasarkan Status
        </h3>
    </div>
    <div class="container pt-5">
        <div class="row d-flex flex-wrap">
            <div class="col-md-12 pb-4" data-aos="fade-up">
                <!-- card -->
                <div class="card card-h-100" style="height: 155px;">
                    <!-- card body -->
                    <div class="card-body" style="background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mt-4 text-center fw-bold">
                                    <span id="totalCounter" class="counter-value" data-target="0">0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="text-center fw-bold">
                            <span class="mx-auto font-size-13">Jumlah Semua Permohonan Informasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 pb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                <!-- card -->
                <div class="card card-h-100 w-100" style="height: 155px;">
                    <!-- card body -->
                    <div class="card-body" style="background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mt-4 text-center fw-bold">
                                    <span class="counter-value" id="belumProsesCounter" data-target="0">0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center fw-bold text-center">
                            <span class="font-size-12 text-nowrap">Permohonan Belum diproses</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 pb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                <!-- card -->
                <div class="card card-h-100 w-100" style="height: 155px;">
                    <!-- card body -->
                    <div class="card-body" style="background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mt-4 text-center fw-bold">
                                    <span class="counter-value" id="diprosesCounter" data-target="0">0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center fw-bold text-center">
                            <span class="font-size-12 text-nowrap">Permohonan Sedang diproses</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 pb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                <!-- card -->
                <div class="card card-h-100 w-100" style="height: 155px;">
                    <!-- card body -->
                    <div class="card-body" style="background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mt-4 text-center fw-bold">
                                    <span class="counter-value" id="diberikanCounter" data-target="0">0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center fw-bold">
                            <span class="font-size-12">Permohonan diberikan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 pb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                <!-- card -->
                <div class="card card-h-100 w-100" style="height: 155px;">
                    <!-- card body -->
                    <div class="card-body" style="background-color: rgba(138, 196, 208, 0.37); box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mt-4 text-center fw-bold">
                                    <span class="counter-value" id="ditolakCounter" data-target="0">0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center fw-bold">
                            <span class="font-size-12">Permohonan ditolak</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="wilayah">
    <div class="container-fluid pt-5 pb-5">
        <div class="wilayah_overlay"></div>
        <img src="<?= base_url('assets/img/Group 35.png') ?>" alt="" class="wilayahimg">
        <div class="container1 text-center">
            <span class="badge pb-3">
                <h5 class="fw-bold pt-2">Website Wilayah</h5>
            </span>
            <div id="container1" data-aos="fade-up">
                <div id="slider-container">
                    <!-- <button class="btn carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" onclick="slideRight()" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button> -->
                    <!-- <span onclick="slideRight()"><i class="fa-regular fa-circle-left fa-2x" style="position: absolute; top: calc(50% - 30px); left: 2px; color:#28527A;"></i></span> -->
                    <span onclick="slideRight()"><i class="fa-solid fa-circle-arrow-left fa-2x" style="position: absolute; top: calc(50% - 30px); left: 2px; color:#f4d160;"></i></span>
                    <div id="slider">
                        <?php foreach ($tb_wilayah as $wilayah) : ?>
                            <div class="slide">
                                <span class="lingkaran3">
                                    <a href="<?= $wilayah->link_wilayah ?>" target="_blank" style="text-decoration: none; color:#28527A;">
                                        <img style="width: auto;" src="<?= base_url($wilayah->gambar_wilayah) ?>">
                                        <h5 class="judul"><?= $wilayah->nama_wilayah ?></h5>
                                    </a>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- <button class="btn carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" onclick="slideLeft()" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> -->
                    <span onclick="slideLeft()"><i class="fa-solid fa-circle-arrow-right fa-2x" style="position: absolute; top: calc(50% - 30px); right: 2px; color:#f4d160;"></i></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container pt-5 pb-5">
</div>
<div class="container pt-3 pb-3">
</div>

<script>
    $(document).ready(function() {
        updateTotal();

        function updateTotal() {
            $.ajax({
                url: "/admin/permohonan/totalData", // URL untuk total permohonan informasi
                type: "GET",
                success: function(responsePemohon) {
                    $.ajax({
                        url: "/admin/keberatan/totalData", // URL untuk total permohonan keberatan
                        type: "GET",
                        success: function(responseKeberatan) {
                            // Hitung total gabungan
                            var total = parseInt(responsePemohon.total) + parseInt(responseKeberatan.total);
                            // Update nilai total pada elemen dengan id "totalCounter"
                            $("#totalCounter").attr("data-target", total);
                            $("#totalCounter").text(total);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        updateCounts();

        function updateCounts() {
            // Update count for "Belum diproses"
            updateCounter("Belum diproses", "belumProsesCounter");

            // Update count for "Diproses"
            updateCounter("Diproses", "diprosesCounter");

            // Update count for "Permohonan diberikan"
            updateCounter("Diberikan", "diberikanCounter");

            // Update count for "Permohonan ditolak"
            updateCounter("Ditolak", "ditolakCounter");
        }

        function updateCounter(status, counterId) {
            // Ajax request untuk tb_pemohon
            $.ajax({
                url: "/admin/permohonan/totalByStatus/" + status,
                type: "GET",
                success: function(responsePemohon) {
                    // Ajax request untuk tb_keberatan
                    $.ajax({
                        url: "/admin/keberatan/totalByStatus/" + status,
                        type: "GET",
                        success: function(responseKeberatan) {
                            // Menghitung total gabungan dari kedua response
                            var total = parseInt(responsePemohon.total) + parseInt(responseKeberatan.total);

                            // Update nilai pada elemen dengan id sesuai counterId
                            $("#" + counterId).attr("data-target", total);
                            $("#" + counterId).text(total);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        }
    });
</script>

<?= $this->endSection('') ?>
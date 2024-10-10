<?= $this->include('admin/layouts/script') ?>

</head>
<style>
    .greeting-card {
        position: relative;
        background-color: #28527a;
        border-radius: 15px;
        padding: 20px;
        color: #f4d160;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: smoothBounce 2s infinite ease-in-out;
    }

    .greeting-title {
        color: #FFF;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .greeting-message {
        font-size: 18px;
        line-height: 1.5;
        font-weight: bold;
    }

    .greeting-card img {
        max-width: 100px;
        transition: transform 0.3s;
    }

    .greeting-card img:hover {
        transform: scale(1.1);
    }

    @keyframes smoothBounce {

        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }

        100% {
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .greeting-title {
            font-size: 24px;
        }

        .greeting-message {
            font-size: 16px;
        }
    }
</style>

<body>
    <?= $this->include('admin/layouts/navbar') ?>
    <?= $this->include('admin/layouts/sidebar') ?>
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Greeting Card -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="greeting-card">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h2 class="greeting-title mb-2">Selamat Datang Di Halaman Admin IKNA AMIKOM</h2>
                                    <p class="greeting-message">"Setiap Langkah Kecil Membawa Kita Lebih Dekat Pada Tujuan Besar! &#128521"</p>
                                </div>
                                <div class="col-md-3 text-end">
                                    <img src="<?= base_url('assets/img/ikna.png') ?>" alt="Welcome" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-cubes fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Semua Barang</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="belumProsesCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-hourglass-start fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Permohonan Belum Diproses</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="diberikanCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-check-circle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;"> Permohonan Diberikan</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="ditolakCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-times-circle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;"> Permohonan Ditolak</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalCounter1" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-cube fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Barang Kondisi Baik</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalCounter1" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-recycle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Barang Kondisi Rusak</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">Permohonan Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row-->


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->
    <?= $this->include('admin/layouts/footer') ?>

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('admin/layouts/script2') ?>
    <!-- <script>
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

    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                $.ajax({
                    url: "/admin/informasi_publik/totalData", // URL untuk total permohonan informasi
                    type: "GET",
                    success: function(responseInformasi) {
                        // Hitung total gabungan
                        var total = parseInt(responseInformasi.total);
                        // Update nilai total pada elemen dengan id "totalCounter1"
                        $("#totalCounter1").attr("data-target", total);
                        $("#totalCounter1").text(total);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script> -->


</body>

</html>
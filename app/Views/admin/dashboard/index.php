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

    .table-container {
        transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
        overflow: hidden;
    }

    .table-container.collapsed {
        max-height: 0;
        opacity: 0;
    }

    .shadow-3d {
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.6),
            0 6px 20px rgba(255, 255, 255, 0.4);
        border-radius: 10px;
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
                                    <p class="greeting-message">"TUHAN adalah kekuatan umat-Nya dan benteng keselamatan bagi orang yang diurapi-Nya !" Mazmur 28:8</p>
                                </div>
                                <div class="col-md-3 text-end">
                                    <img src="<?= base_url('assets/img/ikna.png') ?>" alt="Welcome" class="img-fluid shadow-3d">
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
                                            <span class="counter-value ms-3" id="totalCounter5" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-cube fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Barang Kondisi Baik</span>
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
                                            <span class="counter-value ms-3" id="totalCounter6" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-recycle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Barang Kondisi Rusak</span>
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
                                            <span class="counter-value ms-3" id="belumDiprosesCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-shopping-basket fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Barang Belum Diproses</span>
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
                                            <span class="counter-value ms-3" id="dipinjamkanCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-truck fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Barang Dipinjamkan</span>
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
                                            <span class="counter-value ms-3" id="dikembalikanCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-check-circle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Peminjam Sudah Mengembalikan</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row-->

                <div class="card">
                    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #28527a;">
                        <h5 class="mb-0" style="color: #f4d160 !important; font-size: 16px;">
                            <i class="bi bi-box me-2"></i>Stok Barang
                        </h5>
                        <button id="toggleTableBtn" class="btn btn-light">
                            <i id="toggleIcon" class="bi bi-eye-slash me-1"></i>Sembunyikan
                        </button>
                    </div>
                    <div id="tableContainer" class="card-body table-container">
                        <div class="table-responsive">
                            <table id="tableSettingBarang" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Total Barang</th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Barang Tersedia</th>
                                        <th>Barang Rusak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($barang as $row) : ?>
                                        <tr>
                                            <td class="text-center" style="width: 50px;"><?= $i++; ?></td>
                                            <td>
                                                <a href="<?= site_url('admin/barang/cek_data/' . $row['slug']) ?>" class="text-decoration-none">
                                                    <?= truncateText($row['nama_barang'], 20); ?>
                                                </a>
                                            </td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= $row['nama_kondisi']; ?></td>
                                            <td class="text-center"><?= $row['jumlah_total']; ?> Unit</td>
                                            <td class="text-center"><?= $row['jumlah_dipinjam']; ?> Unit</td>
                                            <td class="text-center"><?= $row['jumlah_total_baik']; ?> Unit</td>
                                            <td class="text-center"><?= $row['jumlah_total_rusak']; ?> Unit</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <?php
    function truncateText($text, $maxLength)
    {
        // Memeriksa apakah teks lebih panjang dari batas maksimum
        if (strlen($text) > $maxLength) {
            // Mengambil substring dari awal hingga batas maksimum
            $text = substr($text, 0, $maxLength);
            // Mencari posisi spasi terakhir untuk memastikan tidak memotong kata di tengah
            $lastSpace = strrpos($text, ' ');
            if ($lastSpace !== false) {
                $text = substr($text, 0, $lastSpace);
            }
            // Menambahkan ellipsis (...) untuk menunjukkan bahwa teks dipotong
            $text .= '...';
        }
        return $text;
    }
    ?>
    <!-- end main content-->
    <?= $this->include('admin/layouts/footer') ?>
    </div>
    <!-- END layout-wrapper -->
    <?= $this->include('admin/layouts/script2') ?>
    <script>
        $(document).ready(function() {
            $("#tableSettingBarang").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#tableSettingBarang_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableContainer = document.getElementById('tableContainer');
            const toggleTableBtn = document.getElementById('toggleTableBtn');
            const toggleIcon = document.getElementById('toggleIcon');

            toggleTableBtn.addEventListener('click', function() {
                tableContainer.classList.toggle('collapsed');

                if (tableContainer.classList.contains('collapsed')) {
                    toggleTableBtn.innerHTML = '<i id="toggleIcon" class="bi bi-eye me-1"></i>Tampilkan';
                } else {
                    toggleTableBtn.innerHTML = '<i id="toggleIcon" class="bi bi-eye-slash me-1"></i>Sembunyikan';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                $.ajax({
                    url: "<?= site_url('admin/barang/totalData'); ?>",
                    type: "GET",
                    success: function(responseInformasi) {
                        var total = parseInt(responseInformasi.total) || 0; // Tambahkan fallback ke 0
                        if (!isNaN(total)) {
                            $("#totalCounter").attr("data-target", total);
                            $("#totalCounter").text(total);
                        } else {
                            $("#totalCounter").attr("data-target", 0);
                            $("#totalCounter").text(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $("#totalCounter").attr("data-target", 0);
                        $("#totalCounter").text(0);
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
                    url: "<?= site_url('admin/barang_baik/totalData'); ?>",
                    type: "GET",
                    success: function(responseInformasi) {
                        var total = parseInt(responseInformasi.total) || 0;
                        if (!isNaN(total)) {
                            $("#totalCounter5").attr("data-target", total);
                            $("#totalCounter5").text(total);
                        } else {
                            $("#totalCounter5").attr("data-target", 0);
                            $("#totalCounter5").text(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $("#totalCounter5").attr("data-target", 0);
                        $("#totalCounter5").text(0);
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
                    url: "<?= site_url('admin/barang_rusak/totalData'); ?>",
                    type: "GET",
                    success: function(responseInformasi) {
                        var total = parseInt(responseInformasi.total) || 0;
                        if (!isNaN(total)) {
                            $("#totalCounter6").attr("data-target", total);
                            $("#totalCounter6").text(total);
                        } else {
                            $("#totalCounter6").attr("data-target", 0);
                            $("#totalCounter6").text(0);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $("#totalCounter6").attr("data-target", 0);
                        $("#totalCounter6").text(0);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            updateCounts();

            function updateCounts() {
                // Update count for "Belum Diproses"
                updateCounter("Belum Diproses", "belumDiprosesCounter");

                // Update count for "Ditolak"
                updateCounter("Ditolak", "ditolakCounter");

                // Update count for "Dipinjamkan"
                updateCounter("Dipinjamkan", "dipinjamkanCounter");

            }

            function updateCounter(status, counterId) {
                // Satu permintaan AJAX per status
                $.ajax({
                    url: "<?= site_url('admin/transaksi/totalByStatus/'); ?>" + status,
                    type: "GET",
                    success: function(response) {
                        // Pastikan response total valid
                        var total = parseInt(response.total);

                        if (!isNaN(total)) {
                            // Update nilai pada elemen dengan id sesuai counterId
                            $("#" + counterId).attr("data-target", total);
                            $("#" + counterId).text(total);
                        } else {
                            console.error("Response total is not a number:", response);
                        }
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
                // Update untuk semua status
                let statuses = [{
                    status: "Dikembalikan",
                    id: "dikembalikanCounter"
                }];

                statuses.forEach(function(item) {
                    updateCounter(item.status, item.id);
                });
            }

            function updateCounter(status, counterId) {
                $.ajax({
                    url: "<?= site_url('admin/transaksi/totalUserByStatus/'); ?>" + status,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            $("#" + counterId)
                                .attr("data-target", response.total)
                                .text(response.total);
                        } else {
                            console.error("Error:", response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>
</body>

</html>
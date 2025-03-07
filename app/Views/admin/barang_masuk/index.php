<?= $this->include('admin/layouts/script') ?>

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
                        <h4 class="mb-sm-0 font-size-18">Data Barang Masuk</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Aktivitas Barang</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barang Masuk</a></li>
                                <li class="breadcrumb-item active">Data Barang Masuk</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
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
                            <table id="tableBarangMasuk" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <div class="col-md-3 mb-3">

                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_barang_masuk as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row['nama_barang'], 70); ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= formatTanggalIndo($row['tanggal_masuk']); ?></td>
                                            <td><?= $row['keterangan_masuk']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <?= $this->include('admin/layouts/footer') ?>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <?= $this->include('admin/layouts/script2') ?>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable dan simpan ke variabel table
            var table = $("#tableBarangMasuk").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#tableBarangMasuk_wrapper .col-md-6:eq(0)');

            // Tambahkan dropdown filter ke div yang sudah ada di HTML
            $('.col-md-3').append(`
                <div class="dropdown d-inline-block ms-2">
                    <button class="btn waves-effect waves-light bg-info dropdown-toggle" type="button" id="filterButton" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                        <i class="fas fa-info font-size-16 align-middle me-2"></i>Filter Keterangan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterButton">
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Transaksi">Transaksi Peminjaman</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Inventaris">Penambahan Inventaris</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" id="resetFilter">Tampilkan Semua</a></li>
                    </ul>
                </div>
            `);

            // Variabel untuk menyimpan filter yang aktif
            var activeFilter = '';

            // Event listener untuk opsi filter
            $('.filter-option').on('click', function(e) {
                e.preventDefault();

                var filterValue = $(this).data('filter');
                activeFilter = filterValue;

                // Update tombol filter dengan filter yang aktif
                $('#filterButton').html('<i class="fas fa-info font-size-16 align-middle me-2"></i>Filter: ' + filterValue);

                // Terapkan filter ke DataTable
                $('#tableBarangMasuk').DataTable().search(filterValue).draw();
            });

            // Event listener untuk reset filter
            $('#resetFilter').on('click', function(e) {
                e.preventDefault();

                // Reset filter yang aktif
                activeFilter = '';

                // Kembalikan teks tombol filter ke default
                $('#filterButton').html('<i class="fas fa-info font-size-16 align-middle me-2"></i>Filter Keterangan');

                // Reset filter DataTable
                $('#tableBarangMasuk').DataTable().search('').draw();
            });
        });
    </script>
    </body>

    </html>
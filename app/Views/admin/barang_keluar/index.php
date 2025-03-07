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
                        <h4 class="mb-sm-0 font-size-18">Data Barang Keluar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Aktivitas Barang</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barang Keluar</a></li>
                                <li class="breadcrumb-item active">Data Barang Keluar</li>
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
                            <table id="tableBarangRusak" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <div class="col-md-3 mb-3">
                                    <a href=" <?= site_url('admin/barang_keluar/tambah') ?>" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Total Barang</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_barang_keluar as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row['nama_barang'], 70); ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= $row['total_barang']; ?> Unit</td>
                                            <td><?= formatTanggalIndo($row['tanggal_keluar']); ?></td>
                                            <td><?= $row['keterangan']; ?></td>
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
            var table = $("#tableBarangRusak").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#tableBarangRusak_wrapper .col-md-6:eq(0)');

            // Tambahkan dropdown filter
            var buttonContainer = $('.col-md-3:has(a.btn)');
            buttonContainer.append(`
                <div class="dropdown d-inline-block ms-2">
                    <button class="btn waves-effect waves-light bg-info dropdown-toggle" type="button" id="filterButton" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                        <i class="fas fa-info font-size-16 align-middle me-2"></i>Filter Keterangan
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterButton">
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Dipinjamkan">Filter Dipinjamkan</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Bekas">Filter Bekas</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Rusak">Filter Rusak</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Cacat">Filter Cacat</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Seken">Filter Seken</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Diperbaiki">Filter Diperbaiki</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Gagal">Filter Gagal</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Preloved">Filter Preloved</a></li>
                        <li><a class="dropdown-item filter-option" href="#" data-filter="Turun harga">Filter Turun harga</a></li>
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

                // Terapkan filter ke DataTable dengan cara reinstansiasi
                $('#tableBarangRusak').DataTable().search(filterValue).draw();
            });

            // Event listener untuk reset filter
            $('#resetFilter').on('click', function(e) {
                e.preventDefault();

                // Reset filter yang aktif
                activeFilter = '';

                // Kembalikan teks tombol filter ke default
                $('#filterButton').html('<i class="fas fa-info font-size-16 align-middle me-2"></i>Filter Keterangan');

                // Reset filter DataTable dengan cara reinstansiasi
                $('#tableBarangRusak').DataTable().search('').draw();
            });
        });
    </script>

    <!-- HAPUS -->
    <script>
        $(document).ready(function() {
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var id_barang_rusak = $(this).data('id');

                Swal.fire({
                    title: "Anda Yakin Ingin Menghapus?",
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#28527A",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '<?= site_url('admin/barang_rusak/delete') ?>',
                            data: {
                                id_barang_rusak: id_barang_rusak,
                                _method: 'DELETE'
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: response.success,
                                        icon: "success"
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else if (response.error) {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.error,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Terjadi kesalahan. Silakan coba lagi.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    <!-- HAPUS -->
    </body>

    </html>
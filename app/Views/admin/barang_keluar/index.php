<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk input field saat tidak diedit */
    input[type="text"].input-readonly {
        background-color: #f0f0f0 !important;
        border: 1px solid #ccc !important;
    }

    /* CSS untuk input field saat diedit */
    input[type="text"]:not(.input-readonly) {
        background-color: white !important;
        border: 1px solid white;
    }

    input[type="text"].form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 8px;
    }

    .btn-success.save {
        background-color: green !important;
        border-color: green !important;
    }

    .btn-success.save:focus {
        box-shadow: none !important;
    }

    .custom-border {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }
</style>


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
                                        <!-- <th>Aksi</th> -->
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
                                            <!-- <td style="width: 50px">
                                                <a href="<?= site_url('admin/barang_keluar/cek_data/' . $row['nama_barang']) ?>" class="btn btn-warning btn-sm view"><i class="fas fa-edit"></i> Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= $row['id_barang_keluar'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </td> -->
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
            $("#tableBarangRusak").DataTable({
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
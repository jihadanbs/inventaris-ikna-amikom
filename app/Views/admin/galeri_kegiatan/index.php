<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS yang sudah ada */
    .custom-border {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
        background-color: black;
        background-size: 100%, 100%;
    }

    .carousel-control-prev,
    .carousel-control-next {
        background-color: transparent;
        border: none;
    }

    .carousel-img {
        max-width: 80px;
        max-height: 80px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    /* CSS baru untuk gambar kegiatan */
    .activity-img {
        width: 180px;
        height: auto;
        border-radius: 6px;
        transition: transform 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .activity-img:hover {
        transform: scale(1.05);
    }

    /* Styling untuk modal */
    .modal-content {
        background-color: #fff;
        border-radius: 8px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
    }

    .modal-body img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Animasi modal */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.show .modal-dialog {
        transform: none;
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
                        <h4 class="mb-sm-0 font-size-18">Data Galeri kegiatan </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Galeri kegiatan</a></li>
                                <li class="breadcrumb-item active">Data Galeri kegiatan</li>
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

                            <table id="example1" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <div class="col-md-3 mb-3">
                                    <a href="/admin/galeri-kegiatan/tambah" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Foto Kegiatan</th>
                                        <th>Judul</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($kegiatan as $row) : ?>
                                        <tr>
                                            <td style="width: 10px" scope="row"><?= $i++; ?></td>
                                            <!-- Tampilan gambar yang bisa diklik -->
                                            <td class="text-center">
                                                <img src="<?= base_url($row['foto_kegiatan']); ?>" class="activity-img" alt="Foto Kegiatan" data-bs-toggle="modal" data-bs-target="#activityImageModal" style="cursor: pointer;">
                                            </td>

                                            <!-- Modal untuk zoom gambar -->
                                            <div class="modal fade" id="activityImageModal" tabindex="-1" aria-labelledby="activityImageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="activityImageModalLabel">DETAIL FOTO KEGIATAN "<?= $row['judul_kegiatan']; ?>"</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="<?= base_url($row['foto_kegiatan']); ?>"
                                                                class="img-fluid"
                                                                alt="Foto Kegiatan Detail"
                                                                style="max-height: 80vh;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td><?= $row['judul_kegiatan']; ?></td>
                                            <td><?= formatTanggalIndo($row['tanggal_foto']); ?></td>
                                            <td style="width: 155px">
                                                <a href="<?= site_url('admin/galeri-kegiatan/cek_data/' . $row['judul_kegiatan']); ?>" class="btn btn-info btn-sm view"><i class="fa fa-eye"></i> Cek</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id_kegiatan="<?= $row['id_kegiatan'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
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
            $("#example1").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <!-- HAPUS -->
    <script>
        $(document).ready(function() {
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var id_kegiatan = $(this).data('id_kegiatan');

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
                            url: "<?= site_url('admin/galeri-kegiatan/delete') ?>",
                            data: {
                                id_kegiatan: id_kegiatan
                            }, // Kirim ID sebagai data POST
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: response.message,
                                        icon: "success"
                                    }).then(() => {
                                        location.reload(); // Refresh halaman
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.message,
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
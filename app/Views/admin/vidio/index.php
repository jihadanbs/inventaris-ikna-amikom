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
                        <h4 class="mb-sm-0 font-size-18">Data Vidio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vidio</a></li>
                                <li class="breadcrumb-item active">Data Vidio</li>
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
                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                        <?= session()->getFlashdata('pesan') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('gagal')) : ?>
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                        <?= session()->getFlashdata('gagal') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-3 mb-3">
                                    <a href="/admin/vidio/tambah" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Vidio</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_vidio as $row) : ?>
                                        <tr>
                                            <td data-field="id_vidio" style="width: 10px" scope="row"><?= $i++; ?></td>
                                            <td data-field="link_vidio" style="width: 250px">
                                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= $row['link_vidio']; ?>" frameborder="0" allowfullscreen></iframe>
                                            </td>
                                            <td data-field="judul_vidio" style="width: 250px"><?= $row['judul_vidio']; ?></td>
                                            <td data-field="tanggal_vidio" style="width: 250px"><?= $row['tanggal_vidio']; ?></td>
                                            <td style=" width: 155px">
                                                <a href="/admin/vidio/cek_data/<?= $row['id_vidio'] ?>" class="btn btn-info btn-sm view"><i class="fa fa-eye"></i> Cek</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= $row['id_vidio'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Delete
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
                "lengthMenu": [
                    [5, 10, 15, 20, 25], // Pilihan panjang entri yang tersedia
                    [5, 10, 15, 20, 25] // Label untuk pilihan panjang entri
                ],
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
                var id_vidio = $(this).data('id');

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
                            url: "<?= site_url('/admin/vidio/delete') ?>",
                            data: {
                                id_vidio: id_vidio // Gunakan nama variabel yang benar
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: response.success,
                                        icon: "success"
                                    }).then(() => {
                                        // Refresh halaman setelah sukses menghapus
                                        location.reload();
                                    });
                                } else if (response.error) {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.error,
                                        icon: "error"
                                    });
                                }
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
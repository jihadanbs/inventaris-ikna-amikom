<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk status "Belum Diproses" dan "Diproses" */
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk status "Diberikan" */
    .text-success {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk status "Ditolak" */
    .text-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 5px 10px;
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
                        <h4 class="mb-sm-0 font-size-18">Data Permohonan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Permohonan</a></li>
                                <li class="breadcrumb-item active">Data Permohonan</li>
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
                                <div class="col-md-3 mb-3">
                                    <a href="/admin/permohonan/tambah" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_pengunjung as $row) : ?>
                                        <tr>
                                            <td data-field="id_pengunjung" style="width: 10px" scope="row"><?= $i++; ?></td>
                                            <td data-field="email"><?= $row->email; ?></td>
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <!-- HAPUS -->
    <!-- <script>
            $(document).ready(function() {
                $('.sa-warning').click(function(e) {
                    e.preventDefault();
                    var id_pemohon = $(this).data('id');

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
                                url: "/admin/permohonan/delete",
                                data: {
                                    id_pemohon: id_pemohon
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
        </script> -->
    <!-- HAPUS -->

    <script>
        $(document).ready(function() {
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var id_pemohon = $(this).data('id');

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
                            url: "/admin/permohonan/delete",
                            data: {
                                id_pemohon: id_pemohon
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: response.message,
                                        icon: "success"
                                    }).then(() => {
                                        // Refresh halaman setelah sukses menghapus
                                        location.reload();
                                    });
                                } else if (response.status === 'error') {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.message,
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
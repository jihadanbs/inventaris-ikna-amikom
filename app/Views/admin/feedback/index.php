<?= $this->include('admin/layouts/script') ?>
<style>
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .text-success {
        background-color: #d4edda;
        color: #155724;
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
                        <h4 class="mb-sm-0 font-size-18">Data Feedback Pengunjung</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Feedback Pengunjung</a></li>
                                <li class="breadcrumb-item active">Data Feedback Pengunjung</li>
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

                                <!-- <div class="col-md-3 mb-3">
                                    <a href="/admin/feedback/tambah/" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div> -->
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Isi Pesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_feedback as $row) : ?>
                                        <tr>
                                            <td data-field="id_feedback" style="width: 10px" scope="row"><?= $i++; ?></td>
                                            <td data-field="nama"><?= truncateText($row->nama, 10); ?></td>
                                            <td data-field="email"><?= $row->email; ?></td>
                                            <td data-field="subjek"><?= truncateText($row->subjek, 10); ?></td>
                                            <td data-field="pesan"><?= truncateText($row->pesan, 10); ?></td>
                                            <td data-field="status">
                                                <?php
                                                $statusClass = '';
                                                if ($row->status === 'Belum dibalas') {
                                                    $statusClass = 'text-warning';
                                                } elseif ($row->status === 'Sudah Ditanggapi') {
                                                    $statusClass = 'text-success';
                                                }
                                                ?>
                                                <span class="<?= $statusClass; ?>"><strong><?= $row->status; ?></strong></span>
                                            </td>
                                            <td style="width: 155px">
                                                <a href="/admin/feedback/cek_data/<?= $row->id_feedback ?>" class="btn btn-info btn-sm view"><i class="fa fa-eye"></i> Cek</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= $row->id_feedback ?>">
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
    <script>
        $(document).ready(function() {
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var id_feedback = $(this).data('id');

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
                            url: "<?= site_url('/admin/feedback/delete') ?>",
                            data: {
                                id_feedback: id_feedback
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
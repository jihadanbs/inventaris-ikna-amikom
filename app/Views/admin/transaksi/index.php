<?= $this->include('admin/layouts/script') ?>

<style>
    .btn.disabled {
        opacity: 0.65;
        cursor: not-allowed;
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
                        <h4 class="mb-sm-0 font-size-18">Data Transaksi Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/transaksi') ?>">Transaksi Barang</a></li>
                                <li class="breadcrumb-item active">Data Transaksi Barang</li>
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
                            <table id="tableTransaksi" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Total</th>
                                        <!-- <th>Kategori</th> -->
                                        <th>Tanggal Transaksi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_user_peminjam as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td>
                                                <a href="<?= site_url('admin/user-peminjam/profile/' . $row['username']) ?>" class="text-decoration-none">
                                                    <?= $row['nama_lengkap']; ?>
                                                </a>
                                            </td>
                                            <td><?= $row['kode_peminjaman']; ?></td>
                                            <td><?= $row['total_jenis_barang']; ?> Jenis Barang</td>
                                            <!-- <td><?= $row['kategori_list']; ?></td> -->
                                            <td><?= formatTanggalIndo($row['tanggal_pengajuan']); ?></td>
                                            <td class="text-center">
                                                <?php if ($row['status'] === 'Belum Diproses') : ?>
                                                    <span class="badge bg-primary text-white">Belum Diproses</span>
                                                <?php elseif ($row['status'] === 'Ditolak') : ?>
                                                    <span class="badge bg-danger text-white">Ditolak</span>
                                                <?php elseif ($row['status'] === 'Dipinjamkan') : ?>
                                                    <span class="badge bg-info text-white">Dipinjamkan</span>
                                                <?php elseif ($row['status'] === 'Dikembalikan') : ?>
                                                    <span class="badge bg-success text-white">Dikembalikan</span>
                                                <?php else : ?>
                                                    <span class="badge bg-secondary text-white">Tidak Diketahui</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="width: 155px">
                                                <a href="<?= site_url('admin/transaksi/cek_data/' . $row['kode_peminjaman']) ?>" class="btn btn-info btn-sm view">
                                                    <i class="fa fa-eye"></i> Cek
                                                </a>

                                                <a href="<?= site_url('admin/user_peminjam/cek_data/' . $row['kode_peminjaman']) ?>"
                                                    class="btn btn-danger btn-sm waves-effect waves-light sa-warning"
                                                    <?= ($row['status'] != 'Dikembalikan' && $row['status'] != 'Ditolak') ? 'onclick="return false;" style="pointer-events: none; opacity: 0.5;"' : '' ?>>
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
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

    <!-- ALERT WHATSAPP -->
    <?php if (session()->getFlashdata('whatsapp_link')) : ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Data Berhasil Disimpan!',
                    text: 'Apakah Anda ingin mengirimkan melalui WhatsApp?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Buka WhatsApp',
                    cancelButtonText: 'Tidak',
                    customClass: {
                        confirmButton: 'btn btn-primary m-2',
                        cancelButton: 'btn btn-danger m-2'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Membuka link di tab baru
                        window.open('<?= session()->getFlashdata('whatsapp_link') ?>', '_blank');
                    }
                });
            });
        </script>
    <?php endif; ?>
    <!-- END ALERT WHATSAPP -->

    <script>
        $(document).ready(function() {
            $("#tableTransaksi").DataTable({
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
            }).buttons().container().appendTo('#tableTransaksi_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $('#tableTransaksi').on('click', '.sa-warning', function(e) {
            e.preventDefault();
            var kode_peminjaman = $(this).closest('tr').find('td:nth-child(3)').text().trim(); // Sesuaikan dengan kolom kode peminjaman

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
                        url: "<?= site_url('admin/transaksi/delete') ?>",
                        data: {
                            kode_peminjaman: kode_peminjaman,
                            _method: 'DELETE'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Refresh halaman atau reload DataTable
                                    location.reload();
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
                                title: "Error!",
                                text: "Terjadi kesalahan: " + error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    </script>

    </body>
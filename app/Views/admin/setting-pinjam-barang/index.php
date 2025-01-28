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
                        <h4 class="mb-sm-0 font-size-18">Setting Pinjam Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/setting-pinjam-barang') ?>">Setting Barang</a></li>
                                <li class="breadcrumb-item active">Setting Pinjam Barang</li>
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
                            <table id="tableSettingBarang" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <div class="col-md-3 mb-3">
                                    <a href=" <?= site_url('admin/setting-pinjam-barang/tambah') ?>" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Total Barang</th>
                                        <th>Masa Pinjam (Hari)</th>
                                        <th>Status Tampil</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_setting_pinjam_barang as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row['nama_barang'], 70); ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= $row['nama_kondisi']; ?></td>
                                            <td><?= $row['jumlah_total_baik']; ?> Unit</td>
                                            <td><?= $row['masa_pinjam']; ?> Hari</td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="badge <?= $row['is_tampil'] ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' ?>">
                                                        <?= $row['is_tampil'] ? 'Ditampilkan' : 'Tidak Ditampilkan' ?>
                                                    </span>
                                                    <input type="checkbox"
                                                        class="form-check-input mx-2 status-checkbox"
                                                        data-id="<?= $row['id_setting_pinjam_barang'] ?>"
                                                        <?= $row['is_tampil'] ? 'checked' : '' ?>>
                                                </div>
                                            </td>
                                            <td style="width: 155px">
                                                <a href="<?= site_url('admin/setting-pinjam-barang/edit/' . $row['slug']) ?>" class="btn btn-warning btn-sm view"><i class="fas fa-edit"></i> Ubah</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= $row['id_setting_pinjam_barang'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input type="checkbox" class="form-check-input mx-2" id="selectAll">
                            <small style="font-weight: bold;">(Select All)</small> <br>
                            <small class="form-text text-muted">
                                <span style="color: red;">Note : Total Barang yang tampilkan berdasarkan kondisi barang yang layak digunakan</span>
                            </small>
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
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const statusCheckboxes = document.querySelectorAll('.status-checkbox');

            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                let updatePromises = [];

                statusCheckboxes.forEach(checkbox => {
                    if (checkbox.checked !== isChecked) {
                        checkbox.checked = isChecked;
                        updatePromises.push(updateStatus(checkbox, isChecked));
                    }
                });

                Promise.all(updatePromises)
                    .then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Semua status berhasil diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal memperbarui beberapa status'
                        });
                    });
            });

            statusCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateStatus(this, this.checked);
                });
            });

            function updateStatus(checkbox, isChecked) {
                const id = checkbox.dataset.id;
                const csrfToken = document.querySelector('meta[name="X-CSRF-TOKEN"]')?.content;

                return fetch('<?= site_url('admin/setting-pinjam-barang/updateStatusTampil') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            id: id,
                            is_tampil: isChecked ? 1 : 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const badge = checkbox.parentElement.querySelector('.badge');
                            if (isChecked) {
                                badge.className = 'badge bg-success-subtle text-success';
                                badge.textContent = 'Ditampilkan';
                            } else {
                                badge.className = 'badge bg-danger-subtle text-danger';
                                badge.textContent = 'Tidak Ditampilkan';
                            }
                        } else {
                            checkbox.checked = !isChecked;
                            throw new Error(data.message);
                        }
                    });
            }

            function updateSelectAllState() {
                const allChecked = Array.from(statusCheckboxes).every(checkbox => checkbox.checked);
                const someChecked = Array.from(statusCheckboxes).some(checkbox => checkbox.checked);

                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }

            statusCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectAllState);
            });

            updateSelectAllState();
        });
    </script>

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
            }).buttons().container().appendTo('#tableSettingBarang_wrapper .col-md-6:eq(0)');
        });
    </script>

    <!-- HAPUS -->
    <script>
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_setting_pinjam_barang = $(this).data('id');

            // console.log('ID yang dikirim:', id_setting_pinjam_barang); // Debugging ID

            Swal.fire({
                title: "Anda Yakin Ingin Menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28527A",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url('admin/setting-pinjam-barang/delete') ?>/' + id_setting_pinjam_barang,
                        data: {
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
                                    location.reload();
                                });
                            } else if (response.status === 'error') {
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
                                text: "Terjadi kesalahan, Silakan coba lagi.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    </script>
    <!-- HAPUS -->

    </body>

    </html>
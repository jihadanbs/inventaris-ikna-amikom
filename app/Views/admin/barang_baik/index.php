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
                        <h4 class="mb-sm-0 font-size-18">Data Barang Baik</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kondisi Barang</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barang Kondisi Baik</a></li>
                                <li class="breadcrumb-item active">Data Barang Baik</li>
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
                            <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBarangModalLabel">Ubah Data Barang Baik</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="editBarangForm">
                                            <div class="modal-body">
                                                <input type="hidden" id="id_barang_baik" name="id_barang_baik">
                                                <div class="mb-3">
                                                    <label for="jumlah_total_baik" class="form-label">Jumlah Total Kondisi Baik/Layak<span class="text-danger">*</span></label>
                                                    <input type="number" style="background-color: white;" class="form-control" id="jumlah_total_baik" name="jumlah_total_baik" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan_baik" class="form-label">Keterangan<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" style="background-color: white;" id="keterangan_baik" name="keterangan_baik" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                                                <button type="submit" class="btn btn-warning btn-md edit"><i class="fas fa-save"></i> Simpan Perubahan Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                            <table id="tableBarangBaik" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Total Barang</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_barang_baik as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row['nama_barang'], 70); ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= $row['jumlah_total_baik']; ?> Unit</td>
                                            <td><?= $row['keterangan_baik']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm view" onclick="editBarang(<?= $row['id_barang_baik'] ?>, <?= $row['jumlah_total_baik'] ?>, '<?= $row['keterangan_baik'] ?>')"><i class="fas fa-edit"></i> Ubah</button>
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
            $("#tableBarangBaik").DataTable({
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
            }).buttons().container().appendTo('#tableBarangBaik_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        function editBarang(id, jumlah, keterangan) {
            document.getElementById('id_barang_baik').value = id;
            document.getElementById('jumlah_total_baik').value = jumlah;
            document.getElementById('keterangan_baik').value = keterangan;

            new bootstrap.Modal(document.getElementById('editBarangModal')).show();
        }

        document.getElementById('editBarangForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const id = formData.get('id_barang_baik');

            const data = {
                jumlah_total_baik: formData.get('jumlah_total_baik'),
                keterangan_baik: formData.get('keterangan_baik')
            };

            fetch(`<?= site_url('admin/barang_baik/update') ?>/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editBarangModal')).hide();
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui data');
                });
        });
    </script>

    </body>

    </html>
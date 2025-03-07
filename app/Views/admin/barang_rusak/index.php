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
                        <h4 class="mb-sm-0 font-size-18">Data Barang Rusak</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kondisi Barang</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Barang Kondisi Rusak</a></li>
                                <li class="breadcrumb-item active">Data Barang Rusak</li>
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
                            <!-- Modal Edit Barang Rusak -->
                            <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBarangModalLabel">Ubah Data Barang Rusak</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="editBarangForm">
                                            <div class="modal-body">
                                                <input type="hidden" id="id_barang_rusak" name="id_barang_rusak">
                                                <div class="mb-3">
                                                    <label for="jumlah_total_rusak" class="form-label">Jumlah Total Kondisi Rusak<span class="text-danger">*</span></label>
                                                    <input type="number" style="background-color: white;" class="form-control" id="jumlah_total_rusak" name="jumlah_total_rusak" required>
                                                    <div id="jumlah_total_rusak_error" class="text-danger" style="font-size: 0.875em; display: none;"></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="keterangan_rusak" class="form-label">Keterangan<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" style="background-color: white;" id="keterangan_rusak" name="keterangan_rusak" rows="3"></textarea>
                                                    <div id="keterangan_rusak_error" class="text-danger" style="font-size: 0.875em; display: none;"></div>
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
                            <table id="tableBarangRusak" class="table table-bordered dt-responsive nowrap w-100">
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
                                    <?php foreach ($tb_barang_rusak as $row) : ?>
                                        <tr>
                                            <td style="width: 2px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row['nama_barang'], 70); ?></td>
                                            <td><?= $row['nama_kategori']; ?></td>
                                            <td><?= $row['jumlah_total_rusak']; ?> Unit</td>
                                            <td><?= $row['keterangan_rusak']; ?></td>
                                            <td style="width: 50px">
                                                <button type="button" class="btn btn-warning btn-sm view" onclick="editBarang(<?= $row['id_barang_rusak'] ?>, <?= $row['jumlah_total_rusak'] ?>, '<?= $row['keterangan_rusak'] ?>')"><i class="fas fa-edit"></i> Ubah</button>
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
            $("#tableBarangRusak").DataTable({
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
            }).buttons().container().appendTo('#tableBarangRusak_wrapper .col-md-6:eq(0)');
        });

        function editBarang(id, jumlahRusak, keteranganRusak) {
            // Isi data ke dalam form modal
            document.getElementById('id_barang_rusak').value = id;
            document.getElementById('jumlah_total_rusak').value = jumlahRusak;
            document.getElementById('keterangan_rusak').value = keteranganRusak;

            // Tampilkan modal untuk mengedit
            $('#editBarangModal').modal('show');
        }

        document.getElementById('editBarangForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const id = formData.get('id_barang_rusak');

            // Ambil nilai jumlah rusak dan keterangan
            const jumlahRusak = formData.get('jumlah_total_rusak');
            const keteranganRusak = formData.get('keterangan_rusak');

            // Reset pesan error
            document.getElementById('jumlah_total_rusak_error').style.display = 'none';
            document.getElementById('keterangan_rusak_error').style.display = 'none';

            // Validasi input
            let isValid = true;

            // Validasi jumlah rusak
            if (!jumlahRusak || jumlahRusak <= 0) {
                document.getElementById('jumlah_total_rusak_error').innerText = 'Jumlah rusak harus lebih besar dari 0!';
                document.getElementById('jumlah_total_rusak_error').style.display = 'block';
                isValid = false;
            }

            // Validasi keterangan
            if (!keteranganRusak) {
                document.getElementById('keterangan_rusak_error').innerText = 'Keterangan harus diisi!';
                document.getElementById('keterangan_rusak_error').style.display = 'block';
                isValid = false;
            }

            // Jika form tidak valid, hentikan eksekusi
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Silakan periksa kembali inputan Anda!',
                });
                return;
            }

            // Jika valid, lanjutkan dengan mengirim data
            const data = {
                jumlah_total_rusak: jumlahRusak,
                keterangan_rusak: keteranganRusak,
            };

            fetch(`<?= site_url('admin/barang_rusak/update') ?>/${id}`, {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui.',
                        }).then(() => {
                            // Refresh page after success
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: 'Terjadi kesalahan saat memperbarui data',
                    });
                });
        });
    </script>


    </body>

    </html>
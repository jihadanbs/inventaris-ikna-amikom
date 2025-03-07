<?= $this->include('admin/layouts/script') ?>

<style>
    #userCardControls {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
    }

    .dataTables_length,
    .dataTables_filter {
        display: flex;
        align-items: center;
    }

    .dataTables_length label,
    .dataTables_filter label {
        margin-right: 10px;
    }

    .dataTables_filter input {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .dt-buttons button {
        padding: 8px 12px;
        border-radius: 5px;
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .dt-buttons button:hover {
        background-color: #495057;
    }
</style>

<?= $this->include('admin/layouts/navbar') ?>
<?= $this->include('admin/layouts/sidebar') ?>
<?= $this->include('admin/layouts/rightsidebar') ?>

<?= $this->section('content'); ?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data User Peminjam</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/user-peminjam') ?>">User Peminjam</a></li>
                                <li class="breadcrumb-item active">Data User Peminjam</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Container untuk DataTables search dan filter controls -->
            <div class="card mb-4">
                <div class="card-body">
                    <div id="userCardControls">
                        <!-- DataTables controls akan ditambahkan di sini oleh JavaScript -->
                    </div>

                    <!-- Container untuk card users dengan ID untuk DataTables -->
                    <div id="userCardContainer" class="card-users-container">
                        <div class="row user-cards">
                            <?php foreach ($tb_user as $row) : ?>
                                <div class="col-xl-3 col-sm-6 user-card-item"
                                    data-nama="<?= esc($row['nama_lengkap']); ?>"
                                    data-username="<?= esc($row['username']); ?>"
                                    data-pekerjaan="<?= esc($row['pekerjaan']); ?>"
                                    data-email="<?= esc($row['email']); ?>">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="dropdown text-end">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="<?= site_url('admin/user-peminjam/delete/' . $row['username']) ?>">Hapus</a>
                                                </div>
                                            </div>

                                            <div class="mx-auto mb-4">
                                                <?php
                                                $profileImage = !empty($row['file_profil']) ? base_url($row['file_profil']) : base_url('assets/img/404.gif');
                                                ?>
                                                <img src="<?= esc($profileImage, 'attr'); ?>" alt="Profile Picture" class="avatar-xl rounded-circle img-thumbnail">
                                            </div>

                                            <h5 class="font-size-16 mb-1"><a href="#" class="text-body"> <?= esc($row['nama_lengkap']); ?> </a></h5>
                                            <p class="text-muted mb-2"> <?= esc($row['pekerjaan']); ?> </p>
                                        </div>

                                        <div class="btn-group" role="group">
                                            <a href="<?= site_url('admin/user-peminjam/profile/' . $row['username']) ?>" class="btn btn-outline-light text-truncate">
                                                <i class="uil uil-user me-1"></i> Profile
                                            </a>
                                            <a href="https://wa.me/<?= '62' . substr(esc($row['no_telepon']), 1); ?>" target="_blank" class="btn btn-outline-light text-truncate">
                                                <i class="uil uil-whatsapp me-1"></i> WhatsApp
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Hidden table untuk export (tidak ditampilkan tapi digunakan DataTables) -->
                    <div style="display: none;">
                        <table id="tableUser" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>No Telepon</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($tb_user as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= esc($row['nama_lengkap']); ?></td>
                                        <td><?= esc($row['username']); ?></td>
                                        <td><?= esc($row['no_telepon']); ?></td>
                                        <td><?= esc($row['email']); ?></td>
                                        <td><?= esc($row['alamat']); ?></td>
                                        <td><?= esc($row['pekerjaan']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tambahkan div untuk pagination dengan float-end -->
                    <div class="row g-0 align-items-center">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0" id="dataInfo"><!-- Info jumlah entri akan ditambahkan oleh JavaScript --></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                <div id="cardPagination" class="dataTables_paginate paging_simple_numbers"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
        <?= $this->include('admin/layouts/footer') ?>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <?= $this->include('admin/layouts/script2') ?>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables untuk tabel tersembunyi (untuk export dan pagination)
            var dataTable = $("#tableUser").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 8,
                'searching': true,
                "lengthMenu": [
                    [4, 8, 12, -1],
                    [4, 8, 12, "Semua"]
                ],
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    'colvis'
                ],
                "language": {
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                }
            });

            // Tambahkan tombol export ke container kontrol
            dataTable.buttons().container().appendTo('#userCardControls');

            // Tampilkan kontrol length (jumlah item per halaman)
            $('#userCardControls').prepend($('.dataTables_length'));

            // Tampilkan kotak pencarian
            $('#userCardControls').prepend($('.dataTables_filter'));

            // Fungsi untuk menampilkan info data (jumlah entri)
            function updateDataInfo() {
                var info = dataTable.page.info();
                $('#dataInfo').html('Showing ' + (info.start + 1) + ' to ' + info.end + ' of ' + info.recordsDisplay + ' entries');
            }

            // Panggil updateDataInfo saat pertama kali halaman dimuat
            updateDataInfo();

            // Clone pagination DataTables ke cardPagination dengan kelas untuk mengatur posisi
            function updatePagination() {
                $('#cardPagination').empty();
                var paginationClone = $('#tableUser_paginate').clone(true);
                paginationClone.addClass('float-sm-end'); // Tambahkan kelas float-end
                paginationClone.appendTo('#cardPagination');
            }

            // Panggil updatePagination saat pertama kali halaman dimuat
            updatePagination();

            // Kustomisasi tampilan card berdasarkan pagination DataTables
            function displayCards() {
                var info = dataTable.page.info();
                var startIndex = info.start;
                var endIndex = info.end;

                // Sembunyikan semua card terlebih dahulu
                $('.user-card-item').hide();

                // Ambil data yang sudah difilter oleh DataTables
                var filteredData = dataTable.rows({
                    search: 'applied'
                }).data();

                // Tampilkan hanya card yang sesuai dengan hasil pencarian dan halaman yang aktif
                filteredData.each(function(data, dataIndex) {
                    if (dataIndex >= startIndex && dataIndex < endIndex) {
                        // Ambil username dari data untuk mencocokkan dengan card
                        var username = data[2]; // indeks 2 adalah kolom username di tabel
                        $('.user-card-item[data-username="' + username + '"]').show();
                    }
                });
            }

            // Panggil displayCards saat pertama kali halaman dimuat
            displayCards();

            // Update tampilan card setiap kali DataTable berubah (paging, searching, dll)
            dataTable.on('draw', function() {
                // Update pagination
                updatePagination();

                // Update info data
                updateDataInfo();

                // Update tampilan card
                displayCards();
            });

            // Gunakan fungsi pencarian dari DataTables
            $('.dataTables_filter input').on('keyup', function() {
                dataTable.search(this.value).draw();
            });

            // Tambahkan tombol untuk pengaturan tampilan kolom
            $('#userCardControls').append('<div class="mt-2 ms-2"><button class="btn btn-sm btn-info" id="toggleCardViewBtn">Pengaturan Tampilan</button></div>');

            // Modal untuk pengaturan tampilan (simulasi colvis)
            $('body').append(`
        <div class="modal fade" id="cardViewSettings" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pengaturan Tampilan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showNama" checked>
                            <label class="form-check-label" for="showNama">Nama Lengkap</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showPekerjaan" checked>
                            <label class="form-check-label" for="showPekerjaan">Pekerjaan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showButtons" checked>
                            <label class="form-check-label" for="showButtons">Tombol Aksi</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    `);

            // Toggle modal pengaturan tampilan
            $('#toggleCardViewBtn').on('click', function() {
                var cardViewModal = new bootstrap.Modal(document.getElementById('cardViewSettings'));
                cardViewModal.show();
            });

            // Implementasi toggle untuk elemen tampilan
            $('#showNama').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.font-size-16.mb-1').show();
                } else {
                    $('.font-size-16.mb-1').hide();
                }
            });

            $('#showPekerjaan').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.text-muted.mb-2').show();
                } else {
                    $('.text-muted.mb-2').hide();
                }
            });

            $('#showButtons').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.btn-group').show();
                } else {
                    $('.btn-group').hide();
                }
            });
        });
    </script>

    <!-- HAPUS -->
    <script>
        $('.sa-warning').click(function(e) {
            if ($(this).hasClass('disabled')) {
                return false;
            }

            e.preventDefault();
            var id_user_peminjam = $(this).data('id');

            // console.log('ID yang dikirim:', id_user_peminjam); // Debugging ID

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
                        url: '<?= site_url('admin/user_peminjam/delete') ?>/' + id_user_peminjam,
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
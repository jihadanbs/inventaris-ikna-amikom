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

    .editable-input {
        border: none;
        /* Hilangkan border by default */
        outline: none;
        /* Hilangkan outline saat focus */
    }

    .edit-mode .editable-input {
        border: 1px solid black;
        /* Tampilkan border saat dalam mode edit */
        cursor: not-allowed;
        /* Ubah kursor menjadi tanda teks saat dalam mode edit */
    }
</style>
</head>

<body>

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
                            <h4 class="mb-sm-0 font-size-18">Data Cara Memperoleh Informasi</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Cara Memperoleh Informasi</a></li>
                                    <li class="breadcrumb-item active">Data Cara Memperoleh Informasi</li>
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

                                    <div class="col-md-3">
                                        <button type="button" class="btn waves-effect waves-light mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #28527A; color:white;">
                                            <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Cara Memperoleh Informasi</h5>
                                                        <!-- Menambahkan ID ke tombol "Silang" -->
                                                        <button type="button" id="closeButton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form action="/admin/memperoleh_informasi/save" method="POST">
                                                            <?= csrf_field(); ?>
                                                            <div class="mb-3">
                                                                <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                                                <input class="form-control" id="deskripsi" name="deskripsi" cols="30" rows="10" style="background-color: white;" placeholder="Masukkan Deskripsi" autofocus></input>
                                                                <!-- Menambahka div untuk menampilkan pesan validasi -->
                                                                <div id="deskripsiValidation" class="text-danger"></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Menambahkan ID ke tombol "Batal" -->
                                                                <button type="button" id="batalButton" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <!-- Menambahkan ID ke tombol "Tambah" -->
                                                                <button type="submit" id="tambahButton" class="btn btn-primary" style="background-color: #28527A; color:white;">Tambah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb_memperoleh_informasi as $row) : ?>
                                            <tr>
                                                <td data-field="id_memperoleh_informasi" style="width: 80px" scope="row"><?= $i++; ?></td>
                                                <td data-field="deskripsi"><?= $row['deskripsi']; ?>

                                                </td>
                                                <td style="width: 150px">
                                                    <button type="button" class="btn btn-warning btn-sm edit waves-effect waves-light" data-id="<?= $row['id_memperoleh_informasi']; ?>" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i> <span class="btn-text">Edit</span>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= $row['id_memperoleh_informasi']; ?>">
                                                        <i class="fas fa-trash-alt"></i> <span class="btn-text">Delete</span>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm save waves-effect waves-light d-none" data-id="<?= $row['id_memperoleh_informasi']; ?>">
                                                        <i class="fas fa-save"></i> <span class="btn-text">Simpan</span>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm cancel waves-effect waves-light d-none" data-id="<?= $row['id_memperoleh_informasi']; ?>">
                                                        <i class="fas fa-times"></i> <span class="btn-text">Batal</span>
                                                    </button>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
        </div>

    </div>

    <?= $this->include('admin/layouts/footer') ?>
    <?= $this->include('admin/layouts/script2') ?>

    <!-- Export -->
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $("#example1").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!-- End Export -->

    <!-- EDIT -->
    <script>
        $(document).ready(function() {
            var originalData = {}; // Objek untuk menyimpan data awal
            var editedIds = []; // Array untuk menyimpan id_lembaga yang sedang diedit

            // Event klik untuk tombol Edit
            $(document).on('click', '.edit', function() {
                var tr = $(this).closest('tr');
                var id_memperoleh_informasi = $(this).data('id');
                var deskripsi = tr.find("[data-field='deskripsi']").text().trim(); // Hapus spasi ekstra

                // Simpan data awal sebelum diubah
                originalData[id_memperoleh_informasi] = deskripsi;

                // Tambahkan id_lembaga ke dalam array editedIds
                if (!editedIds.includes(id_memperoleh_informasi)) {
                    editedIds.push(id_memperoleh_informasi);
                }

                var deskripsi_input = '<input type="text" class="form-control input-editable bg-gray" style="width: 885px;" value="' + deskripsi + '">'; // Tambahkan class bg-gray

                // Ganti teks dengan input
                tr.find("[data-field='deskripsi']").html(deskripsi_input);

                // Fokuskan input dan atur kursor ke posisi terakhir
                var input = tr.find("[data-field='deskripsi'] input")[0];
                input.focus();
                input.setSelectionRange(input.value.length, input.value.length);

                // Tampilkan tombol Simpan dan Batal, serta sembunyikan tombol Edit dan Hapus
                $(this).addClass('d-none');
                $(this).siblings('.sa-warning').addClass('d-none');
                $(this).siblings('.cancel').removeClass('d-none');
                $(this).siblings('.save').removeClass('d-none');
            });

            // Event klik untuk tombol Batal
            $(document).on('click', '.cancel', function() {
                var tr = $(this).closest('tr');
                var id_memperoleh_informasi = $(this).data('id');

                // Kembalikan tampilan ke semula menggunakan data awal
                tr.find("[data-field='deskripsi']").text(originalData[id_memperoleh_informasi]);

                // Hapus id_memperoleh_informasi dari array editedIds
                editedIds = editedIds.filter(function(item) {
                    return item !== id_memperoleh_informasi;
                });

                // Tampilkan tombol Edit dan Hapus, serta sembunyikan tombol Simpan dan Batal
                $(this).addClass('d-none');
                $(this).siblings('.edit').removeClass('d-none');
                $(this).siblings('.sa-warning').removeClass('d-none');
                $(this).siblings('.save').addClass('d-none');
            });

            // Event klik untuk tombol Simpan
            $(document).on('click', '.save', function() {
                var dataToSave = [];

                // Loop melalui setiap id_lembaga yang sedang diedit
                editedIds.forEach(function(id_memperoleh_informasi) {
                    var tr = $('button.edit[data-id="' + id_memperoleh_informasi + '"]').closest('tr');
                    var deskripsi = tr.find("[data-field='deskripsi'] input").val().trim(); // Hapus spasi ekstra
                    dataToSave.push({
                        id_memperoleh_informasi: id_memperoleh_informasi,
                        deskripsi: deskripsi
                    });
                });

                // Lakukan AJAX untuk menyimpan perubahan ke database
                $.ajax({
                    url: '<?= site_url('admin/memperoleh_informasi/simpan_perubahan') ?>',
                    method: 'POST',
                    data: {
                        dataToSave: dataToSave
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses dan refresh halaman jika berhasil
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            // Tampilkan pesan error jika terjadi kesalahan
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message ? response.message : 'Deskripsi sudah ada dalam database !'
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan: ' + error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menyimpan data.'
                        });
                    }
                });
            });
        });
    </script>
    <!-- END EDIT -->

    <!-- HAPUS -->
    <script>
        $(document).ready(function() {
            $('.sa-warning').click(function(e) {
                e.preventDefault();
                var id_memperoleh_informasi = $(this).data('id');

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
                            url: "<?= site_url('/admin/memperoleh_informasi/delete') ?>",
                            data: {
                                id_memperoleh_informasi: id_memperoleh_informasi
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

    <!-- TAMBAH -->
    <script>
        $(document).ready(function() {
            // Tangkap event klik pada tombol "Tambah"
            $('#tambahButton').click(function() {
                // Hapus pesan validasi jika ada
                $('#deskripsiValidation').text('');

                // Periksa apakah input nama_dinas tidak kosong
                if ($('#deskripsi').val() === '') {
                    // Tampilkan pesan validasi
                    $('#deskripsiValidation').text('Deskripsi harus diisi !');
                    // Hentikan aksi default
                    return false;
                }

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('/admin/memperoleh_informasi/save'); ?>",
                    data: {
                        deskripsi: $('#deskripsi').val()
                    },
                    success: function(response) {
                        // Tampilkan notifikasi jika nama dinas sudah ada di database
                        if (response.error) {
                            $('#deskripsiValidation').text(response.error);
                            // Reset nilai input nama_dinas
                            $('#deskripsi').val('');
                            return false;
                        }

                        // Tampilkan notifikasi sukses dengan SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            text: response.success
                        }).then((result) => {
                            // Jika tombol "OK" ditekan, refresh halaman
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan kesalahan jika terjadi kesalahan AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Deskripsi sudah ada dalam database !'
                        });
                        // Reset nilai input nama_dinas
                        $('#deskripsi').val('');
                    }
                });

                // Hindari pengiriman form secara otomatis
                return false;
            });

            // Tangkap event saat tombol "Batal" pada modal ditekan
            $('#batalButton, #closeButton').click(function() {
                // Hapus pesan validasi
                $('#deskripsiValidation').text('');
                // Reset nilai input nama_dinas
                $('#deskripsi').val('');
            });
        });
    </script>
    <!-- TAMBAH -->

</body>

</html>
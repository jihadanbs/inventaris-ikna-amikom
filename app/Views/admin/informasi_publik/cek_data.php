<?= $this->include('admin/layouts/script') ?>
<div class="col-md-12">

    <?= $this->include('admin/layouts/navbar') ?>
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
        <?= $this->include('admin/layouts/sidebar') ?>
    </div>
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Publik</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">PPID Kab. Pesawaran</h3>
                    </div>

                    <div class="card-body">
                        <?php
                        if (session()->getFlashdata('pesan')) {
                            echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                            echo session()->getFlashdata('pesan');
                            echo '</h5></div>';
                        }
                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Informasi Publik</b></h4>
                            <?php if (!empty($tb_informasi_publik)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/psw.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                    <th width="170px">Nama Dinas</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->nama_dinas ?? '' ?> </td>
                                </tr>
                                <tr>
                                    <th width="150px">Kategori Informasi</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->nama_kategori ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Jenis Informasi</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->nama_jenis ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Judul</th>
                                    <th class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->judul ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->deskripsi ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal File</th>
                                    <th class="text-center">:</th>
                                    <td><?= $tb_informasi_publik->tanggal_file ?? '' ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width=50px>NO</th>
                                    <th>Dokumen</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dokumen as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td><?= $value->judul ?></td>
                                        <td class="text-center">
                                            <?php if ($value->file_informasi_publik) : ?>
                                                <a href="<?= base_url($value->file_informasi_publik) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/informasi_publik" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/informasi_publik/edit/<?= $value->slug ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $value->id_informasi_publik ?>">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>

<?= $this->include('admin/layouts/script2') ?>

<!-- HAPUS -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_informasi_publik = $(this).data('id');

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
                        url: "/admin/informasi_publik/delete2", // Ubah sesuai dengan URL
                        data: {
                            id_informasi_publik: id_informasi_publik
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect ke halaman /admin/informasi_publik setelah sukses menghapus
                                    window.location.href = '/admin/informasi_publik';
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
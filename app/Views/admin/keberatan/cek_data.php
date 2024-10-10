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

    /* CSS untuk kode keberatan */
    .kode-keberatan {
        background-color: #f0f0f0;
        color: #333;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 16px;
        display: inline-block;
    }

    /* CSS untuk readmore */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .read-more-link {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<div class="col-md-12">
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
        <?= $this->include('admin/layouts/navbar') ?>
        <?= $this->include('admin/layouts/sidebar') ?>
    </div>
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Keberatan</a></li>
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
                        function getStatusClass($status)
                        {
                            switch ($status) {
                                case 'Diberikan':
                                    return 'text-success';
                                case 'Ditolak':
                                    return 'text-danger';
                                case 'Diproses':
                                    return 'text-warning';
                                default:
                                    return 'text-warning';
                            }
                        }
                        ?>

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
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }
                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Keberatan Informasi Publik</b></h4>
                            <?php if (!empty($keberatan)) : ?>
                                <tr>
                                    <td rowspan="50" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/psw.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                    <th width="170px">Nama Lengkap</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $keberatan['nama'] ?? '' ?></strong> </td>
                                </tr>
                                <tr>
                                    <th width="150px">Email</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $keberatan['email'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">Nomor Telepon</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $keberatan['no_telepon'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th class="text-center">:</th>
                                    <td><?= $keberatan['alamat'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Keberatan</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="kode-keberatan">
                                            <?= empty($keberatan['kode_keberatan']) ? 'Tidak Punya Kode Keberatan' : $keberatan['kode_keberatan'] ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="<?= getStatusClass($keberatan['status']) ?>">
                                            <?= empty($keberatan['status']) ? 'Belum Diproses' : $keberatan['status'] ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Ringkasan Kasus</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore">
                                        <?php if ($keberatan) : ?>
                                            <?= truncateText($keberatan['ringkasan_kasus'], 50) ?? 'Data tidak ditemukan'; ?>
                                            <?php if (strlen(strip_tags($keberatan['ringkasan_kasus'])) > 20) : ?>
                                                <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($keberatan['ringkasan_kasus']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            Data tidak ditemukan
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th style="font-size: 1.0rem;">Alasan Yang Dipilih</th>
                                    <th class="text-center" style="font-size: 1.0rem;">:</th>
                                    <td>
                                        <?php if (empty($keberatan['deskripsi'])) : ?>
                                            <span class="badge bg-danger" style="font-size: 0.75em;">Tidak ada alasan yang di pilih</span>
                                        <?php else : ?>
                                            <?php
                                            $deskripsiList = explode(", ", $keberatan['deskripsi']);
                                            foreach ($deskripsiList as $deskripsi) :
                                            ?>
                                                <span class="badge bg-success" style="font-size: 0.75rem;"><?= $deskripsi ?></span>
                                            <?php endforeach; ?>
                                            <br><br>
                                            <span class="badge bg-primary" style="font-size: 0.75rem;">Jumlah alasan : <?= count($deskripsiList) ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Modal Structure -->
                                <div id="readMoreModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p id="modal-text"></p>
                                    </div>
                                </div>
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
                                        <td>File Keberatan</td>
                                        <td class="text-center">
                                            <?php if ($value->file_keberatan) : ?>
                                                <a href="<?= base_url($value->file_keberatan) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- Tambahan File Diberikan jika statusnya 'Diberikan' -->
                                    <?php if ($value->status == 'Diberikan') : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?>.</td>
                                            <td>File Diberikan</td>
                                            <td class="text-center">
                                                <?php if ($value->file_diberikan) : ?>
                                                    <a href="<?= base_url($value->file_diberikan) ?>" class="btn btn-success btn-sm view" target="_blank">
                                                        <i class="fas fa-eye"></i> View File
                                                    </a>
                                                <?php else : ?>
                                                    <a href="#" class="btn btn-success btn-sm view disabled" title="File tidak tersedia">
                                                        <i class="fas fa-eye"></i> View File
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4 d-flex justify-content-between align-items-center">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="/admin/keberatan" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/keberatan/diproses/<?= $keberatan['id_keberatan'] ?>" class="btn btn-warning btn-md ml-3 <?= $keberatan['status'] == 'Diproses' || $keberatan['status'] == 'Ditolak' || $keberatan['status'] == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-hourglass-half"></i> Proses
                                </a>
                                <a href="/admin/keberatan/ditolak/<?= $keberatan['id_keberatan'] ?>" class="btn btn-danger btn-md ml-3 <?= $keberatan['status'] == 'Belum diproses' || $keberatan['status'] == 'Ditolak' || $keberatan['status'] == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-times"></i> Tolak
                                </a>
                                <a href="/admin/keberatan/diberikan/<?= $keberatan['id_keberatan'] ?>" class="btn btn-success btn-md ml-3 <?= $keberatan['status'] == 'Belum diproses' || $keberatan['status'] == 'Ditolak' || $keberatan['status'] == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-check"></i> Terima
                                </a>
                            </div>
                            <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $keberatan['id_keberatan'] ?>">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>

<?= $this->include('admin/layouts/script2') ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("readMoreModal");
        const modalText = document.getElementById("modal-text");
        const closeBtn = document.querySelector(".modal .close");

        document.querySelectorAll(".read-more-link").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const fullText = this.getAttribute("data-text");
                modalText.innerText = fullText;
                modal.style.display = "block";
            });
        });

        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

<!-- hapus -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_keberatan = $(this).data('id');

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
                        url: "/admin/keberatan/delete2",
                        data: {
                            id_keberatan: id_keberatan
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect ke halaman /admin/keberatan setelah sukses menghapus
                                    window.location.href = '/admin/keberatan';
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
<!-- end hapus -->
</body>

</html>
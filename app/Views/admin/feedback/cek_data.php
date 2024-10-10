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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Feedback Pengunjung</a></li>
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
                                case 'Sudah Ditanggapi':
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
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Feedback Pengunjung</b></h4>
                            <?php if (!empty($tb_feedback)) : ?>
                                <tr>
                                    <td rowspan="50" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/psw.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                    <th width="170px">Nama Lengkap</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_feedback->nama ?? '' ?></strong> </td>
                                </tr>
                                <tr>
                                    <th width="150px">Email</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_feedback->email ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">No. Telepon</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_feedback->no_telepon ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Subjek</th>
                                    <th class="text-center">:</th>
                                    <td><strong><?= $tb_feedback->subjek ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Isi Pesan</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><?= truncateText($tb_feedback->pesan, 50) ?? 'Data tidak ditemukan'; ?>
                                        <?php if (strlen(strip_tags($tb_feedback->pesan)) > 50) : ?>
                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_feedback->pesan), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="<?= getStatusClass($tb_feedback->status) ?>">
                                            <?= empty($tb_feedback->status) ? 'Belum dibalas' : $tb_feedback->status ?>
                                        </strong>
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

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/feedback" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/feedback/balas/<?= $tb_feedback->id_feedback ?>" class="btn btn-success btn-md ml-3 <?= $tb_feedback->status == 'Sudah Ditanggapi' ? 'disabled' : '' ?>">
                                    <i class="fas fa-reply"></i> Balas
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $tb_feedback->id_feedback ?>">
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
                        url: "/admin/feedback/delete2",
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
                                    // Redirect ke halaman /admin/feedback setelah sukses menghapus
                                    window.location.href = '/admin/feedback';
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
</body>

</html>
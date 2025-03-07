<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk readmore */
    .jendela {
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

    .jendela-content {
        position: relative;
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .close {
        position: absolute;
        top: -8px;
        right: 10px;
        color: red;
        font-size: 30px;
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
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Profile Peminjam</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/user-peminjam') ?>">Data Peminjam</a></li>
                                    <li class="breadcrumb-item active">Profile Peminjam</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">IKNA AMIKOM YOGYAKARTA</h3>
                    </div>

                    <div class="card-body">

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-4"><b>FORMULIR CEK DATA PEMINJAM</b></h4>
                            <?php if (!empty($tb_user)) : ?>
                                <tr>
                                    <td rowspan="1" width="150px" class="text-center">
                                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $files = explode(', ', $tb_user['file_profil'] ?? '');
                                                if (!empty($files[0])) :
                                                    foreach ($files as $index => $file) : ?>
                                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                            <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="Profil User" style="max-height: 300px; object-fit: cover;">
                                                        </div>
                                                    <?php endforeach;
                                                else : ?>
                                                    <div class="carousel-item active">
                                                        <img src="<?= esc(base_url('assets/img/404.gif'), 'attr'); ?>" class="d-block w-100" alt="Default Image" style="max-height: 300px; object-fit: cover;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td style="padding-left: 50px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Nama Lengkap</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user['nama_lengkap'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Username</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user['username'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Pekerjaan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user['pekerjaan'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Email</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user['email'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">No. Telepon</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php
                                                // Ambil nomor telepon dari database
                                                $no_telepon = $tb_user['no_telepon'] ?? '';

                                                // Konversi nomor telepon ke format internasional
                                                if (substr($no_telepon, 0, 1) == '0') {
                                                    $no_telepon_wa = '+62' . substr($no_telepon, 1);
                                                } else {
                                                    $no_telepon_wa = $no_telepon;
                                                }

                                                // Buat link WhatsApp
                                                $link_wa = "https://wa.me/{$no_telepon_wa}";
                                                ?>
                                                <p>
                                                    <a href="<?= esc($link_wa, 'attr'); ?>" target="_blank" class="text-success">
                                                        <?= esc($no_telepon); ?>
                                                    </a>
                                                </p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Alamat</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user['alamat'] ?? '', 'html'); ?></p>
                                            </div>

                                            <!-- script read more -->
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const modal = document.getElementById("readMoreModal");
                                                    const modalText = document.getElementById("jendela-text");
                                                    const closeBtn = document.querySelector(".jendela .close");

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
                                            <!-- end script -->

                                            <!-- Modal Structure -->
                                            <div id="readMoreModal" class="jendela">
                                                <div class="jendela-content">
                                                    <span class="close">&times;</span>
                                                    <p id="jendela-text"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>
<?= $this->include('admin/layouts/script2') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousels = document.querySelectorAll('.carousel');
        carousels.forEach(function(carousel) {
            new bootstrap.Carousel(carousel);
        });
    });
</script>

<script>
    $('.sa-warning').click(function(e) {
        if ($(this).hasClass('disabled')) {
            return false;
        }

        e.preventDefault();
        var id_user = $(this).data('id');

        // console.log('ID yang dikirim:', id_user); // Debugging ID

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
                    url: '<?= site_url('admin/user_peminjam/delete') ?>/' + id_user,
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
                                window.location.href = '<?= site_url('admin/transaksi') ?>';
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
</body>

</html>
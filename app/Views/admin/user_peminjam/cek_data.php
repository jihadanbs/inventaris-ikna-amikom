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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Peminjam</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/user_peminjam') ?>">Data Peminjam</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data Peminjam</li>
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
                            <?php if (!empty($tb_user_peminjam)) : ?>
                                <tr>
                                    <td rowspan="1" width="250px" class="text-center">
                                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach (explode(', ', $tb_user_peminjam['path_file_foto_barang'] ?? '') as $index => $file) : ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-height: 300px; object-fit: cover;">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>

                                    <td style="padding-left: 50px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Nama Lengkap</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user_peminjam['nama_lengkap'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Pekerjaan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user_peminjam['pekerjaan'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Email</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user_peminjam['email'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">No. Telepon</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php
                                                // Ambil nomor telepon dari database
                                                $no_telepon = $tb_user_peminjam['no_telepon'] ?? '';

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
                                                <label class="fw-bold text-black">Kode Peminjaman</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user_peminjam['kode_peminjaman'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Alamat</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_user_peminjam['alamat'] ?? '', 'html'); ?></p>
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

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">NO</th>
                                    <th>DOKUMENTASI BARANG</th>
                                    <th width="100px">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if (!empty($tb_user_peminjam)) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($no++, 'html'); ?>.</td>
                                        <td><?= esc($tb_user_peminjam['nama_barang'] ?? '', 'html'); ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($tb_user_peminjam['path_file_foto_barang'])) : ?>
                                                <button type="button" class="btn btn-info btn-sm view" data-bs-toggle="modal" data-bs-target="#exampleModal<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>">
                                                    <i class="fas fa-eye"></i> View File
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div id="carouselExampleIndicators<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" class="carousel slide" data-bs-ride="carousel">
                                                                    <!-- Carousel Indicators -->
                                                                    <div class="carousel-indicators">
                                                                        <?php
                                                                        $files = explode(', ', $tb_user_peminjam['path_file_foto_barang']);
                                                                        foreach ($files as $index => $file) :
                                                                        ?>
                                                                            <button type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                                                                        <?php endforeach; ?>
                                                                    </div>

                                                                    <!-- Carousel Items -->
                                                                    <div class="carousel-inner">
                                                                        <?php foreach ($files as $index => $file) : ?>
                                                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                                <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-width: 800px; max-height: 600px; margin: 0 auto;">
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>

                                                                    <!-- Carousel Controls -->
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_user_peminjam['id_barang'] ?? '', 'attr'); ?>" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php else : ?>
                                                <a href="javascript: void(0);" class="btn btn-info btn-sm view disabled" title="Gambar tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/user_peminjam'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>

                                <button type="button"
                                    class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning"
                                    data-id="<?= $tb_user_peminjam['id_user_peminjam'] ?>"
                                    <?= ($tb_user_peminjam['status'] != 'Dikembalikan' && $tb_user_peminjam['status'] != 'Ditolak') ? 'disabled' : '' ?>>
                                    <i class="fas fa-trash-alt"></i> Hapus Data Peminjam
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
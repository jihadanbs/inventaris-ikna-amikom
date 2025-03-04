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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Transaksi</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/transaksi') ?>">Data Transaksi</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data Transaksi</li>
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
                            <h4 class="text-center mb-4"><b>FORMULIR CEK DATA TRANSAKSI</b></h4>
                            <?php if (!empty($detail_peminjaman)) : ?>
                                <?php $first_item = $detail_peminjaman[0] ?? []; ?>
                                <tr>
                                    <td rowspan="1" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/ikna.png') ?>" id="gambar_load" width="250px" height="200" alt="Logo Desa">
                                    </td>

                                    <td style="padding-left: 50px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Nama Lengkap</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($detail_peminjaman[0]['nama_lengkap'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Nama Barang</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($detail_peminjaman[0]['nama_barang'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Kategori Barang</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($detail_peminjaman[0]['kategori_list'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Total Barang</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($detail_peminjaman[0]['total_jenis_barang'] ?? '', 'html'); ?> Unit</p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Kondisi</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($detail_peminjaman[0]['nama_kondisi'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Status</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p>
                                                    <?php
                                                    // Menampilkan badge berdasarkan status
                                                    if ($detail_peminjaman[0]['status'] === 'Belum Diproses') : ?>
                                                        <span class="badge bg-primary-subtle text-primary fs-6">Belum Diproses</span>
                                                    <?php elseif ($detail_peminjaman[0]['status'] === 'Ditolak') : ?>
                                                        <span class="badge bg-danger-subtle text-danger fs-6">Ditolak</span>
                                                    <?php elseif ($detail_peminjaman[0]['status'] === 'Dipinjamkan') : ?>
                                                        <span class="badge bg-warning-subtle text-warning fs-6">Dipinjamkan</span>
                                                    <?php elseif ($detail_peminjaman[0]['status'] === 'Dikembalikan') : ?>
                                                        <span class="badge bg-success-subtle text-success fs-6">Dikembalikan</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary-subtle text-secondary fs-6">Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Tanggal Transaksi</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php if (empty($detail_peminjaman[0]['tanggal_pengajuan'])): ?>
                                                    <span class="badge bg-warning text-dark fs-6">Belum ada data</span>
                                                <?php else: ?>
                                                    <p><?= formatTanggalIndo($detail_peminjaman[0]['tanggal_pengajuan'], 'html'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Tanggal Dipinjamkan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php if (empty($detail_peminjaman[0]['tanggal_dipinjamkan'])): ?>
                                                    <span class="badge bg-warning text-dark fs-6">Belum ada data</span>
                                                <?php else: ?>
                                                    <p><?= formatTanggalIndo($detail_peminjaman[0]['tanggal_dipinjamkan'], 'html'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Tanggal Perkiraan Dikembalikan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php if (empty($detail_peminjaman[0]['tanggal_perkiraan_dikembalikan'])): ?>
                                                    <span class="badge bg-warning text-dark fs-6">Belum ada data</span>
                                                <?php else: ?>
                                                    <p><?= formatTanggalIndo($detail_peminjaman[0]['tanggal_perkiraan_dikembalikan'], 'html'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Tanggal Dikembalikan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <?php if (empty($detail_peminjaman[0]['tanggal_dikembalikan'])): ?>
                                                    <span class="badge bg-warning text-dark fs-6">Belum ada data</span>
                                                <?php else: ?>
                                                    <p><?= formatTanggalIndo($detail_peminjaman[0]['tanggal_dikembalikan'], 'html'); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <!-- truncate text -->
                                            <?php
                                            function truncateText($text, $maxLength)
                                            {
                                                if (strlen($text) > $maxLength) {
                                                    return substr($text, 0, $maxLength) . '...';
                                                }
                                                return $text;
                                            }
                                            ?>
                                            <!-- end truncate text -->
                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Kepentingan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <strong>
                                                    <?= truncateText($detail_peminjaman[0]['kepentingan'] ?? 'Belum ada deskripsi lebih lanjut', 100); ?>
                                                    <?php if (strlen(strip_tags($detail_peminjaman[0]['kepentingan'] ?? '')) > 100) : ?>
                                                        <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($detail_peminjaman[0]['kepentingan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                    <?php endif; ?>
                                                </strong>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Catatan</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <strong>
                                                    <?= !empty($detail_peminjaman[0]['catatan_peminjaman']) ? truncateText($detail_peminjaman[0]['catatan_peminjaman'], 100) : 'Belum ada Catatan lebih lanjut'; ?>
                                                    <?php if (strlen(strip_tags($detail_peminjaman[0]['catatan_peminjaman'] ?? '')) > 100) : ?>
                                                        <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($detail_peminjaman[0]['catatan_peminjaman']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                    <?php endif; ?>
                                                </strong>
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
                                    <th>DOKUMENTASI BERKAS</th>
                                    <th width="100px">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Cukup ambil data pertama saja dari detail_peminjaman
                                if (!empty($detail_peminjaman) && isset($detail_peminjaman[0])) :
                                    $value = $detail_peminjaman[0];
                                    $no = 1;
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>Dokumen Jaminan</td>
                                        <td class="text-center">
                                            <?php if (!empty($value['dokumen_jaminan'])) : ?>
                                                <a href="<?= base_url($value['dokumen_jaminan']) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>Bukti Pengembalian</td>
                                        <td class="text-center">
                                            <?php if (!empty($value['bukti_pengembalian'])) : ?>
                                                <a href="<?= base_url($value['bukti_pengembalian']) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <h4 class="text-center mb-4"><b>DAFTAR BARANG YANG DIPINJAM</b></h4>
                        <?php
                        // Konfigurasi pagination
                        $items_per_page = 4; // Jumlah card per halaman
                        $total_items = count($detail_peminjaman);
                        $total_pages = ceil($total_items / $items_per_page);

                        // Mendapatkan halaman saat ini
                        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $current_page = max(1, min($current_page, $total_pages)); // Memastikan halaman valid

                        // Menghitung offset untuk item yang akan ditampilkan
                        $offset = ($current_page - 1) * $items_per_page;

                        // Mengambil item untuk halaman saat ini
                        $current_items = array_slice($detail_peminjaman, $offset, $items_per_page);
                        ?>

                        <div class="row">
                            <?php foreach ($current_items as $item) : ?>
                                <div class="col-md-4 col-lg-3 mb-4">
                                    <div class="card h-100">
                                        <div id="carouselExample<?= $item['id_barang'] ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach (explode(', ', $item['path_file_foto_barang'] ?? '') as $index => $file) : ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-height: 300px; object-fit: cover;">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?= $item['id_barang'] ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?= $item['id_barang'] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title"><?= truncateText($item['nama_barang'], 50) ?></h5>
                                            <ul class="list-unstyled">
                                                <li><strong>Kategori:</strong> <?= $item['nama_kategori'] ?></li>
                                                <li><strong>Kondisi:</strong> <?= $item['nama_kondisi'] ?></li>
                                                <li><strong>Jumlah Dipinjam:</strong> <?= $item['total_dipinjam'] ?></li>
                                            </ul>
                                        </div>

                                        <div class="card-footer">
                                            <a href="<?= site_url('admin/barang/cek_data/' . $item['slug_barang']) ?>" class="btn btn-primary btn-sm w-100">
                                                <i class="fa fa-info-circle"></i> Detail Barang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Navigasi Pagination -->
                        <?php if ($total_pages > 1) : ?>
                            <nav aria-label="Page navigation" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <!-- Tombol Previous -->
                                    <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Tombol halaman -->
                                    <?php
                                    // Tentukan rentang halaman yang ditampilkan
                                    $start_page = max(1, $current_page - 2);
                                    $end_page = min($total_pages, $current_page + 2);

                                    // Tampilkan halaman pertama jika tidak dalam rentang
                                    if ($start_page > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                        if ($start_page > 2) {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                                        }
                                    }

                                    // Tampilkan halaman dalam rentang
                                    for ($i = $start_page; $i <= $end_page; $i++) {
                                        echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '">
                        <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                      </li>';
                                    }

                                    // Tampilkan halaman terakhir jika tidak dalam rentang
                                    if ($end_page < $total_pages) {
                                        if ($end_page < $total_pages - 1) {
                                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                                        }
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                                    }
                                    ?>

                                    <!-- Tombol Next -->
                                    <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="<?= site_url('admin/transaksi'); ?>" class="btn btn-secondary btn-md ml-3">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>

                            <?php
                            $status = $detail_peminjaman[0]['status'] ?? '';
                            ?>

                            <a href="<?= site_url('admin/transaksi/ditolak/' . $kode_peminjaman); ?>"
                                class="btn btn-danger btn-md ml-3 <?= $status == 'Ditolak' || $status == 'Dipinjamkan' || $status == 'Dikembalikan' ? 'disabled' : '' ?>">
                                <i class="fas fa-times"></i> Ditolak
                            </a>

                            <a href="<?= site_url('admin/transaksi/dipinjamkan/' . $kode_peminjaman); ?>"
                                class="btn btn-warning btn-md ml-3 <?= $status == 'Dikembalikan' || $status == 'Ditolak' || $status == 'Dipinjamkan' ? 'disabled' : '' ?>">
                                <i class="fas fa-hourglass-half"></i> Dipinjamkan
                            </a>

                            <a href="<?= site_url('admin/transaksi/dikembalikan/' . $kode_peminjaman); ?>"
                                class="btn btn-success btn-md ml-3 <?= $status == 'Belum Diproses' || $status == 'Ditolak' || $status == 'Dikembalikan' ? 'disabled' : '' ?>">
                                <i class="fas fa-check"></i> Dikembalikan
                            </a>
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

<!-- HAPUS -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_barang = $(this).data('id');

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
                        url: "<?= site_url('admin/barang/delete2') ?>",
                        data: {
                            id_barang: id_barang,
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
                                    // Redirect ke halaman /admin/barang setelah sukses menghapus
                                    window.location.href = '<?= site_url('admin/barang') ?>';
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
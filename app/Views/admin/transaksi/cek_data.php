<?= $this->include('admin/layouts/script') ?>

<style>
    #barangContainer {
        transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
        overflow: hidden;
        max-height: 5000px;
    }

    #barangContainer.collapsed {
        max-height: 0;
        opacity: 0;
        padding-top: 0;
        padding-bottom: 0;
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">IKNA AMIKOM YOGYAKARTA</h3>
                        <a href="<?= esc(site_url('admin/transaksi/cetak/' . urlencode($peminjaman['kode_peminjaman'])), 'attr') ?>" class="btn btn-success waves-effect waves-light ms-auto">
                            <i class="fa fa-print"></i> Print
                        </a>
                    </div>

                    <div class="card-body">

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

                        <div class="card shadow-lg p-4">
                            <h4 class="text-center mb-2"><b>FORMULIR CEK DATA TRANSAKSI</b></h4>
                            <?php if (!empty($detail_peminjaman)) : ?>
                                <?php $first_item = $detail_peminjaman[0] ?? []; ?>
                                <div class="text-center bg-info" style="color: white;"><?= esc($first_item['kode_peminjaman'] ?? ''); ?></div>
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-3 text-center">
                                        <img src="<?= base_url('assets/img/ikna.png') ?>" id="gambar_load" class="img-fluid rounded" alt="Logo Ikna">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row gy-3">
                                            <div class="col-md-6">
                                                <h6><b>Nama Lengkap</b></h6>
                                                <p><?= esc($first_item['nama_lengkap'] ?? ''); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Nama Barang</b></h6>
                                                <p><?= esc($first_item['barang_list'] ?? ''); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Kategori Barang</b></h6>
                                                <p><?= esc($first_item['kategori_list'] ?? ''); ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><b>Total Barang</b></h6>
                                                <p><?= esc($first_item['total_jenis_barang'] ?? ''); ?> Jenis Barang</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>Kondisi</b></td>
                                                <td><?= esc($first_item['nama_kondisi'] ?? ''); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Status</b></td>
                                                <td>
                                                    <?php if ($first_item['status'] === 'Belum Diproses') : ?>
                                                        <span class="badge bg-primary">Belum Diproses</span>
                                                    <?php elseif ($first_item['status'] === 'Ditolak') : ?>
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    <?php elseif ($first_item['status'] === 'Dipinjamkan') : ?>
                                                        <span class="badge bg-info">Dipinjamkan</span>
                                                    <?php elseif ($first_item['status'] === 'Dikembalikan') : ?>
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Tanggal Transaksi</b></td>
                                                <td><?= formatTanggalIndo2($first_item['tanggal_pengajuan'] ?? '') ?: 'Belum ada data'; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Kepentingan</b></td>
                                                <td>
                                                    <?= truncateText($first_item['kepentingan'] ?? 'Belum ada deskripsi', 100); ?>
                                                    <?php if (strlen(strip_tags($first_item['kepentingan'] ?? '')) > 100) : ?>
                                                        <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($first_item['kepentingan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Tanggal Dipinjamkan</b></td>
                                                <td><?= formatTanggalIndo2($first_item['tanggal_dipinjamkan'] ?? '') ?: 'Belum ada data'; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Tanggal Perkiraan Dikembalikan</b></td>
                                                <td><?= formatTanggalIndo2($first_item['tanggal_perkiraan_dikembalikan'] ?? '') ?: 'Belum ada data'; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Tanggal Dikembalikan</b></td>
                                                <td><?= formatTanggalIndo2($first_item['tanggal_dikembalikan'] ?? '') ?: 'Belum ada data'; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Catatan Peminjaman</b></td>
                                                <td>
                                                    <?= truncateText($first_item['catatan_peminjaman'] ?? '' ?: 'Belum ada catatan', 100); ?>
                                                    <?php if (strlen(strip_tags($first_item['catatan_peminjaman'] ?? '' ?: 'Belum ada catatan')) > 100) : ?>
                                                        <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($first_item['catatan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Modal untuk Read More -->
                                <div id="readMoreModal" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Informasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p id="jendela-text"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const modal = new bootstrap.Modal(document.getElementById("readMoreModal"));
                                        const modalText = document.getElementById("jendela-text");
                                        document.querySelectorAll(".read-more-link").forEach(link => {
                                            link.addEventListener("click", function(event) {
                                                event.preventDefault();
                                                modalText.innerText = this.getAttribute("data-text");
                                                modal.show();
                                            });
                                        });
                                    });
                                </script>

                            <?php endif; ?>
                        </div>

                        <table class="table table-bordered table-sm shadow-lg">
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

                        <div class="card shadow-lg">
                            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center" style="background-color: #28527a; height: 70px;">
                                <h4 class="mb-0" style="color: white !important; font-size: 16px;">
                                    <i class="bi bi-box-seam me-2"></i>DAFTAR BARANG YANG DIPINJAM
                                </h4>
                                <button id="toggleBarangBtn" class="btn btn-light">
                                    <i id="toggleIcon" class="bi bi-eye-slash me-1"></i>Sembunyikan
                                </button>
                            </div>
                            <div id="barangContainer" class="card-body">
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
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const barangContainer = document.getElementById('barangContainer');
                                const toggleBarangBtn = document.getElementById('toggleBarangBtn');
                                const toggleIcon = document.getElementById('toggleIcon');

                                toggleBarangBtn.addEventListener('click', function() {
                                    barangContainer.classList.toggle('collapsed');

                                    if (barangContainer.classList.contains('collapsed')) {
                                        toggleBarangBtn.innerHTML = '<i id="toggleIcon" class="bi bi-eye me-1"></i>Tampilkan';
                                    } else {
                                        toggleBarangBtn.innerHTML = '<i id="toggleIcon" class="bi bi-eye-slash me-1"></i>Sembunyikan';
                                    }
                                });
                            });
                        </script>

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
                                class="btn btn-info btn-md ml-3 <?= $status == 'Dikembalikan' || $status == 'Ditolak' || $status == 'Dipinjamkan' ? 'disabled' : '' ?>">
                                <i class="fas fa-hourglass-half"></i> Dipinjamkan
                            </a>

                            <a href="<?= site_url('admin/transaksi/dikembalikan/' . $kode_peminjaman); ?>"
                                class="btn btn-success btn-md ml-3 <?= $status == 'Belum Diproses' || $status == 'Ditolak' || $status == 'Dikembalikan' ? 'disabled' : '' ?>">
                                <i class="fas fa-check"></i> Dikembalikan
                            </a>

                            <?php
                            $tanggal_sekarang = date('Y-m-d');
                            $tanggal_perkiraan = $first_item['tanggal_perkiraan_dikembalikan'] ?? '';

                            if ($tanggal_perkiraan && strtotime($tanggal_sekarang) > strtotime($tanggal_perkiraan)) : ?>
                                <a href="<?= site_url('admin/transaksi/warning/' . $kode_peminjaman); ?>"
                                    class="btn btn-warning btn-md ml-3 <?= $status == 'Belum Diproses' || $status == 'Ditolak' || $status == 'Dikembalikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-exclamation-triangle"></i> Peringatan
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>
<?= $this->include('admin/layouts/script2') ?>

<!-- ALERT WHATSAPP -->
<?php if (session()->getFlashdata('whatsapp_link')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: 'Peminjaman Barang Melewati Waktu Pengembalian!',
                text: 'Apakah Anda ingin mengirimkan melalui WhatsApp?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Buka WhatsApp',
                cancelButtonText: 'Tidak',
                customClass: {
                    confirmButton: 'btn btn-primary m-2',
                    cancelButton: 'btn btn-danger m-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Membuka link di tab baru
                    window.open('<?= session()->getFlashdata('whatsapp_link') ?>', '_blank');
                }
            });
        });
    </script>
<?php endif; ?>
<!-- END ALERT WHATSAPP -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousels = document.querySelectorAll('.carousel');
        carousels.forEach(function(carousel) {
            new bootstrap.Carousel(carousel);
        });
    });
</script>

</body>
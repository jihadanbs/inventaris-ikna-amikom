<?= $this->include('layouts/template') ?>
<?= $this->include('layouts/navbar') ?>

<section class="product-detail-section py-5">
    <div class="container">
        <div class="row">
            <div class="row d-flex align-item-center">
                <?= $this->include('alert/frontalert'); ?>
            </div>

            <!-- Bagian Kiri - Foto Produk -->
            <div class="col-md-6">
                <!-- Main Image -->
                <div class="main-image-barang mb-3">
                    <?php
                    $photos = explode(", ", $tb_barang['path_file_foto_barang']);
                    if (!empty($photos[0])) :
                    ?>
                        <img src="<?= base_url($photos[0]) ?>" id="main-product-image" class="img-fluid" style="width: 100%; height: auto;">
                    <?php else: ?>
                        <img src="<?= base_url('assets/images/default.jpg') ?>" id="main-product-image" class="img-fluid" style="width: 100%; height: auto;">
                    <?php endif; ?>
                </div>

                <!-- Thumbnail Images -->
                <div class="thumbnail-images">
                    <div class="row">
                        <button type="button" class="btn btn-nav btn-prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="col img-slide">
                            <div class="d-flex">
                                <?php
                                if (!empty($photos)):
                                    foreach ($photos as $index => $photo):
                                ?>
                                        <div class="col-3">
                                            <img src="<?= base_url($photo) ?>"
                                                class="img-thumbnail product-thumbnail <?= ($index === 0) ? 'active' : '' ?>"
                                                onclick="changeImage(this.src)">
                                        </div>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                        <button type="button" class="btn btn-nav btn-next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan - Detail Produk -->
            <div class="col-md-6">
                <div class="product-details">
                    <!-- Nama Produk -->
                    <h1 class="product-title h2 mb-3"><?= $tb_barang['nama_barang'] ?></h1>
                    <i class="bi bi-geo-alt-fill"></i>
                    <span class="badge badge-light city-badge"><?= $tb_barang['lokasi'] ?></span>
                    <!-- Rating dan Jumlah Stok -->
                    <div class="rating-terjual mb-3">
                        <span class="badge badge-warning">
                            Stok tersedia : <?= $tb_barang['jumlah_total_baik'] ?? 0 ?>
                        </span>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="color-selection mb-4">
                        <h6 class="mb-2">Tanggal Upload</h6>
                        <div class="btn-group" role="group">
                            <?= formatTanggalIndo($tb_barang['tanggal_masuk']) ?>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="additional-info mb-4">
                        <div class="row">
                            <div class="col-4">
                                <p class="mb-1">Kondisi</p>
                                <strong><?= $tb_barang['nama_kondisi'] ?></strong>
                            </div>
                            <div class="col-4">
                                <p class="mb-1">Masa peminjaman</p>
                                <strong><?= $tb_barang['masa_pinjam'] ?? '5 Hari' ?> Hari</strong>
                            </div>
                            <div class="col-4">
                                <p class="mb-1">Kategori</p>
                                <strong><?= $tb_barang['nama_kategori'] ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="product-description mb-4">
                        <h6 class="mb-2">Deskripsi</h6>
                        <p><?= $tb_barang['deskripsi'] ?></p>
                    </div>

                    <?php if (session()->getFlashdata('whatsapp_link')) : ?>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    title: 'Pengajuan Berhasil!',
                                    text: 'Apakah Anda ingin mendokumentasikan melalui WhatsApp?',
                                    icon: 'success',
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

                    <!-- Tombol Ajukan Peminjaman -->
                    <div class="action-buttons">
                        <form action="<?= site_url('ajukan') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                            <button class="btn btn-primary btn-lg btn-block">Ajukan Peminjaman</button>
                            <button class="btn btn-warning btn-lg btn-block">Masukan keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL FORM AJUKIAN PEMINJAMAN -->

<div class="modal modal-form-peminjaman fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="peminjamanModalLabel">Form Pengajuan Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPengajuan" action="<?= site_url('pinjam') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="id_barang" value="<?= $tb_barang['id_barang'] ?>">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="kepentingan">Kepentingan</label>
                        <textarea class="form-control <?= session('errors.kepentingan') ? 'is-invalid' : '' ?>" name="kepentingan" id="kepentingan" rows="3"><?= old('kepentingan') ?></textarea>
                        <?php if (session('errors.kepentingan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.kepentingan') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="kepentingan">Dokumen Jaminan</label>
                        <input type="file" class="form-control <?= session('errors.dokumen_jaminan') ? 'is-invalid' : '' ?>" name="dokumen_jaminan" id="dokumen_jaminan" rows="3"><?= old('dokumen_jaminan') ?></input>
                        <?php if (session('errors.dokumen_jaminan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.dokumen_jaminan') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Footer -->
<div class="footer_bg" style="margin-top : auto;">
    <?= $this->include('layouts/info') ?>
    <?= $this->include('layouts/footer') ?>
</div>
<!-- Scripts -->
<?= $this->include('layouts/script') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script>
    $(document).ready(function() {
        $('#formPengajuan').on('submit', function(e) {
            e.preventDefault();

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        // Menampilkan pesan Bootstrap alert
                        $('body').prepend(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.pesan}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);

                        // Sembunyikan modal dan hapus backdrop
                        $('#peminjamanModal').modal('hide').on('hidden.bs.modal', function() {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            // SweetAlert loading effect
                            Swal.fire({
                                icon: 'info',
                                title: 'Proses sedang berjalan...',
                                text: 'Halaman akan dimuat ulang...',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        });

                    } else if (response.errors) {
                        $.each(response.errors, function(field, message) {
                            const inputField = $(`[name="${field}"]`);
                            inputField.addClass('is-invalid');
                            inputField.after(`<div class="invalid-feedback">${message}</div>`);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.pesan || 'Terjadi kesalahan pada sistem',
                            confirmButtonText: 'OK'
                        });
                    }
                },

                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada sistem. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script> -->

<script>
    $(document).ready(function() {
        <?php if (session()->getFlashdata('errors')) : ?>
            $('#peminjamanModal').modal('show');
        <?php endif; ?>
    });

    // Fungsi untuk mengganti gambar utama
    function changeImage(src) {
        document.getElementById('main-product-image').src = src;

        // Update active thumbnail
        document.querySelectorAll('.product-thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
            if (thumb.src === src) {
                thumb.classList.add('active');
            }
        });
    }

    // CODINGAN UNTUK ZOOM FOTO
    document.getElementById('main-product-image').addEventListener('mousemove', function(e) {
        const image = this;
        const offsetX = e.offsetX;
        const offsetY = e.offsetY;
        const x = (offsetX / image.offsetWidth) * 100;
        const y = (offsetY / image.offsetHeight) * 100;

        image.style.transformOrigin = `${x}% ${y}%`;
    });

    document.getElementById('main-product-image').addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.5)';
    });

    document.getElementById('main-product-image').addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });

    // Fungsi untuk mengganti gambar utama
    function changeImage(src) {
        document.getElementById('main-product-image').src = src;

        // Update active thumbnail
        document.querySelectorAll('.product-thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
            if (thumb.src === src) {
                thumb.classList.add('active');
            }
        });
    }

    // Navigasi thumbnail
    const thumbnailContainer = document.querySelector('.thumbnail-images .col');
    const prevButton = document.querySelector('.btn-prev');
    const nextButton = document.querySelector('.btn-next');

    prevButton.addEventListener('click', () => {
        thumbnailContainer.scrollLeft -= 100;
    });

    nextButton.addEventListener('click', () => {
        thumbnailContainer.scrollLeft += 100;
    });
</script>
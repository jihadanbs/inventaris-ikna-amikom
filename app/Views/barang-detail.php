<?= $this->include('layouts/template') ?>
<?= $this->include('layouts/navbar') ?>

<section class="product-detail-section py-5">
    <div class="container">
        <div class="row">
            <?= $this->include('alert/frontalert'); ?>
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
                        <span class="badge badge-success">
                            Stok tersedia : <?= $tb_barang['jumlah_total_baik'] ?? 0 ?>
                        </span>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="color-selection mb-4">
                        <h6 class="mb-2">Tanggal masuk</h6>
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
                            if (confirm('Pengajuan berhasil ! Kirim notifikasi WhatsApp ?')) {
                                window.location.href = '<?= session()->getFlashdata('whatsapp_link') ?>';
                            }
                        </script>
                    <?php endif; ?>

                    <!-- Tombol Ajukan Peminjaman -->
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#peminjamanModal">Ajukan Peminjaman</button>
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
                <form id="formPengajuan" action="<?= base_url('ajukan') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="id_barang" value="<?= $tb_barang['id_barang'] ?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : '' ?>" name="nama_lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') ?>">
                        <?php if (session('errors.nama_lengkap')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.nama_lengkap') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>" name="pekerjaan" id="pekerjaan" value="<?= old('pekerjaan') ?>">
                        <?php if (session('errors.pekerjaan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.pekerjaan') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= old('email') ?>">
                        <?php if (session('errors.email')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="noTelepon">No. Telepon</label>
                        <input type="tel" class="form-control <?= session('errors.no_telepon') ? 'is-invalid' : '' ?>" name="no_telepon" id="no_telepon" value="<?= old('no_telepon') ?>">
                        <small class="form-text text-muted">
                            <span>Contoh : 081234567891 |<span style="color: red;"> jangan pakai 62</span></span>
                        </small>
                        <?php if (session('errors.no_telepon')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.no_telepon') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat" id="alamat" rows="3"><?= old('alamat') ?></textarea>
                        <?php if (session('errors.alamat')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.alamat') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="total_dipinjam">Jumlah Yang Ingin Dipinjam</label>
                        <input type="number" class="form-control <?= session('errors.total_dipinjam') ? 'is-invalid' : '' ?>" name="total_dipinjam" id="total_dipinjam" value="<?= old('total_dipinjam') ?>">
                        <?php if (session('errors.total_dipinjam')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.total_dipinjam') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="kepentingan">Kepentingan</label>
                        <textarea class="form-control <?= session('errors.kepentingan') ? 'is-invalid' : '' ?>" name="kepentingan" id="kepentingan" rows="3"><?= old('kepentingan') ?></textarea>
                        <?php if (session('errors.kepentingan')) : ?>
                            <div class="invalid-feedback">
                                <?= session('errors.kepentingan') ?>
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
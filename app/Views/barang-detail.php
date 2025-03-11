<?= $this->include('layouts/template') ?>
<?= $this->include('layouts/navbar') ?>

<section class="product-detail-section py-5">
    <div class="container">
        <div class="row">
            <div class="row d-flex align-item-center">
                <?= $this->include('alert/frontalert'); ?>
            </div>

            <!-- Bagian Kiri - Foto Produk -->
            <div class="col-md-6 ml-auto">
                <!-- Main Image -->
                <div class="main-image-barang mb-3">
                    <?php
                    $photos = explode(", ", $tb_barang['path_file_foto_barang']);
                    if (!empty($photos[0])) :
                    ?>
                        <img src="<?= base_url($photos[0]) ?>" id="main-product-image" class="img-fluid" style="width: 100%; height: auto;">
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/404.gif'); ?>" id="main-product-image" class="img-fluid" style="width: 100%; height: auto;">
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

                    <!-- Tombol Ajukan Peminjaman -->
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-lg btn-block" onclick="ajukanPeminjaman()">Ajukan Peminjaman</button>
                        <button class="btn btn-warning btn-lg btn-block" onclick="masukKeranjang()">Masukan Keranjang</button>
                    </div>

                    <script>
                        function ajukanPeminjaman() {
                            let data = {
                                id_barang: '<?= $tb_barang['id_barang'] ?>',
                                slug: '<?= $slugUserBarang ?>'
                            };

                            // Kirim ke server
                            fetch('/ajukanPeminjaman', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.status === 'success') {
                                        // Redirect ke halaman keranjang
                                        window.location.href = '<?= site_url('keranjang-barang') ?>';
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: result.message || 'Gagal menambahkan barang',
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menambahkan barang',
                                        icon: 'error'
                                    });
                                });
                        }

                        function masukKeranjang() {
                            let data = {
                                id_barang: '<?= $tb_barang['id_barang'] ?>',
                                slug: '<?= $slugUserBarang ?>'
                            };

                            // Kirim ke server
                            fetch('/masukKeranjang', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.status === 'success') {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Barang telah ditambahkan ke keranjang',
                                            icon: 'success'
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: result.message || 'Gagal menambahkan barang ke keranjang',
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat menambahkan barang ke keranjang',
                                        icon: 'error'
                                    });
                                });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<div class="footer_bg" style="margin-top : auto;">
    <?= $this->include('layouts/info') ?>
    <?= $this->include('layouts/footer') ?>
</div>
<!-- Scripts -->
<?= $this->include('layouts/script') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
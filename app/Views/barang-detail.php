<?= $this->include('layouts/template') ?>

<style>
.product-thumbnail {
    cursor: pointer;
    transition: all 0.3s ease;
}

.product-thumbnail.active {
    border: 2px solid #007bff;
}

.main-image {
    overflow: hidden;
}

#main-product-image {
    transition: transform 0.3s ease;
}

.product-title {
    font-weight: bold;
    color: #333;
}
.rating-terjual{
    font-size: 22px;
}

.size-selection .btn-group .btn,
.color-selection .btn-group .btn {
    padding: 0.5rem 1.5rem;
}

.additional-info {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.25rem;
}

.product-description {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
}

.action-buttons {
    position: sticky;
    bottom: 0;
    background-color: white;
    padding: 1rem 0;
    border-top: 1px;
}

.thumbnail-images {
    position: relative;
}


.btn-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    z-index: 1;
}

.btn-prev {
    left: 0;
}

.btn-next {
    right: 0;
}

.thumbnail-images .col {
    overflow-x: auto;
    white-space: nowrap;
    scroll-behavior: smooth;
}

.thumbnail-images .col::-webkit-scrollbar {
    display: none;
}

.modal-dialog {
    max-width: 500px;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.modal-footer {
    border-top: 1px solid #dee2e6;
    padding: 1rem;
}
</style>

    <?= $this->include('layouts/navbar') ?>


<section class="product-detail-section py-5">
    <div class="container">
        <div class="row">
            <!-- Bagian Kiri - Foto Produk -->
            <div class="col-md-6">
                <!-- Main Image -->
                <div class="main-image mb-3">
                    <img src="<?= base_url('assets/images/tes2.jpg') ?>" id="main-product-image" class="img-fluid" style="width: 100%; height: auto;">
                </div>
                
                <!-- Thumbnail Images -->
                <div class="thumbnail-images">
                    <div class="row">
                        <button type="button" class="btn btn-nav btn-prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="col img-slide">
                            <div class="d-flex">
                                <div class="col-3">
                                    <img src="<?= base_url('assets/images/tes2.jpg') ?>" class="img-thumbnail product-thumbnail active" onclick="changeImage(this.src)">
                                </div>
                                <div class="col-3">
                                    <img src="<?= base_url('assets/images/tes.jpg') ?>" class="img-thumbnail product-thumbnail" onclick="changeImage(this.src)">
                                </div>
                                <div class="col-3">
                                    <img src="<?= base_url('assets/images/tes3.jpg') ?>" class="img-thumbnail product-thumbnail" onclick="changeImage(this.src)">
                                </div>
                                <div class="col-3">
                                    <img src="<?= base_url('assets/images/tes.jpg') ?>" class="img-thumbnail product-thumbnail" onclick="changeImage(this.src)">
                                </div>
                                <div class="col-3">
                                    <img src="<?= base_url('assets/images/tes3.jpg') ?>" class="img-thumbnail product-thumbnail" onclick="changeImage(this.src)">
                                </div>
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
                    <h1 class="product-title h2 mb-3">nama barang</h1>
                    
                    <!-- Rating dan Jumlah Terjual -->
                    <div class="rating-terjual mb-3">
                        <span class="badge badge-success">
                            Stok tersedia : 12
                        </span>
                    </div>

                    <!-- Pilihan Warna -->
                    <div class="color-selection mb-4">
                        <h6 class="mb-2">Tanggal masuk:</h6>
                        <div class="btn-group" role="group">
                           2 Januari 2025
                        </div>
                    </div>

                    <!-- Pilihan Ukuran -->
                    <div class="size-selection mb-4">
                        <h6 class="mb-2">Tanggal keluar:</h6>
                        <div class="btn-group" role="group">
                        2 Januari 2025
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="additional-info mb-4">
                        <div class="row">
                            <div class="col-4">
                                <p class="mb-1">Kondisi:</p>
                                <strong>Baik</strong>
                            </div>
                            <div class="col-4">
                                <p class="mb-1">Masa peminjaman:</p>
                                <strong>1 Bulan</strong>
                            </div>
                            <div class="col-4">
                                <p class="mb-1">Kategori:</p>
                                <strong>Perlengkapan</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="product-description mb-4">
                        <h6 class="mb-2">Deskripsi:</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ex sapiente officiis, laudantium reiciendis exercitationem rem cumque necessitatibus? Natus, odit!</p>
                    </div>

                    <!-- Tombol Ajukan Peminjaman -->
                    <div class="action-buttons">
                    <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#peminjamanModal">Ajukan Peminjaman</button>
                     </div>
            </div>
        </div>
    </div>
</section>


<!-- MODAL FORM AJUKIAN PEMINJAMAN -->
 <!-- Modal -->
<div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="peminjamanModalLabel">Form Pengajuan Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPeminjaman">
                    <div class="form-group">
                        <label for="namaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namaLengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="noTelepon">No. Telepon</label>
                        <input type="tel" class="form-control" id="noTelepon" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kepentingan">Kepentingan</label>
                        <textarea class="form-control" id="kepentingan" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Kirim Pengajuan</button>
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

<script>
// Fungsi untuk mengganti gambar utama
function changeImage(src) {
    document.getElementById('main-product-image').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.product-thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
        if(thumb.src === src) {
            thumb.classList.add('active');
        }
    });
}

// Zoom functionality
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
        if(thumb.src === src) {
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


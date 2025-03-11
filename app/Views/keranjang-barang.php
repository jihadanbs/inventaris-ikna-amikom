<?= $this->include('layouts/template') ?>

<link href="<?= base_url('assets/css/responsive-keranjang.css') ?>" rel="stylesheet" />

<body class="sub_page">
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <section class="keranjang" style="margin-top: 90px;">
        <div class="container my-4">
            <h2 class="mb-4" style="font-weight:700">Keranjang Barang</h2>

            <div class="category-section">
                <div class="product-row product-row-info">
                    <div class="product-image-info">Foto</div>
                    <div class="product-info">Barang</div>
                    <div class="barang-detail-info">
                        <div>Stok</div>
                        <div>Jumlah Dipinjam</div>
                        <div>Aksi</div>
                    </div>
                </div>
            </div>

            <!-- Container untuk items -->
            <div id="items-container">
                <!-- Items akan dirender di sini menggunakan JavaScript -->
            </div>

            <div class="footer-section">
                <div>
                    <input type="checkbox" class="product-checkbox product-checkbox-all">
                    <button class="btn btn-primary" id="pilihSemuaBtn">Pilih Semua</button>
                    <button class="btn btn-danger" onclick="deleteSelected()">Hapus</button>
                </div>
                <div>
                    <span id="total-items">Total : 0 Barang</span>
                    <button class="btn btn-success" onclick="pinjamSelected()">Pinjam</button>
                </div>
            </div>
        </div>
    </section>

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
                    <form id="formPengajuan" action="<?= site_url('/ajukanPeminjamanBarang') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="selected_peminjaman_ids" id="selected_peminjaman_ids" value="">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="kepentingan">Kepentingan<span style="color: red;">*</span></label>
                            <textarea class="form-control <?= session('errors.kepentingan') ? 'is-invalid' : '' ?>" name="kepentingan" id="kepentingan" rows="3"><?= old('kepentingan') ?></textarea>
                            <?php if (session('errors.kepentingan')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.kepentingan') ?>
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                            <label for="dokumen_jaminan">Dokumen Jaminan<span style="color: red;">*</span></label>
                            <input type="file" accept="image/*" class=" form-control <?= session('errors.dokumen_jaminan') ? 'is-invalid' : '' ?>" name="dokumen_jaminan" id="dokumen_jaminan" rows="3"><?= old('dokumen_jaminan') ?></input>
                            <?php if (session('errors.dokumen_jaminan')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.dokumen_jaminan') ?>
                                </div>
                            <?php endif ?>
                            <small class="form-text text-muted">
                                <span>Berupa KTP atau Kartu Pelajar</span>
                            </small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

    </div>

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxAll = document.querySelector('.product-checkbox-all');
            const container = document.getElementById('items-container');

            // Ambil data keranjang dari server berdasarkan id_user
            fetch('/getKeranjang')
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        const keranjang = result.data;

                        if (keranjang.length === 0) {
                            container.innerHTML = `
                    <div class="alert alert-warning text-center" style="margin-top: 20px;">
                        <h5>Masukkan barang pilihan anda !</h5>
                    </div>`;
                            return;
                        }

                        // Kelompokkan items berdasarkan nama_kategori
                        const itemsByCategory = keranjang.reduce((acc, item) => {
                            if (!acc[item.nama_kategori]) {
                                acc[item.nama_kategori] = [];
                            }
                            acc[item.nama_kategori].push(item);
                            return acc;
                        }, {});

                        // Render items berdasarkan nama_kategori
                        for (const [nama_kategori, items] of Object.entries(itemsByCategory)) {
                            const categorySection = document.createElement('div');
                            categorySection.className = 'category-section';

                            // Tambah header nama_kategori
                            categorySection.innerHTML = `
                    <div class="category-header">${nama_kategori}</div>
                    `;

                            // Render items dalam nama_kategori
                            items.forEach(barang => {
                                let photoPath = '';
                                if (barang.path_file_foto_barang) {
                                    const photos = barang.path_file_foto_barang.split(', ');
                                    photoPath = photos[0] || '/assets/img/404.gif';
                                } else {
                                    photoPath = '/assets/img/404.gif';
                                }

                                const itemHtml = `
                        <div class="product-row" data-id="${barang.id_barang}" data-peminjaman-id="${barang.id_peminjaman}">
                            <input type="checkbox" class="product-checkbox">
                            <img src="${photoPath}" alt="Foto Barang" class="product-image">
                            <div class="product-info">${barang.nama_barang}</div>
                            <div class="barang-detail">
                                <div class="product-details">${barang.jumlah_total_baik}</div>
                                <div class="quantity-control">
                                    <button onclick="updateQuantity(this, -1, '${barang.id_peminjaman}')">-</button>
                                    <span>${barang.total_dipinjam}</span>
                                    <button onclick="updateQuantity(this, 1, '${barang.id_peminjaman}')">+</button>
                                </div>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('${barang.id_peminjaman}')">Hapus</button>
                            </div>
                        </div>
                        `;
                                categorySection.insertAdjacentHTML('beforeend', itemHtml);
                            });

                            container.appendChild(categorySection);
                        }

                        // Event listener untuk checkbox "pilih semua"
                        checkboxAll.addEventListener('change', function() {
                            const checkboxes = document.querySelectorAll('.product-checkbox:not(.product-checkbox-all)');
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = this.checked;
                            });
                            updateTotal();
                        });

                        // Event listener untuk button "pilih semua"
                        document.getElementById('pilihSemuaBtn').addEventListener('click', function() {
                            checkboxAll.checked = !checkboxAll.checked;
                            const checkboxes = document.querySelectorAll('.product-checkbox:not(.product-checkbox-all)');
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = checkboxAll.checked;
                            });
                            updateTotal();
                        });

                        // Setelah semua checkbox dibuat
                        document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                            checkbox.addEventListener('change', updateTotal);
                        });

                        updateTotal();
                    } else {
                        container.innerHTML = `
                <div class="alert alert-danger text-center" style="margin-top: 20px;">
                    <h5>Gagal memuat data keranjang !</h5>
                </div>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    container.innerHTML = `
            <div class="alert alert-danger text-center" style="margin-top: 20px;">
                <h5>Terjadi kesalahan saat memuat data keranjang</h5>
            </div>`;
                });

            // Delegation untuk menangani checkbox baru
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('product-checkbox')) {
                    updateTotal();
                }
            });
        });

        // Fungsi update quantity
        function updateQuantity(button, change, idPeminjaman) {
            const quantitySpan = button.parentElement.querySelector('span');
            const stockElement = button.parentElement.previousElementSibling;
            let quantity = parseInt(quantitySpan.textContent);
            let stock = parseInt(stockElement.textContent);

            // Memperbolehkan quantity bertambah sampai stock habis
            if ((change === -1 && quantity > 1) || (change === 1 && stock > 0)) {
                const newQuantity = change === -1 ? quantity - 1 : quantity + 1;

                // Update via API
                fetch(`/updateJumlahKeranjang/${idPeminjaman}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            jumlah: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update tampilan jika sukses
                            if (change === -1) {
                                quantity--;
                                stock++;
                            } else {
                                quantity++;
                                stock--;
                            }

                            // Update tampilan
                            quantitySpan.textContent = quantity;
                            stockElement.textContent = stock;

                            updateTotal();
                        } else {
                            Swal.fire('Error', data.message || 'Gagal mengupdate jumlah', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Terjadi kesalahan saat update jumlah', 'error');
                    });
            }
        }

        function confirmDelete(idPeminjaman) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Barang akan dihapus dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus melalui API
                    fetch(`/hapusItemKeranjang/${idPeminjaman}`, {
                            method: 'DELETE',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Hapus element dari UI
                                document.querySelector(`[data-peminjaman-id="${idPeminjaman}"]`).remove();

                                // Update total
                                updateTotal();

                                Swal.fire('Terhapus!', 'Barang telah dihapus dari keranjang', 'success');
                            } else {
                                Swal.fire('Error', data.message || 'Gagal menghapus barang', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus barang', 'error');
                        });
                }
            });
        }

        // Fungsi untuk mengupdate total items
        function updateTotal() {
            const checkedItems = document.querySelectorAll('.product-checkbox:checked:not(.product-checkbox-all)');
            document.getElementById('total-items').textContent = `Total : ${checkedItems.length} Barang`;
        }

        function pilihSemua() {
            const checkboxAll = document.querySelector('.product-checkbox-all');
            const checkboxes = document.querySelectorAll('.product-checkbox:not(.product-checkbox-all)');

            // Set semua checkbox sesuai dengan status checkbox utama
            checkboxes.forEach(checkbox => {
                checkbox.checked = checkboxAll.checked;
            });

            updateTotal();
        }

        // Fungsi hapus yang dipilih
        function deleteSelected() {
            const selectedRows = document.querySelectorAll('.product-checkbox:checked:not(.product-checkbox-all)');
            if (selectedRows.length === 0) {
                Swal.fire('Perhatian!', 'Pilih barang yang akan dihapus terlebih dahulu!', 'warning');
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua barang yang dipilih akan dihapus dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let successCount = 0;
                    let totalItems = selectedRows.length;
                    let completedOperations = 0;

                    // Untuk setiap item yang dipilih
                    selectedRows.forEach(checkbox => {
                        const row = checkbox.closest('.product-row');
                        const idPeminjaman = row.dataset.peminjamanId;

                        // Hapus melalui API
                        fetch(`/hapusItemKeranjang/${idPeminjaman}`, {
                                method: 'DELETE',
                            })
                            .then(response => response.json())
                            .then(data => {
                                completedOperations++;

                                if (data.status === 'success') {
                                    successCount++;
                                    row.remove();
                                }

                                // Setelah semua operasi selesai
                                if (completedOperations === totalItems) {
                                    updateTotal();

                                    if (successCount === totalItems) {
                                        Swal.fire(
                                            'Terhapus!',
                                            'Semua barang telah dihapus dari keranjang',
                                            'success'
                                        );
                                    } else {
                                        Swal.fire(
                                            'Peringatan!',
                                            'Beberapa barang gagal dihapus. Silakan coba lagi!',
                                            'warning'
                                        );
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                completedOperations++;

                                if (completedOperations === totalItems) {
                                    updateTotal();
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus barang',
                                        'error'
                                    );
                                }
                            });
                    });
                }
            });
        }

        // Fungsi peminjaman yang dipilih
        function pinjamSelected() {
            const selectedRows = document.querySelectorAll('.product-checkbox:checked:not(.product-checkbox-all)');
            if (selectedRows.length === 0) {
                Swal.fire('Perhatian!', 'Pilih barang yang akan dipinjam terlebih dahulu!', 'warning');
                return;
            }

            // Kumpulkan ID peminjaman yang dipilih
            const selectedPeminjamanIds = Array.from(selectedRows).map(checkbox => {
                const row = checkbox.closest('.product-row');
                return row.dataset.peminjamanId;
            });

            // Simpan ke input tersembunyi
            document.getElementById('selected_peminjaman_ids').value = JSON.stringify(selectedPeminjamanIds);

            // Tampilkan modal peminjaman
            $('#peminjamanModal').modal('show');

            $(document).ready(function() {
                // Perbaikan tombol close (X)
                $(".modal-form-peminjaman .close").on("click", function() {
                    $("#peminjamanModal").modal("hide");
                });

                // Perbaikan tombol Tutup
                $(".modal-form-peminjaman .btn-danger").on("click", function() {
                    $("#peminjamanModal").modal("hide");
                });
            });
        }
    </script>
</body>
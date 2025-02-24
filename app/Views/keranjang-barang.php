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

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxAll = document.querySelector('.product-checkbox-all');

            const keranjang = JSON.parse(sessionStorage.getItem('keranjang') || '[]');
            const container = document.getElementById('items-container');

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
                        photoPath = photos[0] || '<?= base_url("assets/img/404.gif") ?>';
                    } else {
                        photoPath = '<?= base_url("assets/img/404.gif") ?>';
                    }

                    const itemHtml = `
                <div class="product-row" data-id="${barang.id_barang}">
                    <input type="checkbox" class="product-checkbox" ${barang.selected ? 'checked' : ''}>
                    <img src="<?= base_url() ?>${photoPath}" 
                         alt="Foto Barang" class="product-image">
                    <div class="product-info">${barang.nama_barang}</div>
                    <div class="barang-detail">
                        <div class="product-details">${barang.jumlah_total_baik}</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1, '${barang.id_barang}')">-</button>
                            <span>${barang.total_dipinjam}</span>
                            <button onclick="updateQuantity(this, 1, '${barang.id_barang}')">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('${barang.id_barang}')">Hapus</button>
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

            // Pindahkan event listener ke sini, setelah semua checkbox dibuat
            document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            // Cek status checkbox
            const checkboxStatus = localStorage.getItem('checkboxStatus');
            if (checkboxStatus === 'checked') {
                document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                    checkbox.checked = true;
                });
                localStorage.removeItem('checkboxStatus');
            }

            updateTotal();
        });

        // Delegation untuk menangani checkbox baru
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('product-checkbox')) {
                updateTotal();
            }
        });

        // Fungsi update quantity
        function updateQuantity(button, change, idBarang) {
            const quantitySpan = button.parentElement.querySelector('span');
            const stockElement = button.parentElement.previousElementSibling;
            let quantity = parseInt(quantitySpan.textContent);
            let stock = parseInt(stockElement.textContent);

            // Perubahan disini - memperbolehkan quantity bertambah sampai stock habis
            if ((change === -1 && quantity > 1) || (change === 1 && stock > 0)) {
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

                // Update session storage
                let keranjang = JSON.parse(sessionStorage.getItem('keranjang'));
                const item = keranjang.find(item => item.id_barang === idBarang);
                if (item) {
                    item.total_dipinjam = quantity;
                    item.jumlah_total_baik = stock;
                    sessionStorage.setItem('keranjang', JSON.stringify(keranjang));
                }

                // Update database
                fetch(`/updateStok/${idBarang}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            stok: stock
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            Swal.fire('Error', 'Gagal mengupdate stok', 'error');
                        }
                    });

                updateTotal();
            }
        }

        function confirmDelete(idBarang) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Barang akan dihapus dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ambil data keranjang
                    let keranjang = JSON.parse(sessionStorage.getItem('keranjang'));
                    const itemToDelete = keranjang.find(item => item.id_barang === idBarang);

                    if (itemToDelete) {
                        // Hitung stok yang akan dikembalikan
                        const stockToReturn = itemToDelete.total_dipinjam;
                        const newStock = itemToDelete.jumlah_total_baik + stockToReturn;

                        // Update stok di database
                        fetch(`/updateStok/${idBarang}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    stok: newStock
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hapus dari session storage
                                    keranjang = keranjang.filter(item => item.id_barang !== idBarang);
                                    sessionStorage.setItem('keranjang', JSON.stringify(keranjang));

                                    // Hapus element dari UI
                                    document.querySelector(`[data-id="${idBarang}"]`).remove();

                                    // Update total
                                    updateTotal();

                                    Swal.fire('Terhapus!', 'Barang telah dihapus dari keranjang dan stok telah dikembalikan !', 'success');
                                } else {
                                    Swal.fire('Error', 'Gagal mengembalikan stok barang !', 'error');
                                }
                            });
                    }
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
                    let keranjang = JSON.parse(sessionStorage.getItem('keranjang'));
                    let successCount = 0;
                    let totalItems = selectedRows.length;

                    // Buat array promises untuk menangani semua permintaan update stok
                    const updatePromises = Array.from(selectedRows).map(checkbox => {
                        const row = checkbox.closest('.product-row');
                        const idBarang = row.dataset.id;
                        const quantity = parseInt(row.querySelector('.quantity-control span').textContent);
                        const currentStock = parseInt(row.querySelector('.product-details').textContent);
                        const newStock = currentStock + quantity;

                        return fetch(`/updateStok/${idBarang}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                stok: newStock
                            })
                        }).then(response => response.json());
                    });

                    // Jalankan semua update secara bersamaan
                    Promise.all(updatePromises)
                        .then(results => {
                            // Hitung jumlah update yang berhasil
                            successCount = results.filter(result => result.success).length;

                            if (successCount === totalItems) {
                                // Jika semua update berhasil, hapus item dari keranjang
                                selectedRows.forEach(checkbox => {
                                    const row = checkbox.closest('.product-row');
                                    const idBarang = row.dataset.id;
                                    keranjang = keranjang.filter(item => item.id_barang !== idBarang);
                                    row.remove();
                                });

                                sessionStorage.setItem('keranjang', JSON.stringify(keranjang));
                                updateTotal();

                                Swal.fire(
                                    'Terhapus!',
                                    'Semua barang telah dihapus dari keranjang dan stok telah dikembalikan !',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Peringatan!',
                                    'Beberapa barang gagal diproses. Silakan coba lagi !',
                                    'warning'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat memproses penghapusan !',
                                'error'
                            );
                        });
                }
            });
        }

        // Modifikasi fungsi pinjamSelected
        function pinjamSelected() {
            const selectedItems = [];
            document.querySelectorAll('.product-row').forEach(row => {
                const checkbox = row.querySelector('.product-checkbox');
                if (checkbox.checked) {
                    const idBarang = row.dataset.id;
                    const quantity = parseInt(row.querySelector('.quantity-control span').textContent);
                    selectedItems.push({
                        id_barang: idBarang,
                        quantity: quantity
                    });
                }
            });

            if (selectedItems.length > 0) {
                // Simpan item yang dipilih ke session storage
                sessionStorage.setItem('selectedItems', JSON.stringify(selectedItems));

                // Tampilkan modal peminjaman
                $('#peminjamanModal').modal('show');
            } else {
                Swal.fire('Perhatian!', 'Pilih barang yang akan dipinjam terlebih dahulu.', 'warning');
            }
        }
    </script>
</body>

</html>
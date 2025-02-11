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
                         <div>Jumlah Tersedia</div>
                         <div>Aksi</div>
                    </div>
                </div>
            </div>


            <div class="category-section">
                <div class="category-header">Kategori A</div>
                <div class="product-row">
                    <input type="checkbox" class="product-checkbox">
                    <img src="../assets/images/tes2.jpg" alt="Foto Barang" class="product-image">
                    <div class="product-info">Nama Barang 1</div>
                    <div class="barang-detail">
                        <div class="product-details">10</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1)">-</button>
                            <span>1</span>
                            <button onclick="updateQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </div>
                </div>
            </div>
            <div class="category-section">
                <div class="category-header">Kategori A</div>
                <div class="product-row">
                    <input type="checkbox" class="product-checkbox">
                    <img src="../assets/images/tes2.jpg" alt="Foto Barang" class="product-image">
                    <div class="product-info">Nama Barang 1</div>
                    <div class="barang-detail">
                        <div class="product-details">10</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1)">-</button>
                            <span>1</span>
                            <button onclick="updateQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </div>
                </div>
                <div class="product-row">
                    <input type="checkbox" class="product-checkbox">
                    <img src="../assets/images/tes2.jpg" alt="Foto Barang" class="product-image">
                    <div class="product-info">Nama Barang 1</div>
                    <div class="barang-detail">
                        <div class="product-details">10</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1)">-</button>
                            <span>1</span>
                            <button onclick="updateQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </div>
                </div>
                <div class="product-row">
                    <input type="checkbox" class="product-checkbox">
                    <img src="../assets/images/tes2.jpg" alt="Foto Barang" class="product-image">
                    <div class="product-info">Nama Barang 1</div>
                    <div class="barang-detail">
                        <div class="product-details">10</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1)">-</button>
                            <span>1</span>
                            <button onclick="updateQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </div>
                </div>
            </div>
            <div class="category-section">
                <div class="category-header">Kategori A</div>
                <div class="product-row">
                    <input type="checkbox" class="product-checkbox">
                    <img src="../assets/images/tes2.jpg" alt="Foto Barang" class="product-image">
                    <div class="product-info">Nama Barang 1</div>
                    <div class="barang-detail">
                        <div class="product-details">10</div>
                        <div class="quantity-control">
                            <button onclick="updateQuantity(this, -1)">-</button>
                            <span>1</span>
                            <button onclick="updateQuantity(this, 1)">+</button>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <div>
                    <input type="checkbox" class="product-checkbox product-checkbox-all">
                    <button class="btn btn-primary">Pilih Semua</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
                <div>
                    <span>Total : 0 Barang</span>
                    <button class="btn btn-success">Pinjam</button>
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

document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".product-checkbox");
    const selectAllCheckbox = document.querySelector(".product-checkbox-all");
    const totalSpan = document.querySelector(".footer-section span");

    function updateTotal() {
        let total = 0;
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                const quantity = parseInt(checkbox.closest(".product-row").querySelector(".quantity-control span").textContent);
                total += quantity;
            }
        });
        totalSpan.textContent = `Total : ${total} Barang`;
    }

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", updateTotal);
    });

    selectAllCheckbox.addEventListener("change", function () {
        const isChecked = this.checked;
        checkboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });
        updateTotal();
    });

    // Update jumlah saat tombol + atau - ditekan
    document.querySelectorAll(".quantity-control button").forEach((button) => {
        button.addEventListener("click", function () {
            setTimeout(updateTotal, 100);
        });
    });
});

        function updateQuantity(button, change) {
            const quantitySpan = button.parentElement.querySelector('span');
            let quantity = parseInt(quantitySpan.textContent);
            const stock = parseInt(button.parentElement.previousElementSibling.textContent);

            if (change === -1 && quantity > 1) {
                quantity--;
            } else if (change === 1 && quantity < stock) {
                quantity++;
            }
            
            quantitySpan.textContent = quantity;
        }

        function confirmDelete(button) {
            if (confirm("Apakah Anda yakin ingin menghapus barang ini?")) {
                button.closest('.product-row').remove();
            }
        }
    </script>
</body>
</html>

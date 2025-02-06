<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- keranjang section -->
    <section class="keranjang_section" style="margin-top: 90px;">
    <div class="container my-4">
        <h2 class=" mb-4 heading_container" style="font-weight:700">Keranjang barang</h2>
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Jumlah</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="../assets/images/tes2.jpg" alt="Foto Barang" width="200"></td>
                    <td class="align-middle">Nama Barang 2</td>
                    <td class="align-middle">Kategori A</td>
                    <td class="align-middle">20</td>
                    <td class="align-middle">
                        <button class="btn btn-sm btn-warning" onclick="updateQuantity(this, -1)">-</button>
                        <span class="mx-2">1</span>
                        <button class="btn btn-sm btn-primary" onclick="updateQuantity(this, 1)">+</button>
                    </td>
                    <td class="align-middle">
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td><img src="../assets/images/tes2.jpg" alt="Foto Barang" width="200"></td>
                    <td class="align-middle">Nama Barang 1</td>
                    <td class="align-middle">Kategori A</td>
                    <td class="align-middle">10</td>
                    <td class="align-middle">
                        <button class="btn btn-sm btn-warning" onclick="updateQuantity(this, -1)">-</button>
                        <span class="mx-2">1</span>
                        <button class="btn btn-sm btn-primary" onclick="updateQuantity(this, 1)">+</button>
                    </td>
                    <td class="align-middle">
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(this)">Hapus</button>
                    </td>
                </tr>
                <!-- Tambahkan baris lain sesuai kebutuhan -->
            </tbody>
        </table>
        <div class="text-end d-flex justify-content-end">
            <button class="btn btn-primary">Ajukan Peminjaman</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="z-index:999999">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus barang ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    </section>

    <!-- end kersanjang section -->
    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

    <script>
        // UNTUK TOMBOL + DAN -
        function updateQuantity(button, change) {
            const quantitySpan = button.parentElement.querySelector('span');
            let quantity = parseInt(quantitySpan.textContent);
            const stock = parseInt(button.parentElement.previousElementSibling.textContent);

            if (change === -1 && quantity > 0) {
                quantity--;
            } else if (change === 1 && quantity < stock) {
                quantity++;
            }

            quantitySpan.textContent = quantity;
        }

        // UNTUK TOMBOL HAPUS
        function confirmDelete(button) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const confirmButton = document.getElementById('confirmDeleteButton');

            confirmButton.onclick = () => {
                button.closest('tr').remove();
                modal.hide();
            };

            modal.show();
        }
    </script>
</body>
</body>

</html>
<?= $this->include('layouts/template') ?>
<body class="sub_page">
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->
    <section class="barang_section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="fw-bold text-center">Cek Status Barang</h2>
                </div>
                <div class="col-12 mt-2">
                    <div class="input-group mb-3">
                        <form action="/cek_resi" method="post" id="formCekResi" class="w-100">
                            <input name="kode_peminjaman" placeholder="Masukan resi barang..." type="text" 
                                class="form-control border border-primary" 
                                aria-label="Sizing example input" 
                                aria-describedby="inputGroup-sizing-default" 
                                style="height: 50px;">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn-cek-barang btn btn-primary">Cek</button>
                    </form>
                    <button type="button" class="btn-cek-barang btn btn-danger mt-lg-0 mt-2" id="btnReset">Reset</button>
                </div>
            </div>

            <?php if (isset($result) && $searched): ?>
    <?php if ($result): ?>
        <!-- Show table only when data exists -->
        <div class="row my-4" id="resultTable">
            <div class="col-12">
                <h2>Detail data barang</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama lengkap</th>
                            <th scope="col">Nama barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tanggal transaksi</th>
                            <th scope="col">Total barang</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $result['nama_lengkap'] ?></td>
                            <td><?= $result['nama_barang'] ?></td>
                            <td><?= $result['nama_kategori'] ?></td>
                            <td><?= $result['tanggal_pengajuan'] ?></td>
                            <td><?= $result['total_dipinjam'] ?></td>
                            <td><?= $result['status'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <!-- Only show alert when no data -->
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Data dengan kode resi tersebut tidak ditemukan!
        </div>
    <?php endif; ?>
<?php endif; ?>
        </div>
    </section>

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>
    
    <script>
        document.getElementById('btnReset').addEventListener('click', function() {
            // Reset input field
            document.querySelector('input[name="kode_peminjaman"]').value = '';
            
            // Hide both result table and alert message
            const resultTable = document.getElementById('resultTable');
            const alertMessage = document.getElementById('alertMessage');
            
            if (resultTable) {
                resultTable.style.display = 'none';
            }
            if (alertMessage) {
                alertMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>
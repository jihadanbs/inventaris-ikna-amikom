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
                        <form action="<?= site_url('/cek-resi'); ?>" method="post" id="formCekResi" class="w-100">
                            <input name="kode_peminjaman" maxlength="16" placeholder="Masukan Kode Peminjaman Anda" type="text" class="form-control border border-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="height: 50px;" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn-cek-barang btn btn-primary">Cek</button>
                    </form>
                    <button type="button" class="btn-cek-barang btn btn-danger mt-lg-0 mt-2" id="btnReset">Reset</button>
                </div>
            </div>
            <div class="row d-flex align-item-center">
                <?= $this->include('alert/frontalert'); ?>
            </div>
            <?php if (isset($searched) && $searched): ?>
                <div class="row my-4" id="resultTable">
                    <div class="col-12">
                        <h2>Detail Data Barang</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Total Barang</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($result) && is_array($result)): ?>
                                    <?php foreach ($result as $item): ?>
                                        <tr>
                                            <td><?= !empty($item['nama_lengkap']) ? esc($item['nama_lengkap']) : '' ?></td>
                                            <td><?= !empty($item['nama_barang']) ? esc($item['nama_barang']) : '' ?></td>
                                            <td><?= !empty($item['nama_kategori']) ? esc($item['nama_kategori']) : '' ?></td>
                                            <td><?= !empty($item['tanggal_pengajuan']) ? esc(formatTanggalIndo($item['tanggal_pengajuan'])) : 'Data Tidak Ditemukan !' ?></td>
                                            <td><?= !empty($item['total_dipinjam']) ? esc($item['total_dipinjam']) . ' Unit' : '' ?></td>
                                            <td><?= !empty($item['status']) ? esc($item['status']) : '' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data Tidak Ditemukan !</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            // resetinputan 
            document.querySelector('input[name="kode_peminjaman"]').value = '';

            // sembunyikan tabel
            const resultTable = document.getElementById('resultTable');
            if (resultTable) {
                resultTable.style.display = 'none';
            }
        });
    </script>
</body>
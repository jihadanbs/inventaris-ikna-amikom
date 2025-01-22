<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->
    <section class="barang_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold text-center">Cek Status Barang</h2>
                </div>
                <div class="col-12 mt-2">
                    <div class="input-group mb-3">
                        <input placeholder="Masukan resi barang..." type="text" class="form-control border border-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="height: 50px;">
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn-cek-barang btn btn-primary">Cek</button>
                    <button type="button" class="btn-cek-barang btn btn-danger  mt-lg-0 mt-2">Reset</button>
                </div>
            </div>

            <div class="row my-4">
                <div class="col-12">
                    <h2>Detail data barang</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama lengkap</th>
                                <th scope="col">Nama barang </th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Tanggal transaksi</th>
                                <th scope="col">Total barang</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>yes</td>
                                <td>tes</td>
                                <td>@md o</td>
                                <td>tes</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>@fat</td>
                                <td>@fat</td>
                                <td>@fat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->
    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>


</body>

</html>
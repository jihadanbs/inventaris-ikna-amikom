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
                    <input type="text" class="form-control border border-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="col-12">
                <button type="button" class="btn-cek-barang btn btn-primary">Cek</button>
                <button type="button" class="btn-cek-barang btn btn-danger">Reset</button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                <h2>Detail data barang</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
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
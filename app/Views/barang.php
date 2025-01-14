<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->
    <section class="barang_section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <ul class="nav nav-tabs category-tabs mb-4" id="categoryTabs" role="tablist">
                    <li class="nav-item" id="kategori1">
                        <a class="nav-link active" data-toggle="tab" href="#kategoritab1">Perlengkapan</a>
                    </li>
                    <li class="nav-item" id="kategori2">
                        <a class="nav-link" data-toggle="tab" href="#kategoritab2">Kategori 2</a>
                    </li>
                    <li class="nav-item" id="kategori3">
                        <a class="nav-link" data-toggle="tab" href="#kategoritab3">Kategori 3</a>
                    </li>
                    <li class="nav-item" id="kategori4">
                        <a class="nav-link" data-toggle="tab" href="#kategoritab4">Mirip yang kamu </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="categoryTabsContent">
            <!-- barang Tab -->
            <div class="tab-pane fade show active" id="kategoritab1">
                <div class="row">
                    <!-- card barang yang looping -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <div class="card product-card">
                            <img src="/api/placeholder/200/200" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Powerbank Anker Nano 10,000 mAh</h6>
                                <span class="badge badge-warning category-badge mb-2">Power Bank</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                <p class="card-text mt-2">
                                    <strong>Rp 449.000</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- More product cards would go here -->
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Other category tabs would follow the same pattern -->
            <div class="tab-pane fade" id="#kategoritab2">
                <!-- Similar structure as power bank tab -->
            </div>
            <div class="tab-pane fade" id="#kategoritab3">
                <!-- Similar structure as power bank tab -->
            </div>
            <div class="tab-pane fade" id="#kategoritab4">
                <!-- Similar structure as power bank tab -->
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
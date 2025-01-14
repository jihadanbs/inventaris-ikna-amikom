<?= $this->include('layouts/template') ?>

<style>
  
  
</style>
<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->
    <section class="barang_section">
        <div class="container">
            
        <div class="row d-flex justify-content-center mb-4">
        <h2 class="p-2 mb-3">Barang IKNAventory</h2>
    <div class="d-flex justify-content-between align-items-center w-100">
        <button class="btn btn-secondary" id="scrollLeftBtn">&lt;</button>
        <ul class="nav nav-tabs category-tabs  scrollable-tabs" id="categoryTabs" role="tablist">
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
            <a class="nav-link" data-toggle="tab" href="#kategoritab4">Mirip yang kamu</a>
        </li>
        <li class="nav-item" id="kategori5">
            <a class="nav-link" data-toggle="tab" href="#kategoritab5">Kategori 5</a>
        </li>
        <li class="nav-item" id="kategori6">
            <a class="nav-link" data-toggle="tab" href="#kategoritab6">Kategori 6</a>
        </li>
        <li class="nav-item" id="kategori6">
            <a class="nav-link" data-toggle="tab" href="#kategoritab6">Kategori 6</a>
        </li>
        <li class="nav-item" id="kategori6">
            <a class="nav-link" data-toggle="tab" href="#kategoritab6">Kategori 6</a>
        </li>
        </ul>
        <button class="btn btn-secondary" id="scrollRightBtn">&gt;</button>
    </div>
</div>

            <div class="tab-content" id="categoryTabsContent">
            <!-- barang Tab -->
            <div class="tab-pane fade show active" id="kategoritab1">
                <div class="row d-flex justify-content-center">
                    <!-- card barang yang looping -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1 mx-3 mx-sm-0">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/tes4.jpeg" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/tes.jpg" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1">
                        <a href="">
                        <div class="card product-card">
                            <img src="assets/images/work-img.png" class="card-img-top product-img p-2" alt="Product">
                            <div class="card-body">
                                <h6 class="card-title">Judul nama barang disisni  </h6>
                                <span class="badge badge-warning category-badge mb-2">Kategori barang</span>
                                <p class="card-text mb-1">Stock: 50 units</p>
                                <span class="badge badge-light city-badge">Jakarta Utara</span>
                                    <p>Masa pinjam : 2 hari</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- lanjutkan card -->
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation" class="my-4 pb-5">
                    <ul class="pagination-barang pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Other category tabs would follow the same pattern -->
            <div class="tab-pane fade" id="kategoritab2">
                <!-- Similar structure as power bank tab -->
            </div>
            <div class="tab-pane fade" id="kategoritab3">
                <!-- Similar structure as power bank tab -->
            </div>
            <div class="tab-pane fade" id="kategoritab4">
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

    <script>
        const categoryTabs = document.getElementById('categoryTabs');
const scrollLeftBtn = document.getElementById('scrollLeftBtn');
const scrollRightBtn = document.getElementById('scrollRightBtn');

scrollLeftBtn.addEventListener('click', () => {
    categoryTabs.scrollLeft -= 100;
});

scrollRightBtn.addEventListener('click', () => {
    categoryTabs.scrollLeft += 100;
});
  // Memastikan lebar tabs sesuai dengan konten
  function adjustTabWidth() {
    const tabsWidth = $('.scrollable-tabs').width();
    const totalTabsWidth = $('.scrollable-tabs .nav-item').toArray().reduce((sum, tab) => sum + $(tab).outerWidth(), 0);
    
    if (totalTabsWidth > tabsWidth) {
      $('.scrollable-tabs').css('justify-content', 'flex-start');
    } else {
      $('.scrollable-tabs').css('justify-content', 'center');
    }
  }

  $(window).on('load resize', adjustTabWidth);
</script>
</body>

</html>
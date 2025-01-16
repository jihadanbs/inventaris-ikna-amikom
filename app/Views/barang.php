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
                <h2 class="p-2 mb-3" style="font-weight:700;">Barang IKNAVENTORY</h2>
                <div class="d-flex justify-content-between align-items-center w-100">
                    <button class="btn btn-secondary" id="scrollLeftBtn">&lt;</button>
                    <ul class="nav nav-tabs category-tabs scrollable-tabs" id="categoryTabs" role="tablist">
                        <?php
                        $categories = array_unique(array_column($tb_setting_pinjam_barang, 'nama_kategori'));
                        $activeClass = 'active';
                        foreach ($categories as $index => $category) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $activeClass ?>" data-toggle="tab" href="#kategori<?= $index + 1 ?>">
                                    <?= $category ?>
                                </a>
                            </li>
                            <?php $activeClass = ''; ?>
                        <?php endforeach; ?>
                    </ul>
                    <button class="btn btn-secondary" id="scrollRightBtn">&gt;</button>
                </div>
            </div>

            <div class="tab-content" id="categoryTabsContent">
                <?php if (empty($tb_setting_pinjam_barang)) : ?>
                    <div class="text-center">
                        <img src="<?= base_url('assets/img/404.gif') ?>" alt="No Data" class="img-fluid" style="width: 250px;">
                        <h4 class="my-3">Data tidak ditemukan</h4>
                    </div>
                <?php else : ?>
                    <?php
                    $activeClass = 'show active';
                    foreach ($categories as $index => $category) :
                        $hasData = false;
                        foreach ($tb_setting_pinjam_barang as $barang) {
                            if ($barang['nama_kategori'] === $category && $barang['is_tampil'] == 1) {
                                $hasData = true;
                                break;
                            }
                        }
                    ?>
                        <div class="tab-pane fade <?= $activeClass ?>" id="kategori<?= $index + 1 ?>">
                            <?php if (!$hasData) : ?>
                                <div class="text-center">
                                    <img src="<?= base_url('assets/img/404.gif') ?>" alt="No Data" class="img-fluid" style="max-width: 300px;">
                                    <h3 class="my-3">Tidak ada barang di kategori ini</h3>
                                </div>
                            <?php else : ?>
                                <div class="row d-flex justify-content-center">
                                    <?php foreach ($tb_setting_pinjam_barang as $barang) :
                                        if ($barang['nama_kategori'] === $category && $barang['is_tampil'] == 1) : ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 p-1 mx-3 mx-sm-0">
                                                <a href="/barang-detail/<?= $barang['slug'] ?>">
                                                    <div class="card product-card">
                                                        <img src="<?= base_url(explode(',', $barang['path_file_foto_barang'])[0]) ?>"
                                                            class="card-img-top product-img p-2" alt="Product">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><?= $barang['nama_barang'] ?></h6>
                                                            <span class="badge badge-warning category-badge mb-2"><?= $barang['nama_kategori'] ?></span>
                                                            <p class="card-text mb-1">Stok : <?= $barang['jumlah_total_baik'] ?> unit</p>
                                                            <p class="mb-0">Masa pinjam : <?= $barang['masa_pinjam'] ?> hari</p>
                                                            <i class="bi bi-geo-alt-fill"></i>
                                                            <span class="badge badge-light city-badge"><?= $barang['lokasi'] ?></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                    <?php endif;
                                    endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php
                        $activeClass = '';
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="my-4 pb-5">
                <?php $pager->setPath('barang'); ?>
                <ul class="pagination-barang pagination justify-content-center">
                    <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= ($currentPage > 1) ? '?page=' . ($currentPage - 1) : '#' ?>" tabindex="-1">Previous</a>
                    </li>
                    <?php
                    $totalPages = ceil($total / $perPage);
                    for ($i = 1; $i <= $totalPages; $i++) :
                    ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= ($currentPage < $totalPages) ? '?page=' . ($currentPage + 1) : '#' ?>">Next</a>
                    </li>
                </ul>
            </nav>
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
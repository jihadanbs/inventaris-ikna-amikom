<!-- Component yang dapat digunakan berulang kali pada halaman lain yerdapat pada folder Layout-->
<?= $this->include('layouts/template') ?>


<body>
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
        <!-- slider section -->
        <section class=" slider_section ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="row d-flex align-item-center">
                        <?= $this->include('alert/frontalert'); ?>
                    </div>
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="detail_box">
                                        <h1>
                                            IKNAventory
                                        </h1>
                                        <div class="btn-box">
                                            <a href="<?= site_url('kontak'); ?>" class="btn-1">
                                                Kontak Kami
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <img src="<?= base_url('assets/images/slider-img.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->
    <section class="about_section ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/about-img2.png') ?>" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Tentang IKNAventory
                            </h2>
                        </div>
                        <p>
                            UKM IKNA didirikan di Yogyakarta pada tanggal 14 November 1995 dan diresmikan tanggal 7
                            Desember 2011 oleh STMIK AMIKOM Yogyakarta (sekarang menjadi Universitas AMIKOM)
                        </p>
                        <a href="<?= site_url('/about') ?>">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->


    <!-- Kegiatan section -->
    <section class="service_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>Kegiatan IKNAventory</h2>
                <p>Dokumentasi beberapa kegiatan yang pernah dilakukan oleh IKNAventory</p>
            </div>

            <div class="service_container row container-fluid">
                <?php if (!empty($galeriKegiatan)) : ?>
                    <?php foreach (array_slice($galeriKegiatan, 0, 4) as $kegiatan) : ?>
                        <div class="box" data-toggle="modal" data-target="#modal<?= $kegiatan['id_kegiatan'] ?>">
                            <div class="img-box">
                                <img src="<?= base_url($kegiatan['foto_kegiatan']) ?>" alt="Foto <?= $kegiatan['judul_kegiatan'] ?>" class="img-fluid">
                            </div>
                            <div class="detail-box text-center">
                                <h5><?= $kegiatan['judul_kegiatan'] ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="no-data">
                        <img src="<?= base_url('assets/img/404.gif'); ?>" style=" width: 250px;" alt="Data Tidak Ditemukan" class="no-data-img">
                        <p class="no-data-text">Data Tidak Ditemukan</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="btn-box">
                <a href="<?= site_url('/galeri') ?>">
                    Lebih lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Modal untuk setiap kegiatan -->
    <?php if (!empty($galeriKegiatan)) : ?>
        <?php foreach ($galeriKegiatan as $kegiatan) : ?>
            <div class="modal fade" id="modal<?= $kegiatan['id_kegiatan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $kegiatan['id_kegiatan'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header text-white" style=background:#081c5c;>
                            <h5 class="modal-title" id="modalLabel<?= $kegiatan['id_kegiatan'] ?>"><?= $kegiatan['judul_kegiatan'] ?></h5>
                            <button type="button" class="close" style="color: #FFF;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Image Section -->
                                <div class="col-md-6">
                                    <img src="<?= base_url($kegiatan['foto_kegiatan']) ?>" alt="Foto <?= $kegiatan['judul_kegiatan'] ?>" class="img-fluid rounded shadow-sm">
                                </div>
                                <!-- Details Section -->
                                <div class="col-md-6">
                                    <!-- <h6><b>Waktu Kegiatan :</b> <?= formatTanggalIndo($kegiatan['tanggal_foto']); ?></h6> -->
                                    <p class="text-muted mt-0"><b class="text-dark">Keterangan Kegiatan : </b><br><?= $kegiatan['deskripsi'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

    <!-- end Kegiatan section -->

    <!--Start Nav tabs pengurus -->
    <section class="team_section layout_padding2-bottom mt-5">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Pengurus IKNAventory
                </h2>
                <p>
                    Berikut adalah daftar anggota-anggota pengurus IKNAventory
                </p>
            </div>
        </div>
        <!-- Navigasi Tab -->
        <nav>
            <div class="nav nav1 nav-tabs" id="nav-tab" role="tablist">
                <?php
                // Array divisi yang tersedia
                $divisi = ['BPH', 'Kerohanian', 'Kerumahtanggaan', 'Humas', 'Talenta Olahraga', 'Talenta Musik', 'Talenta Pertunjukan', 'Usaha Dana', 'Litbang'];

                foreach ($divisi as $index => $div) :
                    $isActive = ($index === 0) ? 'active' : '';
                    $id = strtolower(str_replace(' ', '-', $div));
                ?>
                    <button class="nav-link <?= $isActive ?>"
                        id="nav-<?= $id ?>-tab"
                        data-toggle="tab"
                        data-target="#nav-<?= $id ?>"
                        type="button"
                        role="tab"
                        aria-controls="nav-<?= $id ?>"
                        aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                        <?= $div ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </nav>

        <!-- Konten Tab -->
        <div class="tab-content" id="nav-tabContent">
            <?php foreach ($divisi as $index => $div) :
                $isActive = ($index === 0) ? 'show active' : '';
                $id = strtolower(str_replace(' ', '-', $div));
            ?>
                <div class="tab-pane fade <?= $isActive ?>"
                    id="nav-<?= $id ?>"
                    role="tabpanel"
                    aria-labelledby="nav-<?= $id ?>-tab">
                    <div class="team_container">
                        <?php
                        // Filter pengurus berdasarkan divisi
                        $pengurusDivisi = array_filter($pengurus, function ($p) use ($div) {
                            return $p['divisi'] === $div;
                        });

                        // Cek apakah ada data pengurus di divisi tersebut
                        if (!empty($pengurusDivisi)) :
                            foreach ($pengurusDivisi as $row) :
                        ?>
                                <!-- Card foto pengurus -->
                                <div class="box b-1 col-lg-2">
                                    <div class="img-box">
                                        <img src="<?= base_url($row['foto']) ?>"
                                            alt="Foto <?= $row['nama'] ?>"
                                            onclick="openImageModal(this.src, '<?= $row['nama'] ?>')">
                                    </div>
                                    <div class="detail-box">
                                        <h5><?= $row['nama'] ?></h5>
                                        <p><?= $row['posisi'] ?></p>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <!-- Tampilkan gambar dan pesan jika data tidak ditemukan -->
                            <div class="no-data">
                                <img src="<?= base_url('assets/img/404.gif'); ?>" style=" width: 250px;" alt="Data Tidak Ditemukan" class="no-data-img">
                                <p class="no-data-text">Data Tidak Ditemukan</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Modal for Image Zoom -->
        <div id="imageModal" class="image-modal">
            <span class="close-modal" onclick="closeImageModal()">&times;</span>
            <div class="modal-pengurus modal-content">
                <img id="modalImage" src="" alt="">
                <div class="zoom-controls">
                    <button class="zoom-btn" onclick="zoomImage('in')"><i class="bi bi-plus-circle"></i> Zoom In</button>
                    <button class="zoom-btn" onclick="zoomImage('out')"><i class="bi bi-dash-circle"></i> Zoom Out</button>
                    <button class="zoom-btn" onclick="resetZoom()"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </section>
    <!-- end team section -->

    <!-- Modal untuk foto pengurus -->
    <div id="imageModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="Modal Image">
        </div>
    </div>

    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

    <script>
        let currentZoom = 1;
        const zoomStep = 0.2;

        function openImageModal(imgSrc, name) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');

            modal.style.display = 'block';
            modalImg.src = imgSrc;
            modalImg.alt = 'Foto ' + name;

            // reset zoom foto
            currentZoom = 1;
            modalImg.style.transform = `scale(${currentZoom})`;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
            resetZoom();
        }

        function zoomImage(direction) {
            const modalImg = document.getElementById('modalImage');

            if (direction === 'in' && currentZoom < 3) {
                currentZoom += zoomStep;
            } else if (direction === 'out' && currentZoom > 0.4) {
                currentZoom -= zoomStep;
            }

            modalImg.style.transform = `scale(${currentZoom})`;
        }

        function resetZoom() {
            const modalImg = document.getElementById('modalImage');
            currentZoom = 1;
            modalImg.style.transform = `scale(${currentZoom})`;
        }

        // Close foto pengurus
        document.getElementById('imageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeImageModal();
            }
        });


        document.addEventListener('keydown', function(event) {
            if (document.getElementById('imageModal').style.display === 'block') {
                switch (event.key) {
                    case 'Escape':
                        closeImageModal();
                        break;
                    case '+':
                        zoomImage('in');
                        break;
                    case '-':
                        zoomImage('out');
                        break;
                    case 'r':
                        resetZoom();
                        break;
                }
            }
        });
    </script>
</body>

</html>
<?= $this->include('layouts/template') ?>

<body class="sub_page">

    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container-fluid">
            <div class="heading_container">
                <h2>Kegiatan IKNAventory</h2>
                <p>Dokumentasi beberapa kegiatan yang pernah dilakukan oleh IKNAventory</p>
            </div>

            <div class="service_container row">
                <!-- Card 1 -->
                <div class="box" data-toggle="modal" data-target="#modal1">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 1</h5>
                    </div>
                </div>


                <!-- Card 2 -->
                <div class="box" data-toggle="modal" data-target="#modal2">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 2</h5>
                    </div>
                </div>


                <!-- Card 3 -->
                <div class="box" data-toggle="modal" data-target="#modal3">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 3</h5>
                    </div>
                </div>


                <!-- Card 4 -->
                <div class="box" data-toggle="modal" data-target="#modal4">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes4.jpeg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 4</h5>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="box" data-toggle="modal" data-target="#modal5 ">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 5</h5>
                    </div>
                </div>


                <!-- Card 6 -->
                <div class="box" data-toggle="modal" data-target="#modal6">
                    <div class="img-box">
                        <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="" class="img-fluid">
                    </div>
                    <div class="detail-box text-center">
                        <h5>Kegiatan 6</h5>
                    </div>
                </div>
            </div>


            <div class="btn-box">
                <a href="#">
                    Back
                </a>
                <a href="#">
                    Next
                </a>
            </div>
        </div>
    </section>

    <!--Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="Brand Promotion" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Brand Promotion</h5>
                    <p>Brand promotion is essential for awareness and visibility.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="Video Marketing" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Video Marketing</h5>
                    <p>Video marketing connects brands with audiences effectively.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes3.jpg') ?>" alt="Site Analysis" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Site Analysis</h5>
                    <p>Site analysis ensures optimal performance for businesses.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal 4 -->
    <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes4.jpeg') ?>" alt="Site Analysis" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Kegiatan 4</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error officia aspernatur alias sequi
                        minus aut praesentium asperiores veritatis accusamus temporibus, ab omnis cumque? Maxime ex
                        possimus soluta sapiente enim? Architecto.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 5 -->
    <div class="modal fade" id="modal5" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes.jpg') ?>" alt="Brand Promotion" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">Kegiatan 5</h5>
                    <p>Brand promotion is essential for awareness and visibility.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 6 -->
    <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="<?= base_url('assets/images/tes2.jpg') ?>" alt="Video Marketing" class="img-fluid mb-3">
                    <h5 class="modal-title font-weight-bold d-flex justify-content-center">kegiatan 6</h5>
                    <p>Video marketing connects brands with audiences effectively.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- end service section -->
    <div class="footer_bg">

        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>

</body>

</html>
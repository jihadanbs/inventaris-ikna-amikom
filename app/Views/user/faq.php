<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- <style>
    .custom-accordion-button {
        background-color: #ADD8E6 !important;
        /* Warna biru muda */
        color: black
            /* Warna teks */
    }
</style> -->

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-100 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4" style="color: #f4d160; font-size: 45px;">FAQ</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<div class="container p-5 pb-5">

    <div class="accordion" id="accordionExample">

        <?php foreach ($groupedFaqs as $kategori => $faqs) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header bg-primary text-danger" id="heading-<?= strtolower(str_replace(' ', '-', $kategori)) ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= strtolower(str_replace(' ', '-', $kategori)) ?>" aria-expanded="false" aria-controls="collapse-<?= strtolower(str_replace(' ', '-', $kategori)) ?>">
                        <?= $kategori ?>
                    </button>
                </h2>
                <div id="collapse-<?= strtolower(str_replace(' ', '-', $kategori)) ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= strtolower(str_replace(' ', '-', $kategori)) ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="accordion" id="accordionExampleOne">
                            <div id="accordion-<?= strtolower(str_replace(' ', '-', $kategori)) ?>">
                                <?php foreach ($faqs as $index => $faq) : ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-<?= $faq->id_faq ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $faq->id_faq ?>" aria-expanded="false" aria-controls="collapse-<?= $faq->id_faq ?>">
                                                <?= $faq->pertanyaan ?>
                                            </button>
                                        </h2>
                                        <div id="collapse-<?= $faq->id_faq ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $faq->id_faq ?>" data-bs-parent="#accordion-<?= strtolower(str_replace(' ', '-', $kategori)) ?>">
                                            <div class="accordion-body">
                                                <?= $faq->jawaban ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?= $this->endSection(''); ?>
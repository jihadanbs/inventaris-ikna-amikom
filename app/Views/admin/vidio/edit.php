<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

<!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
<div style="pointer-events: none;">
    <?= $this->include('admin/layouts/navbar') ?>
    <?= $this->include('admin/layouts/sidebar') ?>
</div>
<?= $this->include('admin/layouts/rightsidebar') ?>

<?= $this->section('content'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Vidio</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vidio</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Vidio</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">

                <div class="col-10">
                    <div class="card border border-secondary rounded p-4">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Formulir Ubah Data Vidio</h2>

                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> -
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form action="/admin/vidio/update/<?= $tb_vidio['id_vidio']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="judul_vidio" class="col-form-label">Judul Vidio</label>
                                        <input type="text" class="form-control custom-border <?= ($validation->hasError('judul_vidio')) ? 'is-invalid' : ''; ?>" id="judul_vidio" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Judul Vidio" name="judul_vidio" value="<?= old('judul_vidio', $tb_vidio['judul_vidio']); ?>"></input>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_vidio'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="link_vidio" class="col-form-label">Link Vidio</label>
                                        <input type="text" class="form-control custom-border <?= ($validation->hasError('link_vidio')) ? 'is-invalid' : ''; ?>" id="link_vidio" cols="30" rows="5" style="background-color: white;" placeholder="Contoh : https://www.youtube.com/live/eIm2wnlMVMs?si=kP-m0x-d7_EHX1ko" name="link_vidio"></input>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('link_vidio'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" cols="30" rows="10" style="background-color: white;" placeholder="Masukkan Deskripsi" name="deskripsi"><?= old('deskripsi', $tb_vidio['deskripsi']); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_vidio" class="col-form-label">Tanggal Vidio :</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_vidio')) ? 'is-invalid' : ''; ?>" id="tanggal_vidio" style="background-color: white;" name="tanggal_vidio" value="<?= old('tanggal_vidio', $tb_vidio['tanggal_vidio']); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tanggal_vidio'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/vidio/cek_data/<?= $tb_vidio['id_vidio'] ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary ">Ubah Data</button>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('admin/layouts/footer') ?>
<!-- end main content-->

<?= $this->include('admin/layouts/script2') ?>

<!-- autofocus input edit langsung kebelakang kata -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputJudul = document.getElementById('judul_vidio');

        // Fungsi untuk mengatur fokus ke posisi akhir input
        function setFocusToEnd(element) {
            element.focus();
            var val = element.value;
            element.value = ''; // kosongkan nilai input
            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
        }

        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
        setFocusToEnd(inputJudul);
    });
</script>
<!-- end autofocus input edit langsung kebelakang kata -->
<?= $this->include('admin/layouts/script') ?>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data FAQ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data FAQ</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data FAQ</h2>
                            <form action="/admin/faq/update/<?= $tb_faq['id_faq']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="id_kategori_faq" class="col-form-label">Nama Kategori FAQ</label>
                                    <select class="form-select custom-border <?= ($validation->hasError('id_kategori_faq')) ? 'is-invalid' : ''; ?>" id="id_kategori_faq" name="id_kategori_faq" aria-label="Default select example" style="background-color: white;" required>
                                        <option value="" selected disabled>Silahkan Pilih Nama Kategori FAQ --</option>
                                        <?php foreach ($tb_kategori_faq as $value) : ?>
                                            <?php $selected = ($value['id_kategori_faq'] == old('id_kategori_faq', $tb_faq['id_kategori_faq'])) ? 'selected' : ''; ?>
                                            <option value="<?= $value['id_kategori_faq'] ?>" <?= $selected ?>><?= $value['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="pertanyaan" class="col-form-label">Pertanyaan :</label>
                                    <textarea class="form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : ''; ?>" name="pertanyaan" id="pertanyaan" required><?= old('pertanyaan', $tb_faq['pertanyaan']); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pertanyaan'); ?>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('pertanyaan', {
                                            toolbar: [{
                                                    name: 'clipboard',
                                                    groups: ['clipboard', 'undo'],
                                                    items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
                                                },
                                                {
                                                    name: 'editing',
                                                    groups: ['find', 'selection', 'spellchecker'],
                                                    items: ['Find', 'Replace']
                                                },
                                                {
                                                    name: 'basicstyles',
                                                    groups: ['basicstyles', 'cleanup'],
                                                    items: ['Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                                                },
                                                {
                                                    name: 'paragraph',
                                                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                                                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-']
                                                },
                                                // { name: 'links', items: [ 'Link', 'Unlink' ] },
                                                // { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
                                                {
                                                    name: 'styles',
                                                    items: ['Styles', 'Format', 'Font', 'FontSize']
                                                },
                                                // { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                                                {
                                                    name: 'others',
                                                    items: ['-']
                                                },
                                            ]
                                        });
                                    </script>
                                </div>

                                <div class="mb-3">
                                    <label for="jawaban" class="col-form-label">Jawaban :</label>
                                    <textarea class="form-control <?= ($validation->hasError('jawaban')) ? 'is-invalid' : ''; ?>" name="jawaban" id="jawaban" required><?= old('jawaban', $tb_faq['jawaban']); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jawaban'); ?>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('jawaban', {
                                            toolbar: [{
                                                    name: 'clipboard',
                                                    groups: ['clipboard', 'undo'],
                                                    items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
                                                },
                                                {
                                                    name: 'editing',
                                                    groups: ['find', 'selection', 'spellchecker'],
                                                    items: ['Find', 'Replace']
                                                },
                                                {
                                                    name: 'basicstyles',
                                                    groups: ['basicstyles', 'cleanup'],
                                                    items: ['Bold', 'Italic', 'Underline', '-', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                                                },
                                                {
                                                    name: 'paragraph',
                                                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                                                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-']
                                                },
                                                // { name: 'links', items: [ 'Link', 'Unlink' ] },
                                                // { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
                                                {
                                                    name: 'styles',
                                                    items: ['Styles', 'Format', 'Font', 'FontSize']
                                                },
                                                // { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                                                {
                                                    name: 'others',
                                                    items: ['-']
                                                },
                                            ]
                                        });
                                    </script>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/faq/cek_data/<?= $tb_faq['id_faq'] ?>" class="btn btn-secondary btn-md ml-3">
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
        var inputJudul = document.getElementById('judul');

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
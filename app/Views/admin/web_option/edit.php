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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Web Option</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Web Option</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Web Option</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Web Option</h2>
                            <form action="/admin/web_option/update/<?= $tb_web_option->id_web_option; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Name :</label>
                                    <textarea class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" required><?= old('name', $tb_web_option->name); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('name'); ?>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('name', {
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
                                    <label for="value" class="col-form-label">Value :</label>
                                    <textarea class="form-control <?= ($validation->hasError('value')) ? 'is-invalid' : ''; ?>" name="value" id="value" required><?= old('value', $tb_web_option->value); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('value'); ?>
                                    </div>
                                    <script>
                                        CKEDITOR.replace('value', {
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
                                    <label for="path_file" class="col-form-label">File :</label>
                                    <input type="file" class="form-control" id="path_file" name="path_file" style="background-color: white;" <?= (old('path_file')) ? 'disabled' : 'required'; ?>>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_web_option->path_file)) : ?>
                                        <p>File exists: <?= $tb_web_option->path_file ?></p>
                                        <input type="hidden" name="old_path_file" value="<?= $tb_web_option->path_file; ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/web_option/cek_data/<?= $tb_web_option->id_web_option ?>" class="btn btn-secondary btn-md ml-3">
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
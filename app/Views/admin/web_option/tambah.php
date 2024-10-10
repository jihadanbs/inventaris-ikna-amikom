<?= $this->include('admin/layouts/script') ?>

<!-- saya nonaktifkan agar agar side bar tidak dapat di klik sembarangan -->
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Web Option</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Web Option</h2>

                            <form action="/admin/web_option/save" method="post" enctype="multipart/form-data" id="validationForm" class="needs-validation" novalidate>
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="name" class="col-form-label">Name :</label>
                                    <textarea class="form-control <?= ($validation->hasError('value')) ? 'is-invalid' : ''; ?>" name="name" id="name" required><?php echo old('name'); ?></textarea>

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
                                    <textarea class="form-control <?= ($validation->hasError('value')) ? 'is-invalid' : ''; ?>" name="value" id="value" required><?php echo old('value'); ?></textarea>

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
                                    <input type="file" class="form-control custom-border" id="path_file" name="path_file" style="background-color: white;" <?= (old('path_file')) ? 'disabled' : ''; ?>>
                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <!-- <div class="invalid-feedback" id="fileError">
                                            Kolom File Tidak Boleh Kosong
                                        </div> -->
                                </div>


                                <div class="modal-footer">
                                    <a href="/admin/web_option" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Tambah</button>
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
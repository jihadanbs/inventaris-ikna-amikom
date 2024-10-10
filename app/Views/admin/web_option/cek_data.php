<?= $this->include('admin/layouts/script') ?>
<div class="col-md-12">
    <style>
        .tabel-kanan {
            display: flex;
            margin-left: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        .read-more-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Web Option</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">PPID Kab. Pesawaran</h3>
                    </div>

                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                <?= session()->getFlashdata('pesan') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('gagal')) : ?>
                            <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                <?= session()->getFlashdata('gagal') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php
                        function truncateText($text, $maxLength)
                        {
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }

                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Web Option</b></h4>
                            <?php if (!empty($tb_web_option)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/psw.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                </tr>
                                <div style="position: fixed; left: 20px">
                                    <tr class="tabel-kanan">
                                        <th width="150px">Name</th>
                                        <th width="30px" class="text-center">:</th>
                                        <td><?= $tb_web_option->name ?? '' ?> </td>
                                    </tr>
                                    <tr class="tabel-kanan">
                                        <th width="150px">Value</th>
                                        <th width="30px" class="text-center">:</th>
                                        <td class="readmore">
                                            <?= truncateText($tb_web_option->value, 50) ?? 'Data tidak ditemukan'; ?>
                                            <?php if (strlen(strip_tags($tb_web_option->value)) > 50) : ?>
                                                <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_web_option->value), ENT_QUOTES, 'UTF-8') ?>">Read more</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <!-- Modal Structure -->
                                    <div id="readMoreModal" class="modal">
                                        <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <p id="modal-text"></p>
                                        </div>
                                    </div>


                                </div>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width=50px>NO</th>
                                    <th>Dokumen</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dokumen as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td><?= $value->name ?></td>
                                        <td class="text-center">
                                            <?php if ($value->path_file) : ?>
                                                <a href="<?= base_url($value->path_file) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="/admin/web_option" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/web_option/edit/<?= $value->id_web_option ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>

<?= $this->include('admin/layouts/script2') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("readMoreModal");
        const modalText = document.getElementById("modal-text");
        const closeBtn = document.querySelector(".modal .close");

        document.querySelectorAll(".read-more-link").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const fullText = this.getAttribute("data-text");
                modalText.innerText = fullText;
                modal.style.display = "block";
            });
        });

        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    });
</script>
</body>

</html>
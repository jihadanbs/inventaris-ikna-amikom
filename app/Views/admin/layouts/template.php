<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/admin/images/favicon.ico') ?>">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/preloader.min.css') ?>" type="text/css" />
    <!-- SweetAlert -->
    <link href="<?= base_url('assets/admin/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/admin/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/admin/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/admin/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />
    <title><?= $title ?></title>
</head>

<body>

    <?= $this->include('layouts/navbar') ?>
    <?= $this->include('layouts/sidebar') ?>
    <?= $this->include('layouts/rightsidebar') ?>

    <?= $this->renderSection('content') ?>


    <?= $this->include('layouts/footer') ?>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/admin/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/libs/feather-icons/feather.min.js') ?>"></script>
    <!-- pace js -->
    <script src="<?= base_url('assets/admin/libs/pace-js/pace.min.js') ?>"></script>

    <script src="<?= base_url('assets/admin/libs/sweetalert2/sweetalert2.min.js') ?>"></script>

    <!-- Sweet alert init js-->
    <script src="<?= base_url('assets/admin/js/pages/sweetalert.init.js') ?>"></script>

    <!-- Table Editable plugin -->
    <script src="<?= base_url('assets/admin/libs/table-edits/build/table-edits.min.js') ?>"></script>

    <script src="<?= base_url('assets/admin/js/pages/table-editable.int.js') ?>"></script>

    <script src="<?= base_url('assets/admin/js/app.js') ?>"></script>
    <!-- Sweet Alerts js -->

    <script>
        $("#sa-warning").click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Anda Yakin Ingin Menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28527A",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data Telah Berhasil Dihapus.",
                        icon: "success"
                    });
                }
            });
        });
    </script>


</body>

</html>
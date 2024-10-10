<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($favicon) && !empty($favicon)) : ?>
        <link rel="shortcut icon" href="<?= base_url($favicon) ?>">
    <?php else : ?>
        <p>favicon</p>
    <?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?> " rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?> " rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?> " rel="stylesheet" type="text/css" />
    <!-- icon -->
    <script src="https://kit.fontawesome.com/f21d09af93.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
    <title><?= $title ?></title>

    <!-- SEO -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>PPID Kabupaten Pesawaran</title>
    <meta name="keywords" content="PPID, ppid, kabupaten pesawaran, pesawaran, lampung, lampung selatan, kabupaten lampung selatan, informasi publik, transparansi, layanan informasi, msib, MSIB, MSIB Batch 6, msib batch 6, kominfo, kominfo kabupaten pesawaran, diskominfo, kominfo pesawaran" />
    <meta name="description" content="PPID Kabupaten Pesawaran menyediakan layanan informasi publik yang transparan dan akurat. Ajukan layanan informasi terpercaya di sini." />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="PPID Kabupaten Pesawaran" />
    <meta name="language" content="Indonesian" />
    <meta name="geo.region" content="ID-LA" />
    <meta name="geo.placename" content="Pesawaran" />
    <meta name="geo.position" content="-5.350000;105.300000" />
    <meta name="ICBM" content="-5.350000, 105.300000" />
    <meta http-equiv="Accept-CH" content="Sec-CH-UA-Platform-Version, Sec-CH-UA-Model" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('path/to/icon.ico'); ?>" />
    <link rel="amphtml" href="<?= base_url('amp/' . uri_string()); ?>">
    <link rel="canonical" href="<?= current_url(); ?>" />

    <!-- Open Graph -->
    <meta property="og:site_name" content="PPID Kabupaten Pesawaran" />
    <meta property="og:title" content="PPID Kabupaten Pesawaran - Keterbukaan Informasi Publik" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="PPID Kabupaten Pesawaran menyediakan layanan informasi publik yang transparan dan akurat. Ajukan layanan informasi terpercaya di sini." />
    <meta property="og:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" />

    <!-- Schema.org for Google+ -->
    <meta itemprop="name" content="PPID Kabupaten Pesawaran - Keterbukaan Informasi Publik" />
    <meta itemprop="url" content="<?= current_url(); ?>" />
    <meta itemprop="description" content="PPID Kabupaten Pesawaran menyediakan layanan informasi publik yang transparan dan akurat. Ajukan layanan informasi terpercaya di sini." />
    <meta itemprop="thumbnailUrl" content="<?= base_url('path/to/image.jpg'); ?>" />
    <link rel="image_src" href="<?= base_url('path/to/image.jpg'); ?>" />
    <meta itemprop="image" content="<?= base_url('path/to/image.jpg'); ?>" />

    <!-- Twitter Card -->
    <meta name="twitter:title" content="PPID Kabupaten Pesawaran - Keterbukaan Informasi Publik" />
    <meta name="twitter:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta name="twitter:url" content="<?= current_url(); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="PPID Kabupaten Pesawaran menyediakan layanan informasi publik yang transparan dan akurat. Ajukan layanan informasi terpercaya di sini." />
    <!-- End SEO -->

</head>

<body>
    <div id="preloader" class="preloader-container">
        <!-- Google Chrome -->
        <div class="infinityChrome">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Safari and others -->
        <div class="infinity">
            <div>
                <span></span>
            </div>
            <div>
                <span></span>
            </div>
            <div>
                <span></span>
            </div>
        </div>

        <!-- Text Animation -->
        <div class="text-animation">SALAM ANDAN JEJAMA</div>
    </div>
    <?= $this->include('layouts/navbar2') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('layouts/footer2') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- Icon -->
    <script src="https://kit.fontawesome.com/f21d09af93.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <!-- Required datatable js -->
    <script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?> "></script>
    <!-- Buttons examples -->
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') ?> "></script>
    <!-- Responsive examples -->
    <script src="<?= base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') ?> "></script>
    <script src="<?= base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?> "></script>
    <!-- Datatable init js -->
    <script src="<?= base_url('assets/js/datatables.init.js') ?> "></script>

    <!-- Navbar -->
    <script>
        $(document).ready(function() {
            var $nav = $('nav');
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 30) {
                    $nav.addClass('bg-dark shadow');
                } else {
                    $nav.removeClass('bg-dark shadow');
                }
            });
        });
    </script>

    <!-- Navbar Active -->
    <script>
        $(document).ready(function() {
            // Mendapatkan URL halaman saat ini
            var currentUrl = window.location.href;

            // Mendapatkan URL navbar "Informasi Publik"
            var navbarUrl = '<?= base_url('/standarlayanan') ?>';

            // Mendapatkan URL submenu "Informasi Publik"
            var submenuUrls = [
                '<?= base_url('/formpermohonan') ?>',
                '<?= base_url('/formkeberatan') ?>',
                '<?= base_url('/cekstatus') ?>',
                '<?= base_url('/sopppid') ?>',
                '<?= base_url('/sengketa') ?>',
                '<?= base_url('/penanganan') ?>',
                '<?= base_url('/biaya') ?>',
                '<?= base_url('/maklumat') ?>'
            ];

            // Memeriksa apakah URL halaman saat ini adalah URL navbar "Informasi Publik"
            if (currentUrl === navbarUrl || submenuUrls.includes(currentUrl)) {
                // Jika iya, tandai navbar "Informasi Publik" sebagai aktif
                $('.navbar-nav .nav-item').removeClass('active');
                $('.navbar-nav .nav-item a[href="<?= base_url('/standarlayanan') ?>"]').closest('.nav-item').addClass('active');
            } else {
                // Jika tidak, hapus kelas "active" dari semua navbar
                $('.navbar-nav .nav-item').removeClass('active');
            }
        });
    </script>

    <!-- Form Cek status -->
    <script>
        $(document).ready(function() {
            $("input[type=radio][name=selectOption]").change(function() {
                var selectedOption = $(this).val();
                if (selectedOption == "1") {
                    $("#form1").show();
                    $("#form2").hide();
                } else if (selectedOption == "2") {
                    $("#form1").hide();
                    $("#form2").show();
                } else {
                    $("#form1").hide();
                    $("#form2").hide();
                }
                // Sembunyikan tabel setiap kali radio button berubah
                $('.table-container1').hide();
                $('.table-container2').hide();
            });

            // Sembunyikan container tabel saat halaman dimuat
            $('.table-container1').hide();
            $('.table-container2').hide();

            // Tampilkan container tabel saat tombol "Cek Status" diklik
            $('#cek-status-btn').click(function() {
                var kode_permohonan = $('#kode_permohonan').val();
                if (kode_permohonan === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'No. Pendaftaran harus diisi',
                    });
                } else {
                    $('.table-container1').show();
                }
            });

            $('#cek-status-btn2').click(function() {
                var keberatan = $('#keberatan').val();
                if (keberatan === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Nomor Keberatan harus diisi',
                    });
                } else {
                    $('.table-container2').show();
                }
            });

            $('.btn.btn-danger').click(function() {
                // Sembunyikan tabel
                $('.table-container1').hide();
                $('.table-container2').hide();
            });
        });
    </script>


    <!-- Alert Formulir Permohonan -->

    <script>
        $(document).ready(function() {
            $("#table-container").hide();

        });
        $("#alertpermohonan").click(function(e) {
            e.preventDefault();
            // Memeriksa apakah semua field telah terisi
            var kode = $(".kode").val();
            var nik = $(".nik").val();

            // Array untuk menyimpan field-field yang belum diisi
            var fieldsKosong = [];

            // Memeriksa setiap field apakah kosong, dan menambahkannya ke array fieldsKosong
            if (kode === "") {
                fieldsKosong.push("Kode Permohonan");
            }
            if (nik === "") {
                fieldsKosong.push("NIK/No. Identitas Pribadi");
            }

            // Jika ada field yang belum terisi, tampilkan pesan peringatan
            if (fieldsKosong.length > 0) {
                var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " belum diisi. Mohon lengkapi semuanya";
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: pesanPeringatan,
                });
            } else {
                // Menampilkan tabel jika semua field telah terisi
                $("#table-container").show();
            }
        });
    </script>
    <!-- <script>
        $("#alertpermohonan").click(function(e) {
            e.preventDefault();
            // Memeriksa apakah semua field telah terisi
            var kode = $("#kode_permohonan").val(); // Perbaiki selector di sini
            var nik = $("#nik").val(); // Perbaiki selector di sini

            // Array untuk menyimpan field-field yang belum diisi
            var fieldsKosong = [];

            // Memeriksa setiap field apakah kosong, dan menambahkannya ke array fieldsKosong
            if (kode === "") {
                fieldsKosong.push("Kode Permohonan");
            }
            if (nik === "") {
                fieldsKosong.push("NIK/No. Identitas Pribadi");
            }

            // Jika ada field yang belum terisi, tampilkan pesan peringatan
            if (fieldsKosong.length > 0) {
                var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " belum diisi. Mohon lengkapi semuanya";
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: pesanPeringatan,
                });
            } else {
                // Mengirim data ke server
                $.ajax({
                    url: '<?php echo base_url('/formkeberatan'); ?>', // Ubah ke URL yang benar
                    method: 'GET',
                    data: {
                        kode_permohonan: kode,
                        nik: nik
                    },
                    success: function(response) {
                        console.log(response); // Debug log
                        // Tampilkan data yang didapat dari server
                        $("#table-container").show().html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Debug log
                    }
                });
            }
        });
    </script> -->


    <!-- Alert Formulir Keberatan -->
    <script>
        $(document).ready(function() {
            $("#formKeberatan").submit(function(event) {
                event.preventDefault();

                // Memeriksa apakah setidaknya satu checkbox telah dicentang
                var alasanChecked = $("input[type='checkbox']:checked").length > 0;
                var nama_keberatan = $(".nama_keberatan").val();
                var alamat_keberatan = $(".alamat_keberatan").val();
                var no_telepon_keberatan = $(".no_telepon_keberatan").val();
                var email_keberatan = $(".email_keberatan").val();
                var ringkasan_kasus = $(".ringkasan_kasus").val();

                // Array untuk menyimpan field-field yang belum diisi
                var fieldsKosong = [];

                // Jika tidak ada alasan yang dicentang, tambahkan ke fieldsKosong
                if (!alasanChecked) {
                    fieldsKosong.push("Alasan Pengajuan Keberatan");
                }
                if (nama_keberatan === "") {
                    fieldsKosong.push("Nama Lengkap");
                }
                if (alamat_keberatan === "") {
                    fieldsKosong.push("Alamat");
                }
                if (no_telepon_keberatan === "") {
                    fieldsKosong.push("No. Telepon");
                }
                if (email_keberatan === "") {
                    fieldsKosong.push("Kasus Posisi");
                }
                if (ringkasan_kasus === "") {
                    fieldsKosong.push("Kasus Posisi");
                }

                // Jika ada field yang belum terisi, tampilkan pesan peringatan
                if (fieldsKosong.length > 0) {
                    var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " belum diisi. Mohon isi terlebih dahulu";
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: pesanPeringatan,
                    });
                    return; // Keluar dari fungsi jika ada field yang kosong
                }

                // Menggunakan FormData untuk mengirim file
                var formData = new FormData(this);

                // Kirim data formulir ke server
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tampilkan pesan sukses jika permohonan berhasil disimpan
                        Swal.fire({
                            html: '<img src="<?= base_url('assets/img/validation.gif') ?>" style="width: 200px;">' +
                                '<p style="margin-top: 20px;">Formulir Keberatan berhasil diajukan! Mohon cek status permohonan keberatan secara berkala!.</p>',
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        // Merefresh halaman setelah 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan gagal jika ada kesalahan dalam menyimpan permohonan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ada kesalahan dalam menyimpan permohonan. Silakan coba lagi.',
                        });
                    }
                });
            });
        });
    </script>

    <!-- Alert Email Unduh PDF -->
    <!-- <script>
        $(document).on('click', '.alertemail', async function(e) {
            e.preventDefault();
            const {
                value: email
            } = await Swal.fire({
                title: "Masukkan Email Anda",
                input: "email_pengunjung",
                inputPlaceholder: "Ketikkan Email Anda Disini",
                text: "Dokumen yang Anda inginkan akan dikirim melalui Alamat Email yang telah dimasukan pada form dibawah. Harap memasukkan alamat email dengan benar! ",
                showCloseButton: true,
                confirmButtonColor: "#28527A",
                confirmButtonText: "Kirim",
                customClass: {
                    input: 'swal-input-yellow',
                    confirmButton: 'swal-confirm-button',
                }
            });
            if (email) {
                Swal.fire({
                    html: '<img src="<?= base_url('assets/img/like.gif') ?>" style="width: 200px;">' +
                        '<p style="margin-top: 20px;">Dokumen berhasil dikirim ke Email, silahkan cek Email Anda.</p>',
                    showConfirmButton: false,
                    showCloseButton: true,
                });
            }
        });
    </script> -->

    <!-- Alert Footer -->
    <script>
        $("#alertkontak2").click(function(e) {
            e.preventDefault();

            // Memeriksa apakah semua field telah terisi
            var nama_feedback = $(".nama_feedback").val();
            var email_feedback = $(".email_feedback").val();
            var telepon = $(".no_telepon_feedback").val();
            var subjek = $(".subjek").val();
            var pesan = $(".pesan").val();

            // Array untuk menyimpan field-field yang belum diisi
            var fieldsKosong = [];

            // Memeriksa setiap field apakah kosong, dan menambahkannya ke array fieldsKosong
            if (nama_feedback === "") {
                fieldsKosong.push("Nama");
            }
            if (email_feedback === "") {
                fieldsKosong.push("Email");
            }
            if (telepon === "") {
                fieldsKosong.push("Nomor Telepon");
            }
            if (subjek === "") {
                fieldsKosong.push("Subjek");
            }
            if (pesan === "") {
                fieldsKosong.push("Isi Pesan");
            }

            // Jika ada field yang belum terisi, tampilkan pesan peringatan
            if (fieldsKosong.length > 0) {
                var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " belum diisi. Mohon lengkapi semuanya";
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: pesanPeringatan,
                });
                return; // Keluar dari fungsi jika ada field yang kosong
            }

            // Jika semua field telah terisi, tampilkan alert dan kirim formulir
            Swal.fire({
                html: '<img src="<?= base_url('assets/img/like.gif') ?>" style="width: 200px;">' +
                    '<p style="margin-top: 20px;">Pesan berhasil dikirim, terima kasih atas feedbacknya, akan segera ditanggapi. Mohon bersabar untuk menunggu.</p>',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                willClose: () => {
                    $('form.footer').submit(); // Mengirim formulir setelah menampilkan pesan
                }
            });
        });
    </script>

    <!-- Data Tabel tanpa Search untuk tabel di halaman cek status -->
    <script>
        $('#datatable').DataTable({
            dom: 't' // Hanya menampilkan tabel tanpa search dan pagination
        });
        $('#datatable1').DataTable({
            dom: 't' // Hanya menampilkan tabel tanpa search dan pagination
        });
    </script>

    <!-- Form Permohonan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kategoriPengajuan = document.getElementById('id_kategori');
            const suratKuasaContainer = document.getElementById('surat_kuasa_container');
            const aktaNotarisLembagaContainer = document.getElementById('akta_notaris_lembaga_container');
            const filePendirianLembagaContainer = document.getElementById('file_pendirian_lembaga_container');
            const suratKesbangpolContainer = document.getElementById('surat_kesbangpol_container');

            function toggleFields() {
                const selectedText = kategoriPengajuan.options[kategoriPengajuan.selectedIndex].text;
                if (selectedText === 'Perorangan') {
                    suratKuasaContainer.style.display = 'none';
                    aktaNotarisLembagaContainer.style.display = 'none';
                    filePendirianLembagaContainer.style.display = 'none';
                    suratKesbangpolContainer.style.display = 'none';
                } else if (selectedText === 'Kelompok Orang') {
                    suratKuasaContainer.style.display = 'block';
                    aktaNotarisLembagaContainer.style.display = 'none';
                    filePendirianLembagaContainer.style.display = 'none';
                    suratKesbangpolContainer.style.display = 'none';
                } else {
                    suratKuasaContainer.style.display = 'block';
                    aktaNotarisLembagaContainer.style.display = 'block';
                    filePendirianLembagaContainer.style.display = 'block';
                    suratKesbangpolContainer.style.display = 'block';
                }
            }

            kategoriPengajuan.addEventListener('change', toggleFields);
            toggleFields();

            document.getElementById('alert3').addEventListener('click', function(e) {
                e.preventDefault();

                var kategori = document.getElementById('id_kategori').value;
                var skpd = document.getElementById('id_lembaga').value;
                var nik = document.getElementById('nik').value;
                var nama = document.getElementById('nama_pemohon').value;
                var alamat = document.getElementById('alamat').value;
                var email = document.getElementById('email').value;
                var telp = document.getElementById('no_telepon').value;
                var pekerjaan = document.getElementById('pekerjaan').value;
                var upload = document.getElementById('file_ktp').value;
                var tanggalPengajuan = document.getElementById('tanggal_pengajuan').value;
                var uploadAkta = aktaNotarisLembagaContainer.style.display !== 'none' ? document.getElementById('akta_notaris_lembaga').value : true;
                var uploadKuasa = suratKuasaContainer.style.display !== 'none' ? document.getElementById('surat_kuasa').value : true;
                var uploadPendirian = filePendirianLembagaContainer.style.display !== 'none' ? document.getElementById('file_pendirian_lembaga').value : true;
                var uploadKesbangpol = suratKesbangpolContainer.style.display !== 'none' ? document.getElementById('surat_kesbangpol').value : true;
                var rincian = document.getElementById('rincian_informasi').value;
                var tujuan = document.getElementById('tujuan').value;

                var caraMemperolehInformasi = document.querySelector("input[name='id_memperoleh_informasi']:checked");
                var mendapatkanSalinan = document.querySelector("input[name='id_mendapat_salinan_informasi']:checked");
                var caraMendapatkanSalinan = document.querySelector("input[name='id_cara_mendapat_salinan_informasi']:checked");

                var fieldsKosong = [];
                if (kategori === "") fieldsKosong.push("Kategori");
                if (skpd === "") fieldsKosong.push("SKPD");
                if (nik === "") fieldsKosong.push("NIK");
                if (nama === "") fieldsKosong.push("Nama");
                if (alamat === "") fieldsKosong.push("Alamat");
                if (email === "") fieldsKosong.push("Email");
                if (telp === "") fieldsKosong.push("Nomor Telepon");
                if (pekerjaan === "") fieldsKosong.push("Pekerjaan");
                if (upload === "") fieldsKosong.push("Upload Foto KTP");
                if (tanggalPengajuan === "") fieldsKosong.push("Tanggal Pengajuan");
                if (rincian === "") fieldsKosong.push("Rincian Informasi");
                if (tujuan === "") fieldsKosong.push("Tujuan Penggunaan Informasi");

                if (!caraMemperolehInformasi) fieldsKosong.push("Cara Memperoleh Informasi");
                if (!mendapatkanSalinan) fieldsKosong.push("Mendapatkan Salinan Informasi");
                if (!caraMendapatkanSalinan) fieldsKosong.push("Cara Mendapatkan Salinan Informasi");

                if (aktaNotarisLembagaContainer.style.display !== 'none' && !uploadAkta) fieldsKosong.push("Upload Akta Notaris Lembaga / Organisasi");
                if (filePendirianLembagaContainer.style.display !== 'none' && !uploadPendirian) fieldsKosong.push("Upload Surat Pendirian Lembaga / Organisasi");
                if (suratKesbangpolContainer.style.display !== 'none' && !uploadKesbangpol) fieldsKosong.push("Upload Surat KESBANGPOL");
                if (suratKuasaContainer.style.display !== 'none' && !uploadKuasa) fieldsKosong.push("Upload Surat Kuasa");

                if (fieldsKosong.length > 0) {
                    var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " belum diisi. Mohon lengkapi semuanya";
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: pesanPeringatan,
                    });
                } else {
                    Swal.fire({
                        html: '<img src="<?= base_url('assets/img/validation.gif') ?>" style="width: 200px;">' +
                            '<p style="margin-top: 20px;">Formulir Permohonan berhasil diajukan! Mohon cek status permohonan permohonan secara berkala!.</p>',
                        showCloseButton: true,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    }).then(function() {
                        document.getElementById('formpermohonan').submit();
                    });
                }
            });
        });
    </script>

    <!-- preloader script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            var preloader = document.getElementById('preloader');
            var content = document.getElementById('content');

            if (!isChrome) {
                document.getElementsByClassName('infinityChrome')[0].style.display = "none";
                document.getElementsByClassName('infinity')[0].style.display = "block";
            } else {
                document.getElementsByClassName('infinityChrome')[0].style.display = "block";
                document.getElementsByClassName('infinity')[0].style.display = "none";
            }

            // Menampilkan preloader
            preloader.style.display = 'flex'; // atau 'block', sesuai dengan display yang Anda atur

            // Menunda penyembunyian preloader
            setTimeout(function() {
                preloader.style.display = 'none';
                content.style.display = 'block'; // Menampilkan konten utama setelah preloader
            }, 2000); // Menunda penyembunyian preloader selama 3 detik
        });
    </script>
    <!-- end preloader script -->
</body>

</html>
<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-120 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4 mt-5" style="color: #f4d160; font-size: 45px;">INFORMASI PUBLIK</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->

<section class="position-relative laptop-view">
    <div class="container p-5">
        <div class="row text-center">
            <div class="col-md mb-1" data-aos="flip-left" data-aos-delay="100">
                <div class="siger-image">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/informasipublik') ?>" class="text-decoration-none">
                    <div class="card text-light " style="background-color:#28527A; height:90px; top:55px; font-weight: 700;">
                        <div class="card-body text-center fw-bold">
                            <h4>Daftar Informasi</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md mb-1" data-aos="flip-left" data-aos-delay="300">
                <div class="siger-image">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/informasiberkala') ?>" class="text-decoration-none">
                    <div class="card text-light" style="background-color: #f4d160; height:90px; top:55px; font-weight: 700;">
                        <div class="card-body text-center fw-bold" style="color: #28527A;  ">
                            <h4>Informasi Berkala</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md mb-1" data-aos="flip-left" data-aos-delay="500">
                <div class="siger-image">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/informasisertamerta') ?>" class="text-decoration-none">
                    <div class="card text-light" style="background-color: #f4d160; height:90px; top:55px; font-weight: 700;">
                        <div class="card-body text-center fw-bold" style="color: #28527A;  ">
                            <h4>Informasi Serta-Merta</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md mb-1" data-aos="flip-left" data-aos-delay="700">
                <div class="siger-image">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/informasisetiapsaat') ?>" class="text-decoration-none">
                    <div class="card text-light" style="background-color: #f4d160; height:90px; top:55px; font-weight: 700;">
                        <div class="card-body text-center fw-bold" style="color: #28527A;  ">
                            <h4>Informasi Setiap Saat</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md mb-1" data-aos="flip-left" data-aos-delay="900">
                <div class="siger-image">
                    <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px">
                </div>
                <a href="<?= base_url('/informasidikecualikan') ?>" class="text-decoration-none">
                    <div class="card text-light" style="background-color: #f4d160; height:90px; top:55px; font-weight: 700;">
                        <div class="card-body text-center fw-bold" style="color: #28527A;  ">
                            <h4>Informasi Dikecualikan</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <img src="<?= base_url('assets/img/Rectangle 103.png') ?>" alt="" class="lineimg position-absolute start-50 translate-middle-x mb-3" style="max-width: 100%; height: auto; z-index: 2;">
</section>

<!-- Swiper Container -->
<div class="swiper-container mt-3" id="swiper-container">
    <div class="swiper-wrapper">
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/informasipublik') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #28527a; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold">
                        <h4>Daftar Informasi</h4>
                    </div>
                </div>
            </a>
        </div>
        <!-- Add more slides here -->
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/informasiberkala') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
                        <h4>Informasi Berkala</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/informasisertamerta') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
                        <h4>Informasi Serta-Merta</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/informasisetiapsaat') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
                        <h4>Informasi Setiap Saat</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 swiper-slide mb-1">
            <!-- Content for Daftar Informasi -->
            <div class="siger-image">
                <img src="<?= base_url('assets/img/siger.png') ?>" alt="" style="width: 190px" class="img-fluid" />
            </div>
            <a href="<?= base_url('/informasidikecualikan') ?>" class="text-decoration-none">
                <div class="card text-light" style="background-color: #f4d160; height: 90px; top: 55px; font-weight: 700">
                    <div class="card-body text-center fw-bold" style="color: #28527a">
                        <h4>Informasi Dikecualikan</h4>
                    </div>
                </div>
            </a>

        </div>
    </div>
    <img src="<?= base_url('assets/img/Rectangle 103.png') ?>" alt="" class="lineimg position-relative start-50 translate-middle-x mb-3" style="max-width: 100%; height: auto; bottom: -50px;">
    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>

<div class="container pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">

                            <!--Pengurutan nama dinas bedasarkan alfabet-->
                            <?php
                            // Array untuk menyimpan nama-nama dinas yang telah ditampilkan
                            $nama_dinas_sorted = array();

                            // Mengambil semua nama dinas dari data yang diterima
                            foreach ($tb_informasi_publik as $row) {
                                // Memastikan nama_dinas belum ada dalam array sebelumnya
                                if (!in_array($row->nama_dinas, $nama_dinas_sorted)) {
                                    $nama_dinas_sorted[] = $row->nama_dinas;
                                }
                            }

                            // Mengurutkan array nama dinas berdasarkan urutan alfabet
                            sort($nama_dinas_sorted);
                            ?>

                            <div class="col-md-3 pb-3">
                                <select id="select-skpd" class="form-select" aria-label="Default select example" style="border-width: 2px;">
                                    <option selected>--Pilih SKPD--</option>
                                    <?php foreach ($nama_dinas_sorted as $value) : ?>
                                        <option value="<?= $value ?>" <?= old('nama_dinas') == $value ? 'selected' : ''; ?>>
                                            <?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!--End Pengurutan nama dinas bedasarkan alfabet-->



                            <!--Pengurutan tahun dari kecil ke besar-->
                            <?php
                            // Array untuk menyimpan tahun-tahun yang telah ditampilkan
                            $tahun_tampil = array();

                            // Mendapatkan semua tahun dan menyimpannya dalam array
                            foreach ($tahun_informasi_publik as $value) {
                                // Mendapatkan bagian tahun dari tanggal
                                $tahun = date('Y', strtotime($value['tanggal_file']));

                                // Menambahkan tahun ke array jika belum ada
                                if (!in_array($tahun, $tahun_tampil)) {
                                    $tahun_tampil[] = $tahun;
                                }
                            }

                            // Mengurutkan array tahun dari kecil ke besar
                            sort($tahun_tampil);
                            ?>

                            <div class="col-md-3 btn-group pb-3">
                                <select id="select-tahun" class="form-select" aria-label="Default select example" style="border-width: 2px;">
                                    <option selected>--Pilih Tahun--</option>
                                    <?php foreach ($tahun_tampil as $tahun) : ?>
                                        <option value="<?= $tahun ?>" <?= old('tahun') == $tahun ? 'selected' : ''; ?>>
                                            <?= $tahun ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!--End Pengurutan tahun dari kecil ke besar-->

                            <div class="col-md-3 btn-group pb-3">
                                <button type="button" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;" onclick="applyFilter()">Filter</button>
                            </div>
                            <div class="col-md-3 btn-group pb-3">
                                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="clearFilter()">Hapus</button>
                            </div>
                        </div>

                        <div class="container pt-3 pb-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="datatable" class="table pt-3 pb-3 table-bordered dt-responsive w-100" style="border-color: #28527A;">
                                                <thead class="table-bg">
                                                    <tr class="highlight text-center" style="color: white;">
                                                        <th>No</th>
                                                        <th>Informasi</th>
                                                        <th>PPID SKPD/UKPD</th>
                                                        <th>Tahun</th>
                                                        <th>Judul</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($tb_informasi_publik as $row) : ?>
                                                        <tr>
                                                            <td data-field="id_informasi_publik" style="width: 10px" scope="row"><?= $i++; ?></td>
                                                            <td data-field="nama_kategori"><?= $row->nama_kategori; ?></td>
                                                            <td data-field="nama_dinas"><?= $row->nama_dinas; ?></td>
                                                            <td data-field="tanggal_file"><?= date('Y', strtotime($row->tanggal_file)); ?></td>
                                                            <td data-field="judul">
                                                                <?php if ($row->file_informasi_publik) : ?>
                                                                    <a href="<?= base_url("/pdf?pdf=" . urlencode($row->file_informasi_publik)) ?>" style="color:#28527A; text-decoration:none;"><?= $row->judul; ?></a>
                                                                <?php else : ?>
                                                                    <a href="javascript:void(0);" style="color:#F5004F; text-decoration:none;"><?= $row->judul; ?></a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <!-- Button untuk memulai proses download -->
                                                            <td style="color:#28527A;">
                                                                <a href="<?= base_url(); ?>/admin/informasi_publik/downloadFile/<?= $row->id_informasi_publik; ?>" class="download-btn">
                                                                    <i class="fa-solid fa-download" style="color: #28527A; display:flex; justify-content:center; align-items:center; height:100%;"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!-- <script>
                                                            $(document).ready(function() {
                                                                // Inisialisasi DataTable
                                                                if (!$.fn.DataTable.isDataTable('#datatable')) {
                                                                    $('#datatable').DataTable({
                                                                        responsive: true
                                                                    });
                                                                }

                                                                // Gunakan event delegation untuk menangani klik pada tombol unduh
                                                                $(document).on('click', '.alert-email', async function(e) {
                                                                    e.preventDefault();
                                                                    const id_informasi_publik = $(this).data('file');
                                                                    const {
                                                                        value: email_pengunjung
                                                                    } = await Swal.fire({
                                                                        title: "Masukkan Email Anda",
                                                                        input: "email",
                                                                        inputPlaceholder: "Ketikkan Email Anda Disini",
                                                                        text: "Dokumen akan dikirim melalui Alamat Email yang telah dimasukan pada form dibawah. Harap memasukkan alamat email dengan benar! ",
                                                                        showCloseButton: true,
                                                                        confirmButtonColor: "#28527A",
                                                                        confirmButtonText: "Kirim",
                                                                        customClass: {
                                                                            input: 'swal-input-yellow',
                                                                            confirmButton: 'swal-confirm-button',
                                                                        }
                                                                    });

                                                                    if (email_pengunjung) {
                                                                        console.log('Mengirim data:', {
                                                                            email_pengunjung: email_pengunjung,
                                                                            id_informasi_publik: id_informasi_publik
                                                                        });
                                                                        $.post('<?= base_url('/admin/informasi_publik/kirim/' . $row->id_informasi_publik) ?>', {
                                                                            email_pengunjung: email_pengunjung,
                                                                            id_informasi_publik: id_informasi_publik
                                                                        }).done(function(response) {
                                                                            console.log('Respons dari server:', response);
                                                                            Swal.fire({
                                                                                html: '<img src="<?= base_url('assets/img/like.gif') ?>" style="width: 200px;">' +
                                                                                    '<p style="margin-top: 20px;">' + response.message + '</p>',
                                                                                showConfirmButton: false,
                                                                                showCloseButton: true,
                                                                            });
                                                                        }).fail(function(response) {
                                                                            console.error('Kesalahan dari server:', response);
                                                                            Swal.fire({
                                                                                icon: 'error',
                                                                                title: 'Gagal',
                                                                                text: response.responseJSON.error,
                                                                            });
                                                                        });
                                                                    }
                                                                });
                                                            });
                                                        </script> -->



                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div>
                    </div>

                    <div class=" col-lg-4">
                        <div class="card mb-5">
                            <div class="card-body" style="background: rgba(138, 196, 208, 0.20); border-radius:10px;">
                                <h5 class="mb-3 text-center">Kategori PPID</h5>
                                <div class="card1 pt-3 mt-3" style="background:white; border-radius:10px; border: 1px solid rgba(67, 67, 67, 0.50);">
                                    <div class="card-body1">
                                        <ul class="list-unstyled fw-medium px-2">
                                            <li>
                                                <a href="<?= base_url('/informasipublik') ?>" class="text-body pb-3 d-block border-bottom" style="text-decoration: none;">
                                                    Daftar Informasi Publik
                                                    <span class="badge rounded-pill ms-1 float-end font-size-12" style="background-color: #434343; color: white;"><?= $totalKategori ?></span>
                                                </a>
                                            </li>
                                            <?php foreach ($kategoriCounts as $kategori) : ?>
                                                <li>
                                                    <a href="<?= base_url($kategori['link']) ?>" class="text-body py-3 d-block border-bottom" style="text-decoration: none;">
                                                        <?= $kategori['nama_kategori'] ?>
                                                        <span class="badge rounded-pill ms-1 float-end font-size-12" style="background-color: #434343; color: white;">
                                                            <?= $kategori['total'] ?>
                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body" style="background: rgba(138, 196, 208, 0.20); border-radius:10px;">
                                <h5 class="mb-3 text-center">Jenis DIP PPID</h5>
                                <div class="card1 pt-3 mt-3" style="background:white; border-radius:10px; border: 1px solid rgba(67, 67, 67, 0.50);">
                                    <div class="card-body1">
                                        <ul class="list-unstyled fw-medium px-2">
                                            <?php foreach ($jenisCounts as $jenis) : ?>
                                                <li>
                                                    <a href="#" class="text-body py-3 d-block border-bottom" style="text-decoration: none;">
                                                        <?= $jenis['nama_jenis'] ?>
                                                        <span class="badge rounded-pill ms-1 float-end font-size-12" style="background-color: #434343; color: white;">
                                                            <?= $jenis['total'] ?>
                                                        </span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function applyFilter() {
        var table = document.getElementById("datatable"); // Ambil referensi tabel
        var skpd = document.getElementById("select-skpd").value;
        var tahun = document.getElementById("select-tahun").value;

        // Loop melalui setiap baris dalam tabel
        var tableRows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        for (var i = 0; i < tableRows.length; i++) {
            var row = tableRows[i];

            // Ambil nilai kolom SKPD dan tahun dari setiap baris
            var skpdCell = row.getElementsByTagName("td")[2]; // Indeks kolom SKPD
            var tahunCell = row.getElementsByTagName("td")[3]; // Indeks kolom tahun

            // Periksa apakah nilai kolom SKPD dan tahun sesuai dengan filter yang dipilih
            if ((skpd === "--Pilih SKPD--" || skpdCell.textContent.trim() === skpd) &&
                (tahun === "--Pilih Tahun--" || tahunCell.textContent.trim() === tahun)) {
                // Tampilkan baris jika sesuai dengan filter
                row.style.display = "";
            } else {
                // Sembunyikan baris jika tidak sesuai dengan filter
                row.style.display = "none";
            }
        }
    }

    function clearFilter() {
        // Hapus nilai yang dipilih dari dropdown SKPD dan tahun
        document.getElementById("select-skpd").selectedIndex = 0;
        document.getElementById("select-tahun").selectedIndex = 0;

        var table = document.getElementById("datatable"); // Ambil referensi tabel
        var tableRows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        // Tampilkan kembali semua baris tabel
        for (var i = 0; i < tableRows.length; i++) {
            tableRows[i].style.display = "";
        }
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    $(document).on('click', '.alert-email', async function(e) {
        e.preventDefault();
        const fileId = $(this).data('file-id');

        const {
            value: email
        } = await Swal.fire({
            title: "Masukkan Email Anda",
            input: "email",
            inputPlaceholder: "Ketikkan Email Anda Disini",
            text: "Dokumen yang Anda inginkan akan dikirim melalui Alamat Email yang telah dimasukkan pada form dibawah. Harap memasukkan alamat email dengan benar!",
            showCloseButton: true,
            confirmButtonColor: "#28527A",
            confirmButtonText: "Kirim",
            customClass: {
                input: 'swal-input-yellow',
                confirmButton: 'swal-confirm-button',
            }
        });

        if (email) {
            $.ajax({
                url: "<?= base_url('admin/informasi_publik/download') ?>",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    email: email,
                    fileId: fileId
                }),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            html: '<img src="<?= base_url('assets/img/like.gif') ?>" style="width: 200px;">' +
                                '<p style="margin-top: 20px;">Dokumen berhasil dikirim ke Email, silahkan cek Email Anda.</p>',
                            showConfirmButton: false,
                            showCloseButton: true,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengunduh file. Silakan coba lagi.',
                    });
                }
            });
        }
    });
</script> -->
<?= $this->endSection(''); ?>
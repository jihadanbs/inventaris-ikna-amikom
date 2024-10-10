<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- hero Start -->
<section class="hero2">
    <div class="hero_overlay"></div>
    <img src="<?= base_url('assets/img/bg.png') ?>" alt="" class="heroimg2">
    <div class="hero_content2 h-100 container-custom position-relative align-items-center">
        <div class="d-flex h-120 align-items-center hero_content-width2">
            <div class="text-center">
                <h1 class="hero_heading fw-bold mb-4 mt-5" style="color: #f4d160; font-size: 45px;">LAPORAN</h1>
                <p class="lead mb-4 fw-bold" style="color: white; font-size: 20px;">Pejabat Pengelola Informasi Dan Dokumentasi (PPID) Kabupaten Pesawaran</p>
            </div>
        </div>
    </div>
</section>
<!-- hero end -->


<div class="container pt-5 pb-5">
    <div class="row">

        <?php
        // Array untuk menyimpan tahun-tahun yang telah ditampilkan
        $tahun_tampil = array();

        // Mendapatkan semua tahun dan menyimpannya dalam array
        foreach ($tahun_laporan as $value) {
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

        <div class="col-md-3 pb-3">
            <select id="select-tahun" class="form-select" aria-label="Default select example" style="border-width: 2px;">
                <option selected>--Pilih Tahun--</option>
                <?php foreach ($tahun_tampil as $tahun) : ?>
                    <option value="<?= $tahun ?>" <?= old('tahun') == $tahun ? 'selected' : ''; ?>>
                        <?= $tahun ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3 btn-group pb-3">
            <button type="button" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;" onclick="applyFilter()">Filter</button>
        </div>
        <div class="col-md-3 btn-group pb-3">
            <button type="button" class="btn btn-danger waves-effect waves-light" onclick="clearFilter()">Hapus</button>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table pt-3 pb-3 table-bordered dt-responsive w-100" style="border-color: #28527A;">
                    <thead class="table-bg">
                        <tr class="highlight text-center" style="color: white;">
                            <th>No</th>
                            <th>Nama Laporan</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tb_laporan as $row) : ?>
                            <tr>
                                <td data-field="id_laporan" style="max-width: 5px" scope="row"><?= $i++; ?></td>
                                <td data-field="judul_laporan">
                                    <?php if ($row['file_laporan']) : ?>
                                        <a href="<?= base_url("/pdf?pdf=" . urlencode(base_url($row['file_laporan']))) ?>" style="color:#28527A; text-decoration:none;">
                                            <?= $row['judul_laporan']; ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="javascript:void(0);" style="color:#F5004F; text-decoration:none;"><?= $row['judul_laporan']; ?></a>
                                    <?php endif; ?>
                                </td>
                                <td data-field="tanggal_file"><?= date('Y', strtotime($row['tanggal_file'])); ?></td>
                                <td style="color:#28527A;">
                                    <a href="<?= base_url(); ?>/admin/laporan/downloadFile/<?= $row['id_laporan']; ?>" class="download-btn">
                                        <i class="fa-solid fa-download" style="color: #28527A; display:flex; justify-content:center; align-items:center; height:100%;"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
</div>

<script>
    function applyFilter() {
        var table = document.getElementById("datatable"); // Ambil referensi tabel
        var tahun = document.getElementById("select-tahun").value;

        // Loop melalui setiap baris dalam tabel
        var tableRows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        for (var i = 0; i < tableRows.length; i++) {
            var row = tableRows[i];

            // Ambil nilai kolom tahun dari setiap baris
            var tahunCell = row.getElementsByTagName("td")[2]; // Indeks kolom tahun

            // Periksa apakah nilai kolom tahun sesuai dengan filter yang dipilih
            if (tahun === "--Pilih Tahun--" || tahunCell.textContent.trim() === tahun) {
                // Tampilkan baris jika sesuai dengan filter
                row.style.display = "";
            } else {
                // Sembunyikan baris jika tidak sesuai dengan filter
                row.style.display = "none";
            }
        }
    }

    function clearFilter() {
        // Hapus nilai yang dipilih dari dropdown tahun
        document.getElementById("select-tahun").selectedIndex = 0;

        var table = document.getElementById("datatable"); // Ambil referensi tabel
        var tableRows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        // Tampilkan kembali semua baris tabel
        for (var i = 0; i < tableRows.length; i++) {
            tableRows[i].style.display = "";
        }
    }
</script>


<?= $this->endSection(''); ?>
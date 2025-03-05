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
                        <h4 class="mb-sm-0 font-size-18">Formulir Peminjaman Barang Dikembalikan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= site_url('admin/transaksi') ?>">Data Transaksi</a></li>
                                <li class="breadcrumb-item"><a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($tb_peminjaman[0]['nama_lengkap'])), 'attr') ?>">Formulir Cek Data Transaksi</a></li>
                                <li class="breadcrumb-item active">Formulir Peminjaman Barang Dikembalikan</li>
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
                            <h2 class="text-center mb-4">FORMULIR PEMINJAMAN BARANG "DIKEMBALIKAN"</h2>
                            <?= $this->include('alert/alert'); ?>
                            <form action="<?= esc(site_url('admin/transaksi/proses_dikembalikan/' . urlencode($tb_peminjaman[0]['id_peminjaman'])), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id_barang" value="<?= esc($tb_peminjaman[0]['id_barang'], 'attr'); ?>">
                                <input type="hidden" name="slug" value="<?= esc($tb_peminjaman[0]['slug'], 'attr'); ?>">
                                <input type="hidden" name="nama_lengkap" value="<?= esc($tb_peminjaman[0]['nama_lengkap'], 'attr'); ?>">
                                <input type="hidden" name="total_dipinjam" value="<?= esc($tb_peminjaman[0]['total_dipinjam'], 'attr'); ?>">
                                <input type="hidden" name="id_peminjaman" value="<?= esc($tb_peminjaman[0]['id_peminjaman'], 'attr'); ?>">
                                <input type="hidden" name="tanggal_dipinjamkan" value="<?= esc($tb_peminjaman[0]['tanggal_dipinjamkan'], 'attr'); ?>">
                                <input type="hidden" name="tanggal_perkiraan_dikembalikan" value="<?= esc($tb_peminjaman[0]['tanggal_perkiraan_dikembalikan'], 'attr'); ?>">
                                <input type="hidden" name="kategori_list" value="<?= esc($tb_peminjaman[0]['kategori_list'] ?? '', 'attr'); ?>">
                                <input type="hidden" name="total_jenis_barang" value="<?= esc($tb_peminjaman[0]['total_jenis_barang'] ?? 0, 'attr'); ?>">
                                <input type="hidden" name="kode_peminjaman" value="<?= esc($tb_peminjaman[0]['kode_peminjaman'], 'attr'); ?>">

                                <label class="col-form-label" style="font-size: 25px;">A. Data Peminjam</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_lengkap" class="col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : ''; ?>" id="nama_lengkap" style="background-color: white;" placeholder="Masukkan Nama Barang" name="nama_lengkap" value="<?= esc(old('nama_lengkap', $tb_peminjaman[0]['nama_lengkap']), 'attr'); ?>" autocomplete="off" readonly>

                                            <?php if (session('errors.nama_lengkap')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_lengkap') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama_barang" class="col-form-label">Nama Barang<span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.nama_barang') ? 'is-invalid' : ''; ?>" id="nama_barang" style="background-color: white;" placeholder="Masukkan Nama Barang" name="nama_barang" value="<?= esc(old('nama_barang', $tb_peminjaman[0]['barang_list']), 'attr'); ?>" autocomplete="off" readonly>

                                            <?php if (session('errors.nama_barang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_barang') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="total_jenis_barang" class="col-form-label">Total Jenis Barang</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="total_jenis_barang" style="background-color: white;" value="<?= esc($tb_peminjaman[0]['total_jenis_barang'] ?? 0, 'attr'); ?> Jenis Barang" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kategori_list" class="col-form-label">Daftar Kategori</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="kategori_list" style="background-color: white;" value="<?= esc($tb_peminjaman[0]['kategori_list'] ?? '-', 'attr'); ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="id_kondisi_barang" class="col-form-label">Kondisi Barang<span class="text-danger">*</span></label>
                                    <select class="form-select custom-border <?= ($validation->hasError('id_kondisi_barang')) ? 'is-invalid' : ''; ?>" id="id_kondisi_barang" name="id_kondisi_barang" aria-label="Default select example" style="background-color: white;" required disabled>
                                        <option value="" selected disabled>~ Silahkan Pilih Nama Kondisi Barang ~</option>
                                        <?php foreach ($tb_kondisi_barang as $value) : ?>
                                            <?php $selected = ($value['id_kondisi_barang'] == old('id_kondisi_barang', $tb_peminjaman[0]['id_kondisi_barang'])) ? 'selected' : ''; ?>
                                            <option value="<?= $value['id_kondisi_barang'] ?>" <?= $selected ?>><?= $value['nama_kondisi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kepentingan" class="col-form-label">Kepentingan<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.kepentingan') ? 'is-invalid' : ''; ?>" id="kepentingan" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan kepentingan" name="kepentingan" autocomplete="off" readonly><?= esc(old('kepentingan', $tb_peminjaman[0]['kepentingan']), 'attr'); ?></textarea>

                                    <?php if (session('errors.kepentingan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.kepentingan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <label class="col-form-label" style="font-size: 25px;">B. Input Data Pengembalian Barang</label>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Total Dipinjam</th>
                                            <th>Barang Kondisi Layak</th>
                                            <th>Barang Kondisi Rusak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tb_peminjaman as $barang): ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="id_barang[]" value="<?= $barang['id_barang'] ?>">
                                                    <?= $barang['nama_barang'] ?>
                                                </td>
                                                <td><?= $barang['total_dipinjam'] ?></td>
                                                <td>
                                                    <input type="number" style="background-color: white;" id="jumlah_baik[]" name="jumlah_baik[]" class="form-control barang-baik" min="0" max="<?= $barang['total_dipinjam'] ?>">
                                                </td>
                                                <td>
                                                    <input type="number" style="background-color: white;" name="jumlah_rusak[]" class="form-control barang-rusak" min="0" max="<?= $barang['total_dipinjam'] ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>Total Keseluruhan:</strong></td>
                                            <td><strong id="total-baik">0</strong></td>
                                            <td><strong id="total-rusak">0</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <!-- autofocus input edit langsung kebelakang kata -->
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        var jumlahTotalBaik = document.getElementById('jumlah_baik[]');

                                        // Fungsi untuk mengatur fokus ke posisi akhir input
                                        function setFocusToEnd(element) {
                                            element.focus();
                                            var val = element.value;
                                            element.value = ''; // kosongkan nilai input
                                            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
                                        }

                                        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
                                        setFocusToEnd(jumlahTotalBaik);
                                    });
                                </script>
                                <!-- end autofocus input edit langsung kebelakang kata -->

                                <div class="mb-3">
                                    <label for="tanggal_dikembalikan" class="col-form-label">Tanggal Dikembalikan Barang<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-border <?= session('errors.tanggal_dikembalikan') ? 'is-invalid' : ''; ?>" name="tanggal_dikembalikan" placeholder="Tanggal Dikembalikan" id="tanggal_dikembalikan" cols="30" rows="10" style="background-color: white;" value="<?= old('tanggal_dikembalikan'); ?>"></input>

                                    <?php if (session('errors.tanggal_dikembalikan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.tanggal_dikembalikan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_dikembalikan" class="col-form-label">Bukti Pengembalian Barang<span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" class="form-control <?= session('errors.bukti_pengembalian') ? 'is-invalid' : ''; ?>" id="bukti_pengembalian" name="bukti_pengembalian" style="background-color: white;" value="<?= old('bukti_pengembalian'); ?>">

                                    <?php if (session('errors.bukti_pengembalian')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.bukti_pengembalian') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan_peminjaman" class="col-form-label">Catatan Untuk Peminjam<span class="text-danger">*</span></label>
                                    <textarea class="form-control custom-border <?= session('errors.catatan_peminjaman') ? 'is-invalid' : ''; ?>" required name="catatan_peminjaman" placeholder="Masukkan Catatan Pengembalian Untuk Peminjam" id="catatan_peminjaman" cols="30" rows="5" style="background-color: white;"><?php echo old('catatan_peminjaman'); ?></textarea>

                                    <?php if (session('errors.catatan_peminjaman')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.catatan_peminjaman') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($tb_peminjaman[0]['kode_peminjaman'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-times"></i> Batal Pengembalian
                                        </a>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data Peminjaman</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('table tbody tr');
        const totalBaikElement = document.getElementById('total-baik');
        const totalRusakElement = document.getElementById('total-rusak');
        const validasiTotalAlert = document.getElementById('validasi-total');

        function validateBarangInputs() {
            let totalDipinjamKeseluruhan = 0;
            let totalBaik = 0;
            let totalRusak = 0;
            let isValid = true;

            // Loop setiap baris untuk mendapatkan total dipinjam keseluruhan
            tableRows.forEach(row => {
                const totalDipinjamCell = row.querySelector('td:nth-child(2)');
                totalDipinjamKeseluruhan += parseInt(totalDipinjamCell.textContent) || 0;
            });

            // Validasi setiap baris
            tableRows.forEach(row => {
                const barangBaikInput = row.querySelector('.barang-baik');
                const barangRusakInput = row.querySelector('.barang-rusak');
                const totalDipinjamCell = row.querySelector('td:nth-child(2)');

                const jumlahBaik = parseInt(barangBaikInput.value) || 0;
                const jumlahRusak = parseInt(barangRusakInput.value) || 0;
                const totalBarangDipinjam = parseInt(totalDipinjamCell.textContent) || 0;

                // Reset status validasi
                barangBaikInput.classList.remove('is-invalid');
                barangRusakInput.classList.remove('is-invalid');

                // Validasi per barang
                if (jumlahBaik + jumlahRusak > totalBarangDipinjam) {
                    barangBaikInput.classList.add('is-invalid');
                    barangRusakInput.classList.add('is-invalid');
                    isValid = false;
                }

                totalBaik += jumlahBaik;
                totalRusak += jumlahRusak;
            });

            // Update total di footer
            totalBaikElement.textContent = totalBaik;
            totalRusakElement.textContent = totalRusak;

            // Validasi total keseluruhan
            if (totalBaik + totalRusak !== totalDipinjamKeseluruhan) {
                validasiTotalAlert.style.display = 'block';
                validasiTotalAlert.textContent = 'Total barang baik dan rusak harus sama dengan total yang dipinjam !';
                isValid = false;
            } else {
                validasiTotalAlert.style.display = 'none';
            }

            return isValid;
        }

        // Tambahkan event listener untuk setiap input
        const barangBaikInputs = document.querySelectorAll('.barang-baik');
        const barangRusakInputs = document.querySelectorAll('.barang-rusak');

        [...barangBaikInputs, ...barangRusakInputs].forEach(input => {
            input.addEventListener('input', validateBarangInputs);
        });

        // Validasi saat form di-submit
        const form = document.getElementById('validationForm');
        form.addEventListener('submit', function(event) {
            if (!validateBarangInputs()) {
                event.preventDefault();
            }
        });

        // Jalankan validasi awal
        validateBarangInputs();
    });
</script>
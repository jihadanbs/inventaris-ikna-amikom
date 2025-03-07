<?= $this->include('admin/layouts/script') ?>

<style>
    .signature-container {
        position: relative;
        width: 75%;
        margin: 0 auto 15px auto;
    }

    .signature-pad-wrapper {
        position: relative;
        width: 100%;
        height: 100px;
        border: 1px solid #e0e0e0;
        background-color: #fff;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .signature-pad {
        width: 100%;
        height: 100%;
    }

    .signature-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .signature-buttons button {
        padding: 3px 8px;
        font-size: 12px;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        body {
            font-size: 12pt;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }

        .page-break {
            page-break-after: always;
        }

        .print-only {
            display: block !important;
        }

        .signature-pad-wrapper {
            border: none !important;
        }

        .signature-buttons {
            display: none !important;
        }

        .signature-image {
            display: block !important;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }

        .signature-section {
            display: block;
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-section .row {
            display: flex;
            flex-wrap: nowrap;
            width: 100%;
        }

        .signature-section .col-6 {
            width: 50%;
            float: left;
            padding: 0 15px;
            box-sizing: border-box;
        }

        .table-responsive {
            overflow: visible !important;
        }

        .table {
            width: 100% !important;
        }

        .col-md-6 {
            width: 50% !important;
            float: left !important;
            display: block !important;
        }

        .row {
            display: flex !important;
            flex-wrap: wrap !important;
            width: 100% !important;
        }

        img.img-fluid {
            max-width: 130px !important;
        }

        .col-md-9 .row .col-md-6 {
            padding: 0 10px !important;
            margin-bottom: 10px !important;
        }

        .col-md-9 .row {
            display: flex !important;
            flex-wrap: wrap !important;
        }
    }

    @media screen {
        .col-md-6 {
            margin-bottom: 10px;
        }
    }

    .print-only {
        display: none;
    }

    .print-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .print-options {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    /* @page {
        size: portrait;
    } */

    .signature-section .col-6 {
        width: 50%;
        min-width: 200px;
    }
</style>

<div class="col-md-12">
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cetak Transaksi</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= site_url('admin/transaksi') ?>">Data Transaksi</a></li>
                                    <li class="breadcrumb-item"><a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($peminjaman['kode_peminjaman'])), 'attr') ?>">Formulir Cek Data Transaksi</a></li>
                                    <li class="breadcrumb-item active">Formulir Cetak Transaksi</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card print-options no-print">
                    <div class="card-body">
                        <h5 class="card-title">Opsi Cetak</h5>
                        <form id="printOptions">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="printHeader" checked>
                                        <label class="form-check-label" for="printHeader">
                                            Informasi Header
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="printDetailInfo" checked>
                                        <label class="form-check-label" for="printDetailInfo">
                                            Detail Informasi Transaksi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="printDokumen" checked>
                                        <label class="form-check-label" for="printDokumen">
                                            Dokumentasi Berkas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="printBarang" checked>
                                        <label class="form-check-label" for="printBarang">
                                            Daftar Barang
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="printLimitItem">
                                        <label class="form-check-label" for="printLimitItem">
                                            Batasi jumlah barang (maksimal 4)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= esc(site_url('admin/transaksi/cek_data/' . urlencode($peminjaman['kode_peminjaman'])), 'attr') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="button" class="btn btn-primary" onclick="printPage()">
                                <i class="fa fa-print"></i> Cetak Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Konten yang akan dicetak -->
                <div class="print-content">
                    <!-- Header -->
                    <div id="headerSection">
                        <div class="print-header">
                            <h3><b>IKNA AMIKOM YOGYAKARTA</b></h3>
                            <h4><b>FORMULIR CETAK TRANSAKSI</b></h4>
                            <?php if (!empty($detail_peminjaman)) : ?>
                                <?php $first_item = $detail_peminjaman[0] ?? []; ?>
                                <div class="bg-info text-white px-3 py-2 mt-2"><?= esc($first_item['kode_peminjaman'] ?? ''); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-md-3 text-center">
                                <img src="<?= base_url('assets/img/ikna.png') ?>" class="img-fluid rounded" style="max-width: 150px;" alt="Logo Ikna">
                            </div>
                            <div class="col-md-9">
                                <div class="row gy-3">
                                    <?php if (!empty($first_item)) : ?>
                                        <div class="col-md-6">
                                            <h6><b>Nama Lengkap</b></h6>
                                            <p><?= esc($first_item['nama_lengkap'] ?? ''); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><b>Nama Barang</b></h6>
                                            <p><?= esc($first_item['barang_list'] ?? ''); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><b>Kategori Barang</b></h6>
                                            <p><?= esc($first_item['kategori_list'] ?? ''); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6><b>Total Barang</b></h6>
                                            <p><?= esc($first_item['total_jenis_barang'] ?? ''); ?> Jenis Barang</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Informasi -->
                    <div id="detailInfoSection">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <?php if (!empty($first_item)) : ?>
                                        <tr>
                                            <td><b>Kondisi</b></td>
                                            <td><?= esc($first_item['nama_kondisi'] ?? ''); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                                <?php if ($first_item['status'] === 'Belum Diproses') : ?>
                                                    <span>Belum Diproses</span>
                                                <?php elseif ($first_item['status'] === 'Ditolak') : ?>
                                                    <span>Ditolak</span>
                                                <?php elseif ($first_item['status'] === 'Dipinjamkan') : ?>
                                                    <span>Dipinjamkan</span>
                                                <?php elseif ($first_item['status'] === 'Dikembalikan') : ?>
                                                    <span>Dikembalikan</span>
                                                <?php else : ?>
                                                    <span>Tidak Diketahui</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Transaksi</b></td>
                                            <td><?= formatTanggalIndo2($first_item['tanggal_pengajuan'] ?? '') ?: 'Belum ada data'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Kepentingan</b></td>
                                            <td><?= $first_item['kepentingan'] ?? 'Belum ada deskripsi'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Dipinjamkan</b></td>
                                            <td><?= formatTanggalIndo2($first_item['tanggal_dipinjamkan'] ?? '') ?: 'Belum ada data'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Perkiraan Dikembalikan</b></td>
                                            <td><?= formatTanggalIndo2($first_item['tanggal_perkiraan_dikembalikan'] ?? '') ?: 'Belum ada data'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Dikembalikan</b></td>
                                            <td><?= formatTanggalIndo2($first_item['tanggal_dikembalikan'] ?? '') ?: 'Belum ada data'; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Catatan Peminjaman</b></td>
                                            <td><?= $first_item['catatan_peminjaman'] ?? '' ?: 'Belum ada catatan'; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Dokumentasi Berkas -->
                    <div id="dokumenSection" class="mt-4">
                        <h5><b>DOKUMENTASI BERKAS</b></h5>
                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">NO</th>
                                    <th>DOKUMENTASI BERKAS</th>
                                    <th width="100px" class="no-print">AKSI</th>
                                    <th width="100%" class="print-only">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($detail_peminjaman) && isset($detail_peminjaman[0])) :
                                    $value = $detail_peminjaman[0];
                                    $no = 1;
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>Dokumen Jaminan</td>
                                        <td class="text-center no-print">
                                            <?php if (!empty($value['dokumen_jaminan'])) : ?>
                                                <a href="<?= base_url($value['dokumen_jaminan']) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center print-only">
                                            <?= !empty($value['dokumen_jaminan']) ? 'Valid' : 'Tidak Valid' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>Bukti Pengembalian</td>
                                        <td class="text-center no-print">
                                            <?php if (!empty($value['bukti_pengembalian'])) : ?>
                                                <a href="<?= base_url($value['bukti_pengembalian']) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center print-only">
                                            <?= !empty($value['bukti_pengembalian']) ? 'Valid' : 'Tidak Valid' ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Daftar Barang -->
                    <div id="barangSection" class="mt-4">
                        <h5><b>DAFTAR BARANG YANG DIPINJAM</b></h5>
                        <div class="row">
                            <?php
                            $max_items = count($detail_peminjaman);
                            foreach ($detail_peminjaman as $index => $item) :
                            ?>
                                <div class="col-md-6 mb-4 barang-item" data-index="<?= $index ?>">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $item['nama_barang'] ?></h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="<?= esc(base_url(explode(', ', $item['path_file_foto_barang'] ?? '')[0] ?? ''), 'attr'); ?>"
                                                        class="img-fluid rounded" alt="Foto Barang" style="max-height: 100px;">
                                                </div>
                                                <div class="col-md-8">
                                                    <ul class="list-unstyled">
                                                        <li><strong>Kategori:</strong> <?= $item['nama_kategori'] ?></li>
                                                        <li><strong>Kondisi:</strong> <?= $item['nama_kondisi'] ?></li>
                                                        <li><strong>Jumlah Dipinjam:</strong> <?= $item['total_dipinjam'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Footer Tanda Tangan -->
                    <div class="mt-5 signature-section">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <p>Petugas,</p>
                                    <div class="signature-container">
                                        <div class="signature-pad-wrapper">
                                            <canvas id="signature-pad-petugas" class="signature-pad"></canvas>
                                        </div>
                                        <div class="signature-buttons no-print">
                                            <button type="button" class="btn btn-sm btn-primary save-signature" data-target="petugas">Simpan</button>
                                            <button type="button" class="btn btn-sm btn-secondary clear-signature" data-target="petugas">Hapus</button>
                                        </div>
                                    </div>
                                    <p><b><?= $petugas['nama_lengkap'] ?? $_SESSION['nama_lengkap'] ?? 'Nama Petugas' ?></b></p>
                                    <p style="border-top: 1px solid #000; width: 75%; margin: 0 auto;"></p>
                                    <input type="hidden" name="signature_petugas" id="signature-data-petugas">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <p>Peminjam,</p>
                                    <div class="signature-container">
                                        <div class="signature-pad-wrapper">
                                            <canvas id="signature-pad-penerima" class="signature-pad"></canvas>
                                        </div>
                                        <div class="signature-buttons no-print">
                                            <button type="button" class="btn btn-sm btn-primary save-signature" data-target="penerima">Simpan</button>
                                            <button type="button" class="btn btn-sm btn-secondary clear-signature" data-target="penerima">Hapus</button>
                                        </div>
                                    </div>
                                    <p><b><?= $first_item['nama_lengkap'] ?? 'Nama Peminjam' ?></b></p>
                                    <p style="border-top: 1px solid #000; width: 75%; margin: 0 auto;"></p>
                                    <input type="hidden" name="signature_penerima" id="signature-data-penerima">
                                </div>
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
    function printPage() {
        // Mengatur visibilitas berdasarkan checkbox
        const showHeader = document.getElementById('printHeader').checked;
        const showDetailInfo = document.getElementById('printDetailInfo').checked;
        const showDokumen = document.getElementById('printDokumen').checked;
        const showBarang = document.getElementById('printBarang').checked;
        const limitItems = document.getElementById('printLimitItem').checked;

        // Sembunyikan/tampilkan bagian sesuai pilihan
        document.getElementById('headerSection').style.display = showHeader ? 'block' : 'none';
        document.getElementById('detailInfoSection').style.display = showDetailInfo ? 'block' : 'none';
        document.getElementById('dokumenSection').style.display = showDokumen ? 'block' : 'none';
        document.getElementById('barangSection').style.display = showBarang ? 'block' : 'none';

        // Siapkan gambar tanda tangan sebelum mencetak
        document.querySelectorAll('.signature-pad').forEach(function(canvas) {
            if (canvas.classList.contains('has-signature')) {
                var signatureData = canvas.getAttribute('data-signature');
                if (signatureData) {
                    // Buat element image untuk menampilkan tanda tangan saat cetak
                    var imgId = 'print-' + canvas.id;
                    var img = document.getElementById(imgId);

                    // Jika belum ada elemen gambar, buat baru
                    if (!img) {
                        img = document.createElement('img');
                        img.id = imgId;
                        img.className = 'signature-image print-only';
                        img.alt = 'Tanda Tangan';
                        // Tambahkan gambar setelah canvas
                        canvas.parentNode.insertBefore(img, canvas.nextSibling);
                    }

                    // Atur source gambar ke data tanda tangan
                    img.src = signatureData;

                    // Sembunyikan canvas dan tampilkan gambar
                    canvas.style.display = 'none';
                    img.style.display = 'block';
                }
            }
        });

        // Batasi jumlah barang jika dipilih
        if (limitItems) {
            const barangItems = document.querySelectorAll('.barang-item');
            barangItems.forEach((item, index) => {
                if (index >= 4) {
                    item.style.display = 'none';
                }
            });
        } else {
            document.querySelectorAll('.barang-item').forEach(item => {
                item.style.display = 'block';
            });
        }

        // Mulai mencetak
        window.print();

        // Kembalikan tampilan setelah mencetak
        setTimeout(function() {
            document.querySelectorAll('.signature-pad').forEach(function(canvas) {
                canvas.style.display = 'block';
            });
            document.querySelectorAll('.signature-image').forEach(function(img) {
                img.style.display = 'none';
            });
        }, 1000);
    }

    // Fungsi untuk inisialisasi SignaturePad
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi SignaturePad untuk petugas
        var canvasPetugas = document.getElementById('signature-pad-petugas');
        var signaturePadPetugas = new SignaturePad(canvasPetugas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'black'
        });

        // Inisialisasi SignaturePad untuk penerima
        var canvasPenerima = document.getElementById('signature-pad-penerima');
        var signaturePadPenerima = new SignaturePad(canvasPenerima, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'black'
        });

        // Hapus label teks default yang tidak diinginkan
        document.querySelectorAll('.signature-pad-wrapper .signature-image').forEach(function(elem) {
            if (elem) {
                elem.remove();
            }
        });

        // Fungsi untuk menyimpan tanda tangan
        document.querySelectorAll('.save-signature').forEach(function(button) {
            button.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var signaturePad = target === 'petugas' ? signaturePadPetugas : signaturePadPenerima;

                if (signaturePad.isEmpty()) {
                    Swal.fire({
                        title: 'Peringatan',
                        text: 'Silakan buat tanda tangan terlebih dahulu',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Ambil data tanda tangan sebagai base64 image
                var signatureData = signaturePad.toDataURL();
                document.getElementById('signature-data-' + target).value = signatureData;

                // Tandai canvas dengan kelas untuk dikenali saat print
                var canvas = document.getElementById('signature-pad-' + target);
                canvas.classList.add('has-signature');
                canvas.setAttribute('data-signature', signatureData);

                // Buat atau perbarui elemen gambar untuk mencetak
                // Pastikan elemen ini HANYA tampil saat mencetak
                var imgId = 'print-' + canvas.id;
                var img = document.getElementById(imgId);
                if (!img) {
                    img = document.createElement('img');
                    img.id = imgId;
                    img.className = 'signature-image print-only';
                    img.alt = 'Tanda Tangan';
                    img.style.display = 'none'; // Pastikan tidak tampil di UI normal
                    // Tambahkan gambar setelah canvas
                    canvas.parentNode.insertBefore(img, canvas.nextSibling);
                }
                img.src = signatureData;

                // Gunakan SweetAlert untuk notifikasi
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Tanda tangan berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        });

        // Fungsi untuk menghapus tanda tangan
        document.querySelectorAll('.clear-signature').forEach(function(button) {
            button.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var signaturePad = target === 'petugas' ? signaturePadPetugas : signaturePadPenerima;
                signaturePad.clear();

                // Hapus data tanda tangan yang tersimpan
                document.getElementById('signature-data-' + target).value = '';

                // Hapus kelas penanda tanda tangan
                var canvas = document.getElementById('signature-pad-' + target);
                canvas.classList.remove('has-signature');
                canvas.removeAttribute('data-signature');

                // Hapus gambar tanda tangan jika ada
                var imgId = 'print-' + canvas.id;
                var img = document.getElementById(imgId);
                if (img) {
                    img.parentNode.removeChild(img); // Hapus elemen img sepenuhnya
                }

                // Gunakan SweetAlert untuk notifikasi
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Tanda tangan berhasil dihapus',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            });
        });

        // Tambahkan CSS untuk memastikan elemen print-only hanya tampil saat mencetak
        var style = document.createElement('style');
        style.textContent = `
        .print-only {
            display: none !important;
        }
        @media print {
            .print-only {
                display: block !important;
            }
            .no-print {
                display: none !important;
            }
        }
    `;
        document.head.appendChild(style);

        // Fungsi untuk menyesuaikan ukuran canvas saat resize
        function resizeCanvas() {
            var canvasList = document.querySelectorAll('.signature-pad');
            canvasList.forEach(function(canvas) {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);

                // Jika ada tanda tangan yang tersimpan, tampilkan kembali
                if (canvas.classList.contains('has-signature')) {
                    var signatureData = canvas.getAttribute('data-signature');
                    if (signatureData) {
                        // Buat image sementara untuk memuat kembali tanda tangan
                        var img = new Image();
                        img.onload = function() {
                            canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        img.src = signatureData;
                    }
                }
            });
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // Hapus label teks default saat halaman dimuat
        window.addEventListener('load', function() {
            document.querySelectorAll('.signature-image').forEach(function(elem) {
                if (elem && !elem.classList.contains('print-only')) {
                    elem.remove();
                }
            });
        });
    });
</script>

</body>
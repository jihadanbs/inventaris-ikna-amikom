<?= $this->include('layouts/template') ?>

<body class="sub_page">
    <div class="hero_area">
        <?= $this->include('layouts/navbar') ?>
    </div>

    <!-- about section -->
    <section class="barang_section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="fw-bold text-center">Cek Status Barang</h2>
                </div>
                <div class="col-12 mt-2">
                    <div class="input-group mb-3">
                        <form action="<?= site_url('/cek-resi'); ?>" method="post" id="formCekResi" class="w-100">
                            <input name="kode_peminjaman" maxlength="16" placeholder="Masukan Kode Peminjaman Anda" type="text" class="form-control border border-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" style="height: 50px;" autocomplete="off">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn-cek-barang btn btn-primary">Cek</button>
                    </form>
                    <button type="button" class="btn-cek-barang btn btn-danger mt-lg-0 mt-2" id="btnReset">Reset</button>
                </div>
            </div>
            <div class="row d-flex align-item-center">
                <?= $this->include('alert/frontalert'); ?>
            </div>
            <?php if (isset($searched) && $searched): ?>
                <div class="row my-4" id="resultTable">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>Detail Data Barang</h2>
                            <div>
                                <button id="btnExportExcel" class="btn btn-success me-2">
                                    <i class="fas fa-file-excel"></i> Ekspor ke Excel
                                </button>
                                <button id="btnExportPDF" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> Ekspor ke PDF
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Total Barang</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($result) && is_array($result)): ?>
                                    <?php foreach ($result as $item): ?>
                                        <tr>
                                            <td><?= !empty($item['nama_lengkap']) ? esc($item['nama_lengkap']) : '' ?></td>
                                            <td><?= !empty($item['nama_barang']) ? esc($item['nama_barang']) : '' ?></td>
                                            <td><?= !empty($item['nama_kategori']) ? esc($item['nama_kategori']) : '' ?></td>
                                            <td><?= !empty($item['tanggal_pengajuan']) ? esc(formatTanggalIndo($item['tanggal_pengajuan'])) : 'Data Tidak Ditemukan !' ?></td>
                                            <td><?= !empty($item['total_dipinjam']) ? esc($item['total_dipinjam']) . ' Unit' : '' ?></td>
                                            <td><?= !empty($item['status']) ? esc($item['status']) : '' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data Tidak Ditemukan !</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <div class="footer_bg">
        <?= $this->include('layouts/info') ?>
        <?= $this->include('layouts/footer') ?>
    </div>
    <?= $this->include('layouts/script') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

    <script>
        // Ekspor ke Excel
        document.getElementById('btnExportExcel').addEventListener('click', function() {
            exportTableToExcel('resultTable', 'Data_Barang');
        });

        function exportTableToExcel(tableID, filename = '') {
            // Pastikan tabel ada
            var table = document.getElementById(tableID);
            if (!table) {
                console.error('Tabel tidak ditemukan');
                return;
            }

            // Ambil semua baris dari tabel
            var rows = table.querySelectorAll('table tr');
            if (rows.length === 0) {
                alert('Tidak ada data untuk diekspor!');
                return;
            }

            // Persiapkan array data untuk workbook
            var data = [];

            // Tambahkan judul laporan
            data.push(['DETAIL DATA BARANG']);
            data.push(['Tanggal Ekspor: ' + new Date().toLocaleString('id-ID')]);
            data.push([]); // Baris kosong

            // Proses setiap baris tabel
            rows.forEach(function(row) {
                var rowData = [];
                row.querySelectorAll('th, td').forEach(function(cell) {
                    rowData.push(cell.innerText.trim());
                });

                // Hanya tambahkan baris yang memiliki data
                if (rowData.some(cell => cell !== '')) {
                    data.push(rowData);
                }
            });

            // Buat workbook baru
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet(data);

            // Atur lebar kolom
            var wscols = [{
                    wch: 20
                }, // Nama Lengkap
                {
                    wch: 20
                }, // Nama Barang
                {
                    wch: 15
                }, // Kategori
                {
                    wch: 20
                }, // Tanggal Transaksi
                {
                    wch: 15
                }, // Total Barang
                {
                    wch: 15
                } // Status
            ];
            ws['!cols'] = wscols;

            // Tambahkan worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Data Barang');

            // Buat nama file dengan tanggal dan waktu
            if (!filename) {
                filename = 'Data_Barang';
            }
            filename += '_' + new Date().toISOString().replace(/[:\-T]/g, '').slice(0, 14);

            // Ekspor file Excel
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        // Ekspor ke PDF
        document.getElementById('btnExportPDF').addEventListener('click', function() {
            exportTableToPDF('resultTable', 'Data_Barang');
        });

        function exportTableToPDF(tableID, filename = '') {
            // Pastikan tabel ada
            var table = document.getElementById(tableID);
            if (!table || !table.querySelector('table')) {
                console.error('Tabel tidak ditemukan');
                return;
            }

            // Ambil header dari tabel
            var headers = [];
            table.querySelectorAll('table thead th').forEach(function(th) {
                headers.push(th.innerText.trim());
            });

            // Ambil data dari tabel
            var data = [];
            table.querySelectorAll('table tbody tr').forEach(function(tr) {
                var row = [];
                tr.querySelectorAll('td').forEach(function(td) {
                    row.push(td.innerText.trim());
                });
                if (row.length > 0) {
                    data.push(row);
                }
            });

            // Jika tidak ada data, tampilkan pesan
            if (data.length === 0) {
                alert('Tidak ada data untuk diekspor!');
                return;
            }

            // Buat objek jsPDF
            const {
                jsPDF
            } = window.jspdf;
            var doc = new jsPDF('l', 'mm', 'a4'); // landscape orientation

            // Dapatkan lebar halaman
            var pageWidth = doc.internal.pageSize.getWidth();
            var pageHeight = doc.internal.pageSize.getHeight();

            // Tambahkan judul
            doc.setFontSize(16);
            doc.setFont('helvetica', 'bold');
            doc.text('DETAIL DATA BARANG', pageWidth / 2, 15, {
                align: 'center'
            });

            // Tambahkan tanggal ekspor
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            var tanggalEkspor = 'Tanggal Ekspor: ' + new Date().toLocaleString('id-ID');
            doc.text(tanggalEkspor, pageWidth / 2, 22, {
                align: 'center'
            });

            // Hitung lebar total tabel berdasarkan lebar kolom
            var columnWidths = [40, 40, 30, 30, 25, 25]; // Lebar kolom dalam mm
            var tableWidth = columnWidths.reduce((a, b) => a + b, 0);

            // Hitung margin kiri untuk membuat tabel berada di tengah
            var leftMargin = (pageWidth - tableWidth) / 2;

            // Pastikan margin kiri tidak negatif
            leftMargin = Math.max(leftMargin, 10); // Minimal margin 10mm

            // Tambahkan tabel menggunakan autoTable
            doc.autoTable({
                head: [headers],
                body: data,
                startY: 30,
                theme: 'grid',
                headStyles: {
                    fillColor: [66, 66, 66],
                    textColor: 255,
                    fontStyle: 'bold',
                    halign: 'center', // Center align header text
                    valign: 'middle'
                },
                styles: {
                    fontSize: 9,
                    cellPadding: 3,
                    overflow: 'linebreak',
                    halign: 'left'
                },
                columnStyles: {
                    0: {
                        cellWidth: columnWidths[0]
                    }, // Nama Lengkap
                    1: {
                        cellWidth: columnWidths[1]
                    }, // Nama Barang
                    2: {
                        cellWidth: columnWidths[2]
                    }, // Kategori
                    3: {
                        cellWidth: columnWidths[3]
                    }, // Tanggal Transaksi
                    4: {
                        cellWidth: columnWidths[4],
                        halign: 'center'
                    }, // Total Barang (center)
                    5: {
                        cellWidth: columnWidths[5],
                        halign: 'center'
                    } // Status (center)
                },
                margin: {
                    left: leftMargin,
                    right: leftMargin
                },
                tableWidth: 'auto'
            });

            // Tambahkan nomor halaman
            var totalPages = doc.internal.pages.length - 1;
            for (var i = 1; i <= totalPages; i++) {
                doc.setPage(i);
                doc.setFontSize(8);
                doc.text('Halaman ' + i + ' dari ' + totalPages, pageWidth - 20, pageHeight - 10);
            }

            // Buat nama file dengan tanggal dan waktu
            if (!filename) {
                filename = 'Data_Barang';
            }
            filename += '_' + new Date().toISOString().replace(/[:\-T]/g, '').slice(0, 14);

            // Simpan file PDF
            doc.save(filename + '.pdf');
        }
    </script>

    <script>
        document.getElementById('btnReset').addEventListener('click', function() {
            // resetinputan 
            document.querySelector('input[name="kode_peminjaman"]').value = '';

            // sembunyikan tabel
            const resultTable = document.getElementById('resultTable');
            if (resultTable) {
                resultTable.style.display = 'none';
            }
        });
    </script>
</body>
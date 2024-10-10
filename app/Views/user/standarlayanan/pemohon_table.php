<div class="container pt-3 pb-5 table-container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table pt-3 pb-3 table-bordered dt-responsive w-100" style="border-color: #28527A;">
                            <thead class="table-bg">
                                <tr class="highlight text-center" style="color: white;">
                                    <th>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Status</th>
                                    <th>PPID SKPD/UKPD</th>
                                    <th>Kategori Pemohon</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Diproses</th>
                                    <th>Tanggal Diberikan</th>
                                    <th>Tanggal Ditolak</th>
                                    <th>Tujuan</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tb_pemohon)) : ?>
                                    <tr>
                                        <td data-field="id_pemohon" scope="row">1</td>
                                        <td data-field="nama_pemohon"><?= $tb_pemohon->nama_pemohon ?? ''; ?></td>
                                        <td data-field="status">
                                            <?php
                                            $statusClass = '';
                                            if ($tb_pemohon->status ?? '' === 'Belum diproses') {
                                                $statusClass = 'badge me-2" style="background-color: black;';
                                            } elseif ($tb_pemohon->status ?? '' === 'Diproses') {
                                                $statusClass = 'badge me-2" style="background-color: #FD9B63;';
                                            } elseif ($tb_pemohon->status ?? '' === 'Diberikan') {
                                                $statusClass = 'badge me-2" style="background-color: #28527A;';
                                            } elseif ($tb_pemohon->status ?? '' === 'Ditolak') {
                                                $statusClass = 'bg-danger badge me-2';
                                            }
                                            ?>
                                            <span class="<?= $statusClass; ?>"><strong><?= $tb_pemohon->status ?? ''; ?></strong></span>
                                        </td>
                                        <td data-field="nama_dinas"><?= $tb_pemohon->nama_dinas ?? ''; ?></td>
                                        <td data-field="nama_kategori"><?= $tb_pemohon->nama_kategori ?? ''; ?></td>
                                        <td data-field="tanggal_pengajuan"><?= $tb_pemohon->tanggal_pengajuan ?? ''; ?></td>
                                        <td data-field="tanggal_diproses"><?= $tb_pemohon->tanggal_diproses ?? ''; ?></td>
                                        <td data-field="tanggal_diberikan"><?= $tb_pemohon->tanggal_diberikan ?? ''; ?></td>
                                        <td data-field="tanggal_ditolak"><?= $tb_pemohon->tanggal_ditolak ?? ''; ?></td>
                                        <td data-field="tujuan"><?= $tb_pemohon->tujuan ?? ''; ?></td>
                                        <td data-field="catatan"><?= $tb_pemohon->catatan ?? ''; ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
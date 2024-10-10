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
                                    <th>Rentan Waktu</th>
                                    <th>Tujuan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($tb_pemohon as $row) : ?>
                                    <tr>
                                        <td data-field="id_pemohon" scope="row"><?= $i++; ?></td>
                                        <td data-field="nama_pemohon"><?= $row->nama_pemohon; ?></td>
                                        <td data-field="status">
                                            <?php
                                            $statusClass = '';
                                            if ($row->status === 'Belum diproses') {
                                                $statusClass = 'badge me-2" style="background-color: black;';
                                            } elseif ($row->status === 'Diproses') {
                                                $statusClass = 'badge me-2" style="background-color: #FD9B63;';
                                            } elseif ($row->status === 'Diberikan') {
                                                $statusClass = 'badge me-2" style="background-color: #28527A;';
                                            } elseif ($row->status === 'Ditolak') {
                                                $statusClass = 'bg-danger badge me-2';
                                            }
                                            ?>
                                            <span class="<?= $statusClass; ?>"><strong><?= $row->status; ?></strong></span>
                                        </td>
                                        <td data-field="nama_dinas"><?= $row->nama_dinas; ?></td>
                                        <td data-field="nama_kategori"><?= $row->nama_kategori; ?></td>
                                        <td data-field="tanggal_pengajuan"><?= $row->tanggal_pengajuan; ?></td>
                                        <td data-field="tanggal_diproses"><?= $row->tanggal_diproses; ?></td>
                                        <td data-field="tanggal_diberikan"><?= $row->tanggal_diberikan; ?></td>
                                        <td data-field="rentan_waktu"><?= $row->rentan_waktu; ?></td>
                                        <td data-field="tujuan"><?= $row->tujuan; ?></td>
                                        <td data-field="catatan"><?= $row->catatan; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
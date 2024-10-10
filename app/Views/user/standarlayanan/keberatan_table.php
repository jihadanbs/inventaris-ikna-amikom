<div class="container-fluid standarlayanan2 pb-5" style="padding-top: 120px;">
    <div class="container pt-3 pb-5 table-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table pt-3 pb-3 table-bordered dt-responsive w-100" style="border-color: #28527A;">
                                <thead class="table-bg">
                                    <tr class="highlight text-center" style="color: white;">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Ringkasan Kasus</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th>Tanggapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_keberatan as $row) : ?>
                                        <tr>
                                            <td data-field="id_keberatan" scope="row"><?= $i++; ?></td>
                                            <td data-field="nama"><?= $row->nama; ?></td>
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

                                            <td data-field="ringkasan_kasus"><?= $row->ringkasan_kasus; ?></td>
                                            <td data-field="email"><?= $row->email; ?></td>
                                            <td data-field="no_telepon"><?= $row->no_telepon; ?></td>
                                            <td data-field="alamat"><?= $row->alamat; ?></td>
                                            <td data-field="tanggapan"><?= $row->tanggapan; ?></td>
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
</div>
<?= $this->extend('layouts/template2') ?>
<?= $this->section('content') ?>

<style>
    @media (max-width: 403px) {
        .form-check-inline {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-check-inline input[type="radio"] {
            margin-right: 5px;
        }

        .form-check-inline label {
            font-size: 13px;
            white-space: nowrap;
        }
    }
</style>

<div class="container-fluid standarlayanan2 pb-5" style="padding-top: 120px;">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/standarlayanan') ?>" style="text-decoration: none; color:#28527A">Standar Layanan</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page" style="color:black;">Cek Status Formulir</li>
        </ol>
    </nav>
    <div class="container text-center">
        <h1 class="mt-5"><strong>STANDAR LAYANAN </strong></h1>
        <h4>Cek Status Formulir</h4>
    </div>
    <form>
        <div class="row">
            <div class="mb-3 mt-3 text-center">
                <div class="form-check form-check-inline">
                    <input type="radio" name="selectOption" value="1" id="option1" />
                    <label for="option1" class="form-check-label">Permohonan Informasi Publik</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="selectOption" value="2" id="option2" />
                    <label for="option2" class="form-check-label">Permohonan Keberatan Informasi Publik</label>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div id="formContainer">
            <form id="form1" style="display:none; padding-left: 20px; padding-right: 20px;">
                <div class="mb-3 mt-5 text-center">
                    <h5>Permohonan Informasi Publik</h5>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="kode_permohonan" class="form-label">No. Pendaftaran:*</label>
                        <input type="text" class="form-control" id="kode_permohonan" placeholder="" name="kode_permohonan">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-danger me-md-2" type="button">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Tambah</button>
                </div>
            </form>

            <form id="form2" style="display: none; padding-left: 20px; padding-right: 20px;">
                <div class="mb-3 mt-5 text-center">
                    <h5>Permohonan Keberatan Informasi Publik</h5>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="keberatan" class="form-label">Nomor Keberatan:*</label>
                        <input type="text" class="form-control" id="keberatan" placeholder="" name="keberatan">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <button class="btn btn-danger me-md-2" type="button">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Tambah</button>
                </div>
            </form>
        </div>
    </div>


    <div class="container pt-3 pb-5 table-container1">
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
                                        <th>Tanggal Upload</th>
                                        <th>Tanggal Diproses</th>
                                        <th>Tanggal Ditolak</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Tujuan</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($tb_pemohon)) : ?>
                                        <tr>
                                            <td data-field="id_pemohon" scope="row"><?= $tb_pemohon->id_pemohon ?? '' ?></td>
                                            <td data-field="nama_pemohon"><?= $tb_pemohon->nama_pemohon ?? '' ?></td>
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
                                            <td data-field="tanggal_ditolak"><?= $tb_pemohon->tanggal_ditolak ?? ''; ?></td>
                                            <td data-field="tanggal_diberikan"><?= $tb_pemohon->tanggal_diberikan ?? ''; ?></td>
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

    <?php if (!empty($tb_keberatan)) : ?>
        <div class="container pt-3 pb-5 table-container2">
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
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Ringkasan Kasus</th>
                                            <th>Catatan</th>
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

                                                <td data-field="alamat"><?= $row->alamat; ?></td>
                                                <td data-field="email"><?= $row->email; ?></td>
                                                <td data-field="no_telepon"><?= $row->no_telepon; ?></td>
                                                <td data-field="ringkasan_kasus"><?= $row->ringkasan_kasus; ?></td>
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
    <?php endif; ?>

</div>


<?= $this->endSection(''); ?>
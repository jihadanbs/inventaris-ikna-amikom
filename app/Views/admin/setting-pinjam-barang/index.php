<!-- File: app/Views/admin/setting_pinjam/index.php -->
<?= $this->extend('templates/admin/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Pengaturan Peminjaman Barang</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengaturan Peminjaman</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Daftar Pengaturan Peminjaman</h4>
                        <a href="<?= site_url('admin/setting-pinjam/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Pengaturan
                        </a>
                    </div>

                    <?= $this->include('alert/alert'); ?>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Status Tampil</th>
                                    <th>Masa Pinjam (Hari)</th>
                                    <th>Status Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($setting_pinjam as $setting) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $setting['nama_barang']; ?></td>
                                        <td>
                                            <?php if ($setting['is_tampil']) : ?>
                                                <span class="badge badge-success">Ditampilkan</span>
                                            <?php else : ?>
                                                <span class="badge badge-secondary">Tidak Ditampilkan</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $setting['masa_pinjam']; ?> hari</td>
                                        <td>
                                            <?php if ($setting['status'] == 'tersedia') : ?>
                                                <span class="badge badge-success">Tersedia</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">Dipinjam</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('admin/setting-pinjam/edit/' . $setting['id_setting_pinjam']) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= site_url('admin/setting-pinjam/delete/' . $setting['id_setting_pinjam']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaturan ini?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
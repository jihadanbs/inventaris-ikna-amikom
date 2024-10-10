<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk status "Belum Diproses" dan "Diproses" */
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk status "Diberikan" */
    .text-success {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk status "Ditolak" */
    .text-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk kode permohonan */
    .kode-permohonan {
        background-color: #f0f0f0;
        color: #333;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 16px;
        display: inline-block;
    }

    /* CSS untuk readmore */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }


    .read-more-link {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
</style>
<div class="col-md-12">
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
        <?= $this->include('admin/layouts/navbar') ?>
        <?= $this->include('admin/layouts/sidebar') ?>
    </div>
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <?= $this->include('admin/layouts/rightsidebar') ?>
    <?= $this->section('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"> Permohonan Informasi Publik</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">PPID Kab. Pesawaran</h3>
                    </div>

                    <div class="card-body">

                        <?php
                        function getStatusClass($status)
                        {
                            switch ($status) {
                                case 'Diberikan':
                                    return 'text-success';
                                case 'Ditolak':
                                    return 'text-danger';
                                case 'Diproses':
                                    return 'text-warning';
                                default:
                                    return 'text-warning';
                            }
                        }
                        ?>

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                <?= session()->getFlashdata('pesan') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('gagal')) : ?>
                            <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                <?= session()->getFlashdata('gagal') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php
                        function truncateText($text, $maxLength)
                        {
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }
                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Permohonan Informasi Publik</b></h4>
                            <?php if (!empty($pemohon)) : ?>
                                <tr>
                                    <td rowspan="50" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/psw.png') ?>" id="gambar_load" width="150px" height="200">
                                    </td>
                                    <th width="170px">Kategori Pengajuan</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $pemohon->nama_kategori ?? '' ?></strong> </td>
                                </tr>
                                <tr>
                                    <th width="150px">Nama SKPD</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $pemohon->nama_dinas ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">NIK/No. Identitas Pribadi</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $pemohon->nik ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th class="text-center">:</th>
                                    <td><strong><?= $pemohon->nama_pemohon ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th class="text-center">:</th>
                                    <td><?= $pemohon->alamat ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th class="text-center">:</th>
                                    <td><strong><?= $pemohon->email ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <th class="text-center">:</th>
                                    <td><?= $pemohon->no_telepon ?? '' ?></td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <th class="text-center">:</th>
                                    <td><?= $pemohon->pekerjaan ?? '' ?></td>
                                </tr>


                                <tr>
                                    <th>Rincian Informasi</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><?= truncateText($pemohon->rincian_informasi, 50) ?? 'Data tidak ditemukan'; ?>
                                        <?php if (strlen(strip_tags($pemohon->rincian_informasi)) > 50) : ?>
                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($pemohon->rincian_informasi), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tujuan Penggunaan Informasi</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><?= truncateText($pemohon->tujuan, 50) ?? 'Data tidak ditemukan'; ?>
                                        <?php if (strlen(strip_tags($pemohon->tujuan)) > 50) : ?>
                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($pemohon->tujuan), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Cara Memperoleh Informasi</th>
                                    <th class="text-center">:</th>
                                    <td><?= $memperoleh->deskripsi ?? '' ?></td>
                                </tr>

                                <tr>
                                    <th>Mendapat Salinan Informasi</th>
                                    <th class="text-center">:</th>
                                    <td><?= $mendapat->deskripsi ?? '' ?></td>
                                </tr>

                                <tr>
                                    <th>Cara Mendapat Salinan Informasi</th>
                                    <th class="text-center">:</th>
                                    <td><?= $cara_mendapat->deskripsi ?? '' ?></td>
                                </tr>

                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong>
                                            <?= empty($pemohon->tanggal_pengajuan) ? '-' : $pemohon->tanggal_pengajuan ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tanggal Diproses</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong>
                                            <?= empty($pemohon->tanggal_diproses) ? '-' : $pemohon->tanggal_diproses ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tanggal Ditolak</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong>
                                            <?= empty($pemohon->tanggal_ditolak) ? '-' : $pemohon->tanggal_ditolak ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tanggal Diberikan</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong>
                                            <?= empty($pemohon->tanggal_diberikan) ? '-' : $pemohon->tanggal_diberikan ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Kode Permohonan</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="kode-permohonan">
                                            <?= empty($pemohon->kode_permohonan) ? 'Tidak Ada Kode Permohonan' : $pemohon->kode_permohonan ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="<?= getStatusClass($pemohon->status) ?>">
                                            <?= empty($pemohon->status) ? 'Belum Diproses' : $pemohon->status ?>
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Catatan</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><strong><?= truncateText($pemohon->catatan, 50) ?? 'Belum ada catatan lebih lanjut'; ?>
                                            <?php if (strlen(strip_tags($pemohon->catatan)) > 50) : ?>
                                                <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($pemohon->catatan), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                            <?php endif; ?>
                                        </strong>
                                    </td>
                                </tr>

                                <!-- Modal Structure -->
                                <div id="readMoreModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p id="modal-text"></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width=50px>NO</th>
                                    <th>Dokumen</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dokumen as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>File KTP</td>
                                        <td class="text-center">
                                            <?php if ($value->file_ktp) : ?>
                                                <a href="<?= base_url($value->file_ktp) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>File Pendirian Lembaga</td>
                                        <td class="text-center">
                                            <?php if (!empty($value->file_pendirian_lembaga)) : ?>
                                                <a href="<?= base_url($value->file_pendirian_lembaga) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>File Surat Kuasa</td>
                                        <td class="text-center">
                                            <?php if (!empty($value->surat_kuasa)) : ?>
                                                <a href="<?= base_url($value->surat_kuasa) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>File Akta Notaris Lembaga</td>
                                        <td class="text-center">
                                            <?php if (!empty($value->akta_notaris_lembaga)) : ?>
                                                <a href="<?= base_url($value->akta_notaris_lembaga) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center"><?= $no++ ?>.</td>
                                        <td>File Surat KESBANGPOL</td>
                                        <td class="text-center">
                                            <?php if (!empty($value->surat_kesbangpol)) : ?>
                                                <a href="<?= base_url($value->surat_kesbangpol) ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <!-- note -->
                                <small class="form-text text-muted">
                                    <span style="color: red;">Jika kategori (Perorangan) hanya file KTP yang dapat dilihat</span>,
                                    <span style="color: blue;">kategori (Kelompok Orang) hanya file KTP dan Surat Kuasa yang dapat dilihat</span>,
                                    <span style="color: black;">Kategori (Lembaga / Organiasi) dapat dilihat seluruh filenya.
                                </small>

                                <!-- end note -->
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4 d-flex justify-content-between align-items-center">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="/admin/permohonan" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="/admin/permohonan/diproses/<?= $pemohon->id_pemohon ?>" class="btn btn-warning btn-md ml-3 <?= $pemohon->status == 'Diproses' || $pemohon->status == 'Ditolak' || $pemohon->status == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-hourglass-half"></i> Proses
                                </a>
                                <a href="/admin/permohonan/ditolak/<?= $pemohon->id_pemohon ?>" class="btn btn-danger btn-md ml-3 <?= $pemohon->status == 'Belum diproses' || $pemohon->status == 'Ditolak' || $pemohon->status == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-times"></i> Tolak
                                </a>
                                <a href="/admin/permohonan/diberikan/<?= $pemohon->id_pemohon ?>" class="btn btn-success btn-md ml-3 <?= $pemohon->status == 'Belum diproses' || $pemohon->status == 'Ditolak' || $pemohon->status == 'Diberikan' ? 'disabled' : '' ?>">
                                    <i class="fas fa-check"></i> Terima
                                </a>
                            </div>
                            <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $pemohon->id_pemohon ?>">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
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
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("readMoreModal");
        const modalText = document.getElementById("modal-text");
        const closeBtn = document.querySelector(".modal .close");

        document.querySelectorAll(".read-more-link").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const fullText = this.getAttribute("data-text");
                modalText.innerText = fullText;
                modal.style.display = "block";
            });
        });

        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

<!-- hapus -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_pemohon = $(this).data('id');

            Swal.fire({
                title: "Anda Yakin Ingin Menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28527A",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/admin/permohonan/delete2",
                        data: {
                            id_pemohon: id_pemohon
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect ke halaman /admin/permohonan setelah sukses menghapus
                                    window.location.href = '/admin/permohonan';
                                });
                            } else if (response.status === 'error') {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<!-- end hapus -->
</body>

</html>
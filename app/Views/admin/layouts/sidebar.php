<style>
    #side-menu li {
        transition: all 0.3s ease;
    }

    #side-menu li:hover {
        transform: scale(1.1);
        /* Efek scaling saat dihover */
    }

    #side-menu li a {
        transition: all 0.3s ease;
    }

    #side-menu li a:hover {
        background-color: #f8f9fa;
        /* Warna latar belakang saat dihover */
        color: #495057;
        /* Warna teks saat dihover */
    }

    #side-menu li a.active {
        position: relative;
        background-color: white;
        /* Warna latar belakang saat aktif */
        color: #fff;
        /* Warna teks saat aktif */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Efek animasi saat aktif */
        border-top-right-radius: 50px;
        /* Lengkungan sudut kanan atas */
        border-bottom-right-radius: 50px;
        /* Lengkungan sudut kanan bawah */
        overflow: hidden;
    }

    #side-menu li a.active {
        position: relative;
        background-color: white;
        /* Warna latar belakang saat aktif */
        color: #fff;
        /* Warna teks saat aktif */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Efek animasi saat aktif */
        border-top-right-radius: 50px;
        border-top-left-radius: 50px;
        /* Lengkungan sudut kanan atas */
        border-bottom-right-radius: 50px;
        border-bottom-left-radius: 50px;
        /* Lengkungan sudut kanan bawah */
        overflow: hidden;
    }

    #side-menu li a.active::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: white;
        /* Warna latar belakang overlay */
        top: 0;
        left: 0;
        border-bottom-left-radius: 50px;
        /* Lengkungan sudut kiri bawah */
        z-index: -1;
        /* Letakkan di bawah konten utama */
        box-shadow: 5px 5px 0 0 #ccc;
        /* Efek shadow untuk garis */
    }
</style>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="barang">
                        <i data-feather="package"></i>
                        <span data-key="t-dashboard">Barang IKNA</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="refresh-cw"></i>
                        <span data-key="t-components">Aktivitas Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="barang_masuk" data-key="t-apps">Data Barang Masuk</a></li>
                        <li><a href="barang_keluar" data-key="t-apps">Data Barang Keluar</a></li>
                        <li><a href="barang_baru" data-key="t-apps">Data Barang Baru</a></li>
                        <li><a href="barang_bekas" data-key="t-apps">Data Barang Bekas</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="codesandbox"></i>
                        <span data-key="t-components">Kondisi Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="barang_baik" data-key="t-apps">Barang Kondisi Baik</a></li>
                        <li><a href="barang_rusak" data-key="t-apps">Barang Kondisi Rusak</a></li>
                    </ul>
                </li>

                <li>
                    <a href="user_peminjam">
                        <i data-feather="users"></i>
                        <span data-key="t-dashboard">User Peminjam</span>
                    </a>
                </li>

                <li>
                    <a href="peminjaman">
                        <i data-feather="shopping-bag"></i>
                        <span data-key="t-dashboard">Peminjaman</span>
                    </a>
                </li>

                <li>
                    <a href="foto">
                        <i data-feather="user-check"></i>
                        <span data-key="t-dashboard">Anggota IKNA</span>
                    </a>
                </li>

                <li>
                    <a href="foto-pengurus">
                        <i data-feather="user-check"></i>
                        <span data-key="t-dashboard">Anggota IKNA</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="kegiatan">
                        <i data-feather="camera"></i>
                        <span data-key="t-dashboard">Kegiatan IKNA</span>
                    </a>
                </li> -->

                <li>
                <a href="galeri-kegiatan">
                        <i data-feather="camera"></i>
                        <span data-key="t-dashboard">Kegiatan IKNA</span>
                    </a>
                </li>

                <li>
                    <a href="faq">
                        <i data-feather="help-circle"></i>
                        <span data-key="t-dashboard">FAQ</span>
                    </a>
                </li>

                <li>
                    <a href="web_option">
                        <i data-feather="settings"></i>
                        <span data-key="t-dashboard">Web Option</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Data Master</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-components">Master Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="kategori_barang" data-key="t-apps">Kategori Barang</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="user"></i>
                        <span data-key="t-components">Master Anggota</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="kategori_anggota" data-key="t-apps">Kategori Anggota</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="disc"></i>
                        <span data-key="t-components">Master FAQ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="kategori_faq" data-key="t-apps">Kategori FAQ</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<?= $this->renderSection('content'); ?>
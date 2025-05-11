<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigasi</li>
                <?php
                if ($_SESSION['level'] == 'admin' or $_SESSION['level'] == 'Kepala Lapas' or $_SESSION['level'] == 'Kasubag TU') {
                    ?>
                    <li>
                        <a href="?page=dashboard">
                            <i class="fe-airplay"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if ($_SESSION['level'] == 'admin') {
                    ?>
                    <li>
                        <a href="?page=pengguna">
                            <i class="fe-user"></i>
                            <span> Data Pengguna </span>
                        </a>
                    </li>
                    <?php
                }
                ?>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-briefcase"></i>
                        <span>Transaksi Aset </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="?page=aset">Pengadaan Aset</a></li>
                        <?php
                        if ($_SESSION['level'] == 'Kasubag TU') {
                            ?>
                            <li><a href="?page=validasi&act=belum">Validasi Aset</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="?page=kelompok-aset">Kelompok Aset</a></li>
                        <li><a href="?page=jenis-aset">Jenis Aset</a></li>
                        <li><a href="?page=letak-aset">Mutasi Aset</a></li>
                        <li><a href="?page=penghapusan-aset">Penghapusan Aset</a></li>
                        <li><a href="?page=pemeliharaan-aset">Pemeliharaan Aset</a></li>
                        <li><a href="?page=pemindahtanganan-aset">Pemindahtanganan Aset</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-file"></i>
                        <span> Laporan Aset </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="?page=laporan">Laporan Aset</a></li>
                        <li><a href="?page=penyusutan-per-aset">Penyusutan per Aset</a></li>
                        <li><a href="?page=penyusutan-per-tahun">Penyusutan per Tahun</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-bar-chart-2"></i>
                        <span> Penyusutan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php
                        if ($_SESSION['level'] == 'admin') {
                            ?>
                            <li><a href="?page=validasi-penyusutan">Validasi Penyusutan</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="?page=daftar-penyusutan">Daftar Penyusutan</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
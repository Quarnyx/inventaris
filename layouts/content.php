<?php

switch ($_GET['page'] ?? '') {
    case 'dashboard':
        include "pages/dashboard.php";
        break;
    case '':
        include "pages/dashboard.php";
        break;
    case 'pengguna':
        include "pages/pengguna/index.php";
        break;
    case 'jenis-aset':
        include "pages/jenis-aset/index.php";
        break;
    case 'kelompok-aset':
        include "pages/kelompok-aset/index.php";
        break;
    case 'aset':
        include "pages/aset/index.php";
        break;
    case 'validasi':
        include "pages/validasi/index.php";
        break;
    case 'daftar-penyusutan':
        include "pages/daftar-penyusutan/index.php";
        break;
    case 'validasi-penyusutan':
        include "pages/validasi-penyusutan/index.php";
        break;
    case 'laporan':
        include "pages/laporan/index.php";
        break;
    case 'penyusutan-per-aset':
        include "pages/laporan/penyusutan-per-aset.php";
        break;
    case 'penyusutan-per-tahun':
        include "pages/laporan/penyusutan-per-tahun.php";
        break;
    case 'letak-aset':
        include "pages/letak-aset/index.php";
        break;
    case 'penghapusan-aset':
        include "pages/penghapusan-aset/index.php";
        break;
    case 'pemeliharaan-aset':
        include "pages/pemeliharaan-aset/index.php";
        break;
    default:
        include "pages/404.php";
        break;
}
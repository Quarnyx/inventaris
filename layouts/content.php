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
    default:
        include "pages/404.php";
        break;
}
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
    default:
        include "pages/404.php";
        break;
}
<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'validasi':
        $id = $_POST['id'];
        $status = 'Sudah Validasi';
        $sql = $conn->query("UPDATE jadwal_penyusutan SET validasi = '$status' WHERE id_jadwal = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    default:
        $aksi = 'tambah';
        break;
}
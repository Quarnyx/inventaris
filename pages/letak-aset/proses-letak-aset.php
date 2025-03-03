<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':
        $id_aset = $_POST['id_aset'];
        $letak_aset = $_POST['letak_aset'];
        $keterangan = $_POST['keterangan'];

        $sql = $conn->query("INSERT INTO letak_aset (id_aset, letak_aset, keterangan) VALUES ('$id_aset', '$letak_aset', '$keterangan')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $id_aset = $_POST['id_aset'];
        $letak_aset = $_POST['letak_aset'];
        $keterangan = $_POST['keterangan'];
        $sql = $conn->query("UPDATE letak_aset SET id_aset = '$id_aset', letak_aset = '$letak_aset', keterangan = '$keterangan' WHERE id_letak = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM aset WHERE id_aset = '$id'");
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
<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':

        $nama_kelompok = $_POST['nama_kelompok'];
        $deskripsi = $_POST['deskripsi_kelompok'];

        $sql = $conn->query("INSERT INTO kelompok_aset (nama_kelompok, deskripsi_kelompok) VALUES ('$nama_kelompok', '$deskripsi')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $nama_kelompok = $_POST['nama_kelompok'];
        $deskripsi = $_POST['deskripsi_kelompok'];

        $sql = $conn->query("UPDATE kelompok_aset SET nama_kelompok = '$nama_kelompok', deskripsi_kelompok = '$deskripsi' WHERE id_kelompok = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM kelompok_aset WHERE id_kelompok = '$id'");
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
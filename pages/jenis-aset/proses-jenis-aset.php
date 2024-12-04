<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':

        $nama_jenis = $_POST['nama_jenis'];
        $deskripsi = $_POST['deskripsi_jenis'];

        $sql = $conn->query("INSERT INTO jenis_aset (nama_jenis, deskripsi_jenis) VALUES ('$nama_jenis', '$deskripsi')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $nama_jenis = $_POST['nama_jenis'];
        $deskripsi = $_POST['deskripsi_jenis'];

        $sql = $conn->query("UPDATE jenis_aset SET nama_jenis = '$nama_jenis', deskripsi_jenis = '$deskripsi' WHERE id_jenis = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM jenis_aset WHERE id_jenis = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'ganti-password':
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $sql = $conn->query("UPDATE pengguna SET password = '$password' WHERE id_pengguna = '$id'");
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
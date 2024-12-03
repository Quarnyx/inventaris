<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':

        $nama_pengguna = $_POST['nama_pengguna'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $sql = $conn->query("INSERT INTO pengguna (nama_pengguna, username, password, level) VALUES ('$nama_pengguna', '$username', '$password', '$level')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $aksi = 'edit';
        $id = $_POST['id'];
        $nama_pengguna = $_POST['nama_pengguna'];
        $username = $_POST['username'];
        $level = $_POST['level'];

        $sql = $conn->query("UPDATE pengguna SET nama_pengguna = '$nama_pengguna', username = '$username', level = '$level' WHERE id_pengguna = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM pengguna WHERE id_pengguna = '$id'");
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
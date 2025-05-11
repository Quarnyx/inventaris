<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':

        $id_aset = $_POST['id_aset'];
        $tanggal_pemeliharaan = $_POST['tanggal_pemeliharaan'];
        $jenis_pemeliharaan = $_POST['jenis_pemeliharaan'];
        $biaya = $_POST['biaya'];
        $keterangan = $_POST['keterangan'];

        $sql = $conn->query("INSERT INTO pemeliharaan_aset (id_aset, tanggal_pemeliharaan, jenis_pemeliharaan, biaya, keterangan) VALUES ('$id_aset', '$tanggal_pemeliharaan', '$jenis_pemeliharaan', '$biaya', '$keterangan')");
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
        $tanggal_pemeliharaan = $_POST['tanggal_pemeliharaan'];
        $jenis_pemeliharaan = $_POST['jenis_pemeliharaan'];
        $biaya = $_POST['biaya'];
        $keterangan = $_POST['keterangan'];

        $sql = $conn->query("UPDATE pemeliharaan_aset SET id_aset = '$id_aset', tanggal_pemeliharaan = '$tanggal_pemeliharaan', jenis_pemeliharaan = '$jenis_pemeliharaan', biaya = '$biaya', keterangan = '$keterangan' WHERE id_pemeliharaan = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM pemeliharaan_aset WHERE id_pemeliharaan = '$id'");
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
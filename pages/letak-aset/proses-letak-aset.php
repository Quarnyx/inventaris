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
        $dari_lokasi = $_POST['dari_lokasi'];
        $ke_lokasi = $_POST['ke_lokasi'];
        $keterangan = $_POST['keterangan'];
        $tanggal_mutasi = $_POST['tanggal_mutasi'];
        $sql = $conn->query("UPDATE letak_aset SET id_aset = '$id_aset', letak_aset = '$ke_lokasi', keterangan = '$keterangan' WHERE id_letak = '$id'");
        // tambahkan ke tabel mutasi_aset
        $sql = $conn->query("INSERT INTO mutasi_aset (id_aset, dari_lokasi, ke_lokasi, keterangan, tanggal_mutasi) VALUES ('$id_aset', '$dari_lokasi', '$ke_lokasi', '$keterangan', '$tanggal_mutasi')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM letak_aset WHERE id_letak = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus_mutasi':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM mutasi_aset WHERE id_mutasi = '$id'");
        if ($sql) {
            echo "ok";
        }
        break;
    default:
        $aksi = 'tambah';
        break;
}